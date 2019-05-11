@extends('layouts.app')

@section('content')

    <div class="wrapper">

        <div class="page-header section" style="background-image: url('{{ URL::asset('images/10.jpg') }}');">
            <div class="filter"></div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">

                            <div class="card" style="margin-top: 120px;margin-bottom: 50px;">
                                <div class="card-header">
                                    <h3>Register</h3>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <input name="code" id="code" type="text" value="@if($code !== ""){{$code}}@else{{ old('code') }}@endif" hidden>

                                        <input  placeholder="Name" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                        <br/>

                                        <input  placeholder="E-mail" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="@if($email !== ""){{$email}}@else{{ old('email') }}@endif" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                        <br/>
                                        @if( empty($selected_country)) {{$selected_country = null}} @endif
                                        {!! Form::select('countries[]', $countries, $selected_country, ['id' => 'country', 'name' => 'country', 'class' => 'form-control', 'required' => 'required']) !!}


                                        @if ($errors->has('country'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                        @endif
                                        <br/>

                                        <input  placeholder="Password" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        <br/>


                                        <input  placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        <br/>

                                        <button class="btn btn-success btn-block btn-round">Continue</button>





                                    </form>

                                    <div class="card-footer text-center">
                                        <a href="{{ route('login') }}" class="btn btn-link">Already Have An Account? Login Here.</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </div>
@endsection
