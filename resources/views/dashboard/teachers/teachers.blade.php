@extends('layouts.dashboard', ['title' => 'Gerenciar Professores'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"/>
@endsection

@section('content')
<div class="list-div p-4">
    <table id="list" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th width="10%">ID</th>
                <th>Nome</th>
                <th width="64px">Ação</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('custom-js')
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/teachers.js') }}"></script>
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="teacher-form" class="form-horizontal">
                <div class="modal-body">
                    <span id="form-result"></span>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label mb-0">Nome da Modalidade:</label>
                        <input type="text" name="name" id="name" class="form-control" autofocus required/>
                    </div>
                    <div class="form-group">
                        <label for="acronym" class="control-label mb-0">Sigla: </label>
                        <input type="text" name="acronym" id="acronym" class="form-control" required/>
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