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
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address</label>

                                <input id="email" type="email" class="au-input au-input--full form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter your e-mail" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button class="au-btn au-btn--block au-btn--blue2 m-b-20" type="submit">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





