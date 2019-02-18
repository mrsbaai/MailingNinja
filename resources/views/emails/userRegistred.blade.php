@component('mail::message')
Hey {{$data['name']}},

Thank you for signing up. You can login at the following link:

@component('mail::button', ['url' => config('app.app_url')])
   Login
@endcomponent

You registered with this email: {{$data['email']}}.

If you forgot your password, simply hit "Forgot password" and you'll be prompted to reset it.

If you have any questions, please let us know!

Best,<br>
{{ config('app.name') }} Support Team
@endcomponent
