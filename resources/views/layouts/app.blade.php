<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>
        @if(explode(".", Request::getHost())[0] == "mailing" or explode(".", Request::getHost())[0] == "mailingninja")
            Mailing Ninja
        @else
            {{strtoupper(explode(".", Request::getHost())[0])}}
        @endif
    </title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />



    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ URL::asset('css/paper-kit.css?v=2.1.0') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">

    <!-- Fonts -->
    <link href='{{ URL::asset('css/google-fonts.css') }}' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ URL::asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    @yield('header')
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent" color-on-scroll="300">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="/">
                @if(explode(".", Request::getHost())[0] == "mailing" or explode(".", Request::getHost())[0] == "mailingninja")
                    Mailing Ninja
                @else
                    {{strtoupper(explode(".", Request::getHost())[0])}}<span id="logo_span" style="font-size:200%;color:#7cc576;">.</span>
                @endif</a>
            <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-auto">

                @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __(' Login') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __(' Get Started') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest




            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="footer section-dark">
    <div class="container">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <li>
                        <a href="https://www.fb.com" target="_blank">Facebook</a>
                    </li>

                </ul>
            </nav>
            <div class="credits ml-auto">
					<span class="copyright">
						© <script>document.write(new Date().getFullYear())</script> -
                        @if(explode(".", Request::getHost())[0] == "mailing" or explode(".", Request::getHost())[0] == "mailingninja")
                            Mailing Ninja
                        @else
                            {{strtoupper(explode(".", Request::getHost())[0])}}<span id="logo_span" style="font-size:200%;color:#7cc576;">.</span>
                        @endif
					</span>
            </div>
        </div>
    </div>
</footer>

</body>

@yield('footer')
<!-- Core JS Files -->
<script src="{{ URL::asset('js/jquery-3.2.1.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/jquery-ui-1.12.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/popper.js') }}" Type="text/javascript"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript"></script>


<!-- Switches -->
<script src="{{ URL::asset('js/bootstrap-switch.min.js') }}" Type="text/javascript"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="{{ URL::asset('js/paper-kit.js?v=2.1.0') }}" Type="text/javascript"></script>

</html>
