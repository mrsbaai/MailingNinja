<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\subscriber;
use App\unsubscribes;
use App\link;

class subscribeController extends Controller
{
    public function subscribe ($code, $email){
        $info = link::all()->where('link', $code);


        $add = new subscriber();
        $add->offer_id = $info['offer_id'];
        $add->user_id = $info['publisher_id'];
        $add->country = $country;
        $add->is_confirmed = false;
        $add->email = $email;


        return $add->save();


    }

    public function unsubscribe ($email){

    }
}
