<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class costumerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function home(request $request){
        $request->user()->authorizeRoles('costumer');
        return view('costumer.home');
    }

}
