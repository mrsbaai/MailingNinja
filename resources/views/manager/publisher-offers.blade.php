@extends('layouts.account')


@section('content')

    <div class="content">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Assign Offer (ID)</h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="col-sm-4 col-centered">
                            {{ Form::open(array('action' => 'managerController@assignOffer', 'id' => 'assignOffer'))}}



                            <input name="publisher_id" value="{{$publisher_id}}" hidden>
                            <input class="form-control btn-lg" name="offer_id"  placeholder="Offer ID" required>

                            <button type="submit" class="btn btn-primary" title="Assign">
                                Assign
                            </button>

                            {{Form::close()}}
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Assigned Offers</h5>
                        @include('flash::message')
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
    {{$title}}'s Private Offers
@endsection

@section('header')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


    <style>

        .table-responsive{
            display: inline;
        }

        .col-centered{
            float: none;
            margin: 0 auto;
            padding-bottom: 20px;
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

@endsection
