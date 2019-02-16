<?php

namespace App\Http\Controllers;

use App\Mail\toCostumer;
use App\Mail\toPublisher;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;


class fireEmail extends Controller
{
    public function fire($is_costumer = true, $to = null, $data = null,$markdown = null, $subject = null){
        app()->forgetInstance('swift.transport');
        app()->forgetInstance('swift.mailer');
        app()->forgetInstance('mailer');
        Mail::clearResolvedInstance('mailer');
        return Mail::to($to)->send(new toCostumer($data,$markdown,$subject));
        if ($is_costumer){
            Config::set('services.mailgun.domain', config('app.mailgun_domain_costumer'));
            Config::set('services.mail.username', config('app.mail_username_costumer'));
            Config::set('services.mail.password', config('app.mail_password_costumer'));
            return Mail::to($to)->send(new toCostumer($data,$markdown,$subject));
        }else{
            Config::set('services.mailgun.domain', config('app.mailgun_domain_publishers'));
            Config::set('services.mail.username', config('app.mail_username_publishers'));
            Config::set('services.mail.password', config('app.mail_password_publishers'));
            return Mail::to($to)->send(new toPublisher($data,$markdown,$subject));
        }



    }
}
