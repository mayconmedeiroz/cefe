$(document).ready(function () {
	$('#list').DataTable({
		processing: true,
		serverSide: true,
		autoWidth: false,
		ajax: {
			url: '/admin/sports/getData',
			type: 'POST'
		},
		lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
		columns: [
			{data: 'id', name: 'id'},
			{data: 'name', name: 'name'},
			{data: 'acronym', name: 'acronym'},
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
				text: '<i class="fas fa-plus"></i> Nova Modalidade',
				attr: {
					id: 'newsport'
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

    $(document).on('click', '#newsport', function(){
		$('#form-result').html('');
		$('#sport-form')[0].reset();
		$('.modal-title').text('Adicionar uma nova modalidade');
		$('#action_button').val('Adicionar');
		$('#formModal').modal('show');
	});

	let userID;

	$(document).on('click', '.edit', function(){
		userID = $(this).attr('id');
		$('#form-result').html('');
		$.ajax({
			url:"/admin/sports/"+userID+"/edit",
			dataType:"json",
			success:function(html){
				$('#name').val(html.data.name);
				$('#acronym').val(html.data.acronym);
				$('#hidden_id').val(html.data.id);
				$('.modal-title').text('Modificar uma modalidade');
				$('#action_button').val('Modificar');
				$('#formModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		userID = $(this).attr('id');
		$('#confirmDelete').text('Confirmar');
		$('#confirmModal').modal('show');
	});

	$('#confirmDelete').click(function(){
		$.ajax({
			method:'DELETE',
			url:'/admin/sports/'+userID,
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

	$('#sport-form').on('submit', function(e) {
		e.preventDefault();
		if ($('#action_button').val() === 'Adicionar') {
			$.ajax({
				url: '/admin/sports/',
				method: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (data) {
					let html = '';
					if (data.errors) {
						html = '<div class="alert alert-danger">' + data.errors + '</div>';
					}
					if (data.success) {
						html = '<div class="alert alert-success">' + data.success + '</div>';
						$('#sport-form')[0].reset();
						$('#list').DataTable().ajax.reload();
					}
					$('#form-result').html(html);
				}
			});
		}

		if($('#action_button').val() === "Modificar") {
			$.ajax({
				url:'/admin/sports/update/',
				method: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success:function(data) {
					let html = '';
					if(data.errors) {
						html = '<div class="alert alert-danger">' + data.errors + '</div>';
					}
					if(data.success) {
						html = '<div class="alert alert-success">' + data.success + '</div>';
						$('#list').DataTable().ajax.reload();
					}
					$('#form-result').html(html);
				}
			});
		}
	});
});