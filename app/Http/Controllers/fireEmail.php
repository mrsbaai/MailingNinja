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

        if ($is_costumer == true){
            Config::set('services.mailgun.domain', config('app.mailgun_domain_costumers'));
            Config::set('services.mail.username', config('app.mail_username_costumers'));
            Config::set('services.mail.password', config('app.mail_password_costumers'));
            $appName = config('app.name');
            Config::set('app.name', $appName . ".");
            Mail::to($to)->send(new toCostumer($data,$markdown,$subject));

            Config::set('app.name', $appName);

        }else{
            Config::set('services.mailgun.domain', config('app.mailgun_domain_publishers'));
            Config::set('services.mail.username', config('app.mail_username_publishers'));
            Config::set('services.mail.password', config('app.mail_password_publishers'));
            $appName = config('app.name');
            $appURL = config('app.url');
            Config::set('app.name', config('app.home_name'));
            Config::set('app.url', config('app.home_url'));
            Mail::to($to)->send(new toPublisher($data,$markdown,$subject));
            Config::set('app.name', $appName);
            Config::set('app.url', $appURL);
        }



    }
}
