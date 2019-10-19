@extends('layouts.dashboard', ['title' => 'Gerenciar Secretários'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/css/datatables.min.css') }}"/>
@endsection

@section('content')
<div class="list-div p-4">
    <table id="list" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width: 10%">ID</th>
                <th>Nome</th>
                <th>Escola</th>
                <th style="width: 64px">Ação</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('custom-js')
<script src="{{ asset('vendors/datatables/js/datatables.min.js') }}"></script>
<script src="{{ asset('js/Controller/DataTableController.js') }}"></script>
<script>
    $(document).ready(function () {
        let dataTableColumns = [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'acronym', name: 'acronym'}
        ];

        new DataTableController('admin', 'secretaries', dataTableColumns, 'Secretário');
    });

    window.customCreate = function () {
        $('#password').attr('required', true);
    };

    window.customEdit = function () {
        $('#password').removeAttr('required');
    }
</script>
@modal
    @slot('inputs')
		<div class="form-group">
			<label for="enrollment" class="control-label mb-0">Matrícula:</label>
			<input name="enrollment" id="enrollment" type="text" class="form-control" autofocus required/>
		</div>
		<div class="form-group">
			<label for="name" class="control-label mb-0">Nome Completo: </label>
			<input name="name" id="name" type="text" class="form-control" required/>
		</div>
		<div class="form-group">
			<label for="email" class="control-label mb-0">Email: </label>
			<input name="email" id="email" type="email" class="form-control" required/>
		</div>
		<div class="form-group">
			<label for="password" class="control-label mb-0">Senha: </label>
			<input name="password" id="password" type="password" class="form-control" required/>
		</div>
        <div class="form-group">
            <label for="school" class="control-label mb-0">Escola: </label>
            <select name="school" id="school" class="form-control" required>
                <option value="" disabled selected hidden>Escolha a Escola</option>
                @foreach($schools as $school)
                    <option value="{{$school->id}}">{{$school->name}}</option>
                @endforeach
            </select>
        </div>
	@endslot
@endmodal
@endsection
