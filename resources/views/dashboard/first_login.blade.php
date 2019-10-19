<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Painel de Controle - Centro Esportivo da FAETEC">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Centro Esportivo da FAETEC</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="d-flex justify-content-center align-items-center h-100">
    <div class="col-lg-6 mx-lg-auto">
        <form id="first-login-form" class="form form-first" method="post">
            @csrf
            <div class="form-group form-first-login-title">
                <span>Primeiro Acesso</span>
            </div>
            <div class="form-body">
                <h5>Olá {{ Auth::user()->name }}, este é o seu primeiro acesso. Seja bem vindo ao CEFE Virtual.</h5>
                <p class="mb-0">Para continuar, por favor, complete os campos abaixo com seus dados. Após, você será redirecionado para a tela inicial.</p>
                <p>Futuramente, você poderá acessar o sistema utilizando a sua matrícula ou o seu email, em conjunto com a senha definida aqui.</p>
                <div id="form-result"></div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input name="email" id="email" type="email" class="form-control" placeholder="Email">
                    <span class="form-text text-muted">Insira o seu email</span>
                </div>
                <div class="form-group">
                    <label for="password">Nova Senha:</label>
                    <input name="password" id="new-password" type="password" class="form-control" autocomplete="new-password" placeholder="Nova Senha">
                    <span class="form-text text-muted">Insira a nova senha</span>
                </div>
                <div class="form-group">
                    <label for="confirmation-password">Confirmar Nova Senha:</label>
                    <input name="confirmation-password" id="confirmation-password" type="password" class="form-control" autocomplete="new-password" placeholder="Confirmar Nova Senha">
                    <span class="form-text text-muted">Confirme a nova senha</span>
                </div>
            </div>
            <div class="form-footer">
                <button class="btn btn-primary" type="submit">Finalizar Cadastro</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/student/first_login.js') }}"></script>
</body>
</html>
