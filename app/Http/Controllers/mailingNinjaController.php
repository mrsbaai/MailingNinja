<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mailingNinjaController extends Controller
{

    public function __construct()
    {

    }

    public function home(){
        if (Auth::check()) {
            return redirect("/home");
        }

        return view('mailingNinja.home');
}

}
