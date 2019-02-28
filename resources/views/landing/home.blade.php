@extends('layouts.home')
@include('landing.Wall')
@include('landing.contact')

@section('content')



                <h1 class="heading uppercase" style="margin-top: -70px; font-size: 500%">{{ config('app.name') }}<span id="logo_span" style="font-size:200%;color:#7cc576;">.</span></h1>
                <h3 class="heading  wow animated fadeInUp">“Latest Bestseller eBooks.”</h3>
                <br/><br/><br/><br/>
                <div class="wow animated fadeInUp">
                    @yield('Wall')
                </div>








        <section>
            <div class=" ">
                <div class="row">
                    @yield('contact')
                </div>
            </div>
        </section>





@endsection