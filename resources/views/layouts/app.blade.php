<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DEÓNOMA - Deonomástica multilíngüe - Grupo de Investigación de Onomástica y Deonomática UCM.</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" id="first-navbar">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse,#app-navbar-optons-collapse">
                        <span class="sr-only">Navegación</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <img src="{{asset('images/logo-ucm.png')}}" alt="" class="logo">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Deonomástica multilíngüe
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                                    &nbsp; Entrar</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa fa-registered" aria-hidden="true"></i>
                                    &nbsp;Registrarse</a></li>
                        @else
                            <li class="top-menu">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                &nbsp; {{ Auth::user()->name }}
                            </li>
                            <li>
                                <a href="{{ url('referentes/user') }}">
                                <i class="fa fa-folder-o" aria-hidden="true"></i>&nbsp; Mis referentes</a>
                            </li>
                            <li>
                                <a href="{{ url('cambios') }}">
                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>&nbsp; Mis cambios</a>
                            </li>    
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Salir
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-default navbar-static-top" id="second-navbar">
            <div class="container">

                <div class="collapse navbar-collapse" id="app-navbar-optons-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                         @auth
                            <li></li>
                            <li>
                                <a href="{{ url('referentes') }}">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    &nbsp;
                                    Todos los referentes
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                         @if ( Auth::check() && Auth::user()->isAdmin() )
                            <li></li>
                            <li>
                                <a href="{{ url('lenguas') }}">
                                    <i class="fa fa-language" aria-hidden="true"></i>
                                    &nbsp;
                                    Lenguas
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('tipos') }}">
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    &nbsp;
                                    Tipos
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main -->
        <div class="container">
            <div class="row">
              <div class="col-md-6">
                  <h3>@yield('header')</h3>
                  <hr>
              </div>
              <div class="col-md-6">
                @if (Session::has('success'))
                  <div class="alert alert-success mgt-2">
                      {{ Session::get('success') }}
                  </div>
                @elseif (Session::has('error'))
                  <div class="alert alert-danger mgt-2">
                      {{ Session::get('error') }}
                  </div>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                    @yield('content')
              </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="copyright">
                            © 2017 Todos los derechos reservados.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="design">
                            @if ( Auth::check() )
                                Soporte técnico: appandapper@gmail.com
                            @endif
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
