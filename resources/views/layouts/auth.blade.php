<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kolega Hotel</title>

    <!-- Scripts -->
{{--    <link href="{{ asset('css/style.css')}}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/app.css')}}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/mdb.js') }}"></script>

    @yield('css')
    <style>

        .imghotel{
            position:relative;
            overflow:hidden;
            padding-bottom:100%;
        }
        .imghotel img{
            position: absolute;
            max-width: 100%;
            max-height: 100%;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
        }

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"> Kolega Hotel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <form action ="#" method="GET" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-primary btn-rounded" type="submit">Search</button>
                    </form>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    @if(\Illuminate\Support\Facades\Auth::guard('hotel'))
                        <li class="nav-item">
                            <a class="nav-link" href="/hotel/{{\Illuminate\Support\Facades\Auth::id()}}">
                            <i class="fa fa-user-circle"></i>
                            Profil
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                        @elseif(\Illuminate\Support\Facades\Auth::guard('user'))
                        <li class="nav-item">
                            <a class="nav-link" href="/hotel/{{\Illuminate\Support\Facades\Auth::id()}}">
                                <i class="fa fa-user-circle"></i>
                                Profil
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item ">
                        <a class="nav-link" href="/home">
                            <i class="fa fa-home"></i>
                            Homes
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-angellist"></i>
                            Job-List
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-whatsapp "></i>
                            Chat
                            <span class="badge badge-danger">11</span>
                        </a>
                    </li>

                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle nav-item active" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Akun <span class="sr-only">(current)</span>
                        </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

</body>
</html>
