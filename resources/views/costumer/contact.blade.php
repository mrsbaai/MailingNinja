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

                        <div class="main-login-form">
                            @include('flash::message')
                            <input type="email" class="form-control" id="lg_role" name="lg_role" value="Costumer" hidden>
                            <div class="login-group">
                                <div class="form-group">
                                    <label for="lg_email" class="sr-only">Email</label>
                                    <input type="email" class="form-control" id="lg_email" name="lg_email" placeholder="email" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="lg_subject" class="sr-only">Subject</label>
                                    <input type="text" class="form-control" id="lg_subject" name="lg_subject" placeholder="subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="lg_message" class="sr-only">Message</label>
                                    <textarea class="form-control" id="lg_message" name="lg_message" placeholder="message" required></textarea>
                                </div>

                            </div>
                            <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
