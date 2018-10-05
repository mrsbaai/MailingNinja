@extends('layouts.account')

@section('content')
    <div class="content">
        <div class="row">
            {!! $chart->render() !!}


        </div>
    </div>


@endsection

@section('footer')
    <script type="text/javascript" src="{{ URL::asset('js/core/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- Chart JS -->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/chartjs.min.js') }}"></script>


@endsection