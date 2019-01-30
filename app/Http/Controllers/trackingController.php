<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use URL;
use App\link;
use Carbon\carbon;
use App\ip;
use App\clicks;


class trackingController extends Controller
{

    public static function ipNew(){
        if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $http_x_headers = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
            $_SERVER['REMOTE_ADDR'] = $http_x_headers[0];
        }

        $ip = ip::where('ip', $_SERVER['REMOTE_ADDR'])->first();


        if ($ip){
            return false;
        }else{
            $add = new ip();
            $add->ip = $_SERVER['REMOTE_ADDR'];
            $add->save();
            return true;
        }



    }
    public function click($code, $email){


        if ($this->ipNew()){
            if($email){
                $subscribe = new subscribeController();
                $subscribe->subscribe($code,$email,2);
            }
            // add log

            $info = link::all()->where('link', $code)->first();

            if ($info){
                $log = clicks::all()
                    ->where('created_at', '>=', Carbon::today())
                    ->where('user_id', $info['user_id'])
                    ->where('offer_id', $info['offer_id'])
                    ->first();

                if (!$log){
                    //add new
                    $add = new clicks();
                    $add->offer_id = $info['offer_id'];
                    $add->user_id = $info['user_id'];
                    $add->count = 1;
                    $add->save();
                }else{
                    $new_count = $log['count'] + 1;
                    $ret = $log->update([
                        'count' => $new_count,
                    ]);
                }
            }


        }
    }

    public function open($code, $email=null){
        if ($this->ipNew()){
            if($email){
                $subscribe = new subscribeController();
                $subscribe->subscribe($code,$email,3);
            }
        }

        $storagePath = URL::asset('images/tracking.png');
        return Image::make($storagePath)->response();
    }

}
