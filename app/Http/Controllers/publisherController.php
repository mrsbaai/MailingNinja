<?php

namespace App\Http\Controllers;
use Okipa\LaravelBootstrapTableList\TableList;
use Illuminate\Http\Request;
use App\offer;
use App\country;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Sells;
use App\clicks;
use App\subscribe_log;


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

        $countries = country::pluck('name','code');
        return view('publisher.account')->with('countries',$countries);
    }
    public function dashboard(Request $request){
        $request->user()->authorizeRoles('publisher');

        $table = app(TableList::class)
            ->setModel(Offer::class)
            ->setRoutes([
                'index' => ['alias' => 'publisher-offers', 'parameters' => []],
            ])
            ->addQueryInstructions(function ($query) {
                $query->select('offers.*')
                    ->where('is_private', false);
            });


        $table->addColumn('id')
            ->isSearchable()
            ->isSortable()
            ->setTitle('ID')
            ->sortByDefault();

        $table->addColumn('title')
            ->setTitle('Title')
            ->isSortable()
            ->setStringLimit(25)
            ->isSearchable();


        $table->addColumn('subscribes_a')
            ->setTitle(__('Subscribes'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>". $entity->id . "</b>";
            });

        $table->addColumn('profit_a')
            ->setTitle(__('Today $'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>$". $entity->id . "</b>";
            });


        $table->addColumn('profit_a')
            ->setTitle(__('Life Time $'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>$". $entity->id . "</b>";
            });

        $table->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {
                $preview_route = route('preview', ['id' => $entity->id, 'n' => 'a']);
                $promote_route = route('promote-offer', ['id' => $entity->id]);
                $stats_route = route('offer-stats', ['id' => $entity->id]);
                $download_route = route('offer-subscribed', ['id' => $entity->id]);


                return "
<a class='p-3' target='blank' href='$preview_route' title='Preview Offer'><i class='fas fa-fw fa-eye'></i></a>
<a class='p-3' target='blank' href='$stats_route'  title='Show Offer Statistics'><i class='fas fa-fw fa-chart-bar'></i></a>
<a class='p-3' target='blank' href='$promote_route'  title='Show Promotional Links & Tools'><i class='fas fa-fw fa-link'></i></a>
<a class='p-3' target='blank' href='$download_route'  title='Download Subscribed E-mail List'><i class='fas fa-fw fa-arrow-down'></i></a>
                        
                        ";
            });

        return view('publisher.home')->with('table', $table);

    }
    public function offerSubscribed(Request $request, $id){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.home');
    }
    public function offerStats(Request $request, $id){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.home');
    }
    public function support(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.support');
    }
    public function statistics(Request $request){
        $request->user()->authorizeRoles('publisher');

        $LeadsChart7 = $this->LeadsChart(Auth::user()->id, null, null, 7);
        $LeadsChart30 = $this->LeadsChart(Auth::user()->id, null, null, 30);
        $LeadsChart90 = $this->LeadsChart(Auth::user()->id, null, null, 90);

        $ProfitChart7 = $this->ProfitChart(Auth::user()->id, null, null, 7);
        $ProfitChart30 = $this->ProfitChart(Auth::user()->id, null, null, 30);
        $ProfitChart90 = $this->ProfitChart(Auth::user()->id, null, null, 90);

        $ClickChart7 = $this->ClickChart(Auth::user()->id, null, null, 7);
        $ClickChart30 = $this->ClickChart(Auth::user()->id, null, null, 30);
        $ClickChart90 = $this->ClickChart(Auth::user()->id, null, null, 90);

        $SubscribesChart7 = $this->SubscribesChart(Auth::user()->id, null, null, 7);
        $SubscribesChart30 = $this->SubscribesChart(Auth::user()->id, null, null, 30);
        $SubscribesChart90 = $this->SubscribesChart(Auth::user()->id, null, null, 90);

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
            ->with('LeadsChart90',$LeadsChart90);
    }


    public function offer(Request $request, $id){
        $request->user()->authorizeRoles('publisher');

        $offer = offer::where('id',$id)->first();

        $data['verticals'] = $offer->verticals()->get();
        $data['price'] = $offer->payout;
        $data['title'] = $offer->title;
        $data['promo'] = $offer->promo;
        $data['thumbnail'] = $offer->thumbnail;
        $data['description'] = $offer->description;
        $data['preview'] = route('preview', ['id' => $offer->id, 'n' => 'a']);
        return view('publisher.offer')->with('data',$data);
    }


    public function offers(Request $request){
        $request->user()->authorizeRoles('publisher');

// we instantiate a table list in the news controller
        $table = app(TableList::class)
            ->setModel(Offer::class)
            ->setRoutes([
                'index' => ['alias' => 'publisher-offers', 'parameters' => []],
            ])
            ->addQueryInstructions(function ($query) {
                $query->select('offers.*')
                    ->where('is_private', false);
            });


        $table->addColumn('id')
            ->isSearchable()
            ->isSortable()
            ->setTitle('ID')
            ->sortByDefault();

        $table->addColumn('title')
            ->setTitle('Title')
            ->isSortable()
            ->setStringLimit(25)
            ->isSearchable();


        $table->addColumn('subscribes_a')
            ->setTitle(__('Subscribes'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>". $entity->id . "</b>";
            });

        $table->addColumn('profit_a')
            ->setTitle(__('Today $'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>$". $entity->id . "</b>";
            });


        $table->addColumn('profit_a')
            ->setTitle(__('Life Time $'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>$". $entity->id . "</b>";
            });

        $table->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {
                $preview_route = route('preview', ['id' => $entity->id, 'n' => 'a']);
                $promote_route = route('promote-offer', ['id' => $entity->id]);
                $stats_route = route('offer-stats', ['id' => $entity->id]);
                $download_route = route('offer-subscribed', ['id' => $entity->id]);


                return "
<a class='p-3' target='blank' href='$preview_route' title='Preview Offer'><i class='fas fa-fw fa-eye'></i></a>
<a class='p-3' target='blank' href='$stats_route'  title='Show Offer Statistics'><i class='fas fa-fw fa-chart-bar'></i></a>
<a class='p-3' target='blank' href='$promote_route'  title='Show Promotional Links & Tools'><i class='fas fa-fw fa-link'></i></a>
<a class='p-3' target='blank' href='$download_route'  title='Download Subscribed E-mail List'><i class='fas fa-fw fa-arrow-down'></i></a>
                        
                        ";
            });


        return view('publisher.offers')->with('table',$table);
    }


    public function subscribers(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.subscribers');
    }




    public function test (){
        return "<img src='https://i.imgur.com/PkVkuGF.jpg'/>";

    }

    public function LeadsChart ($user_id = null, $vertical_id = null, $offer_id = null, $days = 30){

        $name = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        $start = Carbon::now()->subDays($days);

        for ($i = 0 ; $i <= $days; $i++) {
            $date = $start->copy()->addDays($i);
            $dates[] = $date->format('d/m');

            $query  = Sells::latest();


            $query->whereMonth('Created_at',$date->format('m'))
                ->whereDay('Created_at',$date->format('d'))
                ->where('is_refund',false)
                ->where('is_for_host',false)
                ->where('Status','Completed');
            if ($user_id){$query->where('user_id' , $user_id);}
            if ($offer_id){$query->where('offer_id' , $offer_id);}
            if ($vertical_id){$query->where('vertical_id' , $vertical_id);}
            $data[] = count($query->get());
        }

        $chartjs = app()->chartjs
            ->name($name)
            ->type('line')
            ->size(['width' => 400, 'height' => 150])
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
            ->options([]);
        return $chartjs;
    }

    public function clickChart ($user_id = null, $vertical_id = null, $offer_id = null, $days = 30){

        $name = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        $start = Carbon::now()->subDays($days);

        for ($i = 0 ; $i <= $days; $i++) {
            $date = $start->copy()->addDays($i);
            $dates[] = $date->format('d/m');

            $query  = clicks::latest();


            $query->whereMonth('Created_at',$date->format('m'))
                ->whereDay('Created_at',$date->format('d'));

            if ($user_id){$query->where('user_id' , $user_id);}
            if ($offer_id){$query->where('offer_id' , $offer_id);}
            if ($vertical_id){$query->where('vertical_id' , $vertical_id);}
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
            ->size(['width' => 400, 'height' => 150])
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
            ->options([]);
        return $chartjs;
    }

    public function ProfitChart ($user_id = null, $vertical_id = null, $offer_id = null, $days = 30){

        $name = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        $start = Carbon::now()->subDays($days);

        for ($i = 0 ; $i <= $days; $i++) {
            $date = $start->copy()->addDays($i);
            $dates[] = $date->format('d/m');

            $query  = Sells::latest();


            $query->whereMonth('Created_at',$date->format('m'))
                ->whereDay('Created_at',$date->format('d'))
                ->where('is_refund',false)
                ->where('is_for_host',false)
                ->where('Status','Completed');
            if ($user_id){$query->where('user_id' , $user_id);}
            if ($offer_id){$query->where('offer_id' , $offer_id);}
            if ($vertical_id){$query->where('vertical_id' , $vertical_id);}
            $collection = $query->get();
            $profit = 0;
            foreach ($collection as $item) {
                $profit = $profit + $item['payedAmount'];
            }

            $data[] = $profit;
        }


        $chartjs = app()->chartjs
            ->name($name)
            ->type('line')
            ->size(['width' => 400, 'height' => 150])
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
            ->options([]);
        return $chartjs;
    }

    public function SubscribesChart ($user_id = null, $vertical_id = null, $offer_id = null, $days = 30){

        $name = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
        $start = Carbon::now()->subDays($days);

        for ($i = 0 ; $i <= $days; $i++) {
            $date = $start->copy()->addDays($i);
            $dates[] = $date->format('d/m');

            $query  = subscribe_log::latest();


            $query->whereMonth('Created_at',$date->format('m'))
                ->whereDay('Created_at',$date->format('d'));

            if ($user_id){$query->where('user_id' , $user_id);}
            if ($offer_id){$query->where('offer_id' , $offer_id);}
            if ($vertical_id){$query->where('vertical_id' , $vertical_id);}
            $collection = $query->get();
            $subscribes = 0;
            $unsubscribes = 0;
            $confirmed = 0;
            foreach ($collection as $item) {
                $subscribes = $subscribes + $item['subscribes'];
                $unsubscribes = $unsubscribes + $item['unsubscribes'];
                $confirmed = $confirmed + $item['confirmed'];
            }

            $data1[] = $subscribes;
            $data2[] = $unsubscribes;
            $data3[] = $confirmed;
        }

        $chartjs = app()->chartjs
            ->name($name)
            ->type('line')
            ->size(['width' => 400, 'height' => 150])
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
            ->options([]);
        return $chartjs;
    }


}
