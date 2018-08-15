@extends('layouts.manager')

@section('content')
<div class="container">
    <h1>Manage Publishers</h1>

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
@endsection
