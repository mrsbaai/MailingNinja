@component('mail::message')
# Thanks for your payment!

This email is your receipt and includes important information. If you feel this transaction is in error, please respond to this email with the details.

@component('mail::table')
    |        |   |
    | ------------- | --------:|
    | Name      | {{$data['name']}}      |
    | Transaction Id      | {{$data['transaction_id']}}      |
    | Invoice Id      | {{$data['invoice_id']}}      |
    | Product      | {{$data['product']}}      |
    | Payment Type      | {{$data['type']}}      |
    | <b>Amount</b>      | <b>{{$data['amount']}}</b>      |
@endcomponent

Please use the login to your account to download your product.

@component('mail::button', ['url' => config('app.url') . '/login' ])
Login
@endcomponent

E-mail: {{$data['email']}}

Password: Created at signup.

If you forgot your password, simply hit "Forgot password" and you'll be prompted to reset it.

Cheers,<br>
{{ config('app.name') }}
@endcomponent
