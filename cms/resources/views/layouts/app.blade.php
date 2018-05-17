<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--api sampleに記載あり-->
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">　
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
    <!--izimodal-->
    <!--<link rel="stylesheet" href="{{ asset('/css/izModal.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('/css/iziModal.css') }}">

    <!--orignal-->
    <link rel="stylesheet" href="{{ asset('/css/map.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/detail.css') }}">
    
<style type="text/css">

.navbar-default {
  background-color: #ffffff;
  background-image:none;
}
.navbar-default .navbar-brand {
  color: #474747;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
  color: #961212;
}
.navbar-default .navbar-text {
  color: #474747;
}
.navbar-default .navbar-nav > li > a {
  color: #474747;
}
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus {
  color: #961212;
}
.navbar-default .navbar-nav > li > .dropdown-menu {
  background-color: #ffffff;
}
.navbar-default .navbar-nav > li > .dropdown-menu > li > a {
  color: #474747;
}
.navbar-default .navbar-nav > li > .dropdown-menu > li > a:hover,
.navbar-default .navbar-nav > li > .dropdown-menu > li > a:focus {
  color: #961212;
  background-color: #fbecec;
}
.navbar-default .navbar-nav > li > .dropdown-menu > li.divider {
  background-color: #fbecec;
}
.navbar-default .navbar-nav .open .dropdown-menu > .active > a,
.navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
.navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
  color: #961212;
  background-color: #fbecec;
}
.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
  color: #961212;
  background-color: #fbecec;
}
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
  color: #961212;
  background-color: #fbecec;
}
.navbar-default .navbar-toggle {
  border-color: #fff;
}
.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus {
  background-color: #fbecec;
}
.navbar-default .navbar-toggle .icon-bar {
  background-color: #474747;
}
.navbar-default .navbar-collapse,
.navbar-default .navbar-form {
  border-color: #474747;
}
.navbar-default .navbar-link {
  color: #474747;
}
.navbar-default .navbar-link:hover {
  color: #961212;
}

@media (max-width: 767px) {
  .navbar-default .navbar-nav .open .dropdown-menu > li > a {
    color: #474747;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #961212;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #961212;
    background-color: #fbecec;
  }
}
</style>


</head>

<body>
    
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                     <ul class="nav navbar-nav">
                        <li class="{{ (Request::is('/') ? 'active' : '') }}">
                            <a href="{{ url('') }}"><i class="fa fa-home"></i> Search</a>
                        </li>
                        <li class="{{ (Request::is('favorites') ? 'active' : '') }}">
                            <a href="{{ url('favorites') }}">Favorites</a>
                        </li>
                        <li class="{{ (Request::is('mainpage') ? 'active' : '') }}">
                            <a href="{{ url('mainpage') }}">Mainpage</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
    <!-- Scripts -->
    <script src="//code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--<script src="{{ asset('js/app.js') }}"></script>-->
    <script src="{{ asset('js/iziModal.min.js') }}"></script>


        @yield('content')


</body>
</html>
