<?php

namespace App\Http\Controllers;

use App\link;
use App\offer;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
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

    public function screenshotEmailDownload($code){
        $link = link::all()->where('link',$code)->first();
        $offer = offer::where('id', $link['offer_id'])->first();

        $image  = public_path() . 'link.jpg';

        Browsershot::url('https://mailing.ninja/preview/email/' . $code . '/unsubscribe')
            ->setScreenshotType('jpeg', 100)
            ->windowSize(650, 150)
            ->save("$image");

        $unsubscribe_screenshot = Imgur::upload($image);

        Browsershot::url('https://mailing.ninja/preview/email/' . $code . '/link')
            ->setScreenshotType('jpeg', 100)
            ->windowSize(650, 500)
            ->fullPage()
            ->save("$image");

        $link_screenshot = Imgur::upload($image);

        $unsubscribe = "https://" . config('app.promote_url') . "/unsubscribe";
        $link = "https://" . config('app.promote_url') . "/" . $code;
        $view = view('emails.promoteScreenshot')->with('link',$link)
            ->with('link_screenshot',$link_screenshot)
            ->with('unsubscribe',$unsubscribe)
            ->with('unsubscribe_screenshot',$unsubscribe_screenshot)
            ->with('color',$offer['color'])
            ->render();

        header("Content-type: text/html");
        header("Content-Disposition: attachment; filename=creative.htm");
        return $view;

    }
}
