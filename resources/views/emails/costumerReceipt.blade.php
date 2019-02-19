@component('mail::message')
# Thanks for your payment!

This email is your receipt and includes important information. If you feel this transaction is in error, please respond to this email with the details.

@component('mail::table')
    |        |   |
    | ------------- | --------:|
    | Name      | $10      |
    | Transaction Id      | $10      |
    | Invoice Id      | $10      |
    | Product      | $10      |
    | Payment Type      | PayPal      |
    | Amount      | $10      |
@endcomponent

Please use the login to your account to download your product.

@component('mail::button', ['url' => config('app.url') . '/login' ])
Login
@endcomponent

E-mail: {{$data['email']}}

Password: Created at signup.

If you forgot your password, simply hit "Forgot password" and you'll be prompted to reset it.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
