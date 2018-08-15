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

    public function account(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.account');
    }
    public function dashboard(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.home');
    }
    public function support(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.support');
    }
    public function statistics(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.statistics');
    }
    public function offers(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.offers');
    }

    public function subscribers(Request $request){
        $request->user()->authorizeRoles('publisher');
        return view('publisher.subscribers');
    }



}
