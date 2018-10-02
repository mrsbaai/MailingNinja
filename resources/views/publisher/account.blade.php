@extends('layouts.account')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Edit Info</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(array('action' => 'userController@updateInfo', 'id' => 'info-form'))}}
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label for="name">Company (disabled)</label>
                                        <input name="name" id="name" type="text" class="form-control" disabled="" placeholder="Company" value="{{Auth::user()->name}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input name="first_name" id="first_name" type="text" class="form-control" placeholder="First Name"value="{{Auth::user()->first_name}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input name="last_name" id="last_name" type="text" class="form-control" placeholder="Last Name" value="{{Auth::user()->last_name}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label  for="email">Email address</label>
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label  for="skype">Skype</label>
                                        <input name="skype" id="skype" type="text" class="form-control" placeholder="Skype" value="{{Auth::user()->skype}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label  for="phone">Phone Number</label>
                                        <input name="phone" id="phone" type="text" class="form-control" placeholder="Ex: +34 654 995 989" value="{{Auth::user()->phone}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input name="address" id="address" type="text" class="form-control" placeholder="Home Address" value="{{Auth::user()->address}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input name="city" id="city" type="text" class="form-control" placeholder="City"  value="{{Auth::user()->city}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        {!!Form::select('country', $countries, Auth::user()->country, ['class' => 'form-control'])!!}


                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input name="postal_code" id="postal_code" type="number" class="form-control" placeholder="ZIP Code" value="{{Auth::user()->postal_code}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label for="paypal">PayPal E-mail</label>
                                        <input name="paypal" id="paypal" type="email" class="form-control" placeholder="PayPal E-mail (Buisness)" value="{{Auth::user()->paypal}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label for="merchant_id">PayPal Merchant ID</label>
                                        <input name="merchant_id" id="merchant_id" type="text" class="form-control" placeholder="PayPal Merchant ID (Buisness)" value="{{Auth::user()->merchant_id}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label for="website">Website URL</label>
                                        <input name="website" id="website" type="text" class="form-control" placeholder="Website URL" value="{{Auth::user()->website}}">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">Update Info</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="card-title">Change Password</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(array('action' => 'userController@updateInfo', 'id' => 'password-form'))}}
                        {{ csrf_field() }}

                            <div class="row">


                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label for="current_password">Current Password:</label>
                                        <input id="current_password" type="password" name="current_password" class="form-control" placeholder="Your Current Password" required="required">
                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('current-password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 px-1">
                                    <div class="form-group">
                                        <label for="new_password">New Password:</label>
                                        <input id="new_password" type="password" name="new_password" class="form-control" placeholder="Your New Password" required="required">

                                        @if ($errors->has('new-password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('new-password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-4 pl-1">
                                    <div class="form-group">
                                        <label for="new-password_confirmation">Confirm Password:</label>
                                        <input id="new-password_confirmation" type="password" name="new_password_confirmation" class="form-control" placeholder="Type Your New Password again" required="required">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-round">Change Password</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Account
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
