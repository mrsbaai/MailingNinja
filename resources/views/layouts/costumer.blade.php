<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name') }}.</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


    <!-- CSS Files -->


    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/paper-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ URL::asset('css/account.css') }}" rel="stylesheet" />

    @yield('header')

</head>
<body style="background-color: #F4F3EF;">

<div class="wrapper " style="background-color: #F4F3EF;">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">


                    <span class="navbar-brand">

                        <span class="uppercase">{{ config('app.name') }}</span><span id="logo_span" style="font-size:250%;color:#7cc576;">.</span>
                    </span>




                </div>
                @if(Auth::check())
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link btn-rotate"
                               href="/"
                            >My Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-rotate"
                               href="/contact"
                            >Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-rotate"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"
                            >
                                <p>{{ __('Logout') }}</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                    @endif
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- <div class="panel-header panel-header-lg">

    <canvas id="bigDashboardChart"></canvas>


  </div> -->
    <div class="container" style="padding-top:100px;" >
        @include('flash::message')
        @yield('content')
    </div>

        <footer class="footer footer-white ">
            <div class="container-fluid">
                <div class="row text-center">

                    <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, Made With <i class="fa fa-heart heart"></i> By <span class="uppercase">{{ config('app.name') }}</span><span id="logo_span" style="font-size:250%;color:#7cc576;">.</span>
              </span>
                    </div>
                </div>
            </div>
        </footer>

</div>

@yield('footer')

<!--   Core JS Files   -->
<script type="text/javascript" src="{{ URL::asset('js/core/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/core/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/core/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap-notify.js') }}"></script>

<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script type="text/javascript" src="{{ URL::asset('js/paper-dashboard.min.js?v=2.0.0') }}"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->

<script type="text/javascript" src="{{ URL::asset('js/dashboard.js') }}"></script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
    });
</script>

<script>
    $('#flash-overlay-modal').modal();
    $('div.alert').not('.alert-important').delay(15000).fadeOut(450);

</script>
</body>

</html>