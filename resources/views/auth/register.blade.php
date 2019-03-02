@extends('layouts.app-guest')

@section('content')

<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                     <div class="login-nav">
                        <a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
                    </div>
                    <div class="login-logo">
                        <a href="#">
                            <img width="256" height="256" src="{{ asset('images/logo.png') }}" alt="Faster Horses">
                        </a>
                    </div>
                    <div class="login-form">
                        @include('includes.alerts')
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group {{ $errors->has('name') ? ' has-warning' : '' }}">
                                <label>{{ __('Username') }}</label>
                                <input class="au-input au-input--full {{ $errors->has('name') ? ' is-invalid form-control' : '' }}" type="text" name="name"
                                value="{{ old('name') }}" placeholder="Username">
                            </div>

                            <div class="form-group {{ $errors->has('email') ? ' has-warning' : '' }}">
                                <label>{{ __('E-mail Address') }}</label>
                                <input class="au-input au-input--full {{ $errors->has('email') ? ' is-invalid form-control' : '' }}" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                            </div>

                            <div class="form-group {{ $errors->has('password') ? ' has-warning' : '' }}">
                                <label>{{ __('Password') }}</label>
                                <input class="au-input au-input--full {{ $errors->has('password') ? ' is-invalid form-control' : '' }}" type="password" name="password" value="{{ old('password') }}" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Confirm Password') }}</label>

                                <input class="au-input au-input--full {{ $errors->has('password') ? ' is-invalid form-control' : '' }}" type="password"  name="password_confirmation" placeholder="Confirm Password" required>
                            </div>


                            <div class="login-checkbox">
                            </div>
                            <button class="au-btn au-btn--block au-btn--blue2 m-b-20" type="submit">{{ __('register') }}</button>
                        </form>
                        <div class="register-link">
                            <p>
                                {{ __('Already have an account?') }}
                                <a href="{{ route('login') }}">{{ __('Sign in') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
