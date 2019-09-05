@extends('layouts.dashboard', ['title' => 'Importar Estudantes'])

@section('content')
<div class="form">
    <div class="form-body">
        <div id="form-result"></div>
        <div class="row">
            <div class="col-lg-6">
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
            <div class="col-lg-6">
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
        </div>
        <div class="row import-row" style="display:none">
            <div class="col mt-lg-5">
                <form enctype="multipart/form-data" method="POST" action="#" id="import_form">
                    @csrf
                    <div class="custom-file">
                        <input type="file" accept='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' id="import_students" name="import_students" class="custom-file-input" required>
                        <label class="custom-file-label" for="import_students" data-browse="Procurar">Escolha o arquivo Excel</label>
                        <div class="form-group">
                            <input type="submit" name="action_button" id="action_button" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="{{ asset('js/admin/import_students.js') }}"></script>
@endsection
