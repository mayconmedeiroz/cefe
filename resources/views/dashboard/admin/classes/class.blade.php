@extends('layouts.dashboard', ['title' => 'Turma ' . $classes->name ])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"/>
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
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/admin/sportClass.js') }}"></script>
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="student-class-form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="modal-body">
                        <span id="form-result"></span>
                        @csrf
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
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <input type="hidden" name="action" id="action"/>
                            <input type="hidden" name="hidden_id" id="hidden_id"/>
                            <input type="submit" name="action_button" id="action_button" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-0">Você tem certeza que quer remover essa modalidade?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" name="confirmDelete" id="confirmDelete" class="btn btn-danger">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
@endsection