<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\costumerOffers;
use App\offer;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cookie;
use Okipa\LaravelBootstrapTableList\TableList;
use App\link;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class costumerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }


    public function ebooks(){



            $offers = offer::all()->where('is_active', true)->sortByDesc("epc")->take(200);

            return view('costumer.ebooks')
                ->with('offers', $offers);




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
        $name = str_replace(' ', '_', $offer['title']) . "_[The_Password_Is_pbooks].zip";


        $files = Storage::disk('dropbox')->allFiles($id);

        return Storage::disk('dropbox')->download($files[0],$name);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public static function addProductToCostumer($code,$costumer_id){
        $offer = link::all()->where('link',$code)->first();
        $publisher_id = $offer['user_id'];
        $offer_id = $offer['offer_id'];
        $offer_price = $offer['price'];

        $co = costumerOffers::where('costumer_id', $costumer_id)->where('offer_id', $offer_id)->first();
        if ($co == null){
            $add = new costumerOffers();
            $add->publisher_id = $publisher_id;
            $add->costumer_id = $costumer_id;
            $add->offer_id = $offer_id;
            $add->price = $offer_price;
            $add->link = $code;
            $add->paid = false;

            return $add->save();
        }

        return false;


    }

    public function home(request $request){
        $request->user()->authorizeRoles('costumer');

        if(request()->cookie("pre_code") != null and request()->cookie("pre_code") != ""){
            $code = request()->cookie("pre_code");
            $this->addProductToCostumer($code, Auth::user()->id);

            $cookie = \Cookie::forget('pre_code');

            $v = \Response::make('cookie has bee deleted')->withCookie($cookie);

        }
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
                    return '<span class="badge badge-success">Paid</span> <span class="badge badge-info">[The Archive PASSWORD Is: pbooks]</span>';
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
        $offer = costumerOffers::where('costumer_id', Auth::user()->id)->orderByDesc('id', 'desc')->first();
        $landing = new landingController();
        if ($offer){
            $related_offers = $landing->getRelatedBooks($offer->offer_id, $landing->myLocation())->take(3);
        }else{
            $related_offers = offer::all()->where('is_active', true)->sortByDesc("epc")->take(3);

        }

        return view('costumer.home')->with('table',$table)->with('offers',$related_offers);
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
