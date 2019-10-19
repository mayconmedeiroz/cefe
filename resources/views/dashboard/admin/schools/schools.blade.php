@extends('layouts.dashboard', ['title' => 'Gerenciar Modalidades'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/css/datatables.min.css') }}"/>
@endsection

@section('content')
<div class="list-div p-4">
    <table id="list" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th>Nome</th>
                <th>Sigla</th>
                <th width="64px">Ação</th>
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

        new DataTableController('admin', 'sports', dataTableColumns, 'Modalidade');
    });
</script>
@modal
    @slot('inputs')
		<div class="form-group">
			<label for="name" class="control-label mb-0">Nome da Modalidade:</label>
			<input type="text" name="name" id="name" class="form-control" autofocus required/>
		</div>
		<div class="form-group">
			<label for="acronym" class="control-label mb-0">Sigla: </label>
			<input type="text" name="acronym" id="acronym" class="form-control" required/>
		</div>
	@endslot
@endmodal
@endsection
