<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use Illuminate\Support\Facades\Config;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use App\user;
use App\passwordReset;

class ResetPassword extends ResetPasswordNotification
{
    public $token;
    public $email;


    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }



    
        $user = user::all()->first();

        $role = "unknown";

        if ($user->hasRole("publisher") == true){
            $role = "publisher";
        }

        if ($user->hasRole("publisher") == false){
            $role = "not publisher";
        }



        Config::set('app.name', config('app.home_name'));
        Config::set('app.url', config('app.home_url'));
        $from_e = config('app.contact_publishers');
        $from_n = config('app.home_name');
        $ur = 'https://' . config('app.home_url');

        return (new MailMessage)
            ->from($from_e,$from_n)
            ->subject('Reset Password')
            ->line($this->email . 'You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $ur.route('password.reset', md5($this->token), false))
            ->line('If you did not request a password reset, no further action is required.');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
