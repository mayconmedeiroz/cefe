@extends('layouts.dashboard', ['title' => 'Turma ' . $classes->name ])

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
    <script src="{{ asset('js/teacher/sportClass.js') }}"></script>
@endsection