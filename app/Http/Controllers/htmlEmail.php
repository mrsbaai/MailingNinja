<?php

namespace App\Http\Controllers;

use App\link;
use App\offer;
use Illuminate\Http\Request;
use JonnyW\PhantomJs\Client;

class htmlEmail extends Controller
{
    public function getEmailData($code=null,$id=null){

        if($code !== null){
            $link = link::all()->where('link',$code)->first();
            $offer = offer::where('id', $link['offer_id'])->first();
            $data['price'] = $link['price'];
            $data['link'] = "https://" . config('app.promote_url') . "/" . $code;
        }else{
            $offer = offer::where('id', $id)->first();
            $data['price'] = $offer['payout'];
            $data['link'] = "https://" . config('app.promote_url') . "/ebook/" . $id;
        }



        $data['cover'] = $offer['thumbnail'];
        $data['app_name'] = config('app.name') .".";
        $data['unsubscribe'] = "https://" . config('app.promote_url') . "/unsubscribe";
        $data['description'] = $offer['description'];

        $data['about_3'] = $offer['book_about_3'];
        $data['title'] = $offer['title'];
        $data['subtitle'] = $offer['subtitle'];
        $data['primary_color'] = $offer['color'];

        return $data;
    }
    public function previewEmail($code){
        $data = $this->getEmailData($code,null);
        return view('emails.promote')->with('is_link',true)->with('is_unsubscribe',true)->with('data',$data);
    }
    public function previewEmailId($id=null){
        $data = $this->getEmailData(null,$id);
        return view('emails.promote')->with('is_link',true)->with('is_unsubscribe',true)->with('data',$data);
    }

    public function previewEmailLink($code){
        $data = $this->getEmailData($code,null);
        return view('emails.promote')->with('is_link',true)->with('is_unsubscribe',false)->with('data',$data);
    }

    public function previewEmailUnsubscribe($code){
        $data = $this->getEmailData($code,null);
        return view('emails.promote')->with('is_link',false)->with('is_unsubscribe',true)->with('data',$data);
    }

    /**
     * @param $code
     * @return string
     * @throws \Throwable
     */
    public function downloadEmail($code){
        $data = $this->getEmailData($code);
        $view = view('emails.promote')->with('is_link',true)->with('is_unsubscribe',true)->with('data',$data)->render();
        header("Content-type: text/html");
        header("Content-Disposition: attachment; filename=creative.htm");
        return $view;

    }

    public function screenshot(){
        $client = Client::getInstance();
        $client->getEngine()->setPath('../bin/phantomjs.exe');


        $request = $client->getMessageFactory()->createRequest('http://jonnyw.me', 'GET');


        $response = $client->getMessageFactory()->createResponse();

        // Send the request
        $client->send($request, $response);

        if($response->getStatus() === 200) {

            // Dump the requested page content
            echo $response->getContent();
        }

    }
}
