

@extends('layouts.account')

@section('content')

    <div class="content">
        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">About The Product</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{$data['thumbnail']}}" class="img-thumbnail rounded" width="400" alt="{{$data['title']}}">
                            </div>
                            <div class="col-md-7">
                                <h6>{{$data['title']}}</h6>
                                <p>{{$data['description']}}</p>
                                <p>Verticals:
                                    @foreach($data['verticals'] as $key => $vertical)@if ($key != key($data['verticals'])), @endif{{ $vertical['vertical'] }}@endforeach.
                                </p>
                                <span s="">
                                    <a target='blank' href='{{$data['preview']}}' title='Preview Landing Page'>
                                        <button class="btn btn-danger">Preview Landing Page</button>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card ">
                    <div class="card-header">
                        <h5 class="card-title">Generate A Referral Link For This Offer</h5>
                        <p class="card-category">Set the payout to <b>"0"</b> to use the offer for <b>E-mail list building</b>.</p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-4 col-centered">

                                <form>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="font-size: 300%"><b>$</b></div>
                                        </div>
                                        <input class="form-control" name="generate" value="{{$data['price']}}" placeholder="Payout" type="text" style="font-size: 300%">

                                        <div class="input-group-append">
                                                <span class="input-group-text p-0 ">
                                                    <button type="submit" class="btn btn-link" title="Generate">
                                                        <i class="nc-icon nc-minimal-right" style="font-size: 300%"></i>&nbsp;&nbsp;
                                                    </button>
                                                </span>
                                        </div>

                                    </div>

                                </form>
                            </div>

                    </div>


                        <div class="row">


                            <div class="col-centered">

                                    <div class="input-group">
                                        <div class="input-group-prepend" >
                                            <span class="input-group-text" style="font-size: 110%">Link:</span>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="font-size: 130%"><b>http://premiumbooks.net/ssfvfed</b>&nbsp;&nbsp;</span>
                                        </div>

                                    </div>

                            </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Unsubscribers (Suppression list) </h5>
                        <p class="card-category">Don't send this offer to any of these E-mails</p>


                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12 text-center">
                                    <button type="submit" class="btn btn-warning">Download Suppression List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Promotional Tools</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>{!! $data['promo'] !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

        @section('title')
            Offer Info
        @endsection

        @section('header')
            <style>

                h1,h2,h3,h4 {
                    font-size: 120%;
                    font-weight: bold;
                }
                .col-centered{
                    float: none;
                    margin: 0 auto;
                    padding-bottom: 20px;
                }

                .input-group .form-control:not(:first-child):not(:last-child), .input-group-btn:not(:first-child):not(:last-child){
                    border-radius: 0;
                    border-right: 0;
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