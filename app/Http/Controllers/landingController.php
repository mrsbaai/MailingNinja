<?php

namespace App\Http\Controllers;

use App\subscriber;
use App\vertical;
use Illuminate\Http\Request;
use App\offer;
use App\link;
use App\costumerOffers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use URL;

class landingController extends Controller
{



    public function Register(Request $request){

            if (null !== Input::get('code')){
                $code = Input::get('code');
            }else{
                $code = "";
            }
            if (null !== Input::get('email')){
                $email = Input::get('email');
            }else{
                $email = "";
            }

        if(Auth::check() and $request->user()->roles()->first()->name == "costumer"){
            $this->addProductToCostumer($code, Auth::user()->id);
            return redirect()->route('costumer-home');

        }else{

            return view('auth.buy')->with('code', $code)->with('email', $email);
        }


    }

    public static function addProductToCostumer($code,$costumer_id){
        $offer = link::all()->where('link',$code)->first();
        $publisher_id = $offer['user_id'];
        $offer_id = $offer['offer_id'];
        $offer_price = $offer['price'];

        $add = new costumerOffers();
        $add->publisher_id = $publisher_id;
        $add->costumer_id = $costumer_id;
        $add->offer_id = $offer_id;
        $add->price = $offer_price;
        $add->paid = false;

        return $add->save();


    }

    private function categories(){
        return vertical::all()->pluck('vertical');
    }

    private function  subscribers_count(){
        return subscriber::all()->count() + 1000;

    }

    public function test(){
        $this->getRelatedBooks(10);
    }

    private function getRelatedBooks($offer_id){


        $offer = offer::all()->where('id',$offer_id)->first();

        $verticals = $offer->verticals()->get();





        $relateds = offer::where('id', '<>', $offer_id);with('verticals')
            ->whereHas('verticals', function($q) use ($verticals) {
                $q->where('vertical', $verticals[0]['vertical']);
                foreach ($verticals as $vertical){
                    $q->orwhere('vertical', $vertical['vertical']);
                }

            })->orderByDesc('cpc', 'desc')->get();

        if (count($relateds) == 0 ){
            $relateds = offer::all()->orderByDesc('cpc', 'desc')->get();
        }

        $relateds->pluck('thumbnail', 'id');

        return $relateds;


    }
    public function showRelatedBooks($offer_id){

        $offer = offer::all()->where('id',$offer_id)->first();


        return view('landing.relatedWall')
            ->with('offers', $this->getRelatedBooks($offer_id))
            ->with('categories', $this->categories())
            ->with('subscribers_count', $this->subscribers_count())
            ->with('title', $offer['title']);


    }
 public function showVerticalBooks($category){




        $relateds = offer::whereHas('verticals', function($q) use ($category)
        {
            $q->where('vertical', $category);
        })->orderByDesc('cpc', 'desc')->get();



        return view('landing.categoryWall')
            ->with('offers', $relateds)
            ->with('categories', $this->categories())
            ->with('subscribers_count', $this->subscribers_count())
            ->with('category', $category);



    }

    public function previewLanding($id, Request $request){

        return $this->landing(null,$id,null, "preview",$request);
    }
    public function hostLanding($id, Request $request){

        return $this->landing(null,$id,null, "host", $request);

    }
    public function publisherLanding($code, $email=null,Request $request){
        return $this->landing($code,null,$email, "publisher", $request);

    }


    private function landing($code=null, $id=null, $email=null, $type, Request $request){

        $link = null;
        if ($type == "preview") {
            if (config('app.app_url') == $request->getHttpHost()){return abort(403, 'This domain name is not allowed for publishers!');}
            if(Auth::check()){
                $user_id = Auth::user()->id;
                $link = link::all()->where('offer_id',$id)->where('user_id',$user_id)->first();

            }else{
                return abort(403, 'You need to be logged in to preview offers');
            }


        }else{
            $tracking = new trackingController();
            $tracking->click($code,$email);
            if ($email){
                return redirect("/" . $code);
            }
            if ($type == "publisher") {
                if (config('app.app_url') == $request->getHttpHost()){return abort(403, 'This domain name is not allowed for publishers!');}
                $link = link::all()->where('link',$code)->first();
            }
            if ($type == "host") {
                $link = Link::where("user_id",config('app.main_publisher'))->where("offer_id",$id)->first();
            }

        }

        if (!$link){
            $offer = offer::where('id',$id)->first();

            $url = substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
            $newLink = new Link;
            $newLink->offer_id = $id;
            $newLink->user_id = config('app.main_publisher');
            $newLink->price = $offer->payout;
            $newLink->link = $url;
            $newLink->save();
            $link = Link::where("user_id",config('app.main_publisher'))->where("offer_id",$id)->first();

        }

        $code = $link->link;



        if ($link === null){
            return redirect("/");
        }
        $offer = offer::all()->where('id',$link->offer_id)->first();
        if ($offer === null){
            return redirect("/");
        }

        $price = $offer->payout;
        $custom_price = $link->price;

        if ($custom_price == 0){
            $old_price = $price;

        }else{
            $old_price = (($custom_price * 55) / 100) + $custom_price;
            $old_price = intval($old_price);
        }
        if ($custom_price < $price){ $old_price = $price;}

        $price = $custom_price;

        $images = array($offer->thumbnail, $offer->image_1, $offer->image_2, $offer->image_3, $offer->image_4, $offer->image_5, $offer->image_6, $offer->image_7, $offer->image_8, $offer->image_9);


        $related_url = "/related/" . $offer->id;

        $related_offers = $this->getRelatedBooks($offer->id)->take(3);

        return view('layouts.landing')
            ->with('code', $code)
            ->with('offers', $related_offers)
            ->with('title', $offer->title)
            ->with('related_url', $related_url)
            ->with('description', $offer->description)
            ->with('price', $price)
            ->with('old_price', $old_price)
            ->with('thumbnail', $offer->thumbnail)
            ->with('subtitle', $offer->subtitle)
            ->with('images', $images)
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
            ->with('subscribers_count', $this->subscribers_count());
    }




    public function home(){

        if(Auth::guest()){

        $offers = offer::all()->sortByDesc("cpc");

        return view('landing.home')
            ->with('offers', $offers)
            ->with('categories', $this->categories())
            ->with('subscribers_count', $this->subscribers_count());

        }else{
            return redirect("/home");
        }



    }







}
