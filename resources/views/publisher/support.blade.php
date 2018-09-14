@extends('layouts.account')

@section('content')


    <div class="content">
        <div class="row">




            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Send Email</h5>
                        <p class="card-category">We will get back at you as soon as possible.</p>
                    </div>
                    <div class="card-body">
                        {{ Form::open(array('action' => 'ContactController@saveContact', 'id' => 'contact-form', 'class' => 'text-left'))}}

                        <div class="main-login-form">
                            @include('flash::message')
                            <input type="text" id="lg_role" name="lg_role" value="publisher" hidden>
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
                                <textarea class="form-control" id="lg_message" name="lg_message" required></textarea>
                            </div>




                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-round">send</button>
                                </div>
                            </div>

                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>


            <div class="col-md-5">
                <div class="card card-user">
                    <div class="image">
                        <img src="{{ URL::asset('images/profile_back.jpg') }}">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="skype:-skype-name-?chat">
                                <img class="avatar border-gray" src="{{ URL::asset('images/profile_image.jpg') }}">
                                <h5 class="title">Oumaema</h5>
                            </a>
                        </div>
                        <h5 class="card-text text-center">"Account Performance Manager"</h5>
                        <div class="button-container">
                            <a class="btn text-center btn-info btn-round" href="skype:-skype-name-?chat">Start Skype Chat</a>
                        </div>



                        <div class="card-footer">

                            <hr>

                            <div class="button-container">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6 ml-auto">
                                        <h5><i class="fas fa-phone"></i></h5>

                                        <small>+212-623-5789</small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-6 ml-auto mr-auto">
                                        <h5><i class="fab fa-skype"></i></h5>

                                        <small>skype-name</small>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('title')
    Support
@endsection

@section('header')
@endsection

@section('footer')
    <script type="text/javascript" src="{{ URL::asset('js/core/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/bootstrap.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap-notify.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
@endsection

