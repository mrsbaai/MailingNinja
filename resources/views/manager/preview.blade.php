@extends('layouts.minimal')

@section('content')
    <div class="container">
        {!! $summernote->content !!}
    </div>
@endsection
