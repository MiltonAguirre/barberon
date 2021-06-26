<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BarberON</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-md navbar-dark shadow-sm color-secondary">
            <div class="logo-circle">
                <span class="logo">BB</span>
            </div>
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse ml-5 pl-4  mt-2" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto mr-2">
                            <li class="nav-item">
                                <a href="#app" class="nav-link text-white mr-2 ml-5">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a href="/" class="nav-link text-white mx-2">Quienes somos?</a>
                            </li>
                    </ul>
                    <a class="navbar-brand logo text-primary-color mx-5" href="{{ url('/') }}">
                        Barber On
                    </a>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-auto ml-2 float-right">
                        <li class="nav-item">
                            <a href="/" class="nav-link text-white mx-2">Como funciona?</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link text-white ml-2 mr-5">Contacto</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link ml-5" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                          <!--BARBERSHOPS MENU-->
                          @if(\Auth::user()->getRole()=="Barbero" && \Auth::user()->barber)
                            <li class="nav-item dropdown">
                              <a id="navbarDropdownBarber" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->barber->name}} <span class="caret"></span>
                              </a>
                            </li>
                          @endif
                          <!--USERS MENU-->
                            <li class="nav-item dropdown ">
                              <ul class="nav navbar-nav list-inline">
                                <li class="list-inline-item">
                                  @include('includes.avatar')
                                </li>
                                <li class="list-inline-item">
                                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="caret">{{ Auth::user()->username }}</span>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{ route('user.profile') }}">
                                          Mi Perfil
                                      </a>
                                      <a class="dropdown-item" href="{{ route('config') }}">
                                          Configuración
                                      </a>
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                          {{ __('Salir') }}
                                      </a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  </div>
                                </li>
                              </ul>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="my-3">
            @yield('content')
        </main>
        <footer class="footer">
            <h1 class="text-white">Footer</h1>
        </footer>
    </div>
</body>
</html>
