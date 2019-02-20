@extends('layouts.account')


@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">Refer publishers</h5>
                        <p class="card-category">
                            Refer publishers thrue this link, and get <b>"{{ config('app.manager_commission') }}%"</b> net commission from every publisher's total income.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="col-centered" >
                                    <div class="input-group">
                                        <div class="input-group-prepend" >
                                            <span class="input-group-text" style="font-size: 110%">Link:</span>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="font-size: 100%; text-transform: lowercase;"><b>https://{{ config('app.home_url') }}/getstarted/{{Auth::user()->id}}</b>&nbsp;&nbsp;</span>
                                        </div>

                                    </div>

                                </div>


                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Publishers</h5>

                    </div>
                    <div class="card-body">
                        {{$table}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('title')
    Manage Offers
@endsection

@section('header')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <style>
        .table-responsive{
            display: inline;
        }

        .input-group .form-control:not(:first-child):not(:last-child), .input-group-btn:not(:first-child):not(:last-child){
            border-radius: 0;
        }

        .btn:hover, .btn:focus, .btn:active, .btn.active, .btn:active:focus, .btn:active:hover, .btn.active:focus, .btn.active:hover, .show > .btn.dropdown-toggle, .show > .btn.dropdown-toggle:focus, .show > .btn.dropdown-toggle:hover, .navbar .navbar-nav > a.btn:hover, .navbar .navbar-nav > a.btn:focus, .navbar .navbar-nav > a.btn:active, .navbar .navbar-nav > a.btn.active, .navbar .navbar-nav > a.btn:active:focus, .navbar .navbar-nav > a.btn:active:hover, .navbar .navbar-nav > a.btn.active:focus, .navbar .navbar-nav > a.btn.active:hover, .show > .navbar .navbar-nav > a.btn.dropdown-toggle, .show > .navbar .navbar-nav > a.btn.dropdown-toggle:focus, .show > .navbar .navbar-nav > a.btn.dropdown-toggle:hover {
            background-color: transparent !important;
            color: black !important;
            box-shadow: none !important;
        }
    </style>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ URL::asset('js/core/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/bootstrap.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap-notify.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });

    </script>
@endsection
