@extends('layouts.account')

@section('content')
    <div class="content">
        <div class="row">
            @if(Auth::user()->is_monetize == false)
            <div class="col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-email-85 text-primary"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Subscribes <br/>(Today)</p>
                                    <p class="card-title">{{$data['subscribers_today']}}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> {{$data['subscribers_all']}} Available
                        </div>
                    </div>
                </div>
            </div>
            @endif
                @if(Auth::user()->is_monetize == true)
            <div class="col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-money-coins text-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Balance<br/>(Current)</p>
                                    <p class="card-title">${{Auth::user()->balance}}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> <a href="{{ route('publisher-account') }}">Withdraw</a>
                        </div>
                    </div>
                </div>
            </div>
                @endif


            <div class="col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-tap-01 text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Unique Clicks <br/>(Today)</p>
                                    <p class="card-title">{{$data['clicks_today']}}
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> {{$data['clicks_all']}} Lifetime
                        </div>
                    </div>
                </div>
            </div>
        </div>




        @if(Auth::user()->is_monetize == true)
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">[Clicks]</h5>
                        </div>
                        <div class="card-body ">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#Clicks7">7 Days</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Clicks30">30 Days</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Clicks90">90 Days</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="Clicks7" class="container tab-pane active"><br>
                                    <h5>7 Days Clicks</h5>
                                    {!! $ClickChart7->render() !!}


                                </div>
                                <div id="Clicks30" class="container tab-pane fade"><br>
                                    <h5>30 Days Clicks</h5>
                                    {!! $ClickChart30->render() !!}

                                </div>
                                <div id="Clicks90" class="container tab-pane fade"><br>
                                    <h5>90 Days Clicks</h5>
                                    {!! $ClickChart90->render() !!}


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">[CPC]</h5>
                        </div>
                        <div class="card-body ">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#cpc7">7 Days</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cpc30">30 Days</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cpc90">90 Days</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="cpc7" class="container tab-pane active"><br>
                                    <h5>7 Days Profit</h5>
                                    {!! $cpcChart7->render() !!}


                                </div>
                                <div id="cpc30" class="container tab-pane fade"><br>
                                    <h5>30 Days Profit</h5>
                                    {!! $cpcChart30->render() !!}

                                </div>
                                <div id="cpc90" class="container tab-pane fade"><br>
                                    <h5>90 Days Profit</h5>
                                    {!! $cpcChart90->render() !!}


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">[CPA]</h5>
                        </div>
                        <div class="card-body ">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#cpa7">7 Days</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cpa30">30 Days</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cpa90">90 Days</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="cpa7" class="container tab-pane active"><br>
                                    <h5>7 Days Profit</h5>
                                    {!! $cpaChart7->render() !!}


                                </div>
                                <div id="cpa30" class="container tab-pane fade"><br>
                                    <h5>30 Days Profit</h5>
                                    {!! $cpaChart30->render() !!}

                                </div>
                                <div id="cpa90" class="container tab-pane fade"><br>
                                    <h5>90 Days Profit</h5>
                                    {!! $cpaChart90->render() !!}


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        @endif


        @if(Auth::user()->is_monetize == false)
        <div class="row">
            <div class="col-md-12">

                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">Sells</h5>
                    </div>
                    <div class="card-body">
                        {{$table}}
                    </div>
                </div>
            </div>
        </div>
        @endif




    </div>
@endsection

@section('title')
    Dashboard
@endsection

@section('header')
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
    <!-- Chart JS -->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/chartjs.min.js') }}"></script>


@endsection