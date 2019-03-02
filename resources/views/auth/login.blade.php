@extends('layouts.app-guest')

@section('content')
<div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img width="256" height="256" src="{{ asset('images/logo.png') }}" alt="Faster Horses">
                            </a>
                        </div>
                        <div class="login-form">
                            @include('includes.alerts')
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group {{ $errors->has('email') ? ' has-warning' : '' }}">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <input class="au-input au-input--full {{ $errors->has('email') ? ' is-invalid form-control' : '' }}" type="email" name="email" placeholder="Email">
                                    
                                </div>
                                <div class="form-group {{ $errors->has('password') ? ' has-warning' : '' }}">
                                    <label>{{ __('Password') }}</label>
                                    <input class="au-input au-input--full {{ $errors->has('email') ? ' is-invalid form-control' : '' }}" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    {{ __('Remember me') }}
                                    <label class="switch switch-default switch-primary-outline-alt switch-pill mr-4">
                                    <input class="switch-input" type="checkbox" name="remember" checked="{{ old('remember') ? 'true' : 'false' }}">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                     </label>
                                     <label>
                                        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue2 m-b-20" type="submit">{{ __('sign in') }}</button>
                            </form>
                        </div>
                        <div class="register-link">
                                <p>
                                    Don't have an account?
                                    <a href="{{ route('register') }}">Sign Up Here</a>
                                </p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
