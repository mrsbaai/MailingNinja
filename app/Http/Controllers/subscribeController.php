<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\subscriber;
use App\unsubscribes;
use App\link;
use App\offer;
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



        if ($type == 0){

            $offer = offer::where('id',$offer_id)->first();
            if ( $offer){
                $verticals = implode(" & ",$offer->verticals()->pluck('vertical')->toArray());
            }else{
                $verticals = "";
            }

            $data = array('email'=>$email, 'niche'=>$verticals);
            $fire = new fireEmail();
            $fire->fire(true, $email, $data,"emails.costumerSubscribed",'Welcome To Our Newsletter 🎉');



            if ($code !== "" and $code !== null){
                $url = "/" . $code;
            }else{
                $url = "/";
            }

            return ("<script LANGUAGE='JavaScript'>
    window.alert('Thank you! A confirmation link has been sent to your email.')
    window.location.href='" . $url . "';</script>");


        }



    }


    public function unsubscribe ($email = null){

        if ($email == "{email}" or $email == null){
            if(Input::get('email')){
                $email = Input::get('email');
            }else{
                return view('landing.unsubscribe');
            }

        }

        $info = subscriber::all()->where('email', $email)->first();

        $check = unsubscribes::all()->where('email', $email)->first();
        if (!$check){
            if ($this->valid_email($email)){
                $add = new unsubscribes();
                if ($info){
                    $add->offer_id = $info['offer_id'];
                    $add->user_id = $info['user_id'];
                }
                $add->email = $email;
                $add->save();
            }


        }


        return ("<script LANGUAGE='JavaScript'>
    window.alert('Your email $email been unsubscribed. We are sorry to see you go :(')
    window.location.href='/';
    </script>");




    }


    public function confirmSub ($email){

        $subscriber = subscriber::all()->where('email', $email)->first();
        if ($subscriber){
            $subscriber->is_confirmed = true;
            $subscriber->save();
        }

        return ("<script LANGUAGE='JavaScript'>
    window.alert('Thank you! Your subscription has been confirmed')
    window.location.href='/';
    </script>");



    }

}
