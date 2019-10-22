<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $title }} - Centro Esportivo da FAETEC">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - Centro Esportivo da FAETEC</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendors/fontawesome/css/all.min.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/owl-carrousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-homepage.css') }}">
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="fas fa-times js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="site-logo">
                    <a href="{{ route('index') }}" class="d-block">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" title="Logo" class="img-fluid">
                    </a>
                </div>
                <div class="mr-auto">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li class="{{ Request::is('/') ? 'active' : '' }}">
                                <a href="{{ route('index') }}" class="nav-link text-left">Home</a>
                            </li>
                            <li class="{{ Request::is('blog*') ? 'active' : '' }}">
                                <a href="/blog" class="nav-link text-left">Notícias</a>
                            </li>
                            <li class="{{ Request::is('about') ? 'active' : '' }}">
                                <a href="/about" class="nav-link text-left">Sobre Nós</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('login') }}" class="small btn btn-primary btn-red px-4 py-2 rounded-0"><span
                            class="icon-user"></span> Acessar</a>
                    <a href="#" class="d-lg-none site-menu-toggle js-menu-toggle text-black btn">
                        <i class="fas fa-bars fa-lg"></i></a>
                </div>
            </div>
        </div>
    </header>
</div>

@yield('content')

<section class="section-bg style-1" style="background-image: url('{{ asset('img/bg_1.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon fas fa-graduation-cap"></span>
                <h3>Grade fluida</h3>
                <p>Facilidade de troca e escolha de turmas e modalidades de acordo com o ano.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon fas fa-school"></span>
                <h3>Facilidade nos horários</h3>
                <p>Horários de acordo com as escolas.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon fas fa-calendar-alt"></span>
                <h3>Calendário facilitado</h3>
                <p>Calendario para todos com informações.</p>
            </div>
        </div>
    </div>
</section>

@yield('content-down')

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="copyright py-0">
                    <img src="{{ asset('img/logo-footer.png') }}" alt="logo-footer" title="Logo Footer" class="mb-2 img-fluid">
                    <p class="m-0">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;2019 Todos os direitos reservados. | Template feito por <a
                            href="https://colorlib.com" target="_blank" rel="noopener">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/>
    </svg>
</div>
<script src="{{ asset('vendors/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('vendors/owl-carrousel/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('vendors/aos/js/aos.js')}}"></script>
<script src="{{ asset('vendors/jquery-sticky/jquery.sticky.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
@yield('custom-js')
</body>
</html>
