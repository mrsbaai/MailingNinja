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
        $email = "abdelilah.sbaai@gmail.com";
        $content = "Whatever";
        $subject = "(Contact Test)";
        $host_email = config('app.contact_costumers');
        $view = 'emails.contacts.received';
        Mail::to($email)->send(new ContactReceived());
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
