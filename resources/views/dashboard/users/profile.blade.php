@extends('layouts.dashboard', ['title' => 'Meu Perfil'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="profile p-4">
                <div class="profile-pic d-inline-block">
                    <img id="profile-avatar" src="storage/avatars/{{ Auth::user()->avatar }}">
                    <div class="layer">
                        <div class="loader"></div>
                    </div>
                    <a class="image-wrapper">
                        <form enctype="multipart/form-data" method="POST" action="#" id="profilePictureForm">
                            @csrf
                            <input type="file" class="d-none" accept='image/*' name="avatar" id="changePicture">
                            <label class="edit-picture" for="changePicture" type="file">Mudar Foto</label>
                        </form>
                    </a>
                </div>
                <div class="d-inline-block align-middle">
                    <span class="h1">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="alert-group">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Caso alguma informação esteja errada informe ao CEFE.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <div class="row fight">
        <div class="col-lg-6">
            <form method="POST" action="#" id="profileUserForm">
                <div class="form">
                    @csrf
                    <div class="form-group form-title">
                        <div><p>Informações Básicas</p></div>
                    </div>
                    <div class="form-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label for="enrollment">Matrícula:</label>
                                <input name="enrollment" id="enrollment" type="text" class="form-control" value="{{ Auth::user()->enrollment }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Nome Completo:</label>
                                <input name="fullname" id="fullname" type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" id="email" type="email" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input name="password" id="password" type="password" class="form-control" autocomplete="current-password" placeholder="Senha">
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <form method="POST" action="#" id="changePasswordForm">
                @csrf
                <div class="form">
                    <div class="form-group form-title">
                        <div><p>Mudar Senha</p></div>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label for="current">Senha Atual:</label>
                            <input name="current" id="current" type="password" class="form-control" autocomplete="current-password" placeholder="Senha Atual">
                        </div>
                        <div class="form-group">
                            <label for="new-password">Nova Senha:</label>
                            <input name="new-password" id="new-password" type="password" class="form-control" autocomplete="new-password" placeholder="Nova Senha">
                        </div>
                        <div class="form-group">
                            <label for="confirmation-password">Confirmar Nova Senha:</label>
                            <input name="confirmation-password" id="confirmation-password" type="password" class="form-control" autocomplete="new-password" placeholder="Confirmar Nova Senha">
                        </div>
                    </div>
                    <div class="form-footer">
                        <button class="btn btn-primary" type="submit">Mudar Senha</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        $(document).ready(function(){
            $(document).on('change', '#changePicture', function(){
                if($('#changePicture')[0].files.length === 0){return false}
                let formData = new FormData();
                formData.append("avatar", document.getElementById('changePicture').files[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/updateAvatar',
                    method:'POST',
                    data: formData,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        $('.profile').prepend(`
                            <div class="alert ${data.className}">
                                ${data.message}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        `);
                        $('#profile-avatar, #dropdown-img, #dropdown-user-img').attr("src", data.imageUrl);
                    }
                });
            });

            $(document).on('submit', '#profileUserForm', function(e){
                e.preventDefault();
                let formData = new FormData();
                formData.append('email', $('#email').val());
                formData.append('password', $('#password').val());
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/updateUser',
                    method:'POST',
                    data: formData,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        $('.alert-group').append(`
                            <div class="alert ${data.className}">
                                ${data.message}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        `);
                        $('#profile-avatar, #dropdown-img, #dropdown-user-img').attr("src", data.imageUrl);
                        $('#password').val('');
                    }
                });
            });


            $(document).on('submit', '#changePasswordForm', function(e){
                e.preventDefault();
                let formData = new FormData();
                formData.append('current', $('#current').val());
                formData.append('new-password', $('#new-password').val());
                formData.append('confirmation-password', $('#confirmation-password').val());
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'/changePassword',
                    method:'POST',
                    data: formData,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        $('.alert-group').append(`
                            <div class="alert ${data.className}">
                                ${data.message}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        `);
                        $('#profile-avatar, #dropdown-img, #dropdown-user-img').attr("src", data.imageUrl);
                        $('#current, #new-password, #confirmation-password').val('');
                    }
                });
            });
        });
    </script>
@endsection