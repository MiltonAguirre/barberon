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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    BarberON
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                </li>
                            @endif
                        @else
                          <!--OPTIONS ONLY FOR BARBERS USERS                        -->
                          @if(\Auth::user()->getRole()=="Barbero" && \Auth::user()->barber)
                            <li class="nav-item dropdown">
                              <a id="navbarDropdownBarber" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->barber->name}} <span class="caret"></span>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/barber/show/{{\Auth::user()->barber->id}}">
                                    Mi barbería
                                </a>
                                <a class="dropdown-item" href="{{route('barber.edit')}}">
                                    Editar barbería
                                </a>
                                <a class="dropdown-item" href="{{route('image.create')}}">
                                    Subir fotos de barbería
                                </a>
                                <a class="dropdown-item" href="{{route('product.create')}}">
                                    Agregar producto a la barbería
                                </a>
                              </div>
                            </li>
                          @endif
                            <li>
                              @include('includes.avatar')
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        Mi Perfil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.img_profile') }}">
                                        Subir foto de perfíl
                                    </a>
                                    @if(\Auth::user()->getRole()=="Barbero" && \Auth::user()->barber==null)
                                      <a class="dropdown-item" href="{{ route('barber.create') }}">
                                          Crear baberia
                                      </a>
                                    @endif
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
