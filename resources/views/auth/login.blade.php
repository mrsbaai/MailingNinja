@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="page-header" style="background-image: url('{{ URL::asset('images/10.jpg') }}');">
            <div class="filter"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 ml-auto mr-auto">
                        <div class="card card-register">
                            <h3 class="title">Login</h3>
                            <form class="register-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <br>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        {{ __('Remember Me') }}
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <button class="btn btn-danger btn-block btn-round">Login</button>
                            </form>
                            <div class="forgot">
                                <a href="{{ route('password.request') }}" class="btn btn-link btn-danger">{{ __('Forgot Your Password?') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
