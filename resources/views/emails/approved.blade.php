@component('mail::message')
Dear {{$data['name']}},

Your application to Mailing.Ninja has been <b>approved</b>. We are pleased to welcome you to the Mailing.Ninja Network!

Please use the login credentials you created upon registration to sign in to your publisher account.

@component('mail::button', ['url' => config('app.home_url') . '/login'])
    Login
@endcomponent

E-mail: {{$data['email']}}

Password: Created at signup.

If you forgot your password, simply hit "Forgot password" and you'll be prompted to reset it.

#Please complete your account info before using the offers.

<b>Your dedicated account manager name is: "{{$data['manager_name']}}".</b>

Contact your account manager via e-mail at "{{$data['manager_email']}}", or via Skype at "{{$data['manager_skype']}}".

Your account manager and our knowledgeable support team are available 7 days/week. Please contact us with any questions you might have. We can also help you select campaigns that will work well with your preferred promotion styles.

Once again, welcome to the network!

Sincerely,<br>
{{ config('app.name') }} Support Team
@endcomponent
