@component('mail::message')

Hi there,

Thanks for subscribing to the {{ config('app.name') }} Newsletter!

#Get Notifications About The Latest {{$data['niche']}} E-books.

To confirm your subscription, please follow the link:

@component('mail::button', ['url' => "https://" . config('app.url') . "/confirm/" . $data['email']])
    Confirm
@endcomponent

Or copy and paste this link in a browser:

{{"https://" . config('app.url') . "/confirm/" . $data['email']}}

*You can <a href="{{"https://" . config('app.url') . "/unsubscribe/" . $data['email']}}">Unsubscribe</a> from marketing emails at any time.


If you received this email by mistake, simply delete it. You won't be subscribed if you don't click the confirmation link above.

If you have any questions please contact us.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
