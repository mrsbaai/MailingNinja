@extends('layouts.home')
@include('landing.Wall')

@include('landing.contact')

@section('content')

    <center>
        <div class="col-md-12 wow animated fadeInUp" style="Nmargin-top:-100px;">
            <h3 class="heading">People Who Purchased: <b style="text-transform: capitalize;">“{{$title}}”</b></h3>
            <h1 class="heading">Also Liked The Following eBooks:</h1>
            <br/><br/><br/>

        </div>
        <div class="wow animated fadeInUp" >
            @yield('Wall')
            <a href="/" class="btn btn-green " target="_blank">See Top Rated eBooks</a>
        </div>




    </center>


    <section>
        <div class=" ">
            <div class="row">
                @yield('contact')
            </div>
        </div>
    </section>



@endsection