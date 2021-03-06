@extends('layouts.costumer')
@include('landing.Wall')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">My Products</h5>
                    </div>
                    <div class="card-body">
                        {{$table}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @yield('Wall')
    <div class="col-lg-12" >
        <p class="text-center">
            <a id="discover_button" href="/ebooks" class="btn"  style="background-color: #4C4A48;border-color:#4C4A48;"  target="_blank">More eBooks...</a>
        </p>

    </div>
@endsection




@section('header')
    <style>
        .table-responsive{
            display: inline;
        }

        .input-group .form-control:not(:first-child):not(:last-child), .input-group-btn:not(:first-child):not(:last-child){
            border-radius: 0;
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