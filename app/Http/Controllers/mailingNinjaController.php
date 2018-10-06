<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class mailingNinjaController extends Controller
{


    public function home(){
        if (Auth::check()) {
            return redirect("/home");
        }


        return view('mailingNinja.home');
    }

    public function contact(){
        if (Auth::check()) {
            return redirect("/home");
        }

        return view('mailingNinja.contact');
    }

    public function welcome(){
        return ("<script LANGUAGE='JavaScript'>
    window.alert('Thank you for your registration! Your application is now under review.');
    window.location.href='/';
    </script>");

    }

}
