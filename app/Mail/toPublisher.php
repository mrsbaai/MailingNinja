<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class toPublisher extends Mailable
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


        if (isset ($this->data['from'])){
            return $this->from( $this->data['from'])
                ->markdown($this->markdown)
                ->subject($this->subject)
                ->with('data', $this->data);
        }else{
            return $this->from( config('app.contact_publishers'), config('app.home_name'))
                ->markdown($this->markdown)
                ->subject($this->subject)
                ->with('data', $this->data);
        }

    }
}
