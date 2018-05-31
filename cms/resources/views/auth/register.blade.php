<!-- resources/views/register.blade.php -->

@extends('layouts.app_befor_login')
@section('content_befor_login')

    <div class="row register-wrap" style="padding:150px 20px">
        <div class="col-md-8 col-md-offset-2 innner-blur">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-6 col-md-offset-3 control-text">Name</label>

                        <div class="col-md-6 col-md-offset-3">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-6 col-md-offset-3 control-text">E-Mail Address</label>
                    
                    <div class="col-md-6 col-md-offset-3">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-6 col-md-offset-3 control-text">Password</label>

                    <div class="col-md-6 col-md-offset-3">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-6 col-md-offset-3 control-text">Confirm Password</label>

                    <div class="col-md-6 col-md-offset-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                    <div class="form-group login">
                        <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
