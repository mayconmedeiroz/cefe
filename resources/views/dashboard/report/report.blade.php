@extends('layouts.dashboard', ['title' => 'Reportar um Problema'])

@section('content')
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('report') }}" enctype="multipart/form-data">
                <div class="form">
                    @if (\Session::has('error'))
                        <div class="alert alert-{{ (\Session::get('error') == true) ? 'danger' : 'success' }}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach(\Session::get('messages') as $message)
                                {{ $message }}
                            @endforeach
                        </div>
                    @endif
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" placeholder="Título" id="title" name="title" required>
                            <span class="form-text text-muted">Por favor insira um título para o problema.</span>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagem do Artigo</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image" data-browse="Buscar">Escolher Arquivo</label>
                                <span class="form-text text-muted">(Opcional) Por favor envie uma imagem do problema, se houver.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seriousness">Gravidade do Problema</label>
                            <select class="form-control" id="seriousness" name="seriousness">
                                <option value="0">Baixa</option>
                                <option value="1" selected>Média</option>
                                <option value="2">Alta</option>
                                <option value="3">Altíssima</option>
                            </select>
                            <span class="form-text text-muted">Por favor informe a gravidade do problema.</span>
                        </div>
                        <div class="form-group">
                            <label for="content">Detalhes do Problema</label>
                            <div>
                                <textarea class="form-control" style="height: 250px" id="content" name="content"></textarea>
                                <span class="form-text text-muted">Por favor envie os detalhes do problema.</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom-js')
<script>
    $(document).on('change', '#image', function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
