<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\offer;
use App\user;
use App\vertical;
use Okipa\LaravelBootstrapTableList\TableList;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\country;
use App\publisherOffers;
use Carbon\Carbon;
use App\subscriber;
use App\sells;
use App\clicks;
use Illuminate\Support\Facades\Log;
class managerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    private function prossHTML($content){
        $dom = new \domdocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
           // list($type, $data) = explode(';', $data);
           // list(, $data)      = explode(',', $data);

            $image_url = Imgur::upload($data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_url);
        }
        return $dom->savehtml();
    }
    public function storeOffer(Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destination_path = public_path('/thumbnails');
            $image->move($destination_path, $name);
            $thumbnail = "/thumbnails/" . $name;
        }else{
            $thumbnail = null;
        }
        if ($request->is_private == "on"){$is_private = 1;}else{$is_private = 0;}
        $offer = new offer;

        $offer->manager_id = Auth::user()->id;
        $offer->title = $request->title;
        $offer->subtitle = $request->subtitle;
        $offer->thumbnail = $thumbnail;
        $offer->is_private = $is_private;
        $offer->payout = $request->payout;
        if(!$offer->save()){
            flash("Error creating: " . $request->title)->error();
            return back()->withInput();
        }else{
            $offer->verticals()->sync($request->get('verticals'));
            flash("Created: " . $request->title)->success();
            return Redirect::route('offers-edit', $offer->id);
        }
    }
    public function updateOffer(Request $request)
    {
        $offer = offer::find($request->id);
        $product_name = $request->id;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $thumbnail = Imgur::upload($image);
        }else{
            $thumbnail = $offer->thumbnail;
        }

        if ($request->hasFile('product')) {
            $product = $request->file('product');
            Storage::disk('dropbox')->delete($product_name);
            Storage::disk('dropbox')->put($product_name, $product);
        }
        if ($request->is_private == "on"){$is_private = 1;}else{$is_private = 0;}

        $res = $offer->update([
            'thumbnail' => $thumbnail,
            'title' => $request->title,
            'color' => $request->color,
            'description' => $request->description,
            'is_private' => $is_private,
            'payout' => $request->payout,
            'cpc' => $request->cpc,
            'cpa' => $request->cpa,
            'subtitle' =>  $request->subtitle,
            'image_1' =>  $request->image_1,
            'image_2' =>  $request->image_2,
            'image_3' =>  $request->image_3,
            'image_4' =>  $request->image_4,
            'image_5' =>  $request->image_5,
            'image_6' =>  $request->image_6,
            'image_7' =>  $request->image_7,
            'image_8' =>  $request->image_8,
            'image_9' =>  $request->image_9,
            'cover' =>  $request->cover,
            'author_image' =>  $request->author_image,
            'review_name_1' =>  $request->review_name_1,
            'review_content_1' =>  $request->review_content_1,
            'review_name_2' =>  $request->review_name_2,
            'review_content_2' =>  $request->review_content_2,
            'review_name_3' =>  $request->review_name_3,
            'review_content_3' =>  $request->review_content_3,
            'review_name_4' =>  $request->review_name_4,
            'review_content_4' =>  $request->review_content_4,
            'review_name_5' =>  $request->review_name_5,
            'review_content_5' =>  $request->review_content_5,
            'review_name_6' =>  $request->review_name_6,
            'review_content_6' =>  $request->review_content_6,
            'author_name' =>  $request->author_name,
            'author_about' =>  $request->author_about,
            'book_about_1' =>  $request->book_about_1,
            'book_about_2' =>  $request->book_about_2,
            'book_about_3' =>  $request->book_about_3,
        ]);
        $offer->verticals()->sync($request->get('verticals'));
        if ($res){
            flash("Updated: " . $request->title)->success();
        }else{
            flash("Error Updating: " . $request->title)->error();
        }
        return Redirect::route('offers-edit', $offer->id);
    }
    public function globalOfferActivate(Request $request){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_admin == false){
            return Redirect::route('offers-manage');
        }

        $offer = offer::find($request->offer_id);
        $res = $offer->update([
            'is_active' => true,
        ]);
        if ($res){
            flash("Offer 'ID: $request->offer_id' Activated.")->success();
        }else{
            flash("Error Activating offer 'ID: $request->offer_id'.")->error();
        }
        return Redirect::route('manager-dashboard');

    }
    public function home(Request $request){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_admin == false){
            return Redirect::route('offers-manage');
        }
        $date = Carbon::now();
        $query  = subscriber::latest();

        $data['subscribers_all'] = count($query->get());

        $query->whereMonth('Created_at',$date->format('m'))
            ->whereDay('Created_at',$date->format('d'));
        $data['subscribers_today'] = count($query->get());

        $query  = sells::latest();
        $query
            ->where('publisher_id','<>',config('app.main_publisher'))
            ->where('net_amount','>','0')
            ->where('status','Completed');



        $query->whereMonth('Created_at',$date->format('m'))
            ->whereDay('Created_at',$date->format('d'));
        $collection = $query->get();
        $data['leads_today'] = count($collection);
        $profit = 0;
        foreach ($collection as $item) {
            $profit = $profit + $item['payedAmount'];
        }
        $data['profit_today'] = $profit;

        $query  = sells::latest();
        $query
            ->where('publisher_id',config('app.main_publisher'))
            ->where('net_amount','>','0')
            ->where('status','Completed');


        $query->whereMonth('Created_at',$date->format('m'))
            ->whereDay('Created_at',$date->format('d'));
        $collection = $query->get();
        $data['leads_today_house'] = count($collection);
        $profit = 0;
        foreach ($collection as $item) {
            $profit = $profit + $item['payedAmount'];
        }
        $data['profit_today_house'] = $profit;

        $query  = clicks::latest();
        $collection = $query->get();
        $clicks = 0;
        foreach ($collection as $item) {
            $clicks = $clicks + $item['count'];
        }
        $data['clicks_all'] = $clicks;
        $query->whereMonth('Created_at',$date->format('m'))
            ->whereDay('Created_at',$date->format('d'));

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
                    ->where('net_amount', '>', '0')
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

                $route = route('global-offer-stats', ['id' => $entity->offer_id]);
                return "<a class='p-3' target='blank' href='$route' title='Show Offer Statistics'>$entity->offer_id</a>";
            });

        $table->addColumn('publisher_id')
            ->setTitle(__('Publisher Id'))

            ->isSearchable()
            ->isCustomHtmlElement(function ($entity, $column) {

                $route = route('publisher-stats', ['id' => $entity->publisher_id]);
                return "<a class='p-3' target='blank' href='$route' title='Show Offer Statistics'>$entity->publisher_id</a>";
            });



        $table->addColumn('costumer_id')
            ->setTitle('costumer_id')
            ->setStringLimit(10)
            ->isSearchable();


        /// pending offers table
        ///
        $table2 = app(TableList::class)
            ->setModel(Offer::class)
            ->setRoutes([
                'index' => ['alias' => 'offers-manage', 'parameters' => []],
                'create'     => ['alias' => 'offers-new', 'parameters' => []],
                'edit'       => ['alias' => 'offers-edit', 'parameters' => []],
                'destroy'    => ['alias' => 'offers-destroy', 'parameters' => []],
            ]);

            $table2->addQueryInstructions(function ($query) {
                $query->select('offers.*')
                    ->where('is_active', false);
            });

