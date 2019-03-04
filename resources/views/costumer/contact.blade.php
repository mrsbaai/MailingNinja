@extends('layouts.costumer')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Contact Us</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(array('action' => 'ContactController@saveContact', 'id' => 'contact-form', 'class' => 'text-left'))}}
                        @csrf
                        <div class="main-login-form">

                            <input type="text" id="lg_role" name="lg_role" value="costumer" hidden>
                            <input type="email" id="lg_email" name="lg_email" value="{{Auth::user()->email}}" hidden>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Subject: </div>
                                </div>
                                <input type="text" class="form-control" id="lg_subject" name="lg_subject" required>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Message: </div>
                                </div>
                                <textarea rows="5" class="form-control" id="lg_message" name="lg_message" style="max-height: 100%"  required></textarea>
                            </div>




                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <input  class="btn btn-round " alt="Submit" value="Send">
                                </div>
                            </div>

                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

