@component('mail::message')
   Dear {{$data['name']}},

   We have recently reviewed your Mailing.Ninja activity and decided to <b>Disable you account</b>.

   If you you think this is a mistake please contact us.

   Best,<br>
   {{ config('app.name') }} Team
@endcomponent
