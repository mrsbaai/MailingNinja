@component('mail::message')

Hello,

Thank you for contacting us.

We have received your message about "{{$data['subject']}}", and we will look over your message as soon as possible.


Regards,<br>
{{ config('app.name') }}
@endcomponent
