<?php

namespace App\Http\Controllers;
use App\unsubscribes;
use Okipa\LaravelBootstrapTableList\TableList;
use Illuminate\Http\Request;
use App\offer;
use App\user;
use App\country;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Sells;
use App\clicks;
use App\domain;
use App\subscriber;
use App\vertical;
use App\link;
use App\publisherOffers;
use Illuminate\Support\Facades\Input;
use Response;



class publisherController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function home(Request $request){
        $request->user()->authorizeRoles('publisher');
        return $this->dashboard($request);

    }

    public function account(Request $request){
        $request->user()->authorizeRoles('publisher');

        $user = User::find(Auth::user()->id);
        Auth::setUser($user);

        $countries = country::pluck('name','code');
        return view('publisher.account')->with('countries',$countries);
    }
    public function dashboard(Request $request){
        $request->user()->authorizeRoles('publisher');

        $date = Carbon::now();
        $query  = subscriber::latest();

        $query->where('user_id', Auth::user()->id);
        $data['subscribers_all'] = count($query->get());

        $query->whereMonth('created_at',$date->format('m'))
            ->whereDay('created_at',$date->format('d'));
        $data['subscribers_today'] = count($query->get());

        $query  = sells::latest();
        $query->where('publisher_id', Auth::user()->id)
            ->where('net_amount','>', '0')
            ->where('status','Completed');

        $collection = $query->get();
        $data['leads_all'] = count($collection);

        $profit = 0;
        foreach ($collection as $item) {
            $profit = $profit + $item['net_amount'];
        }
        $data['profit_all'] = $profit;

        $query->whereMonth('created_at',$date->format('m'))
            ->whereDay('created_at',$date->format('d'));
        $collection = $query->get();
        $data['leads_today'] = count($collection);
        $profit = 0;
        foreach ($collection as $item) {
            $profit = $profit + $item['net_amount'];
        }
        $data['profit_today'] = $profit;



        $query  = clicks::latest();
        $query->where('user_id', Auth::user()->id);

        $collection = $query->get();
        $clicks = 0;
        foreach ($collection as $item) {
            $clicks = $clicks + $item['count'];
        }
        $data['clicks_all'] = $clicks;
        $query->whereMonth('created_at',$date->format('m'))
            ->whereDay('created_at',$date->format('d'));

        $collection = $query->get();
        $clicks = 0;
        foreach ($collection as $item) {
            $clicks = $clicks + $item['count'];
        }
        $data['clicks_today'] = $clicks;





        $table = app(TableList::class)
            ->setModel(sells::class)
            ->setRoutes([
                'index' => ['alias' => 'publisher-home', 'parameters' => []],
            ])
            ->addQueryInstructions(function ($query) {
                $query->select('sell_log.*')
                    ->where('publisher_id', Auth::user()->id)
                    ->where('net_amount','>', '0')

                    ->where('status', 'Completed');
            });


        $table->addColumn('created_at')
            ->isSortable()
            ->setTitle('Date')
            ->sortByDefault('desc')
            ->setColumnDateFormat('d/m/Y H:i:s');

        $table->addColumn('net_amount')
            ->setTitle(__('Net Amount'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>$". $entity->net_amount. "</b>";
            });


        $table->addColumn('operation_id')
            ->setTitle('Operation Id')
            ->isSearchable();


        $table->addColumn('offer_id')
            ->setTitle(__('Offer Id'))

            ->isSearchable()
            ->isCustomHtmlElement(function ($entity, $column) {

                $route = route('offer-stats', ['id' => $entity->offer_id]);
                return "<a class='p-3' target='blank' href='$route' title='Show Offer Statistics'>$entity->offer_id</a>";
            });


        return view('publisher.home')->with('table', $table)->with('data',$data);

    }
    public function offerSubscribed(Request $request, $id){
        $request->user()->authorizeRoles('publisher');
        if ($id){
            $query = subscriber::latest();
            $query->where('user_id' , Auth::user()->id);
            $query->where('offer_id' , $id);

            $table = $query->get()->toArray();

            if(count($table) === 0){
                return ("<script LANGUAGE='JavaScript'>window.alert('You have 0 subscribers to this offer.');open(location, '_self').close();</script>");
            }




            $offer_name = offer::where('id',$id)->pluck('title')->first();

            $offer = offer::where('id',$id)->first();
            $verticals = implode("|",$offer->verticals()->pluck('vertical')->toArray());

            $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-type'        => 'text/csv'
                ,   'Content-Disposition' => 'attachment;'
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];


            $filename = "[Offer_$id].csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('E-mail Address', 'Country Code', 'Offer Vertical', 'Offer Name', 'Subscription Date'));

            foreach($table as $row) {

                fputcsv($handle, array($row['email'], $row['country'], $verticals, $offer_name, $row['created_at']));
            }

            fclose($handle);


            return Response::download($filename, $filename, $headers)->deleteFileAfterSend();
        }
        return ("<script LANGUAGE='JavaScript'>window.alert('You have 0 subscribers to this offer.');history.go(-1);</script>");
    }

    public function suppressionList(Request $request, $id){
        $request->user()->authorizeRoles('publisher');
        if ($id){
            $query = unsubscribes::latest();

            //only offer
            //$query->where('offer_id' , $id);


            $table = $query->get()->toArray();



            if(count($table) === 0){
                return ("<script LANGUAGE='JavaScript'>window.alert('Suppression list is empty');open(location, '_self').close();</script>");
            }


            //$offer_name = offer::where('id',$id)->pluck('title')->first();

            //$offer = offer::where('id',$id)->first();
           // $verticals = implode("|",$offer->verticals()->pluck('vertical')->toArray());

            $headers = [
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
                ,   'Content-type'        => 'text/csv'
                ,   'Content-Disposition' => 'attachment;'
                ,   'Expires'             => '0'
                ,   'Pragma'              => 'public'
            ];


            $now = Carbon::now()->format('Y-m-d-H-s');;
            $filename = "[Offer-$id][Suppression][$now].csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('E-mail Address'));

            foreach($table as $row) {

                fputcsv($handle, array(md5($row['email'])));
            }

            fclose($handle);


            return Response::download($filename, $filename, $headers)->deleteFileAfterSend();
        }
        return ("<script LANGUAGE='JavaScript'>window.alert('You have 0 subscribers to this offer.');history.go(-1);</script>");
    }
    public function offerStats(Request $request, $id){
        $request->user()->authorizeRoles('publisher');
        return $this->statistics($request, $id,  null);
    }
    public function support(Request $request){
        $request->user()->authorizeRoles('publisher');

        $manager_id = Auth::user()->manager_id;

        $manager = User::where('id',$manager_id)->first();


        $data['name'] = $manager->name;
        $data['skype'] = $manager->skype;
        $data['phone'] = $manager->phone;
        return view('publisher.support')->with('data',$data);
    }
    public function userStats(request $request){
        $request->user()->authorizeRoles('publisher');
        return $this->statistics($request, null,  Auth::user()->id);
    }
    public function statistics(Request $request, $offer_id = null, $user_id = null){

        if ($offer_id != null){
            $offer = offer::where('id', $offer_id)->first();
            $title = $offer['title'];
        }else{
            if ($user_id != null){
                $user = user::where('id', $user_id)->first();
                $title = $user['name'];
            }else{
                $title = "All Offers";
            }

        }
        $LeadsChart7 = $this->LeadsChart($user_id, null, $offer_id, 7);
        $LeadsChart30 = $this->LeadsChart($user_id, null, $offer_id, 30);
        $LeadsChart90 = $this->LeadsChart($user_id, null, $offer_id, 90);

        $ProfitChart7 = $this->ProfitChart($user_id, null, $offer_id, 7);
        $ProfitChart30 = $this->ProfitChart($user_id, null, $offer_id, 30);
        $ProfitChart90 = $this->ProfitChart($user_id, null, $offer_id, 90);

        $ClickChart7 = $this->ClickChart($user_id, null, $offer_id, 7);
        $ClickChart30 = $this->ClickChart($user_id, null, $offer_id, 30);
        $ClickChart90 = $this->ClickChart($user_id, null, $offer_id, 90);

        $SubscribesChart7 = $this->SubscribesChart($user_id, null, $offer_id, 7);
        $SubscribesChart30 = $this->SubscribesChart($user_id, null, $offer_id, 30);
        $SubscribesChart90 = $this->SubscribesChart($user_id, null, $offer_id, 90);

        return view('publisher.statistics')
            ->with('SubscribesChart7',$SubscribesChart7)
            ->with('SubscribesChart30',$SubscribesChart30)
            ->with('SubscribesChart90',$SubscribesChart90)
            ->with('ClickChart7',$ClickChart7)
            ->with('ClickChart30',$ClickChart30)
            ->with('ClickChart90',$ClickChart90)
            ->with('ProfitChart7',$ProfitChart7)
            ->with('ProfitChart30',$ProfitChart30)
            ->with('ProfitChart90',$ProfitChart90)
            ->with('LeadsChart7',$LeadsChart7)
            ->with('LeadsChart30',$LeadsChart30)
            ->with('LeadsChart90',$LeadsChart90)
            ->with('title', $title);
    }


    public function offerSetPrice(Request $request){
        $price = Input::get('price');
        $offer_id = Input::get('offer_id');
        $user_id = Auth::user()->id;

        $link = Link::where("user_id",$user_id)->where("offer_id",$offer_id)->first();

        $res = $link->update([
            'price' => $price,
        ]);

        if ($res){

            if ($price == 0){
                flash("Offer $offer_id price is set to Free. The costumers will be asked for their E-mail address to get a download link for this product.")->success();

            }else{
                flash("Offer $offer_id price is set to: $$price. The costumers will be asked to pay $$price for this product.")->success();

            }
            }else{
            flash("Unable to change the price!")->error();

        }

        return redirect(route('promote-offer', ['id' => $offer_id]));
    }

    public function offerSubjects ($title, $subtitle, $price){

        $subjects = array();

        if ($price == 0){
            array_push($subjects,"[Free Ebook] $title: $subtitle");
            array_push($subjects,"$title: $subtitle [Only 1 Day Left... Get Your Free Ebook!]");
            array_push($subjects,"Free Ebook: $title");
            array_push($subjects,"Get Free Ebook: $title");
            array_push($subjects,"[Free Ebook] $title");
            array_push($subjects,"[Get Free Ebook] $title: $subtitle");
            array_push($subjects,"$title [Only 1 Day Left... Get Your Free Ebook!]");
            array_push($subjects,"$title [The Early Bird Gets the Worm... Get Your Free Ebook!]");
            array_push($subjects,"$title: $subtitle [The Early Bird Gets the Worm... Get Your Free Ebook!]");
        }else{
            array_push($subjects,"[Ebook] $title: $subtitle");
            array_push($subjects,"Ebook: $title [Special Offer 40% OFF!]");
            array_push($subjects,"[Ebook] $title: $subtitle [Special Offer 40% OFF!]");
            array_push($subjects,"Ebook: $title [Special Offer, Only $$price!]");
            array_push($subjects,"Ebook: $title.");
            array_push($subjects,"[Ebook Download] $title.");
            array_push($subjects,"[Ebook] $title: $subtitle [Special Offer, Only $$price!]");
            array_push($subjects,"Ebook: $title [Special Offer 40% OFF, The Early Bird Gets the Worm!]");
            array_push($subjects,"[Ebook] $title: $subtitle [Special Offer 40% OFF, The Early Bird Gets the Worm!]");

        }



        $return_subjects = array();
        foreach ($subjects as $subject){
        if(strlen($subject) < 78){array_push($return_subjects,$subject);}
        }

        return $return_subjects;


    }



    public function offer(Request $request, $id){

        $request->user()->authorizeRoles('publisher');
        $user_id = Auth::user()->id;

        $link = Link::where("user_id",$user_id)->where("offer_id",$id)->first();


        $offer = offer::where('id',$id)->first();

        if (!$link){
            $url = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
            $price =  $offer->payout;

            $newLink = new Link;
            $newLink->offer_id = $id;
            $newLink->user_id = $user_id;
            $newLink->price = $price;
            $newLink->link = $url;
            $newLink->save();
        }else{
            $url = $link->link;
            $price = $link->price;
        }

        //$domain  = domain::all()->sortByDesc("created_at")->where('status',"Active")->where('type',"Promotional")->first();


        $data['subjects']  = $this->offerSubjects($offer->title, $offer->subtitle, $price);
        $data['domain']  = config('app.promote_url');

        $data['verticals'] = $offer->verticals()->get();
        $data['price'] = $price;
        $data['link'] = $url;
        $data['title'] = $offer->title;
        $data['subtitle'] = $offer->subtitle;
        $data['author_name'] = $offer->author_name;
        $data['promo'] = $offer->promo;
        $data['thumbnail'] = $offer->thumbnail;
        $data['description'] = $offer->description;
        $data['about_1'] = $offer->book_about_1;
        $data['offer_id'] = $id;
        $data['preview'] = route('preview', ['id' => $offer->id]);
        $data['suppression'] = route('suppression-list', ['id' => $offer->id]);
        return view('publisher.offer')->with('data',$data);
    }


    public function offers(Request $request){
        $request->user()->authorizeRoles('publisher');

        $this->refreshCPC();
        $table = app(TableList::class)
            ->setModel(Offer::class)
            ->setRoutes([
                'index' => ['alias' => 'publisher-offers', 'parameters' => []],
            ])
            ->addQueryInstructions(function ($query) {
                $query
                    ->select('offers.*')
                    ->where('is_active',true);

            });


        $table->addColumn('id')
            ->isSearchable()
            ->isSortable()
            ->setTitle('ID')
            ->isCustomHtmlElement(function ($entity, $column) {
                return $entity->id;

            });

        $table->addColumn('title')
            ->setTitle('Offer')
            ->isSearchable()
            ->isCustomHtmlElement(function ($entity, $column) {

                $promote_route = route('promote-offer', ['id' => $entity->id]);
                $return = "<b><a href='$promote_route' target='blank'>". $entity->title . "</a></b>";
                if ($entity->is_private == true){
                    if(publisherOffers::where('publisher_id', Auth::user()->id)->where('offer_id', $entity->id)->first()){
                        return $return;
                    }else{
                        return $entity->title;
                    }
                }else{
                    return $return;
                }

            });


        $table->addColumn('')
            ->setTitle(__('Subscribes'))
            ->isCustomHtmlElement(function ($entity, $column) {
                $query  = subscriber::latest();
                $query->where('user_id', Auth::user()->id)->where('offer_id', $entity->id);
                $return = "<b>".  count($query->get()) . "</b>";
                if ($entity->is_private == true){
                    if(publisherOffers::where('publisher_id', Auth::user()->id)->where('offer_id', $entity->id)->first()){
                        return $return;
                    }else{
                        return "Disabled";
                    }
                }else{
                    return $return;
                }
            });
        $table->addColumn('cpc')
            ->isSortable()
            ->setTitle('EPC')
            ->isCustomHtmlElement(function ($entity, $column) {
                $return =  $entity->cpc;
                if ($return ==  0){$return = "-";}
                if ($entity->is_private == true){
                    if(publisherOffers::where('publisher_id', Auth::user()->id)->where('offer_id', $entity->id)->first()){
                        return $return;
                    }else{
                        return "Disabled";
                    }
                }else{
                    return $return;
                }

            })
            ->sortByDefault('desc');


        $table->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {

                $preview_route = route('preview', ['id' => $entity->id]);
                $promote_route = route('promote-offer', ['id' => $entity->id]);
                $stats_route = route('offer-stats', ['id' => $entity->id]);
                $download_route = route('offer-subscribed', ['id' => $entity->id]);

                $return =   "
<a class='p-3' target='_blank' href='$preview_route' title='Preview Offer'><i class='fas fa-fw fa-eye'></i></a>
<a class='p-3' target='_blank' href='$stats_route'  title='Show Offer Statistics'><i class='fas fa-fw fa-chart-bar'></i></a>
<a class='p-3' target='_blank' href='$promote_route'  title='Show Promotional Links & Tools'><i class='fas fa-fw fa-link'></i></a>
<a class='p-3' target='_blank' href='$download_route'  title='Download Subscribed E-mail List'><i class='fas fa-fw fa-arrow-down'></i></a>
                        
                        ";

                if ($entity->is_private == true){
                    if(publisherOffers::where('publisher_id', Auth::user()->id)->where('offer_id', $entity->id)->first()){
                        return $return;
                    }else{
                        return "Disabled";
                    }
                }else{
                    return $return;

                }


            });


        return view('publisher.offers')->with('table',$table);
    }


    public function subscribers(Request $request){
        $request->user()->authorizeRoles('publisher');
        $verticals = vertical::pluck('vertical', 'id');
        $countries = country::pluck('name', 'code');


        $query = subscriber::latest();
        $query->where('user_id' , Auth::user()->id);

        $all_subscribes =  count($query->get());

        $query->whereMonth('created_at',Carbon::now()->format('m'))
            ->whereDay('created_at',Carbon::now()->format('d'));
        $subscribes_today =  count($query->get());


        return view('publisher.subscribers')
            ->with('verticals',$verticals)
            ->with('countries',$countries)
            ->with('subscribes_today',$subscribes_today)
            ->with('all_subscribes',$all_subscribes);
    }

    public function downloadSubscribers(Request $request){


        $request->user()->authorizeRoles('publisher');


        $now = Carbon::now()->format('Y-m-d-H-s');;
        $filename = "[$now].CSV";

        $country = Input::get('country');
        $vertical = Input::get('vertical');
        $period = Input::get('period');
        $confirmed = Input::get('confirmed');
        $type = Input::get('type');
        $filter = Input::get('filter');

        //return $country . $vertical . $period. $confirmed;
        $query = subscriber::latest();

        $query->where('user_id' , Auth::user()->id);

        if ($type){ $query->where('type' , $type);}

        if ($filter){$query->where('email', 'LIKE', '%'.$filter.'%');}



        if ($vertical){

            $query_vertical = vertical::where('id', $vertical)->first();
            $vname =  $query_vertical['vertical'];

            $filename = "[$vname]$filename";
            $offers_ids = $query_vertical->offers()->pluck('offer_id');


            if($offers_ids->count() !== 0){
                $query->whereIn('offer_id' , $offers_ids);
            }else{
                return ("<script LANGUAGE='JavaScript'>window.alert('You have 0 subscribers to this vertical.');history.go(-1);</script>");
            }
        }


       if ($period){
           $filename = "[$period Days]$filename";
           $start = Carbon::now()->subDays($period);
           $now = Carbon::now();
           $query->whereBetween('created_at', [$start, $now])->get();
       }

        if ($country){
            $query->where('country' , $country);
            $filename = "[$country]$filename";
        }
        if ($confirmed){ $query->where('is_confirmed' , $confirmed);}


        $table = $query->get()->toArray();

        if(count($table) === 0){
            return ("<script LANGUAGE='JavaScript'>window.alert('You have 0 subscribers with these options.');history.go(-1);</script>");
        }


        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment;'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];




        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('E-mail Address', 'Country Code', 'Offer Vertical', 'Offer Name', 'Subscription Date'));

        foreach($table as $row) {

            $offer_name = offer::where('id',$row['offer_id'])->pluck('title')->first();
            $offer = offer::where('id',$row['offer_id'])->first();

            if ($offer != null){
                $verticals = implode("|",$offer->verticals()->pluck('vertical')->toArray());
            }else{
                $verticals = "";
            }





            fputcsv($handle, array($row['email'], $row['country'], $verticals, $offer_name, $row['created_at']));
        }

        fclose($handle);


        return Response::download($filename, $filename, $headers)->deleteFileAfterSend();

        //return Redirect::back();
    }



    public function refreshCPC (){
        $offers = offer::all();

        foreach ($offers as $offer){
            $offer_clicks = 0;
            $offer_volume = 0;
            $click_log_entries = clicks::all()->where('offer_id',$offer['id']);
            $sell_log_entries = Sells::all()->where('offer_id',$offer['id'])->where('status','Completed');

            foreach ($click_log_entries as $click_log){
                $offer_clicks = $offer_clicks + $click_log['count'];
            }

            foreach ($sell_log_entries as $sell_log){
                $offer_volume = $offer_volume + $sell_log['net_amount'];
            }

            if ($offer_volume !== 0 and $offer_clicks !== 0){
                $offer_cpc = $offer_volume / $offer_clicks;
            }else{
                $offer_cpc = 0;
            }
            $offer_cpc = number_format((float)$offer_cpc, 2, '.', '');


            $res = $offer->update([
                'cpc' => $offer_cpc,
            ]);

        }

    }


    public function LeadsChart ($user_id = null, $vertical_id = null, $offer_id = null, $days = 30){

        $name = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        $start = Carbon::now()->subDays($days);

        for ($i = 0 ; $i <= $days; $i++) {
            $date = $start->copy()->addDays($i);
            $dates[] = $date->format('d/m');

            $query  = Sells::latest();


            $query->whereMonth('created_at',$date->format('m'))
                ->whereDay('created_at',$date->format('d'))
                ->where('net_amount','>', '0')
                ->where('status','Completed');
            if ($user_id){$query->where('publisher_id' , $user_id);}
            if ($offer_id){$query->where('offer_id' , $offer_id);}
            if ($vertical_id){$query->where('vertical_id' , $vertical_id);}
            $data[] = count($query->get());
        }

        $chartjs = app()->chartjs
            ->name($name)
            ->type('line')
            ->size(['width' => 350, 'height' => 150])
            ->labels($dates)
            ->datasets([
                [
                    "label" => "Lead Count",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data,
                ],
            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'precision' => 0,

                            ]
                        ]
                    ]
                ]
            ]);
        return $chartjs;
    }

    public function clickChart ($user_id = null, $vertical_id = null, $offer_id = null, $days = 30){

        $name = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        $start = Carbon::now()->subDays($days);

        for ($i = 0 ; $i <= $days; $i++) {
            $date = $start->copy()->addDays($i);
            $dates[] = $date->format('d/m');

            $query  = clicks::latest();


            $query->whereMonth('created_at',$date->format('m'))
                ->whereDay('created_at',$date->format('d'));

            if ($user_id){$query->where('user_id' , $user_id);}
            if ($offer_id){$query->where('offer_id' , $offer_id);}
            $collection = $query->get();
            $clicks = 0;
            foreach ($collection as $item) {
                $clicks = $clicks + $item['count'];
            }

            $data[] = $clicks;
        }

        $chartjs = app()->chartjs
            ->name($name)
            ->type('line')
            ->size(['width' => 350, 'height' => 150])
            ->labels($dates)
            ->datasets([
                [
                    "label" => "Clicks",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data,
                ],
            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'precision' => 0,
                            ]
                        ]
                    ]
                ]
            ]);
        return $chartjs;
    }

    public function ProfitChart ($user_id = null, $vertical_id = null, $offer_id = null, $days = 30){

        $name = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        $start = Carbon::now()->subDays($days);

        for ($i = 0 ; $i <= $days; $i++) {
            $date = $start->copy()->addDays($i);
            $dates[] = $date->format('d/m');

            $query  = Sells::latest();


            $query->whereMonth('created_at',$date->format('m'))
                ->whereDay('created_at',$date->format('d'))
                ->where('net_amount','>', '0')
                ->where('status','Completed');
            if ($user_id){$query->where('publisher_id' , $user_id);}
            if ($offer_id){$query->where('offer_id' , $offer_id);}
            if ($vertical_id){$query->where('vertical_id' , $vertical_id);}
            $collection = $query->get();
            $profit = 0;
            foreach ($collection as $item) {
                $profit = $profit + $item['net_amount'];
            }

            $data[] = $profit;
        }


        $chartjs = app()->chartjs
            ->name($name)
            ->type('line')
            ->size(['width' => 350, 'height' => 150])
            ->labels($dates)
            ->datasets([
                [
                    "label" => "Profit ($)",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data,
                ],
            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'precision' => 0,
                            ]
                        ]
                    ]
                ]
            ]);
        return $chartjs;
    }

    public function SubscribesChart ($user_id = null, $vertical_id = null, $offer_id = null, $days = 30){

        $name = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        $start = Carbon::now()->subDays($days);

        for ($i = 0 ; $i <= $days; $i++) {
            $date = $start->copy()->addDays($i);
            $dates[] = $date->format('d/m');

            $query1 = subscriber::latest();
            $query2 = unsubscribes::latest();


            $query1->whereMonth('created_at',$date->format('m'))
                ->whereDay('created_at',$date->format('d'));
            $query2->whereMonth('created_at',$date->format('m'))
                ->whereDay('created_at',$date->format('d'));

            if ($user_id){
                $query1->where('user_id' , $user_id);
                $query2->where('user_id' , $user_id);
            }
            if ($offer_id){
                $query1->where('offer_id' , $offer_id);
                $query2->where('offer_id' , $offer_id);
            }

            $data1[] =  count($query1->get());
            $data2[] = count($query2->get());


            $query3 = $query1->where('is_confirmed',true);
            $data3[] =  count($query3->get());
        }

        $chartjs = app()->chartjs
            ->name($name)
            ->type('line')
            ->size(['width' => 350, 'height' => 150])
            ->labels($dates)
            ->datasets([
                [
                    "label" => "Subscribes",
                    'backgroundColor' => "rgba(200, 200, 154, 0.31)",
                    'borderColor' => "rgba(200, 200, 154, 0.7)",
                    "pointBorderColor" => "rgba(200, 200, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(200, 200, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data1,
                ],
                [
                    "label" => "Unsubscribes",
                    'backgroundColor' => "rgba(10, 10, 154, 0.31)",
                    'borderColor' => "rgba(10, 10, 154, 0.7)",
                    "pointBorderColor" => "rgba(10, 10, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(10, 10, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data2,
                ],
                [
                    "label" => "Confirmed",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $data3,
                ],
            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'precision' => 0,

                            ]
                        ]
                    ]
                ]
            ]);
        return $chartjs;
    }



}
