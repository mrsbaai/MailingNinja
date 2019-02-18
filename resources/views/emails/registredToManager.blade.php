@component('mail::message')
# Publisher ID: {{$data['id']}}

Name : {{$data['name']}}
Country: {{$data['country']}}
Skype: {{$data['skype']}}
E-mail: {{$data['email']}}


Message: {{$data['message']}}

@endcomponent
