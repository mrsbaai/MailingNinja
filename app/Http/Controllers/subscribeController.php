<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\subscriber;
use App\unsubscribes;
use App\link;
use Location;

class subscribeController extends Controller
{
    public function subscribe ($code, $email){

        if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $http_x_headers = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
            $_SERVER['REMOTE_ADDR'] = $http_x_headers[0];
        }
        $country_code = Location::get('105.66.7.96')->countryCode;


        $info = link::all()->where('link', $code)->first();

        $check = subscriber::all()->where('email', $email)->first();
        if (!$check){
            $add = new subscriber();
            $add->offer_id = $info['offer_id'];
            $add->user_id = $info['user_id'];
            $add->country = $country_code;
            $add->is_confirmed = false;
            $add->email = $email;

            $add->save();

        }else{
            $res = unsubscribes::where('email',$email)->delete();
        }

        flash("Thank you fro your subscription.")->success();
        return redirect('/');



    }

    public function unsubscribe ($email){

        $info = subscriber::all()->where('email', $email)->first();

        $check = unsubscribes::all()->where('email', $email)->first();
        if (!$check){
            $add = new unsubscribes();
            if ($info){
                $add->offer_id = $info['offer_id'];
                $add->user_id = $info['user_id'];
            }
            $add->email = $email;
            $add->save();

        }


        flash("You have been unsubscribed. We're sorry to see you go :(")->info();
        return redirect('/');



    }
}
