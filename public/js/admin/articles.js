$(document).ready(function () {
	$(document).on('change', '#image', function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

    $(document).on('hidden.bs.modal', '.modal', function () {
        $('.modal:visible').length && $(document.body).addClass('modal-open');
    });

	$('#summernote').summernote({
		placeholder: 'Insira o corpo do texto',
		dialogsInBody: true,
		height: 200,
		lang: 'pt-BR',
	});
});
