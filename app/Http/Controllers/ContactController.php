<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\user;



class ContactController extends Controller
{


    public function test(){

        $token = "6O4GWLpgx7QyZ6gyBTEJXTHymVktEEZ5AhVMD0agXpICBUmNhwXhnHrwPawX";
        $user = user::where("remember_token", $token)->first();

        return $user->hasRole("publisher");

        $to = "abdelilah.sbaai@gmail.com";
        $subject = "To publisher test 6";
        $markdown= 'emails.contacts.test';
        $content = "testing to publisher";
        $data = array('content'=>$content);


        $fire = new fireEmail();
        $fire->fire(false, $to, $data,$markdown,'publisher');
        $fire->fire(true, $to, $data,$markdown,'costumer');

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
