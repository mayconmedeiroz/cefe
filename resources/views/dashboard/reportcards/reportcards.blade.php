@extends('layouts.dashboard', ['title' => 'Boletim'])

@section('content')
<div class="form">
    <div class="form-body">
        <div class="row">
            <div class="col-lg-3">
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
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="school">Escola:</label>
                    <select name="school" id="school" class="form-control" disabled required>
                        <option value="" disabled selected hidden>Escolha a Escola</option>
                        @foreach(\CEFE\School::get() as $sport)
                            <option value="{{$sport->id}}">{{$sport->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="school_class">Turma:</label>
                    <select name="school_class" id="school_class" class="form-control" disabled required>
                        <option value="" disabled selected hidden>Escolha a Turma:</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
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
        </div>
        <div class="row export-row" style="display: none">
            <div class="col mt-lg-5">
                <a href="" class="export-button btn btn-lg btn-primary">Exportar</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="{{ asset('js/report_cards.js') }}"></script>
@endsection