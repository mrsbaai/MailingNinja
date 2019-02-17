@component('mail::message')

{{$data['content']}}

From {{$data['content']}}.

@endcomponent
