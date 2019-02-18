@component('mail::message')
Hello {{$data['name']}},

Thank you for signing up. Your application is received and currently under review.

You will be notified by email when/if your application is approved.

If you have any questions or concerns throughout this application process, please feel free to contact us.

Your account manager is: "{{$data['manager_name']}}". Contact your account manager via e-mail at "{{$data['manager_email']}}", or Skype at "{{$data['manager_skype']}}".

Best,<br>
{{ config('app.name') }} Team
@endcomponent
