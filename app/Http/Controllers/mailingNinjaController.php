<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class mailingNinjaController extends Controller
{


    public function home(Request $request){

        if (Auth::check()) {
            $role = $request->user()->roles()->first()->name;
            if ( $role == "publisher"){ return redirect()->route('publisher-home');}
            if ( $role == "manager"){ return redirect()->route('manager-home');}
            if ( $role == "costumer"){ return redirect()->route('costumer-home');}
        }else{
            if ($request->getHttpHost() == "mailing.ninja"){
                return view('mailingNinja.home');
            }else{
                return view('landing.home');

            }

        }

    }

    public function welcome(){
        return ("<script LANGUAGE='JavaScript'>
    window.alert('Thank you for your registration!');
    window.location.href='/';
    </script>");

    }

}
