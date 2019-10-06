<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>Login - CEFE</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,500"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 d-none d-sm-block container-left container-left-background">
                <div class="h-100 d-flex align-items-center">
                    <span class="phrase">
                        <p>
                            Autentique-se para prosseguir.
                        </p>
                        <p>
                            Bem-vindo ao dashboard do CEFE, aqui você poderá se cadastrar em turmas, ver suas notas, ver datas de eventos e muito mais...
                        </p>
                    </span>
                </div>
            </div>
            <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
                <!--begin::Head-->
                <div class="kt-login__head">
                    <span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
                    <a href="#" class="kt-link kt-login__signup-link">Sign Up!</a>
                </div>
                <!--end::Head-->

                <!--begin::Body-->
                <div class="kt-login__body">

                    <!--begin::Signin-->
                    <div class="kt-login__form">
                        <div class="kt-login__title">
                            <h3>Sign In</h3>
                        </div>

                        <!--begin::Form-->
                        <form class="kt-form" action="" novalidate="novalidate" id="kt_login_form">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Username" name="username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
                            </div>
                            <!--begin::Action-->
                            <div class="kt-login__actions">
                                <a href="#" class="kt-link kt-login__link-forgot">
                                    Forgot Password ?
                                </a>
                                <button id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign In</button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->

                        <!--begin::Divider-->
                        <div class="kt-login__divider">
                            <div class="kt-divider">
                                <span></span>
                                <span>OR</span>
                                <span></span>
                            </div>
                        </div>
                        <!--end::Divider-->

                        <!--begin::Options-->
                        <div class="kt-login__options">
                            <a href="#" class="btn btn-primary kt-btn">
                                <i class="fab fa-facebook-f"></i>
                                Facebook
                            </a>

                            <a href="#" class="btn btn-info kt-btn">
                                <i class="fab fa-twitter"></i>
                                Twitter
                            </a>

                            <a href="#" class="btn btn-danger kt-btn">
                                <i class="fab fa-google"></i>
                                Google
                            </a>
                        </div>
                        <!--end::Options-->
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Body-->
            </div>
            <!--<div id="login" class="col-md-7 bg-light container-right">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @if ($errors->any())
                    <div class="alert alert-danger w-75 mx-auto d-block fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        O endereço de email/matrícula ou a senha que você inseriu não é válido. Tente novamente.
                    </div>
                    @endif
                    @csrf
                    <h1 class="mb-5 text-center">Login</h1>
                    <div class="form-group">
                        <input placeholder="Email ou Matrícula" id="login" type="text" value="{{ old('email') }}{{ old('enrollment') }}" class="form-control" name="login" required autocomplete="email" autofocus>
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
            </div>-->
        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
