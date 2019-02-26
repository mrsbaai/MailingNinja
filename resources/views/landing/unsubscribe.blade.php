@extends('layouts.costumer')


@section('content')


<br/><br/>


<center>
    <section class="text-center">
        <div class="text-center">


                <div><h2 class="title">Do you want to unsubscribe?</h2></div>
            {{ Form::open(array('action' => 'subscribeController@unsubscribe'))}}
                <div class="row text-center">


                        <input name="email" type="text" style="max-width: 400px;" class="form-control" placeholder="Email to unsubscribe"><br/><br/><br/>
                        <input class="btn btn-danger"  type="submit" value="Unsubscribe">


                    {{ Form::close()}}
                </div>




        </div>
    </section>

</center>





@endsection