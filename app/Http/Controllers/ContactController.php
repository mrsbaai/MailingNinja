<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{


    public function test(){
        $email = "abdelilah.sbaai@gmail.com";
        $content = "Whatever";
        $subject = "(Contact Test)";
        $host_email = config('app.contact_costumers');
        $view = 'emails.contacts.received';

        Mail::send($view, ['content' => $content], function ($message) use($subject,$email,$host_email){
            $message->from($email);
            $message->to($host_email);
            $message->subject($subject);
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
