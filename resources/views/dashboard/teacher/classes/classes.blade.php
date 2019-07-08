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
    <script src="{{ asset('js/teacher/sportClasses.js') }}"></script>
@endsection