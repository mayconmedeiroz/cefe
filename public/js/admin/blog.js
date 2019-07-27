$(document).ready(function () {
	$('#list').DataTable({
		processing: true,
		serverSide: true,
		autoWidth: false,
		ajax: {
			url: '/admin/blog/getData',
			type: 'POST'
		},
		lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
		columns: [
			{data: 'id', name: 'id'},
			{data: 'title', name: 'title'},
			{data: 'user.name', name: 'user.name'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
		],
		dom: "<'row'<'col-sm-12 mb-3'B>>" +
			 "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
			 "<'row'<'col-sm-12'tr>>" +
			 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		buttons: [
			{
				text: '<i class="fas fa-plus"></i> Novo Post',
				attr: {
					id: 'newpost'
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

	$('#summernote').summernote({
		placeholder: 'Insira o corpo do texto',
		dialogsInBody: true,
		height: 400,
		popover: {
			image: [
				['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
				['float', ['floatLeft', 'floatRight', 'floatNone']],
				['remove', ['removeMedia']]
			],
			link: [
				['link', ['linkDialogShow', 'unlink']]
			],
			table: [
				['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
				['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
			],
			air: [
				['color', ['color']],
				['font', ['bold', 'underline', 'clear']],
				['para', ['ul', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'picture']]
			]
		},
		lang: 'pt-BR',
		callbacks: {
			onImageUpload: function(files) {
				console.log(files.length);
				for (let i = files.length -1; i >=0; i--) {
					let formData = new FormData();
					formData.append('image', files[i]);
					$.ajax({
						url: '/admin/blog/uploadImage',
						method: 'POST',
						data: formData,
						contentType: false,
						cache: false,
						processData: false,
						success: function (data) {
							$('#summernote').summernote('editor.insertImage', `/storage/posts/${data}`);
						}
					});
				}
			}
		},
	});

    $(document).on('click', '#newpost', function(){
		$('#form-result').html('');
		$('#post-form')[0].reset();
		$('#summernote').summernote('code', '');
		$('.modal-title').text('Adicionar uma nova postagem');
		$('#action_button').val('Adicionar');
		$('#formModal').modal('show');
	});

	let blogID;

	$(document).on('click', '.edit', function(){
		blogID = $(this).attr('id');
		$('#form-result').html('');
		$.ajax({
			url:"/admin/blog/"+blogID+"/edit",
			dataType:"json",
			success:function(data){
				$('#title').val(data.title);
				$('#hidden_id').val(data.id);
				$('#summernote').summernote('code', data.body);
				$('.modal-title').text('Modificar uma postagem');
				$('#action_button').val('Modificar');
				$('#formModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		blogID = $(this).attr('id');
		$('#confirmDelete').text('Confirmar');
		$('#confirmModal').modal('show');
	});

	$('#confirmDelete').click(function(){
		$.ajax({
			method:'DELETE',
			url:'/admin/blog/'+blogID,
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

	$('#post-form').on('submit', function(e) {
		e.preventDefault();
		let formData = new FormData(this);
		formData.append('body', $('#summernote').summernote('code'));

		if ($('#action_button').val() === 'Adicionar') {
			$.ajax({
				url: '/admin/blog/',
				method: 'POST',
				data: formData,
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
						$('#post-form')[0].reset();
					}
					$('#form-result').html(html);
				}
			});
		}

		if($('#action_button').val() === "Modificar") {
			$.ajax({
				url:'/admin/blog/update/',
				method: 'POST',
				data: formData,
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
					}
					$('#form-result').html(html);
				}
			});
		}
	});
});