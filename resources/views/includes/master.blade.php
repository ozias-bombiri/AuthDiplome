<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{URL::asset('/assets/favicon.ico')}}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <!-- <link href="{{URL::asset('/assets/css/styles.css')}}" rel="stylesheet" /> -->
    <link href="{{URL::asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" /> 
    <!-- Scripts --> 
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        @include('includes.navbar')
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item active"><a class="nav-link" href="/">Accueil</a></li>
                            <li class="nav-item"><a class="nav-link" href="#!">Link</a></li>
                            
                            @guest
                            <li class="nav-item">
                                <a id="color-nav" class="nav-link" href="{{route('login')}}">Se connecter</a>
                            </li>
                            @endguest
                            
                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">username</a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Se deconnecter') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!">profil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!">Modifier le profil</a>
                                </div>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">


                @yield('contenu')



            </div>
        </div>
    </div>
    
    @stack('costum-scripts')

</body>

</html>