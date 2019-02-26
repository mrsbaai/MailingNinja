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
                        <input name="lgemail" type="text" class="form-control" placeholder="Email" data-validation="email">
                    </div>


                </div>

                <div class="row">
                    <div class="col-sm-12 text-right" style="padding-top:18px;">
                        <input id="send_btn" type="submit" class="btn--subscribe btn--primary btn--inside" style="background-color: #4C4A48;border-color:#4C4A48;"value="Unsubscribe">
                    </div>
                </div>

            {{ Form::close()}}
            </div>
        </div>
    </section>





@endsection