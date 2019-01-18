<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\costumerOffers;
use App\offer;
use Illuminate\Support\Facades\Auth;

use Okipa\LaravelBootstrapTableList\TableList;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class costumerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function download(request $request, $id){
        $request->user()->authorizeRoles('costumer');
        if(!costumerOffers::all()->where("costumer_id", Auth::user()->id)->where("offer_id", $id)->where('paid',true)->first()){
            abort(401);
        }

        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $offer = offer::all()->where('id',$id)->first();
        $name = str_replace(' ', '_', $offer['title']) . "_[The_Password_Is_PBOOKS].zip";


        $files = Storage::disk('dropbox')->allFiles($id);

        return Storage::disk('dropbox')->download($files[0],$name);
    }
    public function home(request $request){
        $request->user()->authorizeRoles('costumer');
        $table = app(TableList::class)
            ->setModel(costumerOffers::class)
            ->setRoutes([
                'index' => ['alias' => 'publisher-offers', 'parameters' => []],
            ])
            ->addQueryInstructions(function ($query) {
                $query->select('costumer_products.*');
                $query->where('costumer_id', Auth::user()->id);
            });



        $table->addColumn('title')
            ->setTitle('')
            ->isCustomHtmlElement(function ($entity, $column) {
                $offer = Offer::where('id', $entity->offer_id)->first();
                return '<span class="uppercase" style = "font-size: 150%">[E-BOOK] [' . $offer->title . ']</span>';
            });

        $table->addColumn('paid')
            ->setTitle('')
            ->isCustomHtmlElement(function ($entity, $column) {
                if ($entity->paid == true){
                    return '<span class="badge badge-success">Paid</span> <span class="badge badge-info">[The Archive PASSWORD Is: PBOOKS]</span>';
                }else{
                    return '<span class="badge badge-warning">Unpaid</span>';
                }
            });

        $table->addColumn('price')
            ->setTitle('')
            ->isCustomHtmlElement(function ($entity, $column) {
                $cancel_url = route('cancel-product', ['id' => $entity->offer_id]);
                $paypal_url = route('paypal-invoice', ['invoice' => $entity->id]);

                $download_url = URL::temporarySignedRoute(
                    'costumer-download', now()->addMinutes(30), ['id' => $entity->offer_id]
                );


                if ($entity->paid == true){
                    return '<a href="' . $download_url . '" class="btn btn-success float-right">Download</a>';
                }else{
                    return '<a style="margin-left: 13px;"href="' . $cancel_url . '" class="btn btn-danger float-right">Cancel</a>'
                        . '<a href="' . $paypal_url . '/" class="btn btn-info  float-right">Pay Now [$' . $entity->price . '] [PayPal]</a>';
                }
            });


        return view('costumer.home')->with('table',$table);
    }
    public function cancel_product(request $request, $id){
        $res = costumerOffers::where('costumer_id',Auth::user()->id)->where('offer_id',$id)->delete();
        if ($res){
            flash("Product deleted!")->success();
        }else{
            flash("Error deleting Product!")->error();
        }
        return $this->home($request);
    }
    public function contact(request $request){
        $request->user()->authorizeRoles('costumer');
        return view('costumer.contact');
    }

}
