@extends('layouts.home')
@include('landing.Wall')

@include('landing.contact')

@section('content')

    <center>
        <div class="col-md-12 wow animated fadeInUp">
            <h1 class="heading">Selected Collection Of Bestseller <b style="text-transform: capitalize;">“{{$category}}”</b> eBooks:</h1>

            <br/><br/><br/><br/>

        </div>

        @yield('Wall')

        <a href="/" class="btn btn-green " target="_blank">See Top Rated eBooks</a>
    </center>
    @yield('contact')

@endsection