<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;

class ContactController extends Controller
{


    public function test(){
        $user_email = "abdelilah.sbaai@gmail.com";
        $content = "Whatever";
        $subject = "(Contact Test)";
        $we_email = config('app.contact_costumers');
        $we_name = config('app.app_name');
        $view = 'emails.contacts.received';
        $data = array('name'=>$we_name, 'email'=>$we_email, 'message'=>$content);


        //Mail::to($email)->send(new ContactReceived())->with('site_title','title here');





        Mail::send(new ContactReceived(), $data, function($message) use ($we_email, $we_name, $subject, $user_email)
        {
            $message->from($we_email, $we_name);
            $message->to($user_email)->subject($subject);
        });
    }
    public function saveContact(){
        $email = Input::get('lg_email');
        $subject = Input::get('lg_subject');
        $content = Input::get('lg_message');
        $role = Input::get('lg_role');



        try{

            //$subject = "(SMS-Verification Contact From) " . $subject;
            //$to = 'support@sms-verification.net';
            //Mail::send('mails.contact', ['content' => $content], function ($message) use($subject,$email, $to){
                //$message->from($email);
                //$message->subject($subject);
                //$message->to($to);
            //});

            //$contact = new contact();
            //$contact->email = $email;
            //$contact->subject = $subject;
            //$contact->message = $content;
            //$contact->role = $role;
            //$contact->created_at = Carbon::now();
            //$contact->save();

            flash()->message('Sent! We have received your message and would like to thank you for writing to us. We will look over your message as soon as possible.')->success();
            return \Redirect::back();
        }
        catch(\Exception $e){
            flash()->message('Error! Something went wrong.')->error();
            return \Redirect::back();
        }
    }
}
