<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class publisherController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function home(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.home');
    }

}
