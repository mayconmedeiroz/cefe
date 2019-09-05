$(document).ready(function () {
	$('#summernote').summernote({
		placeholder: 'Insira o corpo do texto',
		dialogsInBody: true,
		height: 400,
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
});
