<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class toCostumer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $markdown, $subject)
    {

        $this->markdown = $markdown;
        $this->subject = $subject;
        $this->data = $data;



    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

            App::forgetInstance('mailer');
            Mail::clearResolvedInstance('mailer');
            Config::set('services.mailgun.domain', config('app.mailgun_domain_costumers'));
            Config::set('services.mail.username', config('app.mail_username_costumers'));
            Config::set('services.mail.password', config('app.mail_password_costumers'));

        return $this->from( config('app.contact_costumers'), config('app.app_name'))
            ->markdown($this->markdown)
            ->subject($this->subject)
            ->with('data', $this->data);
    }
}
