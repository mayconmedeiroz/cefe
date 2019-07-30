<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>{{ $title }} - CEFE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/global/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/global/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/global/style.css') }}">
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="site-logo">
                    <a href="{{ route('index') }}" class="d-block">
                        <img src="{{ asset('img/global/logo.jpg') }}" alt="Image" class="img-fluid">
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
                            <li class="{{ Request::is('contact') ? 'active' : '' }}">
                                <a href="/contact" class="nav-link text-left">Contato</a>
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
                    <a href="#" class="d-lg-none site-menu-toggle js-menu-toggle text-black btn"><span
                                class="icon-menu h3"></span></a>
                </div>
            </div>
        </div>
    </header>
</div>

@yield('content')

<div class="section-bg style-1" style="background-image: url('{{ asset('img/global/bg_1.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon fas fa-graduation-cap"></span>
                <h3>Lorem ipsum dolor sit</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis
                    delectus ea? Dolore, amet reprehenderit.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon fas fa-school"></span>
                <h3>Lorem ipsum dolor sit</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis
                    delectus ea?
                    Dolore, amet reprehenderit.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                <span class="icon fas fa-calendar-alt"></span>
                <h3>Lorem ipsum dolor sit</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis
                    delectus ea?
                    Dolore, amet reprehenderit.</p>
            </div>
        </div>
    </div>
</div>

@yield('content-down')

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="copyright py-0">
                    <img src="{{ asset('img/global/logo.png') }}" alt="Image" class="mb-2 img-fluid">
                    <p class="m-0">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;2019 Todos os direitos reservados. | Template feito por <a
                                href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#51be78"/>
    </svg>
</div>
<script src="{{ asset('/js/jquery.min.js')}}"></script>
<script src="{{ asset('/js/global/jquery-migrate-3.1.0.min.js')}}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('/js/global/owl.carousel.min.js')}}"></script>
<script src="{{ asset('/js/global/jquery.easing.1.3.js')}}"></script>
<script src="{{ asset('/js/global/aos.js')}}"></script>
<script src="{{ asset('/js/global/jquery.sticky.js')}}"></script>
<script src="{{ asset('/js/global/main.js')}}"></script>
@yield('custom-js')
</body>
</html>