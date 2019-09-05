@extends('layouts.dashboard', ['title' => 'Gerenciar Turmas'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"/>
@endsection

@section('content')
    <div class="list-div p-4">
        <table id="list" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th width="18px">ID</th>
                <th>Modalidade</th>
                <th>Nome</th>
                <th>Horário</th>
                <th>Vagas Restante</th>
                <th>Ação</th>
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
            {data: 'sport_name', name: 'sport_name'},
            {data: 'name', name: 'name'},
            {data: 'sport_time', name: 'sport_time'},
            {data: 'vacancies', name: 'vacancies'}
        ];

        new DataTableController('teacher', 'sport_classes', dataTableColumns, 'Turma');
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

    window.viewExists = 'class';
</script>
<script src="{{ asset('js/admin/students.js') }}"></script>
@endsection
