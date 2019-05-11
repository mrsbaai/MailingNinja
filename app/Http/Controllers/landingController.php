<?php

namespace App\Http\Controllers;

use App\country;
use App\subscriber;
use App\vertical;
use Illuminate\Http\Request;
use App\offer;
use App\link;
use App\costumerOffers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use URL;
use Location;

class landingController extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        Cookie::queue("pre_code", $code,120);





        if(Auth::check() and $request->user()->roles()->first()->name == "costumer"){
            $this->addProductToCostumer($code, Auth::user()->id);
            return redirect()->route('costumer-home');

        }else{
            $countries = country::pluck('name','code');
            $selected_country = $this->myLocation();
            return view('auth.buy')->with('code', $code)->with('email', $email)->with('countries',$countries)->with('selected_country',$selected_country);
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
        $add->link = $code;
        $add->paid = false;

        return $add->save();


    }

    private function categories(){

        $verticals = vertical::all()->pluck('vertical');
        $return_verticals = array();

        foreach ($verticals as $vertical){

            $exist = offer::whereHas('verticals', function($q) use ($vertical)
            {
                $q->where('vertical', $vertical);
            })->first();

            if($exist){
                array_push($return_verticals, $vertical);

            }

        }
        return $return_verticals;
    }

    private function  subscribers_count(){
        return subscriber::all()->count() + 1000;

    }

    public function test(){
        $view = view('publisher.test')->render();
        header("Content-type: text/html");
        header("Content-Disposition: attachment; filename=creative.htm");
        return $view;

    }



    public function getRelatedBooks($offer_id, $country = "US"){


        $offer = offer::all()->where('id',$offer_id)->first();

        $verticals = $offer->verticals()->get();

        $relateds = offer::where('id', '<>', $offer_id)->where('is_active',true)->with('verticals')
            ->whereHas('countries', function ($query) use ($country){
                $query->where('code', $country);
            })
            ->whereHas('verticals', function($q) use ($verticals) {
                $q->where('vertical', $verticals[0]['vertical']);
                foreach ($verticals as $vertical){
                    $q->orwhere('vertical', $vertical['vertical']);
                }

            })->orderByDesc('epc', 'desc')->get();


        if (count($relateds) == 0 ){

            $relateds = offer::where('id', '<>', $offer_id)->where('is_active',true)->with('verticals')
                ->whereHas('countries', function ($query){
                    $query->where('code', 'WORLD');
                })
                ->whereHas('verticals', function($q) use ($verticals) {
                    $q->where('vertical', $verticals[0]['vertical']);
                    foreach ($verticals as $vertical){
                        $q->orwhere('vertical', $vertical['vertical']);
                    }

                })->orderByDesc('epc', 'desc')->get();
            if (count($relateds) == 0 ){
                $relateds = offer::where('id', '<>', $offer_id)->where('is_active',true)
                    ->whereHas('countries', function ($query) use ($country){
                        $query->where('code', $country);
                    })->orderByDesc('epc', 'desc')->get();

                if (count($relateds) == 0 ){

                    $relateds = offer::where('id', '<>', $offer_id)->where('is_active',true)->with('verticals')
                        ->whereHas('countries', function ($query){
                            $query->where('code', 'WORLD');
                        })->orderByDesc('epc', 'desc')->get();

                    if (count($relateds) == 0 ){
                        $relateds = offer::where('is_active',true)->where('id', '<>', $offer_id)->orderByDesc('epc', 'desc')->get();
                    }
                }

            }
        }




        $relateds->pluck('thumbnail', 'id');

        return $relateds;


    }
    public function showRelatedBooks($offer_id){

        $offer = offer::all()->where('id',$offer_id)->where('is_active',true)->first();


        return view('landing.relatedWall')
            ->with('offers', $this->getRelatedBooks($offer_id, $this->myLocation()))
            ->with('categories', $this->categories())
            ->with('subscribers_count', $this->subscribers_count())
            ->with('title', $offer['title']);


    }
 public function showVerticalBooks($category){




        $relateds = offer::whereHas('verticals', function($q) use ($category)
        {
            $q->where('vertical', $category);
        })->where('is_active',true)->orderByDesc('epc', 'desc')->get();



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

    public function myLocation(){
        if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $http_x_headers = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
            $_SERVER['REMOTE_ADDR'] = $http_x_headers[0];
        }

        $location = Location::get($_SERVER['REMOTE_ADDR'])->countryCode;

        if ($location == null or $location == ""){
            return "WORLD";

        }else{
            return $location;
        }



    }
    public function publisherLanding($code, $email=null,Request $request){


        $link = link::all()->where('link',$code)->first();
        $offer = offer::all()->where('id',$link->offer_id)->first();
        $allowed_countries = $offer->countries()->get()->pluck('code')->toarray();


        if (in_array($this->myLocation(), $allowed_countries) or in_array("WORLD", $allowed_countries)) {
            return $this->landing($code,null,$email, "publisher", $request);
        }else{
            $related_offer = $this->getRelatedBooks($offer->id, $link->offer_id)->take(1);
            return redirect("/ebook/" . $related_offer['0']['id']);

        }


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

        if($offer->is_active == false and $type <> "preview"){
            return abort(404);
        }


        $price = $offer->payout;
        $custom_price = $link->price;

        if ($custom_price == 0){
            $old_price = $price;

        }else{
            $old_price = 100/60*$custom_price;


            $old_price = intval($old_price);
        }
        //if ($custom_price < $price){ $old_price = $price;}

        $price = $custom_price;

        $images = array($offer->thumbnail, $offer->image_1, $offer->image_2, $offer->image_3, $offer->image_4, $offer->image_5, $offer->image_6, $offer->image_7, $offer->image_8, $offer->image_9);


        $related_url = "/related/" . $offer->id;

        $related_offers = $this->getRelatedBooks($offer->id, $this->myLocation())->take(3);

        return view('layouts.landing')
            ->with('code', $code)
            ->with('offers', $related_offers)
            ->with('title', $offer->title)
            ->with('color', $offer->color)
            ->with('related_url', $related_url)
            ->with('description', $offer->description)
            ->with('price', $price)
            ->with('old_price', $old_price)
            ->with('thumbnail', $offer->thumbnail)
            ->with('cover', $offer->cover)
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

        $offers = offer::all()->where('is_active', true)->sortByDesc("epc");

        return view('landing.home')
            ->with('offers', $offers)
            ->with('categories', $this->categories())
            ->with('subscribers_count', $this->subscribers_count());

        }else{
            return redirect("/home");
        }



    }







}
