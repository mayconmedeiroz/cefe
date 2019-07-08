$(document).ready(function () {

	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	$('.import-row').hide();

	$(document).on('change', '#school_year', function() {
		$('#school').prop('disabled', false);
		$('.import-row').fadeOut('slow');
		$('#school_class').prop('disabled', true);
		$('#school option:first').prop('selected', true);
	});

	$(document).on('change', '#school', function() {
		$('.import-row').fadeIn('slow');
	});

	$(document).on('submit', '#import_form', function(e){
		e.preventDefault();
		let formData = new FormData(this);
		formData.append('school_year', $('#school_year').val());
		formData.append('school', $('#school').val());

		$.ajax({
			url: '/admin/import_students/',
			method: 'POST',
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			beforeSend: function () {
				let html = '<div class="alert alert-warning">Enviando, NÃO SAIA DESSA PÁGINA!</div>';
				$('#form-result').html(html);
			},
			success: function (data) {
				let html = '';
				if (data.errors) {
					html = '<div class="alert alert-danger">' + data.errors + '</div>';
				}
				if (data.success) {
					html = '<div class="alert alert-success">' + data.success + '</div>';
				}
				$('#form-result').html(html);
			}
		});
	});
});