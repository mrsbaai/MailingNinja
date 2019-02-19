@include('landing.subscribe')
        <!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <title>{{ config('app.name') }}.</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/bootstrap.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/owl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/animate.css') }}">
    <link href="{{ asset('landing/font-awesome-4.1.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/et-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/lightbox.css') }}">
    <link id="main" rel="stylesheet" type="text/css" href="{{ asset('landing/css/publisher.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/book.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/subscribe.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <style>
        a:hover{
            color:#484d53;
        }
    </style>



</head>
<body>

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"  ><h2 class="heading uppercase" style="margin-top: -5px;">{{ config('app.name') }}<span id="logo_span" style="font-size:200%;color:#7cc576;">.</span></h2></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-nav">

                <li>
                    <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <ul class="list-unstyled">
                            @foreach ($categories as $category)
                                <li style="padding-left:10px;padding-right:10px;"><nobr><a class="dropdown-item" href="/books/{{$category}}">{{$category}}</a></nobr></li>
                            @endforeach

                        </ul>


                    </div>

                </li>

                <li><a href="#contact" class="scrollto">Contact</a></li>
                <li><a class="scrollto" href="{{ route('login') }}">{{ __(' Login') }}</a></li>


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<section id="book">
    <div class="container">
        @yield('content')
    </div>


</section>

<footer>
    <div class="container">
        <div class="col-sm-12 text-center text-center-mobile">


            <div id="subscribe-modal" class="modal fade flash-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @yield('subscribe')
                        </div>
                    </div>
                </div>
            </div>



            <br/><br/><br/>
            <div class="col-md-12">
                <div class="col-md-2">
                </div>
                <div class="col-md-8 wow animated fadeInUp">
                    @yield('subscribe')
                </div>
                <div class="col-md-2">
                </div>
            </div>



            <div class="col-md-12">
                <p class="copyright small">Copyright © <script> document.write(new Date().getFullYear())</script> <span class="uppercase">{{ config('app.name') }}.</span> - All rights reserved!</p>

            </div>

        </div>

    </div>
</footer>

</div>



<script src="{{ asset('landing/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('landing/js/owl.carousel.js') }}"></script>
<script src="{{ asset('landing/js/lightbox.min.js') }}"></script>
<script src="{{ asset('landing/js/wow.min.js') }}"></script>
<script src="{{ asset('landing/js/jquery.onepagenav.js') }}"></script>
<script src="{{ asset('landing/js/core.js') }}"></script>
<script src="{{ asset('landing/js/tooltip.js') }}"></script>
<script src="{{ asset('landing/js/jquery.form-validator.js') }}"></script>
<script src="{{ asset('landing/js/preloader.js') }}"></script>
<script src="{{ asset('landing/js/main.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
<script>


    $('#flash-overlay-modal').modal();
    setTimeout(function(){
        $('#subscribe-modal').modal();
    }, 30000);


</script>
</body>
</html>