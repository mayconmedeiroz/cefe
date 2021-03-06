@extends('layouts.dashboard', ['title' => 'Turma ' . $breadcrumb->name ])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/css/datatables.min.css') }}"/>
@endsection

@section('content')
    <div class="list-div p-4">
        <table id="list" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th width="18px">ID</th>
                <th>Nome</th>
                <th>Escola</th>
                <th>Turma</th>
                <th>Número</th>
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
    var sport_class;
    var school_class;
    $(document).ready(function () {
        let dataTableColumns = [
            {data: "id", name: "id"},
            {data: "name", name: "name"},
            {data: "acronym", name: "acronym"},
            {data: "class", name: "class"},
            {data: "class_number", name: "class_number"},
        ];

        let sportId = window.location.href.split('/').slice(-1).pop();

        new DataTableController('admin', `class/${sportId}`, dataTableColumns, 'Turma');
    });

    window.customCreate = function () {
        $('#password').attr('required', true);
    };

    window.customEdit = function (data) {
        $('#password').attr('required', false);

        if (data.student_school_class != '') {
            $('#school').val(data.student_school_class[0].school.id).change();
            school_class = data.student_school_class[0].id;
            $('#class_number').val(data.student_school_class[0].pivot.class_number);
        }

        if (data.student_class != '') {
            $('#sport').val(data.student_class[0].sport.id).change();
            sport_class = data.student_class[0].id;
        }
    };
</script>
<script src="{{ asset('js/admin/students.js') }}"></script>
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
		<div class="form-group">
			<label for="school_class" class="control-label mb-0">Turma: </label>
			<select name="school_class" id="school_class" class="form-control" required>
				<option value="" disabled selected hidden>Escolha a Turma:</option>
			</select>
		</div>
		<div class="form-group">
			<label for="class_number" class="control-label mb-0">Número: </label>
			<input type="text" name="class_number" id="class_number" class="form-control" maxlength="2" required/>
		</div>
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
			<label for="sport_class" class="control-label mb-0">Turma do CEFE: </label>
			<select name="sport_class" id="sport_class" class="form-control" required>
				<option value="" disabled selected hidden>Escolha uma Turma:</option>
			</select>
		</div>
	@endslot
@endmodal
@endsection
