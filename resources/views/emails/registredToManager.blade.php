@component('mail::message')
# Publisher ID: {{$data['id']}}


Name : {{$data['name']}}<br/>
Country: {{$data['country']}}<br/>
Skype: {{$data['skype']}}<br/>
E-mail: {{$data['email']}}<br/><br/>


Message: <br/><br/>{{$data['message']}}

@endcomponent
