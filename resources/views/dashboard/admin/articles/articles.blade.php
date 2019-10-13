@extends('layouts.dashboard', ['title' => 'Gerenciar Notícias'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}"/>
@endsection

@section('content')
    <div class="list-div p-4">
        <table id="list" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th width="18px">ID</th>
                <th>Título</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Destaque</th>
                <th>Data</th>
                <th width="94px">Ação</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('custom-js')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/summernote-pt-BR.min.js') }}"></script>
<script src="{{ asset('js/admin/DataTableController.js') }}"></script>
<script src="{{ asset('js/admin/articles.js') }}"></script>
<script>
    $(document).ready(function () {
        let dataTableColumns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'category', name: 'category'},
            {data: 'status', name: 'status'},
            {data: 'featured', name: 'featured'},
            {data: 'date', name: 'date'},
        ];

        new DataTableController('admin', 'articles', dataTableColumns, 'Notícia');
    });

    window.customCreate = function () {
        $('#summernote').summernote('code', '');
    };

    window.customEdit = function (data) {
        $('#summernote').summernote('code', data.content);
    };

    window.customBeforeSubmitAjax = function (formData) {
        formData.append('content', $('#summernote').summernote('code'));
    };

    window.customSubmitSuccess = function () {
        ($('#submit-button').val() === "Adicionar") ? $('#summernote').summernote('code', '') : '';
    }
</script>
@modal
    @slot('inputs')
        <div class="form-group">
            <label>Título do Artigo</label>
            <input type="text" class="form-control" placeholder="Título do Artigo" id="title" name="title" required>
            <span class="form-text text-muted">Por favor insira a título do artigo.</span>
        </div>
        <div class="form-group">
            <label>Imagem do Artigo</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                <label class="custom-file-label" for="image" data-browse="Buscar">Escolher Arquivo</label>
                <span class="form-text text-muted">(Opcional) Por favor envie a imagem do artigo.</span>
            </div>
        </div>
        <div class="form-group">
            <label for="category">Categoria</label>
            <select class="form-control" id="category" name="category" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <span class="form-text text-muted">Por favor escolha a categoria do artigo.</span>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="category">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="DRAFT">Revisão</option>
                        <option value="PUBLISHED">Publicar</option>
                    </select>
                    <span class="form-text text-muted">Por favor escolha o status do artigo.</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="category">Data de Publicação</label>
                    <input type="date" class="form-control" placeholder="Título do Artigo" id="date" name="date">
                    <span class="form-text text-muted">Vazio para publicar no momento.</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="featured">Destaque</label>
            <select class="form-control" id="featured" name="featured" required>
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
            <span class="form-text text-muted">Por favor escolha o destaque do artigo.</span>
        </div>
        <div class="form-group">
            <label for="category">Conteúdo do Artigo</label>
            <div id="summernote"></div>
        </div>
	@endslot
@endmodal
@endsection
