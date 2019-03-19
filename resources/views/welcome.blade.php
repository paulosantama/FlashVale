<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Flash Vale</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                /*background-color: #fff;*/
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            body{
                /*background-image: linear-gradient(to bottom, mediumseagreen , white);*/
                background-image: linear-gradient(to bottom, mediumseagreen , black);
                /*background-image: linear-gradient(to bottom, DeepPink , black);*/
                /*background-image: linear-gradient(to bottom, #e6bc53 , black);*/
                background-repeat: no-repeat;
                background-size: cover;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                color: white;
            }

            /*.title {*/
                /*font-size: 84px;*/
            /*}*/

            .links > a {
                /*color: #636b6f;*/
                color: white;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            /*.m-b-md {*/
                /*margin-bottom: 30px;*/
            /*}*/
            .logo{
            	width:600px;
            	/*height:600px;*/
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @auth
                    @if((Auth::user()->empresa_id==null)&&(Auth::user()->funcionario_id!=null))
                        <a href="{{ url('funcionario/home') }}">Home</a>
                    @elseif((Auth::user()->empresa_id!=null)&&(Auth::user()->funcionario_id==null))
                        <a href="{{ url('empresa/home') }}">Home</a>
                    @endif
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Registrar</a>
                @endauth
            </div>
            <div class="content">
                {{--<div class="title m-b-md">--}}
                    {{-- FLA$H VALE --}}
                    <img src="{{ asset('img/logo3.png') }}" class="img-fluid logo">
                {{--</div>--}}
                {{--<div class="links">--}}
                    {{--<a href="https://laravel.com/docs">Documentation</a>--}}
                    {{--<a href="https://laracasts.com">Laracasts</a>--}}
                    {{--<a href="https://laravel-news.com">News</a>--}}
                    {{--<a href="https://nova.laravel.com">Nova</a>--}}
                    {{--<a href="https://forge.laravel.com">Forge</a>--}}
                    {{--<a href="https://github.com/laravel/laravel">GitHub</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </body>
</html>
