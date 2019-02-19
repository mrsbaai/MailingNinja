<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\landingController;


class mailingNinjaController extends Controller
{


    public function home(Request $request){

        if ($request->getHttpHost() == "premiumbook.net"){
            return "<h1>This domain name has been permanently disabled!</h1>";
        }
        if (Auth::check()) {
            $role = $request->user()->roles()->first()->name;
            if ( $role == "publisher"){ return redirect()->route('publisher-home');}
            if ( $role == "manager"){ return redirect()->route('manager-home');}
            if ( $role == "costumer"){ return redirect()->route('costumer-home');}
        }else{
            if ($request->getHttpHost() == "mailing.ninja"){
                return view('mailingNinja.home');
            }else{
                $landing = new landingController();
                return $landing->home();
            }

        }

    }

    public function welcome(){
        if (Auth::check()) {
            if(Auth::user()->is_active !== 1){
                Auth::logout();
                return ("<script LANGUAGE='JavaScript'>
    window.alert('Thank you for your registration! Your application is currently under review.')
    window.location.href='/';
    </script>");
            }
        }

        return ("<script LANGUAGE='JavaScript'>
    window.alert('Thank you for your registration!')
    window.location.href='/';
    </script>");

    }

}
