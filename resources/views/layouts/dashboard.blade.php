<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - CEFE</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @yield('custom-css')

    <!-- Web Fonts -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
<nav class="navbar navbar-expand main-topbar">
    <a class="logo" href="{{ url('/dashboard') }}">CEFE<span>dashboard</span></a>
    <a class="sidebar-toggle" href="#"><i class="ml-4 ml-sm-5 h3 fa fa-bars"></i></a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="dropdown nav-user">
                <a href="#" class="dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown" aria-haspopup="true">
                    <img id="dropdown-img" src="/storage/avatars/{{ Auth::user()->avatar }}" alt=""/>
                </a>
                <div class="dropdown-menu dropdown-user-inner" aria-labelledby="navbarDropdownUser">
                    <div class="dropdown-user-header">
                        <div class="dropdown-user-photo">
                            <img id="dropdown-user-img" src="/storage/avatars/{{ Auth::user()->avatar }}" alt=""/>
                        </div>
                        <div class="dropdown-user-profile">
                            <span class="dropdown-user-profile-name">{{ Auth::user()->name }}</span>
                            <!-- Mexer na classe d-block -->
                            <span class="dropdown-user-profile-email d-block">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <ul class="dropdown-user-menu">
                        <li>
                            <a href="{{ url('/profile') }}">
                                <i class="fas fa-user"></i>
                                <span><span><span>Meu Perfil</span></span></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-envelope"></i>
                                <span><span><span>Mensagem</span></span></span>
                            </a>
                        </li>
                        <li class="dropdown-user-menu-separator"></li>
                        <li>
                            <a href="{{ route('logout') }}" class="btn btn-outline-danger"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Sair
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="d-flex">
    <div class="sidebar">
        <ul id="menu-accordion">
            <li class="menu-section">
                <span>NAVEGAÇÃO PRINCIPAL</span>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard') ? 'menu-active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @component('layouts.menu.menus')
            @endcomponent
        </ul>
    </div>
    <div class="w-100">
        <nav class="page-breadcrumb" aria-label="breadcrumb">
            {!! html_entity_decode(Breadcrumbs::render(Request::route()->getName(), Request::is('*/class/*') ? $classes->name : '')) !!}
        </nav>
        <div class="m-4">
            <h5 class="mb-4">{{ $title }}</h5>
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@yield('custom-js')
</body>
</html>
