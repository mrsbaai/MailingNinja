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



        $to = "abdelilah.sbaai@gmail.com";
        $markdown= 'emails.costumerReceipt';

        $data = array('email'=>$to, 'name'=>$to, 'transaction_id'=>$to, 'invoice_id'=>$to, 'product'=>$to, 'type'=>$to, 'amount'=>$to, );


        $fire = new fireEmail();
        $fire->fire(true, $to, $data,$markdown,'Payment Received');


    }
    public function saveContact(){
        $email = Input::get('lg_email');
        $subject = Input::get('lg_subject');
        $content = Input::get('lg_message');
        $role = Input::get('lg_role');
        $markdown= 'emails.contactReceived';
        $markdown2= 'emails.contactToSupport';

        $data = array('subject'=>$subject);
        $data2 = array('content'=>$content, 'from_email'=>$email, 'from_name'=>$role);




        try{

            $fire = new fireEmail();
            if ($role == "unregistered_costumer" or $role == "costumer"){
                $is_costumer = true;
                $to = config('app.contact_costumers');

            }else{
                $is_costumer = false;
                $to = config('app.contact_publishers');
            }

            $fire->fire($is_costumer, $email, $data,$markdown,"Contact: " . $subject);

            $fire->fire($is_costumer, $to, $data2,$markdown2, $subject);

            $contact = new contact();
            $contact->email = $email;
            $contact->subject = $subject;
            $contact->message = $content;
            $contact->role = $role;
            $contact->created_at = Carbon::now();
            $contact->save();

            flash()->message('Thank you! Message sent.')->success();
            return \Redirect::back();
        }
        catch(\Exception $e){
            flash()->message('Error! Something went wrong.')->error();
            return \Redirect::back();
        }
    }
}
