<?php

namespace App\Http\Controllers;

use App\Mail\toCostumer;
use App\Mail\toPublisher;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;


class fireEmail extends Controller
{
    /**
     * @param bool $is_costumer
     * @param null $to
     * @param null $data
     * @param null $markdown
     * @param null $subject
     * @return mixed
     */
    public function fire($is_costumer = true, $to = null, $data = null, $markdown = null, $subject = null){
        app()->forgetInstance('swift.transport');
        app()->forgetInstance('swift.mailer');
        app()->forgetInstance('mailer');
        Mail::clearResolvedInstance('mailer');


            Config::set('services.mailgun.domain', config('app.mailgun_domain_publishers'));
            Config::set('services.mail.username', config('app.mail_username_publishers'));
            Config::set('services.mail.password', config('app.mail_password_publishers'));
            return Mail::to($to)->send(new toPublisher($data,$markdown,$subject));
        



    }
}
