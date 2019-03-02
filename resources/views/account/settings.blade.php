@extends('layouts.page')

@section('subcontent')
<div class="col">
    <div class="au-card m-b-30">
        <div class="au-card-inner">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                <div class="au-card-title" style="background-image:url('');">
                    <div class="bg-overlay bg-overlay--blue"></div>
                    <h3>
                        <i class="zmdi zmdi-settings"></i>Account Settings</h3>
                    </div>
                    <div class="card">
                        <form action="{{ route('updateSettings') }}" method="POST">
                            @csrf
                            </div>
                            <div class="card-body card-block">
                                <div class="form-group">
                                    <label class=" form-control-label" for="faculty">{{ __('Name') }}</label>
                                    <div class="input-group">
                                        <input name="name" class="form-control" id="name" type="text" value="{{ Auth::user()->name }}">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label" for="faculty">{{ __('E-mail Address') }}</label>
                                    <div class="input-group">
                                        <input name="email" class="form-control" id="email" type="email" placeholder="{{ Auth::user()->email }}">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label" for="faculty">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <input name="password" class="form-control" id="password" type="password" value="{{ old('password') }}">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label" for="faculty">{{ __('Confirm Password') }}</label>
                                    <div class="input-group">
                                        <input name="password_confirmation" class="form-control" id="password_confirmation" type="password">
                                        <div class="input-group-addon">
                                            <i class="fa fa-asterisk"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="fa fa-dot-circle-o"></i> {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection