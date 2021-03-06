@extends('layouts.dashboard', ['title' => 'Listar Alunos'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendors/datatables/css/datatables.min.css') }}"/>
@endsection

@section('content')
<div class="list-div p-4">
    <table id="list" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="10%">Mátricula</th>
                <th>Nome</th>
                <th width="10%">Turma</th>
                <th width="10%">Número</th>
                <th width="10%">Turma CEFE</th>
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
            {data: "enrollment", name: "enrollment"},
            {data: "name", name: "name"},
            {data: "class", name: "class"},
            {data: "class_number", name: "class_number"},
            {data: "sport_class", name: "sport_class"},
        ];

        new DataTableController('secretary', 'students', dataTableColumns, 'Aluno');
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
<script src="{{ asset('js/secretary/students.js') }}"></script>
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
        <input type="hidden" name="school" id="school" value="{{$school->school_id}}"/>
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
    @endslot
@endmodal
@endsection
