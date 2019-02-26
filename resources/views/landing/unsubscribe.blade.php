@extends('layouts.costumer')


@section('content')


<br/><br/>


<center>
    <section class="text-center">




            {{ Form::open(array('action' => 'subscribeController@unsubscribe'))}}
            <div class = "col-12">
                <div class = "col-3"></div><div class = "col-6"><h2 class="title">Do you want to unsubscribe?</h2></div><div class = "col-3"></div>
                <div class = "col-3"></div><div class = "col-6"> <input name="email" type="text"  class="form-control" placeholder="Email to unsubscribe"></div><div class = "col-3"></div>
                <div class = "col-3"></div><div class = "col-6"> <input class="btn btn-danger"  type="submit" value="Unsubscribe"></div><div class = "col-3"></div>

            </div>





                    {{ Form::close()}}



    </section>

</center>





@endsection