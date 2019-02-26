<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Mailing.Ninja :: @yield('title')</title>
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

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | oranlogige | red | yellow"
      -->
        <div class="logo">
            <a href="/" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="{{ URL::asset('images/logo-small.png') }}">
                </div>
            </a>
            <a href="/" class="simple-text logo-normal">
                Mailing Ninja
                <!-- <div class="logo-image-big">
                  <img src="../assets/img/logo-big.png">
                </div> -->
            </a>
        </div>
        <div class="sidebar-wrapper">
            @if (Auth::user()->hasRole('manager'))
                <ul class="nav">
                    <li @if(Route::current()->getName() == 'manager-dashboard' or Route::current()->getName() == 'manager-home') class="active" @endif>
                        <a href="{{ route('manager-dashboard') }}">
                            <i class="nc-icon nc-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li @if(Request::is('*stat*')) class="active" @endif>
                        <a href="{{ route('manager-statistics') }}">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Statistics</p>
                        </a>
                    </li>
                    <li @if(Route::current()->getName() == 'offers-new' or Route::current()->getName() == 'offers-destroy' or Route::current()->getName() == 'offers-edit' or Route::current()->getName() == 'offers-edit-promo' or Route::current()->getName() == 'offers-manage' or Route::current()->getName() == 'store-offer' or Route::current()->getName() == 'update-offer' or Route::current()->getName() == 'update-landing' or Route::current()->getName() == 'update-promo') class="active" @endif>
                        <a href="{{ route('offers-manage') }}">
                            <i class="nc-icon nc-bulb-63"></i>
                            <p>Manage Offers</p>
                        </a>
                    </li>


                    <li @if( Route::current()->getName() == 'manage-publishers' or Route::current()->getName() == 'edit-publisher' or  Route::current()->getName() == 'publisher-private-offers'  or Route::current()->getName() == 'publisher-offer-destroy') class="active" @endif>
                        <a href="{{ route('manage-publishers') }}">
                            <i class="nc-icon nc-badge"></i>
                            <p>Manage Publishers</p>
                        </a>
                    </li>
                    <li @if(Route::current()->getName() == 'manager-account') class="active" @endif>
                        <a href="{{ route('manager-account') }}">
                            <i class="nc-icon nc-circle-10"></i>
                            <p>Account</p>
                        </a>
                    </li>



                    <li class="active-pro">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"
                        >
                            <i class="nc-icon nc-button-power"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endif
            @if (Auth::user()->hasRole('publisher'))
                <ul class="nav">
                    <li @if(Route::current()->getName() == 'publisher-dashboard' or Route::current()->getName() == 'publisher-home') class="active" @endif>
                        <a href="{{ route('publisher-dashboard') }}">
                            <i class="nc-icon nc-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li @if(Request::is('*statistics*')) class="active" @endif>
                        <a href="{{ route('publisher-statistics') }}">
                            <i class="nc-icon nc-chart-bar-32"></i>
                            <p>Statistics</p>
                        </a>
                    </li>

                    <li @if(Request::is('*offers*')) class="active" @endif>
                        <a href="{{ route('publisher-offers') }}">
                            <i class="nc-icon nc-shop"></i>
                            <p>Offers</p>
                        </a>
                    </li>


                    <li @if(Route::current()->getName() == 'publisher-subscribers') class="active" @endif>
                        <a href="{{ route('publisher-subscribers') }}">
                            <i class="nc-icon nc-cloud-download-93"></i>
                            <p>E-mails</p>
                        </a>
                    </li>
                    <li @if(Route::current()->getName() == 'publisher-account') class="active" @endif>
                        <a href="{{ route('publisher-account') }}">
                            <i class="nc-icon nc-badge"></i>
                            <p>Account</p>
                        </a>
                    </li>
                    <li @if(Route::current()->getName() == 'publisher-support') class="active" @endif>
                        <a href="{{ route('publisher-support') }}">
                            <i class="nc-icon nc-chat-33"></i>
                            <p>Support</p>
                        </a>
                    </li>

                    <li class="active-pro">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"
                        >
                            <i class="nc-icon nc-button-power"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endif

        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>

                    <span class="navbar-brand">@yield('title')</span>




                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                    <ul class="navbar-nav">
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
            </div>
        </nav>
        <!-- End Navbar -->
        <!-- <div class="panel-header panel-header-lg">

    <canvas id="bigDashboardChart"></canvas>


  </div> -->

        <div class="container-fluid" style="padding-top:100px;padding-right:30px;">
            @include('flash::message')
            @yield('content')
        </div>

        <footer class="footer footer-black  footer-white ">
            <div class="container-fluid">
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
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Abdelilah
              </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
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