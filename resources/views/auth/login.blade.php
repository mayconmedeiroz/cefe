<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Login - Centro Esportivo da FAETEC"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Login - Centro Esportivo da FAETEC</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/css/bootstrap.min.css') }}"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/style-login.css') }}"/>
</head>
<body>
<div class="grid grid-ver grid-root">
    <div class="grid grid-hor grid-root">
        <div class="grid-item grid-item-fluid grid grid-desktop grid-ver-desktop grid-hor-tablet-and-mobile">
            <div class="grid-item grid-item-order-tablet-and-mobile-2 grid grid-hor login-aside" style="background: url({{ asset('img/background.jpg') }}) right 100%;">
                <div class="grid-item">
                    <a href="{{ route('index') }}" class="login-logo">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" title="Logo">
                    </a>
                </div>
                <div class="grid-item grid-item-fluid grid grid-ver">
                    <div class="grid-item grid-item-middle">
                        <h3 class="login-title">Autentique-se para prosseguir!</h3>
                        <h4 class="login-subtitle">Bem-vindo ao dashboard do CEFE, aqui você poderá se cadastrar em turmas, ver suas notas, ver datas de eventos e muito mais...</h4>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="login-info">
                        <div class="login-copyright">
                            &copy 2019 Centro Esportivo da FAETEC
                        </div>
                        <div class="login-menu">
                            <a href="#" class="link">Lorem</a>
                            <a href="#" class="link">Ipsum</a>
                            <a href="#" class="link">Dolor sit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-item grid-item-fluid  grid-item-order-tablet-and-mobile-1 login-wrapper">
                <div class="login-body">
                    <div class="login-form">
                        <div class="login-title">
                            <h3>Entrar</h3>
                        </div>
                        <form class="form" method="POST" action="{{ route('login') }}">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    O endereço de email/matrícula ou a senha que você inseriu não é válido. Tente novamente.
                                </div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Email ou Matrícula" name="login" id="login" value="{{ old('email') }}{{ old('enrollment') }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Senha" name="password" id="password">
                            </div>
                            <div class="login-actions">
                                <a href="#" class="link login-link-forgot">
                                    Esqueceu a senha ?
                                </a>
                                <button id="kt_login_signin_submit" class="btn btn-primary btn-elevate login-btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
