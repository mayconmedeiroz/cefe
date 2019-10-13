@extends('layouts.dashboard', ['title' => 'Gerenciar Modalidades'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"/>
@endsection

@section('content')
<div class="list-div p-4">
    <table id="list" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th>Nome</th>
                <th width="64px">Ação</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('custom-js')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/admin/DataTableController.js') }}"></script>
<script>
    $(document).ready(function () {
        let dataTableColumns = [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
        ];

        new DataTableController('admin', 'categories', dataTableColumns, 'Categoria');
    });
</script>
@modal
    @slot('inputs')
		<div class="form-group">
			<label for="name" class="control-label mb-0">Nome da Categoria:</label>
			<input type="text" name="name" id="name" class="form-control" autofocus required/>
		</div>
	@endslot
@endmodal
@endsection