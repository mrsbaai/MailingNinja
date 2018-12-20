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

        $offer = offer::all()->where('id',$id)->first;
        $files = Storage::disk('dropbox')->allFiles($id);

        return Storage::disk('dropbox')->download($files[0],$offer['title']);
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
                    return '<span class="badge badge-success">Paid</span>';
                }else{
                    return '<span class="badge badge-warning">Unpaid</span>';
                }
            });

        $table->addColumn('price')
            ->setTitle('')
            ->isCustomHtmlElement(function ($entity, $column) {
                $cancel_url = "#";

                $download_url = URL::temporarySignedRoute(
                    'costumer-download', now()->addMinutes(30), ['id' => $entity->offer_id]
                );


                if ($entity->paid == true){
                    return '<a href="' . $download_url . '" class="btn btn-success float-right">Download</a>';
                }else{
                    return '<a style="margin-left: 13px;"href="' . $cancel_url . '" class="btn btn-danger float-right">Cancel</a>'
                        . '<a href="/" class="btn btn-info  float-right">Pay Now (Only $' . $entity->price . ')</a>';
                }
            });


        return view('costumer.home')->with('table',$table);
    }
    public function contact(request $request){
        $request->user()->authorizeRoles('costumer');
        return view('costumer.contact');
    }

}
