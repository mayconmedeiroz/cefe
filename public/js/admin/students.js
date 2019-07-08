$(document).ready(function () {
	$('#list').DataTable({
		processing: true,
		serverSide: true,
		autoWidth: false,
		ajax: {
			url: '/admin/students/getData',
			type: 'POST'
		},
		lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
		columns: [
			{data: "id", name: "id"},
			{data: "enrollment", name: "enrollment"},
			{data: "name", name: "name"},
			{data: "acronym", name: "acronym"},
			{data: "class", name: "class"},
			{data: "class_number", name: "class_number"},
			{data: "sport_class", name: "sport_class"},
			{data: "action", name: "action", orderable: false, searchable: false},
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
				text: '<i class="fas fa-plus"></i> Novo Aluno',
				attr: {
					id: 'newstudent'
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

	let sport_class;
	let school_class;

	$(document).on('change', '#sport', function() {
		let sportId = $(this).val();
		if(sportId) {
			$.ajax({
				url: '/admin/students/getSportClasses/'+sportId,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('#sport_class').empty().append('<option value="" disabled selected hidden>Escolha uma Turma:</option>');
					$.each(data, function(key, value){
						$('#sport_class').append(`<option value="${value.id}">${value.name}</option>`);
					});
					if ($('.edit') && sport_class) {
                        changeClass(sport_class);
						sport_class = false;
					}
				}
			});
		}
	});

	$(document).on('change', '#school', function() {
		let schoolId = $(this).val();
		if(schoolId) {
			$.ajax({
				url: '/admin/students/getSchoolClasses/'+schoolId,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('#school_class').empty().append('<option value="" disabled selected hidden>Escolha a Turma:</option>');
					$.each(data, function(key, value){
						$('#school_class').append(`<option value="${value.id}">${value.class}</option>`);
					});
					if ($('.edit') && school_class) {
                        changeSchoolClass(school_class);
						school_class = false;
					}
				}
			});
		}
	});

	$(document).on('click', '#newstudent', function(){
		$('#form-result').html('');
		$('#sport-form')[0].reset();
		$('.modal-title').text('Adicionar um novo aluno');
		$('#action').val('add');
		$('#action_button').val('Adicionar');
		$('#password').attr('required', true);
		$('#formModal').modal('show');
	});

	let userID;
	$(document).on('click', '.edit', function(){
		userID = $(this).attr('id');
		$('#form-result').html('');
		$.ajax({
			url:"/admin/students/"+userID+"/edit",
			dataType:"json",
			success:function(html){
				$('#enrollment').val(html.data.enrollment);
				$('#name').val(html.data.name);
				$('#email').val(html.data.email);
				$('#password').val(html.data.password).attr('required', false);
				$('#school').val(html.data.school_name).change();
				school_class = html.data.class;
                $('#class_number').val(html.data.class_number);
				sport_class = html.data.sport_class;
				$('#sport').val(html.data.sport_id).change();
				$('#action').val('mod');
				$('#hidden_id').val(html.data.id);
				$('.modal-title').text('Modificar um aluno');
				$('#action_button').val('Modificar');
				$('#formModal').modal('show');
			}
		})
	});

	function changeClass(html){
		$('#sport_class').val(html);
	}

    function changeSchoolClass(html){
        $('#school_class').val(html);
    }

	$(document).on('click', '.delete', function(){
		userID = $(this).attr('id');
		$('#confirmDelete').text('Confirmar');
		$('#confirmModal').modal('show');
	});

	$('#confirmDelete').click(function(){
		$.ajax({
			method:'DELETE',
			url:'/admin/students/'+userID,
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
				url: '/admin/students/',
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
				url:'/admin/students/update/',
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