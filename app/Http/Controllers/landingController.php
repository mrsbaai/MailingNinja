<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\offer;
class landingController extends Controller
{

    public function home(){
        return view('landing.home');
    }


    public function preview($id, $n){
        $offer = offer::all()->where('id',$id)->first();
        $price = $offer->payout;
        $old = (($offer->payout * 40) / 100) + $price;
        if ($n == "a"){
            $landing = $offer->landing_a;
        }else{
            $landing = $offer->landing_b;
        }


        $buy ="
        <div class='text-center'>
            <h3><u>Download Now (<strike>$$old</strike> Only $$price)</u></h3><br/>
            <div class='info-form'>
                <a href='/'><img src='/images/pp.png' width='300px'/></a>
            </div>
            <br>
        </div>
        ";

        $free = "
        <div class='text-center'>
            <h3><u>Download For Free</u>:</h3><br/>
            <div class='info-form'>
                <form action='' class='form-inline justify-content-center'>
                    <div class='input-group'>
                        <input type='text' class='form-control form-control-lg' id='email' name='email' placeholder='Your E-mail Here' aria-label='Please Enter Your E-mail To Receive This Product For Free.'>
                        <div class='input-group-append'>
                            <button type='submit' class='btn btn-success btn-lg'>Send Download Link</button>
                        </div>
                    </div>
                </form>
            </div>
            <br>
        </div>
        ";


        $html = str_replace("[ACTION]",$buy, $landing);

        return view('landing.preview')->with('offer',$html);
    }

    public function show(){
        return view('landing.home');
    }




}
