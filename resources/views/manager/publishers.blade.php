@extends('layouts.account')



@extends('layouts.account')


@section('content')

    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Manage Publishers</h5>
                        <p class="card-category">...</p>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid no-padding ">
                            <div class="col-sm-12 no-padding ">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            @foreach($columns as $column)
                                                <th>{{ $column }}</th>
                                            @endforeach
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($rows as $id => $array)
                                            <tr>
                                                @foreach($array as $content)
                                                    <td>{{ $content }}</td>
                                                @endforeach
                                                <td><a href="/manager/publishers/{{$array['0']}}">Manage</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('title')
    Manage Publishers
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
'
@endsection

