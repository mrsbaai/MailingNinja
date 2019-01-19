<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\subscriber;
use App\unsubscribes;
use App\link;
use Illuminate\Support\Facades\Input;
use Location;

class subscribeController extends Controller
{

    public function subscribePost(){
        return $this->subscribe(Input::get('code'), Input::get('email'));
    }

    public static function subscribe ($code, $email){


        if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $http_x_headers = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
            $_SERVER['REMOTE_ADDR'] = $http_x_headers[0];
        }
        $country_code = Location::get($_SERVER['REMOTE_ADDR'])->countryCode;


        $info = link::all()->where('link', $code)->first();

        $check = subscriber::all()->where('email', $email)->first();
        if (!$check){
            $add = new subscriber();
            $add->offer_id = $info['offer_id'];
            $add->user_id = $info['user_id'];
            $add->type = 0;
            $add->country = $country_code;
            $add->is_confirmed = false;
            $add->email = $email;

            $add->save();

        }else{
            $res = unsubscribes::where('email',$email)->delete();
        }


        // send confirm subscription email


        flash()->overlay("You have been successfully subscribed");

        if ($code !== "" and $code !== null){
            return redirect('/' . $code);
        }else{
            return redirect('/');
        }




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


        flash()->overlay("We're sorry to see you go :(", "You have been unsubscribed.");
        return redirect('/');



    }
}
