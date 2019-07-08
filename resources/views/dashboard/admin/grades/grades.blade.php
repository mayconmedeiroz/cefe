@extends('layouts.dashboard', ['title' => 'Lançamento de Notas'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"/>
@endsection

@section('content')
<form id="form-grade" method="POST">
    <div class="form">
        <div class="form-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="school_year">Ano Letivo:</label>
                        <select name="school_year" id="school_year" class="form-control" required>
                            <option value="" disabled selected hidden>Escolha o ano letivo</option>
                            @foreach(\CEFE\SchoolYear::get() as $school_year)
                                <option value="{{$school_year->id}}">{{$school_year->school_year}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sport">Modalidade:</label>
                        <select name="sport" id="sport" class="form-control" disabled required>
                            <option value="" disabled selected hidden>Escolha a Modalidade</option>
                            @foreach(\CEFE\Sport::get() as $sport)
                                <option value="{{$sport->id}}">{{$sport->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="sport_class">Turma:</label>
                        <select name="sport_class" id="sport_class" class="form-control" disabled required>
                            <option value="" disabled selected hidden>Escolha a Turma:</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="evaluation">Avaliação:</label>
                        <select name="evaluation" id="evaluation" class="form-control" disabled required>
                            <option value="" disabled selected hidden>Escolha a Avaliação:</option>
                            @foreach(\CEFE\Evaluation::get() as $evaluation)
                                <option value="{{$evaluation->id}}">{{$evaluation->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="planned_classes">Aulas Previstas:</label>
                        <input type="text" name="planned_classes" id="planned_classes" class="form-control" disabled required/>

                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="classes_held">Aulas Realizadas:</label>
                        <input type="text" name="classes_held" id="classes_held" class="form-control" disabled required/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-div d-none p-4">
        <div class="form-result"></div>
        <table id="list" class="table table-striped table-bordered" style="width:100%">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-plus"></i> Salvar Notas</button>
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th>Nome</th>
                    <th>Faltas</th>
                    <th>Nota</th>
                    <th>Nota de Recuperação</th>
                </tr>
            </thead>
        </table>
    </div>
</form>
@endsection

@section('custom-js')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/admin/grades.js') }}"></script>
@endsection