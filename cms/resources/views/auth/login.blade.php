<!-- resources/views/login.blade.php -->

@extends('layouts.app_befor_login')
@section('content_befor_login')


        <div class="row" style="padding:150px 20px">
            <div class="col-md-8 col-md-offset-2 innner-blur">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-6 col-md-offset-3 control-text">E-Mail Address</label>

                        <div class="col-md-6 col-md-offset-3">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                        <div class="col-md-3 col-md-offset-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="checkbox">
                                <a class=" btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>    
                        </div>
                    </div>
                    <div class="form-group login">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
@endsection