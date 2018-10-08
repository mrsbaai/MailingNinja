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
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/offer_images/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', '/offer_images/'. $image_name);
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
        return view('manager.home');
    }
    public function account(Request $request){
        $request->user()->authorizeRoles('manager');
        return view('manager.account');
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
            ->sortByDefault()
            ->isSearchable()
            ->isSortable()
            ->setTitle('id');
        $table->addColumn()
            ->setTitle('Status')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->is_active){
                    $a_route = route('publisher-status', ['id' => $entity->id,'status' => "0"]);
                    return "<a class='btn btn-danger btn-sm' href='$a_route'>Deactivate</a>";
                }else{
                    $a_route = route('publisher-status', ['id' => $entity->id,'status' => "1"]);
                    return "<a class='btn btn-primary btn-sm' href='$a_route'>Activate</a>";
                }
            });
        return view('manager.publishers')->with('table', $table);
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
        return view('manager.publisher')->with('id',$id);
    }
}