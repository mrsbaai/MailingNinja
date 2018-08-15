@extends('layouts.manager')

@section('content')
    <div class="container">
        <h1>Welcome Back {{ Auth::user()->name }}!</h1>

    </div>
@endsection
