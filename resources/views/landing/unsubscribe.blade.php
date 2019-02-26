@extends('layouts.costumer')


@section('content')


<br/><br/>



    <section>
        <div class="text-center">
            <div class="row">
                {{ Form::open(array('action' => 'subscribeController@unsubscribe'))}}
                    <div><h2 class="title">Do you want to unsubscribe?</h2></div>

                <div class="row">

                    <div class="col-sm-12">
                        <input name="email" type="text" class="form-control" placeholder="Email to unsubscribe">
                    </div>


                </div>

                <div class="row">
                    <a href="#" class="btn btn-danger"  type="submit">Unsubscribe</a>


                </div>

            {{ Form::close()}}
            </div>
        </div>
    </section>





@endsection