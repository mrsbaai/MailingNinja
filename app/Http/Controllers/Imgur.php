<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;;

class Imgur extends Controller
{
    public function Upload (){
        $filename = $img['tmp_name'];
        $client_id='67fd839d20ce847';		// Replace this with your client_id, if you want images to be uploaded under your imgur account
        $handle = fopen($filename, 'r');
        $data = fread($handle, filesize($filename));
        $pvars = array('image' => base64_encode($data));
        $timeout = 30;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
        $out = curl_exec($curl);
        curl_close ($curl);
        $pms = json_decode($out,true);
        $url=$pms['data']['link'];
        if($url!=''){
            echo "<h4 bg-success>Uploaded Without Any Problem</h4>";
            echo "<input type='text' id='image-link' value='".substr($url,8)."'/><button onclick='copyToClipboard()'>Copy link</button><br/><hr/><h5>Preview : </h5>";
            echo "<img id='imgur-image' alt='imgur-image' src='$url'/>";
        }
        else{
            echo "<h4 class='bg-danger'>There’s a Problem</h4>";
            echo "<div>".$pms['data']['error']."</div>";
        }
    }
}
