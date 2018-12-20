<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\offer;
use Illuminate\Support\Facades\Auth;

class landingController extends Controller
{

    public function home(){
        if (!Auth::user()){
            return "ddd";
            return view('landing.home');
        }else{
            return redirect("/home");
        }

    }


    public function preview($id){


        $offer = offer::all()->where('id',$id)->first();
        $price = $offer->payout;

        // get from links database
        $custom_price = 0;

        if ($custom_price == 0){
            $old_price = $price;

        }else{
            $old_price = (($offer->payout * 55) / 100) + $price;
            $old_price = intval($old_price);
        }
        $price = $custom_price;

        $images = array($offer->thumbnail, $offer->image_1, $offer->image_2, $offer->image_3, $offer->image_4, $offer->image_5, $offer->image_6, $offer->image_7, $offer->image_8, $offer->image_9);
        return view('landing.preview')
            ->with('title', $offer->title)
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
            ->with('book_about_3', $offer->book_about_3);
    }

    public function show(){
        return view('landing.home');
    }




}
