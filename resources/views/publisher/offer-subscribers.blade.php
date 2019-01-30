@extends('layouts.account')

@section('content')
    <div class="container">
        <h1>Subscribers (Email list building)</h1>
        <div class="container">
            <p>This offer has generated a total of <u><b>1223</b> subscribers</u>.</p>
            <div class="form-group col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Download 1223 E-mails</button>
            </div>
        </div>

    </div>
@endsection

@section('title')
    Offer Subscribers
@endsection

@section('header')
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
