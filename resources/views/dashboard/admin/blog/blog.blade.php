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
                <th>Autor</th>
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
<script src="{{ asset('js/admin/blog.js') }}"></script>
<script>
    $(document).ready(function () {
        let dataTableColumns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'user.name', name: 'user.name'},
        ];

        new DataTableController('admin', 'blog', dataTableColumns, 'Notícia');
    });

    window.customCreate = function () {
        $('#summernote').summernote('code', '');
    };

    window.customEdit = function (data) {
        $('#summernote').summernote('code', data.body);
    };

    window.customBeforeSubmitAjax = function (formData) {
        formData.append('body', $('#summernote').summernote('code'));
    };

    window.customSubmitSuccess = function () {
        ($('#submit-button').val() === "Adicionar") ? $('#summernote').summernote('code', '') : '';
    }

</script>
@modal
    @slot('inputs')
		<div class="form-group">
			<label for="image">Imagem:</label>
			<input type="file" class="form-control-file" id="image" name="image">
		</div>
		<div class="form-group">
			<label for="title" class="control-label mb-0">Título: </label>
			<input type="text" name="title" id="title" class="form-control" required/>
		</div>
		<div class="form-group">
			<label for="body" class="control-label mb-0">Corpo: </label>
			<div id="summernote" name="body" id="body"></div>
		</div>
	@endslot
@endmodal
@endsection