// we add some columns to the table list
        $table2->addColumn('id')
            ->isSearchable()
            ->isSortable()
            ->setTitle('id');
        $table2->addColumn('title')
            ->setTitle('Title')
            ->isSortable()
            ->setStringLimit(20)
            ->isSearchable()
            ->useForDestroyConfirmation();

        $table2->addColumn('is_private')
            ->isSortable()
            ->setTitle('P?');
        $table2->addColumn('')
            ->setTitle('Status')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->is_active){
                    return "<span style='color:green'>[ACTIVE]</span>";
                }else{
                    return "<span style='color:gray'>[PENDING]</span>";
                }

            });

        $table2->addColumn('TYPE')

            ->setTitle('TYPE')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->cpc > 0){
                    Return "CPC";
                }elseif ($entity->cpa > 0){
                    Return "CPA";
                }else{
                    Return "-";
                }

            });

        $table2->addColumn('PAYOUT')
            ->setTitle('PAYOUT')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->cpc > 0){
                    Return $entity->cpc;
                }elseif ($entity->cpa > 0){
                    Return $entity->cpa;
                }else{
                    Return "-";
                }

            });

        $table2->addColumn('payout')
            ->setTitle('Price');

        $table2->addColumn('updated_at')
            ->setTitle('Last Update')
            ->isSortable()
            ->sortByDefault()
            ->isCustomHtmlElement(function ($entity, $column) {
                return $this->nicetime($entity->updated_at) ;
            });

        $table2->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {

                $activate_route = route('global-offer-activate', ['offer_id' => $entity->id]);
                return  "<a class='p-3' target='blank' href='$activate_route'  title='Activate'><h2>Activate</h2></a>";
            });
        $table2->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {

                $preview_route = route('preview', ['offer_id' => $entity->id]);
                return  "<a class='p-3' target='blank' href='$preview_route'  title='Preview Offer'><i class='fas fa-fw fa-eye'></i></a>";
            });


        return view('manager.home')->with('table', $table)->with('table2', $table2)->with('data',$data);;
    }

    public function globalOfferStats(Request $request, $offer_id){
        $request->user()->authorizeRoles('manager');
        $publisherController = new publisherController;
        return $publisherController->statistics($request, $offer_id,  null);

    }
    public function globalStats(Request $request){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_admin == false){
            return Redirect::route('offers-manage');
        }
        $publisherController = new publisherController;
        return $publisherController->statistics($request, null,  null);

    }
    public function account(Request $request){
        $request->user()->authorizeRoles('manager');

        $countries = country::pluck('name','code');
        $user = User::find(Auth::user()->id);
        Auth::setUser($user);
        return view('publisher.account')->with('countries',$countries);
    }
    public function new(Request $request){
        $verticals = vertical::pluck('vertical','id');
        $request->user()->authorizeRoles('manager');
        return view('manager.offer-editor')->with('color',"green")->with('thumbnail',"../images/ebook.png")->with('verticals',$verticals);
    }
    private function nicetime($date)
    {
        if(empty($date)) {
            return "No date provided";
        }
        $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths         = array("60","60","24","7","4.35","12","10");
        date_default_timezone_set("UTC");
        $now             = time();
        $unix_date         = strtotime($date);
        if(empty($unix_date)) {
            return "Bad date";
        }
        if($now > $unix_date) {
            $difference     = $now - $unix_date;
            $tense         = "ago";
        } else {
            $difference     = $unix_date - $now;
            $tense         = "from now";
        }
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if($difference != 1) {
            $periods[$j].= "s";
        }
        return "$difference $periods[$j] {$tense}";
    }
    public function offers(Request $request){
        $request->user()->authorizeRoles('manager');
// we instantiate a table list in the news controller
        $table = app(TableList::class)
            ->setModel(Offer::class)
            ->setRoutes([
                'index' => ['alias' => 'offers-manage', 'parameters' => []],
                'create'     => ['alias' => 'offers-new', 'parameters' => []],
                'edit'       => ['alias' => 'offers-edit', 'parameters' => []],
                'destroy'    => ['alias' => 'offers-destroy', 'parameters' => []],
            ]);

        if (Auth::user()->is_admin == false){
            $table->addQueryInstructions(function ($query) {
                $query->select('offers.*')
                    ->where('manager_id', Auth::user()->id);
            });
        }

// we add some columns to the table list
        $table->addColumn('id')
            ->isSearchable()
            ->isSortable()
            ->setTitle('id');
        $table->addColumn('title')
            ->setTitle('Title')
            ->isSortable()
            ->setStringLimit(20)
            ->isSearchable()
            ->useForDestroyConfirmation();

        $table->addColumn('is_private')
            ->isSortable()
            ->setTitle('P?');
        $table->addColumn('')
            ->setTitle('Status')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->is_active){
                    return "<span style='color:green'>[ACTIVE]</span>";
                }else{
                    return "<span style='color:gray'>[PENDING]</span>";
                }

            });

        $table->addColumn('TYPE')

            ->setTitle('TYPE')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->cpc > 0){
                    Return "CPC";
                }elseif ($entity->cpa > 0){
                    Return "CPA";
                }else{
                    Return "-";
                }

            });

        $table->addColumn('PAYOUT')
            ->setTitle('PAYOUT')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->cpc > 0){
                    Return $entity->cpc;
                }elseif ($entity->cpa > 0){
                    Return $entity->cpa;
                }else{
                    Return "-";
                }

            });

        $table->addColumn('payout')
            ->setTitle('Price');

        $table->addColumn('updated_at')
            ->setTitle('Last Update')
            ->isSortable()
            ->sortByDefault()
            ->isCustomHtmlElement(function ($entity, $column) {
                return $this->nicetime($entity->updated_at) ;
            });

        if (Auth::user()->is_admin == true){
            $table->addColumn()
                ->setTitle(__(' '))
                ->isCustomHtmlElement(function ($entity, $column) {

                    $stats_route = route('global-offer-stats', ['offer_id' => $entity->id]);
                    return  "<a class='p-3' target='blank' href='$stats_route'  title='Show Offer Statistics'><i class='fas fa-fw fa-chart-bar'></i></a>";
                });

        }

        $table->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {

                $preview_route = route('preview', ['offer_id' => $entity->id]);
                return  "<a class='p-3' target='blank' href='$preview_route'  title='Preview Offer'><i class='fas fa-fw fa-eye'></i></a>";
            });

        return view('manager.offers')->with('table',$table);
    }
    public function destroyOffer(Request $request){
        $request->user()->authorizeRoles('manager');
        $res = offer::where('id',$request->id)->delete();
        if ($res){
            flash("Offer deleted!")->success();
        }else{
            flash("Error deleting offer!")->error();
        }

        return $this->offers($request);
    }
    public function destroyPublisherOffer(Request $request, $publisher_id,$id){
        $request->user()->authorizeRoles('manager');


        $res = publisherOffers::where('id',$request->id)->delete();
        if ($res){
            flash("Offer deleted!")->success();
        }else{
            flash("Error deleting offer!")->error();
        }
        return Redirect::route('publisher-private-offers', $publisher_id);
    }
    public function edit(Request $request, $id){
        $verticals = vertical::pluck('vertical','id');
        $request->user()->authorizeRoles('manager');
        $offer = offer::all()->where('id',$id)->first();
        $selected_verticals = $offer->verticals()->get();
        return view('manager.offer-editor')
            ->with('verticals',$verticals)
            ->with('color',$offer->color)
            ->with('title', $offer->title)
            ->with('is_private', $offer->is_private)
            ->with('description', $offer->description)
            ->with('payout', $offer->payout)
            ->with('cpc', $offer->cpc)
            ->with('cpa', $offer->cpa)
            ->with('id', $id)
            ->with('thumbnail', $offer->thumbnail)
            ->with('selected_verticals', $selected_verticals)
            ->with('subtitle', $offer->subtitle)
            ->with('image_1', $offer->image_1)
            ->with('image_2', $offer->image_2)
            ->with('image_3', $offer->image_3)
            ->with('image_4', $offer->image_4)
            ->with('image_5', $offer->image_5)
            ->with('image_6', $offer->image_6)
            ->with('image_7', $offer->image_7)
            ->with('image_8', $offer->image_8)
            ->with('image_9', $offer->image_9)
            ->with('cover', $offer->cover)
            ->with('author_image', $offer->author_image)
            ->with('review_name_1', $offer->review_name_1)
            ->with('review_content_1', $offer->review_content_1)
            ->with('review_name_2', $offer->review_name_2)
            ->with('review_content_2', $offer->review_content_2)
            ->with('review_name_3', $offer->review_name_3)
            ->with('review_content_3', $offer->review_content_3)
            ->with('review_name_4', $offer->review_name_4)
            ->with('review_content_4', $offer->review_content_4)
            ->with('review_name_5', $offer->review_name_5)
            ->with('review_content_5', $offer->review_content_5)
            ->with('review_name_6', $offer->review_name_6)
            ->with('review_content_6', $offer->review_content_6)
            ->with('author_name', $offer->author_name)
            ->with('author_about', $offer->author_about)
            ->with('book_about_1', $offer->book_about_1)
            ->with('book_about_2', $offer->book_about_2)
            ->with('book_about_3', $offer->book_about_3)

            ;
    }
    public function editLanding(Request $request, $id, $n){
        $request->user()->authorizeRoles('manager');
        $offer = offer::all()->where('id',$id)->first();
        if ($n == 'a'){
            $landing = $offer->landing_a;
        }else{
            $landing = $offer->landing_b;
        }
        return view('manager.offer-editor-content')->with('landing', $landing)->with('n', $n)->with('id', $id);
    }
    public function editPromo(Request $request, $id){
        $request->user()->authorizeRoles('manager');
        $offer = offer::all()->where('id',$id)->first();
        return view('manager.offer-editor-promo')->with('promo', $offer->promo)->with('id', $id);
    }
    public function updateLanding(Request $request)
    {
        $request->user()->authorizeRoles('manager');
        $offer = offer::find($request->id);
        if ($request->n == "a"){
            $res = $offer->update([
                'landing_a' => $this->prossHTML($request->landing),
                'profit_a' => 0,
                'profit_b' => 0,
                'subscribes_a' => 0,
                'subscribes_b' => 0,
            ]);
        }else {
            $res = $offer->update([
                'landing_b' => $this->prossHTML($request->landing),
                'profit_a' => 0,
                'profit_b' => 0,
                'subscribes_a' => 0,
                'subscribes_b' => 0,
            ]);
        }
        if ($res){
            flash("Offer 'ID: $request->id' Updated.")->success();
        }else{
            flash("Error updating offer 'ID: $request->id'.")->error();
        }
        return view('manager.offer-editor-content')->with('landing', $request->landing)->with('n', $request->n)->with('id', $request->id);
    }
    public function updatePromo(Request $request)
    {
        $request->user()->authorizeRoles('manager');
        $offer = offer::find($request->id);
        $res = $offer->update([
            'promo' => $this->prossHTML($request->promo),
        ]);
        if ($res){
            flash("Offer 'ID: $request->id' Updated.")->success();
        }else{
            flash("Error updating offer 'ID: $request->id'.")->error();
        }
        return view('manager.offer-editor-promo')->with('promo', $request->promo)->with('id', $request->id);
    }
    public function destroyPublisher(Request $request){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_offer_manager == true){
            return Redirect::route('offers-manage');
        }
        $res = user::where('id',$request->id)->delete();
        if ($res){
            flash("Publisher deleted!")->success();
        }else{
            flash("Error deleting publisher!")->error();
        }
        return $this->publishers($request);
    }
    public function publishers(Request $request){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_offer_manager == true){
            return Redirect::route('offers-manage');
        }
        $table = app(TableList::class)
            ->setModel(user::class)
            ->setRoutes([
                'index' => ['alias' => 'manage-publishers', 'parameters' => []],
                'edit'       => ['alias' => 'edit-publisher', 'parameters' => []],
                'destroy'    => ['alias' => 'publisher-destroy', 'parameters' => []],
            ])
            ->addQueryInstructions(function ($query) {
                $query->select('users.*')
                    ->where('manager_id', Auth::user()->id);
            });
        $table->addColumn('id')
            ->useForDestroyConfirmation()
            ->isSearchable()
            ->isSortable()
            ->setTitle('id');

        $table->addColumn('name')
            ->useForDestroyConfirmation()
            ->isSearchable()
            ->isSortable()
            ->setTitle('Company');
        $table->addColumn("created_at")
            ->sortByDefault('desc')
            ->isSearchable()
            ->setTitle('signed up')
            ->isCustomHtmlElement(function ($entity, $column) {
                return $this->nicetime($entity->created_at);
            });

        $table->addColumn()
            ->setTitle('Activation')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->is_active){
                    $a_route = route('publisher-status', ['id' => $entity->id,'status' => "0"]);
                    return "<a class='btn btn-danger btn-sm' href='$a_route' onclick='return confirm(\"Are you sure you want to BLOCK this publisher and send an AUTOMATIC EMAIL? \")'>Deactivate</a>";
                }else{
                    $a_route = route('publisher-status', ['id' => $entity->id,'status' => "1"]);
                    return "<a class='btn btn-primary btn-sm' href='$a_route' onclick='return confirm(\"Are you sure you want to ACTIVATE this publisher and send an AUTOMATIC EMAIL? \")'>Activate</a>";
                }
            });

        $table->addColumn()
            ->setTitle(__('Stats/Offers'))
            ->isCustomHtmlElement(function ($entity, $column) {
                $offers_route = route('publisher-private-offers', ['id' => $entity->id]);
                $stats_route = route('publisher-stats', ['id' => $entity->id]);

                return "
<a class='p-3' target='blank' href='$stats_route'  title='Show Publishers Statistics'><i class='fas fa-fw fa-chart-bar'></i></a>
<a class='p-3' target='blank' href='$offers_route'  title='Edit Publishers Private Offers'><i class='fas fa-fw fa-link'></i></a>
                        
                       ";
            });


        return view('manager.publishers')->with('table', $table);
    }

    public function assignOffer(Request $request){
        if (Auth::user()->is_offer_manager == true){
            return Redirect::route('offers-manage');
        }
        if (null != Offer::find($request->offer_id)){
            $user = User::find($request->publisher_id);
            $user->offers()->attach($request->offer_id);
            flash("Private offer added!")->success();
        }else{
            flash("Offer ID not valid!")->error();
        }

        return Redirect::route('publisher-private-offers', $request->publisher_id);

    }

    public function publisherPrivateOffers(Request $request, $id){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_offer_manager == true){
            return Redirect::route('offers-manage');
        }

        $user = User::where('id',$id)->first();
        $title = $user['name'];
        $table = app(TableList::class)
            ->setModel(publisherOffers::class)
            ->setRoutes([
                'index' => ['alias' => 'publisher-private-offers', 'parameters' => ['id' => $id]],
                'destroy'    => ['alias' => 'publisher-offer-destroy', 'parameters' => ['id' => '', 'publisher_id' => $id]],
            ])
            ->addQueryInstructions(function ($query)  use ($id){
                $query->where('publisher_id', $id);
            });

        $table->addColumn('offer_id')
            ->isSearchable()
            ->isSortable()
            ->useForDestroyConfirmation()
            ->setTitle('Offer ID');


        $table->addColumn('offer_id')
            ->setTitle('Offer Title')

            ->isCustomHtmlElement(function ($entity, $column) {
                $ret = Offer::where('id', $entity->offer_id)->first();
                return $ret['title']  ;
            });

        $table->addColumn('created_at')
            ->setTitle('Added Date')
            ->isSortable()
            ->sortByDefault()
            ->isCustomHtmlElement(function ($entity, $column) {
                return $this->nicetime($entity->created_at) ;
            });

        return view('manager.publisher-offers')->with('publisher_id',$id)->with('table',$table)->with('title',$title);
    }

    public function publisherStats(Request $request, $id){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_offer_manager == true){
            return Redirect::route('offers-manage');
        }
        $publisherController = new publisherController;
        return $publisherController->statistics($request, null,  $id);
    }
    public function activePublisher(Request $request, $id, $status){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_offer_manager == true){
            return Redirect::route('offers-manage');
        }
        $publisher= user::where('id', $id)->where('manager_id', Auth::user()->id)->first();
        $res = $publisher->update([
            'is_active' => $status,
        ]);
        if ($res){
            $fire = new fireEmail();
            if ($status == 0){
                $data = array('name'=>$publisher['name']);
                $fire->fire(false, $publisher['email'], $data,'emails.userBlocked','Your account has been blocked.');
            }else{
                $data = array('email'=>$publisher['email'], 'name'=>$publisher['name'], 'manager_name'=>$request->user()->name, 'manager_email'=>$request->user()->email, 'manager_skype'=>$request->user()->skype);
                $fire->fire(false, $publisher['email'], $data,'emails.approved','Application Approved 🚀');

            }
            flash("Publisher status updated!")->success();
        }else{
            flash("Error updating publisher status!")->error();
        }
        return $this->publishers($request);
    }
    public function publisher(Request $request, $id){
        $request->user()->authorizeRoles('manager');
        if (Auth::user()->is_offer_manager == true){
            return Redirect::route('offers-manage');
        }
        $countries = country::pluck('name','code');
        $user = User::where('id',$id)->first();

        if (isset($user->manager->id)){

        if ($user->manager->id == Auth::user()->id){
if($user['is_monetize'] == true){
    $data['type'] = "Magnetization Account";
}else{
    $data['type'] = "List Building Account";
}

            $data['id'] = $id;
            $data['name'] = $user['name'];
            $data['first_name'] = $user['first_name'];
            $data['last_name'] = $user['last_name'];
            $data['email'] = $user['email'];
            $data['skype'] = $user['skype'];
            $data['phone'] = $user['phone'];
            $data['address'] = $user['address'];
            $data['city'] = $user['city'];
            $data['country'] = $user['country'];
            $data['postal_code'] = $user['postal_code'];
            $data['paypal'] = $user['paypal'];
            $data['merchant_id'] = $user['merchant_id'];
            $data['website'] = $user['website'];
            $data['message'] = $user['message'];
            return view('manager.publisher-account')
                ->with('countries',$countries)
                ->with('data',$data);
            //return view('manager.publisher')->with('id',$id);
        }else{
            return "/";

        }
            return "/";
        }


    }

    public function downloadProduct(request $request, $id){
        $request->user()->authorizeRoles('manager');



        $offer = offer::all()->where('id',$id)->first();
        $name = str_replace(' ', '_', $offer['title']) . "_[The_Password_Is_pbooks].zip";

        $files = Storage::disk('dropbox')->allFiles($id);

        return Storage::disk('dropbox')->download($files[0],$name);

    }


}