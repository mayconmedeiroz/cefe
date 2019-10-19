@extends('layouts.dashboard', ['title' => 'Gerenciar Turmas'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/css/datatables.min.css') }}"/>
@endsection

@section('content')
    <div class="list-div p-4">
        <table id="list" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th width="18px">ID</th>
                <th>Modalidade</th>
                <th>Nome</th>
                <th>Professor</th>
                <th>Horário</th>
                <th>Vagas Restante</th>
                <th width="101px">Ação</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@section('custom-js')
<script src="{{ asset('vendors/datatables/js/datatables.min.js') }}"></script>
<script src="{{ asset('js/admin/sportClasses.js') }}"></script>
<script src="{{ asset('js/admin/DataTableController.js') }}"></script>
<script>
    $(document).ready(function () {
        let dataTableColumns = [
            {data: 'id', name: 'id'},
            {data: 'sport_name', name: 'sport_name'},
            {data: 'name', name: 'name'},
            {data: 'teacher_name', name: 'teacher_name'},
            {data: 'sport_time', name: 'sport_time'},
            {data: 'vacancies', name: 'vacancies'}
        ];

        new DataTableController('admin', 'sport_classes', dataTableColumns, 'Turma');
    });

    window.customEdit = function (data) {
        $('#sport').val(data.id);
        $('#teachers').val(data.teachers_id.split(", "));
    };

    window.customBeforeSubmitAjax = function (formData) {
        formData.append('teachers', $('#teachers').val());
    };

    window.viewExists = 'class';
</script>
@modal
    @slot('inputs')
		<div class="form-group">
			<label for="sport" class="control-label mb-0">Modalidade: </label>
			<select name="sport" id="sport" class="form-control" required>
				<option value="" disabled selected hidden>Escolha a Modalidade:</option>
				@foreach($sports as $sport)
					<option value="{{$sport->id}}">{{$sport->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="name" class="control-label mb-0">Nome: </label>
			<input type="text" name="name" id="name" class="form-control" required readonly/>
		</div>
		<div class="form-group">
			<label for="name" class="control-label mb-0">Vagas: </label>
			<input type="number" name="vacancies" id="vacancies" class="form-control" min="0" maxlength="4" required/>
		</div>
		<div class="form-group">
			<label for="name" class="control-label mb-0">Professor(es): </label>
				<select name="teachers" id="teachers" class="form-control" multiple required>
					@foreach($teachers as $teacher)
						<option value="{{$teacher->id}}">{{$teacher->name}}</option>
					@endforeach
				</select>
		</div>
		<div class="form-group">
			<label for="weekday" class="control-label mb-0">Dia da semana: </label>
			<select name="weekday" id="weekday" class="form-control" required>
				<option value="" disabled selected hidden>Escolha o dia da semana:</option>
				<option value="0">Domingo</option>
				<option value="1">Segunda-feira</option>
				<option value="2">Terça-feira</option>
				<option value="3">Quarta-feira</option>
				<option value="4">Quinta-feira</option>
				<option value="5">Sexta-feira</option>
				<option value="6">Sábado</option>
			</select>
		</div>
		<div class="form-group">
			<label for="start_time" class="control-label mb-0">Horário de Ínicio: </label>
			<input type="time" id="start_time" name="start_time" min="07:00:00" max="18:00:00" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="end_time" class="control-label mb-0">Horário de Fim: </label>
			<input type="time" id="end_time" name="end_time" min="07:00:00" max="18:00:00" class="form-control" required>
		</div>
	@endslot
@endmodal
@endsection
