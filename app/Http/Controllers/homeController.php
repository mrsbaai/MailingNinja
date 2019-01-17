<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function __construct()
    {

        //$this->middleware('auth');
    }

    public function redirect(Request $request){
        return "ss";
        $role = $request->user()->roles()->first()->name;
        return $role;
        if ( $role == "publisher"){ return redirect("/publisher");}
        if ( $role == "manager"){ return redirect()->route('manager');;}
        if ( $role == "costumer"){ return redirect("/members");}

    }

    public function home(Request $request){
        return "s0";
    }





}
