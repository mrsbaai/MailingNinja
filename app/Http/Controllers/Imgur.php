<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;;

class Imgur extends Controller
{
    public static function Upload ($file){
        $client_id = '9107f334ba6f8b2';
        $file = file_get_contents($file);
        $url = 'https://api.imgur.com/3/image.json';
        $headers = array("Authorization: Client-ID $client_id");
        $pvars  = array('image' => base64_encode($file));
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL=> $url,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $pvars
        ));

        $out = curl_exec($curl);
        $pms = json_decode($out,true);
        curl_close ($curl);

        $url=$pms['data']['link'];

        if($url!=''){
            return $url;
        }
        else{
            return false;
        }
    }
}
