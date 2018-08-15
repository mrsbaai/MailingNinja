<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\contact;
use Carbon\Carbon;

class ContactController extends Controller
{


    public function saveContact(){
        $email = Input::get('lg_email');
        $subject = Input::get('lg_subject');
        $content = Input::get('lg_message');
        $role = Input::get('lg_role');

        try{

            //$subject = "(SMS-Verification Contact From) " . $subject;
            $to = 'support@sms-verification.net';
            //Mail::send('mails.contact', ['content' => $content], function ($message) use($subject,$email, $to){
                //$message->from($email);
                //$message->subject($subject);
                //$message->to($to);
            //});

            $contact = new Contact();
            $contact->email = $email;
            $contact->subject = $subject;
            $contact->message = $content;
            $contact->role = $role;
            $contact->created_at = Carbon::now();
            $contact->save();

            flash('Thank you for your message! We will get back to you as soon as possible.')->clear();
            return redirect()->intended('contact');
        }
        catch(\Exception $e){
            flash('Something went wrong')->error();
            return redirect()->intended('contact');
        }
    }
}
