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
use App\clicks;;
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
        if ($request->is_active == "on"){$is_active = 1;}else{$is_active = 0;}
        if ($request->is_private == "on"){$is_private = 1;}else{$is_private = 0;}
        $offer = new offer;
        $offer->title = $request->title;
        $offer->thumbnail = $thumbnail;
        $offer->description = $request->description;
        $offer->is_active = $is_active;
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
        $product_name = $request->id . ".zip" ;
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
        if ($request->is_active == "on"){$is_active = 1;}else{$is_active = 0;}
        if ($request->is_private == "on"){$is_private = 1;}else{$is_private = 0;}
        $res = $offer->update([
            'thumbnail' => $thumbnail,
            'title' => $request->title,
            'product' => $product_name,
            'description' => $request->description,
            'is_active' => $is_active,
            'is_private' => $is_private,
            'payout' => $request->payout
        ]);
        $offer->verticals()->sync($request->get('verticals'));
        if ($res){
            flash("Updated: " . $request->title)->success();
        }else{
            flash("Error Updating: " . $request->title)->error();
        }
        return Redirect::route('offers-edit', $offer->id);
    }
    public function home(Request $request){
        $request->user()->authorizeRoles('manager');
        $date = Carbon::now();
        $query  = subscriber::latest();

        $data['subscribers_all'] = count($query->get());

        $query->whereMonth('Created_at',$date->format('m'))
            ->whereDay('Created_at',$date->format('d'));
        $data['subscribers_today'] = count($query->get());

        $query  = sells::latest();
        $query
            ->where('is_for_host',false)
            ->where('is_refund',false)
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
            ->where('is_for_host',true)
            ->where('is_refund',false)
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
                    ->where('is_refund', false)
                    ->where('status', 'Completed');
            });


        $table->addColumn('created_at')
            ->isSortable()
            ->setTitle('Date')
            ->sortByDefault('desc')
            ->setColumnDateFormat('d/m/Y H:i:s');

        $table->addColumn('payedAmount')
            ->setTitle(__('Net Amount'))
            ->isSortable()
            ->isCustomHtmlElement(function ($entity, $column) {
                return "<b>$". $entity->payedAmount. "</b>";
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



        $table->addColumn('buyerEmail')
            ->setTitle('Buyer E-Mail')
            ->setStringLimit(25)
            ->isSearchable();


        return view('manager.home')->with('table', $table)->with('data',$data);;
    }

    public function globalOfferStats(Request $request, $offer_id){
        $request->user()->authorizeRoles('manager');
        $publisherController = new publisherController;
        return $publisherController->statistics($request, $offer_id,  null);

    }
    public function globalStats(Request $request){
        $request->user()->authorizeRoles('manager');
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
        return view('manager.offer-editor')->with('verticals',$verticals);
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
        $table->addColumn('is_active')
            ->isSortable()
            ->setTitle('A?');
        $table->addColumn('is_private')
            ->isSortable()
            ->setTitle('P?');
        $table->addColumn('profit_a')
            ->isSortable()
            ->setTitle('A($) ');
        $table->addColumn('profit_b')
            ->isSortable()
            ->setTitle('B($) ');
        $table->addColumn('subscribes_a')
            ->isSortable()
            ->setTitle('A(Subs) ');
        $table->addColumn('subscribes_b')
            ->isSortable()
            ->setTitle('B(Subs) ');
        $table->addColumn('updated_at')
            ->setTitle('Last Update')
            ->isSortable()
            ->sortByDefault()
            ->isCustomHtmlElement(function ($entity, $column) {
                return $this->nicetime($entity->updated_at) ;
            });

        $table->addColumn()
            ->setTitle(__(' '))
            ->isCustomHtmlElement(function ($entity, $column) {

                $stats_route = route('global-offer-stats', ['offer_id' => $entity->id]);
                return  "<a class='p-3' target='blank' href='$stats_route'  title='Show Offer Statistics'><i class='fas fa-fw fa-chart-bar'></i></a>";
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
            ->with('title', $offer->title)
            ->with('is_private', $offer->is_private)
            ->with('is_active', $offer->is_active)
            ->with('description', $offer->description)
            ->with('payout', $offer->payout)
            ->with('id', $id)
            ->with('thumbnail', $offer->thumbnail)
            ->with('selected_verticals', $selected_verticals);
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
                    return "<a class='btn btn-danger btn-sm' href='$a_route'>Deactivate</a>";
                }else{
                    $a_route = route('publisher-status', ['id' => $entity->id,'status' => "1"]);
                    return "<a class='btn btn-primary btn-sm' href='$a_route'>Activate</a>";
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
        $publisherController = new publisherController;
        return $publisherController->statistics($request, null,  $id);
    }
    public function activePublisher(Request $request, $id, $status){
        $request->user()->authorizeRoles('manager');
        $publisher= user::where('id', $id)->where('manager_id', Auth::user()->id);
        $res = $publisher->update([
            'is_active' => $status,
        ]);
        if ($res){
            flash("Publisher status updated!")->success();
        }else{
            flash("Error updating publisher status!")->error();
        }
        return $this->publishers($request);
    }
    public function publisher(Request $request, $id){
        $request->user()->authorizeRoles('manager');
        $countries = country::pluck('name','code');
        $user = User::where('id',$id)->first();

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
    }


}