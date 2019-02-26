@extends('layouts.costumer')


@section('content')


<br/><br/>


<center>
    <section class="text-center">
        <div class="text-center">
            <div class="row">
                {{ Form::open(array('action' => 'subscribeController@unsubscribe'))}}
                <div><h2 class="title">Do you want to unsubscribe?</h2></div>

                <div class="row text-center">

                    <div class="col-sm-12 text-center">
                        <input name="email" type="text" class="form-control" placeholder="Email to unsubscribe">
                        <a href="#" class="btn btn-danger"  type="submit">Unsubscribe</a>
                    </div>


                </div>

  
                {{ Form::close()}}
            </div>
        </div>
    </section>

</center>





@endsection