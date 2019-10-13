$(document).ready(function () {
	$(document).on('change', '#image', function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
	
	
	$('#summernote').summernote({
		placeholder: 'Insira o corpo do texto',
		dialogsInBody: true,
		height: 200,
		lang: 'pt-BR',
	});
});
