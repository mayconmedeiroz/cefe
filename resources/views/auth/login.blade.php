<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - CEFE</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<div class="container-fluid">
    <div class="row container-left-background">
        <div class="col-md-6 container-left">
            <div class="logo-left p-4">
                <a href="#">
                    <img src="{{ asset('img/logo.png') }}" alt="CEFE">
                </a>
            </div>
            <div class="h-75 d-flex align-items-center">
                <span class="phrase">
                    <p>
                        Lorem ipsum dolor sit amet, consec adipiscing alot elit. Praesent hendrerit efficitur enim at tempus.
                    </p>
                    <p>
                        Lorem ipsum dolor sit
                    </p>
                </span>
            </div>
        </div>
        <div id="login" class="col-md-6 bg-light">
            <div class="d-table w-100 mx-auto container-right">
                <form class="d-table-cell align-middle" method="POST" action="{{ route('login') }}">
                    @if ($errors->has('email') or $errors->has('password'))
                    <div class="alert alert-danger w-75 mx-auto d-block fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        O endereço de email ou a senha que você inseriu não é válido. Tente novamente.
                    </div>
                    @endif
                    @csrf
                    <h1 class="py-5">Login</h1>
                    <div class="form-group">
                        <input placeholder="Email" id="email" type="text" value="{{ old('email') }}" class="form-control" name="email" required autocomplete="email" autofocus>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Senha">
                    </div>
                    <div class="form-group button-group">
                        <a class="forget-pass-div" href="#">Esqueci a senha</a>
                        <button type="submit" class="btn btn-primary float-sm-right">Acessar</button>
                    </div>
                </form>
            </div>
            <hr class="mx-5"/>
            <p class="text-center">Primeiro acesso? <a class="first-login-div" href="#">clique aqui</a></p>
        </div>
        <div id="forget-password" class="col-md-6 bg-light d-none d-sm-none">
            <div class="d-table w-100 mx-auto container-right">
                <form class="d-table-cell align-middle">
                    <h1 class="py-5">Esqueci a senha</h1>
                    <div class="form-group">
                        <input type="email" class="form-control" id="" placeholder="Email">
                    </div>
                    <div class="form-group button-group">
                        <a class="login-div" href="#">Fazer Login</a>
                        <button type="submit" class="btn btn-primary float-sm-right">Enviar</button>
                    </div>
                </form>
            </div>
            <hr class="mx-5"/>
            <p class="text-center">Primeiro acesso? <a class="first-login-div" href="#">clique aqui</a></p>
        </div>
        <div id="first-login" class="col-md-6 bg-light d-none d-sm-none">
            <div class="d-table w-100 mx-auto container-right">
                <form class="d-table-cell align-middle" method="POST" action="{{ route('login') }}">
                    @if ($errors->has('email') or $errors->has('password'))
                        <div class="alert alert-danger w-75 mx-auto d-block fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            A matrícula ou a senha que você inseriu não é válida. Tente novamente.
                        </div>
                    @endif
                    @csrf
                    <h1 class="py-5">Primeiro Acesso</h1>
                    <div class="form-group">
                        <input placeholder="Matrícula" id="enrollment" type="text" value="{{ old('enrollment') }}" class="form-control" name="enrollment" required autocomplete="email" autofocus>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Senha">
                    </div>
                    <div class="form-group button-group">
                        <a class="forget-pass-div" href="#">Esqueci a senha</a>
                        <button type="submit" class="btn btn-primary float-sm-right">Acessar</button>
                    </div>
                </form>
            </div>
            <hr class="mx-5"/>
            <p class="text-center">Já fez o primeiro acesso? <a class="login-div" href="#">clique aqui</a></p>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>