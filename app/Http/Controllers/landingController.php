<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class landingController extends Controller
{

    public function home(){
        return view('landing.home');
    }


}
