@extends('layouts.costumer')


@section('content')


<br/><br/>


<center>
    <section class="text-center">
        <div class="text-center">


                <div><h2 class="title">Do you want to unsubscribe?</h2></div>
            {{ Form::open(array('action' => 'subscribeController@unsubscribe'))}}
                <div class="row text-center">

                    <div class="col-sm-12 text-center">
                        <input name="email" type="text" style="max-width: 400px;" class="form-control" placeholder="Email to unsubscribe">
                        <a href="#" class="btn btn-danger"  type="submit">Unsubscribe</a>
                    </div>

                    {{ Form::close()}}
                </div>




        </div>
    </section>

</center>





@endsection