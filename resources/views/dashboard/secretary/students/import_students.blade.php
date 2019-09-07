@extends('layouts.dashboard', ['title' => 'Importar Estudantes'])

@section('content')
<div class="form">
    <div class="form-body">
        <div id="form-result">
            <div class="alert alert-secondary" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">Bem-vindo!</h4>
                <p>Este é o sistema de importar estudantes, se você já conhece pode seguir em frente.</p>
                <p>Caso não conheça é bem simples, siga o tutorial do excel.</p>
                <hr/>
                <a class="text-dark" href="{{ asset('excel/importar-estudante-base.xlsx') }}" download>
                    Clique aqui para baixar o excel base.
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
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
        </div>
        <div class="row import-row" style="display:none">
            <div class="col mt-lg-5">
                <form enctype="multipart/form-data" method="POST" action="#" id="import_form">
                    @csrf
                    <div class="custom-file">
                        <input type="file" accept='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' id="import_students" name="import_students" class="custom-file-input" required>
                        <input type="hidden" id="school" value="{{ $school->school_id }}"/>
                        <label class="custom-file-label" for="import_students">Escolha o arquivo Excel</label>
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
    <script src="{{ asset('js/admin/ImportStudentController.js') }}"></script>
    <script>
        new ImportStudentController('secretary');
    </script>
@endsection
