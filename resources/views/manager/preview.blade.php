@extends('layouts.app')

@section('content')
    <div class="container">
        {!! $summernote->content !!}
    </div>
@endsection
