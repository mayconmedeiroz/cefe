$(document).ready(function () {
	$('#list').DataTable({
		processing: true,
		serverSide: true,
		autoWidth: false,
		ajax: {
			url: '/admin/sport_classes/getData',
			type: 'POST'
		},
		lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
		columns: [
			{data: 'id', name: 'id'},
			{data: 'sport_name', name: 'sport_name'},
			{data: 'name', name: 'name'},
			{data: 'teacher_name', name: 'teacher_name'},
			{data: 'sport_time', name: 'sport_time'},
			{data: 'vacancies', name: 'vacancies'},
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
				title: 'Listar Turmas'
			},
			{
				extend: 'pdf',
				text: '<i class="fas fa-file-pdf"></i> PDF',
				exportOptions: {columns: 'th:not(:last-child)'},
				title: 'Listar Turmas'
			},
			{
				extend: 'print',
				text: '<i class="fas fa-print"></i> Imprimir',
				exportOptions: {columns: 'th:not(:last-child)'},
				title: 'Listar Turmas',
			},
			{
				text: '<i class="fas fa-plus"></i> Nova Turma',
				attr: {
					id: 'newsportclass'
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

    $(document).on('change', '#sport', function() {
        let sportId = $(this).val();
        let classId = $('#hidden_id').val();
        if(sportId) {
            $.ajax({
                url: ($('#sport-class-form').on('submit') && $('#action_button').val() === "Modificar") ? `/admin/sport_classes/getSportName/${sportId}/${classId}` : `/admin/sport_classes/getSportName/${sportId}/0`,
                type: 'GET',
                dataType: 'json',
                success:function(data) {
                    $('#name').val(data);
                }
            });
        }
    });

    $(document).on('click', '#newsportclass', function(){
		$('#form-result').html('');
		$('#sport-class-form')[0].reset();
		$('.modal-title').text('Adicionar uma nova turma');
		$('#action_button').val('Adicionar');
		$('#formModal').modal('show');
	});

	let userID;

	$(document).on('click', '.edit', function(){
		userID = $(this).attr('id');
		$('#form-result').html('');
		$.ajax({
			url:"/admin/sport_classes/"+userID+"/edit",
			dataType:"json",
			success:function(html){
				$('#sport').val(html.data.sport_id);
				$('#name').val(html.data.name);
                $('#vacancies').val(html.data.vacancies);
                $('#teachers').val(html.data.teachers_id.split(", "));
                $('#weekday').val(html.data.weekday);
                $('#start_time').val(html.data.start_time);
                $('#end_time').val(html.data.end_time);
				$('#hidden_id').val(html.data.id);
				$('.modal-title').text('Modificar uma turma');
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
			url:'/admin/sport_classes/'+userID,
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

	$('#sport-class-form').on('submit', function(e) {
		e.preventDefault();
		$('#name').removeAttr('disabled');
		let form_data = new FormData(this);
		form_data.append('teachers', $('#teachers').val());

		if ($('#action_button').val() === 'Adicionar') {

			$.ajax({
				url: '/admin/sport_classes/',
				method: 'POST',
				data: form_data,
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
						$('#sport-class-form')[0].reset();
						$('#list').DataTable().ajax.reload();
					}
					$('#form-result').html(html);
				}
			});
		}

		if($('#action_button').val() === "Modificar") {
			$.ajax({
				url:'/admin/sport_classes/update/',
				method: 'POST',
				data: form_data,
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
		$('#name').attr('disabled', 'disabled');
	});
});