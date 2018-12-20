<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function redirect(Request $request){
        $role = $request->user()->roles()->first()->name;
        if ( $role == "publisher"){ return redirect("/publisher");}
        if ( $role == "manager"){ return redirect("/manager");}
        if ( $role == "costumer"){ return redirect("/members");}

    }





}
