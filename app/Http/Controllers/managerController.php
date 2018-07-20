<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class managerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function home(Request $request){
        $request->user()->authorizeRoles('manager');

        return view('manager.home');
    }



}
