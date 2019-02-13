
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    @yield('style')
    <style>
        .navVerde{
            background-color: mediumseagreen;
            color: white;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark navbar-laravel navVerde">
            <div class="container">
                @if(!((Request::is('*login'))||(Request::is('*register'))||(Request::is('*reset'))))
                    @if((Auth::user()->empresa_id==null)&&(Auth::user()->funcionario_id!=null))
                    <a class="navbar-brand" href="{{ url('/funcionario/home') }}">
                    {{ config('app.name', 'Laravel') }}
                    </a>
                    @elseif((Auth::user()->empresa_id!=null)&&(Auth::user()->funcionario_id==null))
                    <a class="navbar-brand" href="{{ url('/empresa/home') }}">
                    {{ config('app.name', 'Laravel') }}
                    </a>
                    @endif
                @else
                    <a class="navbar-brand" href="#">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                @endif
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
                                <a class="nav-link" href="{{ route('login') }}" style="color: white;">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}" style="color: white;">{{ __('Registrar') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: white;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if((Auth::user()->empresa_id==null)&&(Auth::user()->funcionario_id!=null))
                                        <?php
                                            $rota = 'funcEdit';
                                        ?>
                                            <a href="{{route($rota)}}" class="dropdown-item">
                                                Perfil
                                            </a>
                                    @elseif((Auth::user()->empresa_id!=null)&&(Auth::user()->funcionario_id==null))
                                        <?php
                                            $rota = 'empEdit';
                                        ?>
                                            <a href="{{route($rota)}}" class="dropdown-item">
                                                Perfil
                                            </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
    @yield('script')
</body>
</html>
