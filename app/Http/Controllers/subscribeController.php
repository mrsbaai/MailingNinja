<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\subscriber;
use App\unsubscribes;
use App\link;
use Illuminate\Support\Facades\Input;
use Location;
use App\ip;

class subscribeController extends Controller
{

    public function subscribePost(){
        return $this->subscribe(Input::get('code'), Input::get('email'));
    }

    private function valid_email($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            list($user, $domain ) = explode( '@', $email );
            if(checkdnsrr( $domain, 'mx')) {
                return true;
            };
        }else{
            return false;
        }
    }


    public function subscribe ($code, $email, $type = 0){

        if ($this->valid_email($email) == false){
            if($type = 0) {
                flash()->overlay("Un-valid E-mail Address!");
                if ($code !== "" and $code !== null){
                    return redirect('/' . $code);
                }else{
                    return redirect('/');
                }
            }else{
                return;
            }

        }
        if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $http_x_headers = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
            $_SERVER['REMOTE_ADDR'] = $http_x_headers[0];
        }
        $country_code = Location::get($_SERVER['REMOTE_ADDR'])->countryCode;

        if ($country_code == null) {
            $country_code = "MA";
        }

        $info = link::all()->where('link', $code)->first();

        if ($info){
            $offer_id = $info['offer_id'];
            $user_id = $info['user_id'];
        }else{
            $offer_id = $user_id  = config('app.main_publisher');
        }

        $check = subscriber::all()->where('email', $email)->first();
        if (!$check){
            $add = new subscriber();
            $add->offer_id = $offer_id;
            $add->user_id = $user_id;
            $add->type = $type;
            $add->country = $country_code;
            $add->is_confirmed = false;
            $add->email = $email;

            $add->save();

        }else{
            $res = unsubscribes::where('email',$email)->delete();
        }



        if ($type = 0){


            $offer = offer::where('id',$offer_id)->first();
            $verticals = implode(" & ",$offer->verticals()->pluck('vertical')->toArray());
            $data = array('email'=>$email, 'niche'=>$verticals);
            $fire = new fireEmail();
            $fire->fire(false, $email, $data,"costumerSubscribed",'Welcome To Our Newsletter 🎉');
            flash()->overlay("You have been successfully subscribed");

            if ($code !== "" and $code !== null){
                return redirect('/' . $code);
            }else{
                return redirect('/');
            }

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


    public function confirm ($email){

        $subscriber = subscriber::all()->where('email', $email)->first();
        if ($subscriber){
            $subscriber->is_confirmed = true;
            $subscriber->save();
        }

        flash()->overlay("Your subscription has been confirmed", "Thank you!");
        return redirect('/');


    }

}
