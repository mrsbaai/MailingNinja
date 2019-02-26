@extends('layouts.costumer')


@section('content')


<br/><br/>


<center>
    <section class="text-center">
        <div class="text-center">


                <div><h2 class="title">Do you want to unsubscribe?</h2></div>
            {{ Form::open(array('action' => 'subscribeController@unsubscribe'))}}
                <div class="row">
                    <input name="email" type="text" style="max-width: 400px;" class="form-control" placeholder="Email to unsubscribe">
                </div>
            <div class="row">
                <input class="btn btn-danger"  type="submit" value="Unsubscribe">

                </div>





                    {{ Form::close()}}




        </div>
    </section>

</center>





@endsection