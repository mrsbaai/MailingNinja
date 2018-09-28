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
            $name = time().'.'.$image->getClientOriginalExtension();
            $destination_path = public_path('/thumbnails');
            $image->move($destination_path, $name);
            $thumbnail = "/thumbnails/" . $name;
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
            'title' => $request->title,
            'thumbnail' => $thumbnail,
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
            ->setTitle('Active?');

        $table->addColumn('is_private')
            ->isSortable()
            ->setTitle('Private?');



        $table->addColumn('updated_at')
            ->setTitle('Update date')
            ->isSortable()
            ->sortByDefault()
            ->setColumnDateFormat('d/m/Y H:i:s');

       // $table->addColumn()
        //    ->setTitle(__('preview'))
        //    ->isCustomHtmlElement(function ($entity, $column) {
        //        $preview_route = route('preview', ['id' => $entity->id]);
        //        $preview_label = __('Preview');
        //        return "<a class='btn btn-primary btn-sm' target='blank' href='$preview_route'>$preview_label</a>";
         //   });
        return view('manager.offers')->with('table',$table);
    }

    public function destroyOffer(Request $request){
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

    public function updateLanding(Request $request)
    {
        $request->user()->authorizeRoles('manager');


        $offer = offer::find($request->id);


        if ($request->n == "a"){
            $res = $offer->update([
                'landing_a' => $this->prossHTML($request->landing),
            ]);
        }else {
            $res = $offer->update([
                'landing_b' => $this->prossHTML($request->landing),
            ]);
        }

        if ($res){
            flash("Offer 'ID: $request->id' Updated.")->success();
        }else{
            flash("Error updating offer 'ID: $request->id'.")->error();
        }

        return view('manager.offer-editor-content')->with('landing', $request->landing)->with('n', $request->n)->with('id', $request->id);


    }
    public function publishers(Request $request){
        $manager_id = Auth::user()->id;

        $records = user::all()->where('manager_id',$manager_id);
        $columns =  array("id", "name", "email", "balance");
        $data = $this->formatData($records,$columns);

        $request->user()->authorizeRoles('manager');
        return view('manager.publishers')->with('rows', $data['rows'])->with('columns', $data['columns']);
    }

    public function publisher(Request $request, $id){
        $request->user()->authorizeRoles('manager');
        return view('manager.publisher')->with('id',$id);
    }


    Public function formatData($records, $columns){

        $rows = [];
        foreach($records as $index => $record) {
            $row = [];
            foreach($columns as $column){
                $newRow = $record[$column];
                if($column == "created_at"){
                    $newRow = $this->nicetime($record[$column]);
                }
                array_push($row, $newRow);
            }
            array_push($rows, $row);
        }

        return array('rows' => $rows, 'columns' => $columns);
    }


}
