@extends('layouts.manager')

@section('header')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection
@section('content')
<div class="container">
    <h1>Manage Offers</h1>
    @include('flash::message')
    {{$table}}
</div>
@endsection
