<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class mailingNinjaController extends Controller
{


    public function home(Request $request){
        return "tst";
        if (Auth::check()) {
            $role = $request->user()->roles()->first()->name;
            if ( $role == "publisher"){ return redirect()->route('publisher-home');}
            if ( $role == "manager"){ return redirect()->route('manager-home');}
            if ( $role == "costumer"){ return redirect()->route('costumer-home');}
        }else{
            return view('mailingNinja.home');
        }

    }

    public function welcome(){
        return ("<script LANGUAGE='JavaScript'>
    window.alert('Thank you for your registration!');
    window.location.href='/';
    </script>");

    }

}
