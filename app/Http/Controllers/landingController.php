<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\offer;
class landingController extends Controller
{

    public function home(){
        return view('landing.home');
    }


    public function preview($id){
        $offer = offer::all()->where('id',$id)->first();
        return view('landing.preview')->with('offer',$offer->offer);
    }

    public function show(){
        return view('landing.home');
    }




}
