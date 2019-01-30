@extends('layouts.home')
@include('landing.Wall')
@include('landing.contact')

@section('content')



                <h1 class="heading uppercase" style="margin-top: -5px; font-size: 500%">{{explode(".", Request::getHost())[0]}}<span id="logo_span" style="font-size:200%;color:#7cc576;">.</span></h1>
                <h3 class="heading">“Latest Bestseller eBooks From Well Known Resources.”</h3>
<br/><br/><br/><br/><br/>
                @yield('Wall')







        <section>
            <div class="container ">
                <div class="row">
                    @yield('contact')
                </div>
            </div>
        </section>





@endsection