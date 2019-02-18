@component('mail::message')
Hey {{$data['name']}},

Thank you for signing up. You can login at the following link:

@component('mail::button', ['url' => $data['url']])
   Login
@endcomponent

You registered with this email: {{$data['name']}}.

If you forgot your password, simply hit "Forgot password" and you'll be prompted to reset it.


Best,<br>
{{ config('app.name') }} Support Team
@endcomponent
