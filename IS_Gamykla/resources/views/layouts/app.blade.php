<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    @php
                    $user = Auth::user();    
                    @endphp
                    <ul class="navbar-nav mr-auto">
                        @if ($user->userlevel == Config::get('constants.GAMYKLOS_VADOVAS') || $user->userlevel == Config::get('constants.ADMINISTRATORIUS'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gamyklos.index') }}">
                                    <i class="fas fa-industry"></i>
                                    Gamyklos
                                </a>
                            </li>
                        @endif
                        @if ($user->userlevel != Config::get('constants.KLIENTAS'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tvarkarasciai.index') }}">
                                <i class="fas fa-calendar-day"></i>
                                Tvarkaraščiai
                            </a>
                        </li>
                        @endif
                        @if ($user->userlevel == Config::get('constants.SANDELIO_VADOVAS') || $user->userlevel == Config::get('constants.ADMINISTRATORIUS'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sandelis.index') }}">
                                <i class="fas fa-warehouse"></i>
                                Sandėliai
                            </a>
                        </li>
                        @endif
                        @if ($user->userlevel == Config::get('constants.GAMYKLOS_VADOVAS') || $user->userlevel == Config::get('constants.ADMINISTRATORIUS'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tvarkarascio_statistika.show') }}">
                                <i class="fas fa-chart-bar"></i>
                                Tvarkaraščio statisktika
                            </a>
                        </li>
                        @endif
                        @if ($user->userlevel == Config::get('constants.SANDELIO_VADOVAS') || $user->userlevel == Config::get('constants.ADMINISTRATORIUS'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('populiariausios_prekes.show') }}">
                                <i class="fas fa-chart-line"></i>
                                Populiariausios prekės
                            </a>
                        </li>
                        @endif
                        @if ($user->userlevel == Config::get('constants.KLIENTAS') || $user->userlevel == Config::get('constants.ADMINISTRATORIUS'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-store"></i>
                                eParduotuve
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('eparduotuve.search') }}"><i class="fas fa-search"></i>Prekių paieška</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('eparduotuve.cart') }}"><i class="fas fa-shopping-cart"></i>Krepšelis</a>
                            </div>
                        </li>
                        @endif
                        @if ($user->userlevel == Config::get('constants.ADMINISTRATORIUS'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                <!-- <i class="fas fa-user"></i> -->
                                Admin
                            </a>
                        </li>
                        @endif
                    </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.editprofile') }}">
                                        {{ __('My profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
