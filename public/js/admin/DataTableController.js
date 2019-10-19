class DataTableController {
    "use strict";

    constructor(userLevel, urlMethod, dataTablesColumns, name) {
        this.loadDataTable(userLevel, urlMethod, dataTablesColumns, name);
        this.showPanelCreate(name);
        this.showPanelEdit(userLevel, urlMethod, name);
        this.onSubmit(userLevel, urlMethod);
        this.showPanelDelete(userLevel, urlMethod);
    }

    loadDataTable(userLevel, urlMethod, dataTablesColumns, name) {

        let buttons = [];

        if (userLevel != 'teacher') {
            buttons = [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i> Copiar',
                    exportOptions: {columns: 'th:not(:last-child)'}
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    exportOptions: {columns: 'th:not(:last-child)'},
                    title: `Listar ${name}s`,
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    exportOptions: {columns: 'th:not(:last-child)'},
                    title: `Listar ${name}s`,
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Imprimir',
                    exportOptions: {columns: 'th:not(:last-child)'},
                    title: `Listar ${name}s`,
                },
                {
                    text: `<i class="fas fa-plus"></i> Novo ${name}`,
                    attr: {
                        id: 'new'
                    }
                }
            ];
        }

        if (typeof actionRow === 'undefined') {
            dataTablesColumns.push(
                {name: 'action', orderable: false, searchable: false,
                    render: function (data, type, row) {
                        return `${(typeof viewExists != 'undefined') ? `<a href="/${userLevel}/${viewExists}/${row.id}" class="view btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>` : ''}
                                ${(!(userLevel === 'teacher')) ? `<button type="button" name="edit" id="${row.id}" class="edit btn btn-primary btn-sm ${(typeof viewExists != 'undefined') ? 'mx-lg-1' : 'mr-lg-1'}"><i class="fas fa-edit"></i></button>
                                <button type="button" name="delete" id="${row.id}" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>` : ''}`;
                    }
                }
            );
        }

        $('#list').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: `/${userLevel}/${urlMethod}/getData`,
                type: 'POST'
            },
            lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
            pagingType: "full_numbers",
            columns: dataTablesColumns,
            dom: "<'row'<'col-sm-12 mb-3'B>>" +
                 "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: buttons,
            select: {
                selector: 'td:not(:last-child)'
            },
            language: {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros.",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Mostrando _MENU_ resultados",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "<i class='fas fa-angle-right'></i>",
                    "sPrevious": "<i class='fas fa-angle-left'></i>",
                    "sFirst": "<i class='fas fa-angle-double-left'></i>",
                    "sLast": "<i class='fas fa-angle-double-right'></i>"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                },
                "buttons": {
                    "copyTitle": "Copiar para área de transferência",
                    "copySuccess": {
                        "_": "Copiou %d linhas para a área de transferência",
                        "1": "Copiou uma linha para a área de transferência"
                    }
                }
            }
        });
    }

    showPanelCreate(name) {
        $(document).on('click', '#new', function(){
            $('#form-result').html('');
            $(`#submit-form`)[0].reset();
            $('#formModal .modal-title').text(`Adicionar ${name}`);
            $('#submit-button').val('Adicionar');
            $('#action').val('add');

            if (typeof customCreate === 'function') {
                customCreate();
            }

            $('#formModal').modal('show');

        });
    }

    onSubmit(userLevel, urlMethod) {

        $(document).on('submit', `#submit-form`, function(e){

            e.preventDefault();

            let formData = new FormData(this);

            if (typeof customBeforeSubmitAjax === 'function') {
                customBeforeSubmitAjax(formData);
            }

            let action = ($('#submit-button').val() === 'Adicionar') ? '' : '/update';

            $.ajax({
                url:`/${userLevel}/${urlMethod}${action}`,
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success:function(data) {

                    let html, messages = '';

                    data.messages.forEach((message)=> {
                        messages += `<p>${message}</p>`;
                    });

                    html = `<div class="alert alert-${(data.error) ? 'danger' : 'success'}">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                ${messages}
                            </div>`;

                    if(!data.error) {
                        ($('#submit-button').val() === "Adicionar") ? $('#submit-form')[0].reset() : '';
                        $('#list').DataTable().ajax.reload();
                    }

                    if (typeof customSubmitSuccess === 'function') {
                        customSubmitSuccess();
                    }

                    $('#form-result').html(html);

                }
            });
        });
    }

    showPanelEdit(userLevel, urlMethod, name) {

        let buttonId;

        $(document).on('click', '.edit', function(){

            buttonId = $(this).attr('id');

            $('#form-result').html('');

            $.ajax({
                url:`/${userLevel}/${urlMethod}/${buttonId}/edit`,
                dataType:"json",
                success:function(data){
                    $('#submit-form')[0].reset();

                    Object.keys(data).forEach(function(item) {

                        $(`#${item}`).val(data[item]);

                    });

                    if (typeof customEdit === 'function') {
                        customEdit(data);
                    }

                    $('#formModal .modal-title').text(`Modificar ${name}`);
                    $('#submit-button').val('Modificar');
                    $('#action').val('mod');
                    $('#formModal').modal('show');
                }

            });

        });

    }

    showPanelDelete(userLevel, urlMethod) {

        let buttonId;

        $(document).on('click', '.delete', function() {

            buttonId = $(this).attr('id');
            $('#confirmModal').modal('show');

        });

        $(document).on('click', '#confirmDelete', function() {
            $(this).text('Excluindo...');

            $.ajax({
                method:'DELETE',
                url:`/${userLevel}/${urlMethod}/${buttonId}`,
                success:function(){
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#list').DataTable().ajax.reload();
                        $('#confirmDelete').text('Confirmar');
                    }, 300);
                }
            });
        });
    }

}
