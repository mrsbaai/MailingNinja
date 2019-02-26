@extends('layouts.costumer')


@section('content')


<br/><br/>


<center>
    <section class="text-center">




            {{ Form::open(array('action' => 'subscribeController@unsubscribe'))}}
            <div class = "col-12">
                <div><h2 class="title">Do you want to unsubscribe?</h2></div>
                <div> <input name="email" type="text" style="max-width: 400px;" class="form-control" placeholder="Email to unsubscribe"></div>
                <div> <input class="btn btn-danger"  type="submit" value="Unsubscribe"></div>








            </div>





                    {{ Form::close()}}



    </section>

</center>





@endsection