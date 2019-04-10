<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use URL;
use App\link;
use Carbon\carbon;
use App\ip;
use App\clicks;
use App\cpc;
use App\sells;
use App\cpa;
use App\opens;
use App\user;


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

                if ($info['cpc'] > 0){


                    // cpc profit protection


                    $query  = sells::latest();
                    $query->where('publisher_id', $info['user_id'])
                        ->where('offer_id', $info['offer_id'])
                        ->where('status','Completed');
                    $collection = $query->get();
                    $paypal_profit = 0;
                    foreach ($collection as $item) {
                        $paypal_profit = $paypal_profit + $item['net_amount'];
                    }

                    $paypal_profit = ($paypal_profit * 70) / 100;

                    $query  = cpc::latest();
                    $query->where('user_id', $info['user_id'])
                        ->where('offer_id', $info['offer_id']);
                    $collection = $query->get();
                    $cpc_profit = 0;
                    foreach ($collection as $item) {
                        $cpc_profit = $cpc_profit + $item['value'];
                    }

                    if($paypal_profit > $cpc_profit or $cpc_profit < 5) {

                        // update publisher balance
                        $publisher = user::all()->where('id', $info['user_id'])->first();
                        $new_balance = $publisher['balance'] + $info['cpc'];
                        $ret = $publisher->update([
                            'balance' => $new_balance,
                        ]);

                        // log
                        $cpc = cpc::all()
                            ->where('created_at', '>=', Carbon::today())
                            ->where('user_id', $info['user_id'])
                            ->where('offer_id', $info['offer_id'])
                            ->first();
                        if (!$cpc){
                            //add new
                            $add = new cpc();
                            $add->offer_id = $info['offer_id'];
                            $add->user_id = $info['user_id'];
                            $add->count = 1;
                            $add->value = $info['cpc'];
                            $add->save();
                        }else{
                            $new_count = $cpc['count'] + 1;
                            $new_value = $cpc['value'] + $info['cpc'];
                            $ret = $cpc->update([
                                'count' => $new_count,
                                'value' => $new_value,
                            ]);
                        }
                    }




                }

            }


        }
    }

    public function open($code, $email=null){

            if($email){
                $subscribe = new subscribeController();
                $subscribe->subscribe($code,$email,3);
            }

            $info = link::all()->where('link', $code)->first();

            if ($info){
                $log = opens::all()
                    ->where('created_at', '>=', Carbon::today())
                    ->where('user_id', $info['user_id'])
                    ->where('offer_id', $info['offer_id'])
                    ->first();

                if (!$log){
                    //add new
                    $add = new opens();
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


        $storagePath = URL::asset('images/tracking.png');
        return Image::make($storagePath)->response();
    }



}
