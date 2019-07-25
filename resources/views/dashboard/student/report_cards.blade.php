@extends('layouts.dashboard', ['title' => 'Boletim'])

@section('content')
<div class="form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="school_year">Ano Letivo:</label>
                    <select name="school_year" id="school_year" class="form-control" required>
                        <option value="" disabled selected hidden>Escolha o ano letivo</option>
                        @foreach($school_years as $school_year)
                            <option value="{{$school_year->id}}">{{$school_year->school_year}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="evaluation">Avaliação:</label>
                    <select name="evaluation" id="evaluation" class="form-control" disabled required>
                        <option value="" disabled selected hidden>Escolha a Avaliação:</option>
                        @foreach($evaluations as $evaluation)
                            <option value="{{$evaluation->id}}">{{$evaluation->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row grade" style="display: none;">
            <div class="col mt-lg-5">
                <table id="list" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nota</th>
                            <th>Faltas</th>
                            <th>Nota de Recuperação</th>
                        </tr>
                    </thead>
                    <tr>
                        <td id="grade"></td>
                        <td id="absence"></td>
                        <td id="recuperation_grade"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="{{ asset('js/student/report_cards.js') }}"></script>
@endsection