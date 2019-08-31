<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="submit-form" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    <span id="form-result"></span>
                    @csrf
                    {{ $inputs }}
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="hidden" name="action" id="action"/>
                        <input type="hidden" name="id" id="id"/>
                        <input type="submit" name="submit-button" id="submit-button" class="btn btn-primary"/>
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
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="mb-0">Você tem certeza que quer remover?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" name="confirmDelete" id="confirmDelete" class="btn btn-danger">Confirmar</button>
            </div>
        </div>
    </div>
</div>
