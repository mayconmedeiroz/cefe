$(document).ready(function () {
	$('#list').DataTable({
		processing: true,
		serverSide: true,
		autoWidth: false,
		ajax: {
			url: '/admin/employees/getData',
			type: 'POST'
		},
		lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
		columns: [
			{data: 'id', name: 'id'},
			{data: 'name', name: 'name'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
		],
		dom: "<'row'<'col-sm-12 mb-3'B>>" +
			 "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
			 "<'row'<'col-sm-12'tr>>" +
			 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		buttons: [
			{
				extend: 'copy',
				text: '<i class="fas fa-copy"></i> Copiar',
				exportOptions: {columns: 'th:not(:last-child)'}
			},
			{
				extend: 'excel',
				text: '<i class="fas fa-file-excel"></i> Excel',
				exportOptions: {columns: 'th:not(:last-child)'},
				title: 'Listar Alunos'
			},
			{
				extend: 'pdf',
				text: '<i class="fas fa-file-pdf"></i> PDF',
				exportOptions: {columns: 'th:not(:last-child)'},
				title: 'Listar Alunos'
			},
			{
				extend: 'print',
				text: '<i class="fas fa-print"></i> Imprimir',
				exportOptions: {columns: 'th:not(:last-child)'},
				title: 'Listar Alunos',
			},
			{
				text: '<i class="fas fa-plus"></i> Novo Funcionário',
				attr: {
					id: 'newemployee'
				}
			}
		],
		select: {
			selector: 'td:not(:last-child)'
		},
		language: {
			url: '/js/portuguese.datatable.json'
		}
	});

    $(document).on('click', '#newemployee', function(){
		$('#form-result').html('');
		$('#employee-form')[0].reset();
		$('.modal-title').text('Adicionar uma novo funcionário');
		$('#action_button').val('Adicionar');
		$('#formModal').modal('show');
		$('#password').attr('required', true);
		$('#action').val('add');
	});

	let employeeID;

	$(document).on('click', '.edit', function(){
		employeeID = $(this).attr('id');
		$('#form-result').html('');
		$.ajax({
			url:"/admin/employees/"+employeeID+"/edit",
			dataType:"json",
			success:function(data){
				$('#enrollment').val(data.enrollment);
				$('#name').val(data.name);
				$('#email').val(data.email);
				$('#password').val(data.password).attr('required', false);
				$('#action').val('mod');
				$('#hidden_id').val(data.id);
				$('.modal-title').text('Modificar um funcionário');
				$('#action_button').val('Modificar');
				$('#formModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		employeeID = $(this).attr('id');
		$('#confirmDelete').text('Confirmar');
		$('#confirmModal').modal('show');
	});

	$('#confirmDelete').click(function(){
		$.ajax({
			method:'DELETE',
			url:'/admin/employees/'+employeeID,
			beforeSend:function(){
				$('#confirmDelete').text('Excluindo...');
			},
			success:function(){
				setTimeout(function(){
					$('#confirmModal').modal('hide');
					$('#list').DataTable().ajax.reload();
				}, 300);
			}
		});
	});

	$('#employee-form').on('submit', function(e) {
		e.preventDefault();
		if ($('#action_button').val() === 'Adicionar') {
			$.ajax({
				url: '/admin/employees/',
				method: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (data) {
					displayMessages(data);
				}
			});
		}

		if($('#action_button').val() === "Modificar") {
			$.ajax({
				url:'/admin/employees/update/',
				method: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success:function(data) {
					displayMessages(data);
				}
			});
		}
	});

	function displayMessages(data) {
		let html = '';
		if (data.errors) {
			html = '<div class="alert alert-danger">';
			for(let count = 0; count < data.errors.length; count++) {
				html += '<p>' + data.errors[count] + '</p>';
			}
			html += '</div>';
		}
		if(data.success)
		{
			html = '<div class="alert alert-success">' + data.success + '</div>';
			($('#action_button').val() === "Adicionar") ? $('#employee-form')[0].reset() : '';
			$('#list').DataTable().ajax.reload();
		}
		$('#form-result').html(html);
	}
});
