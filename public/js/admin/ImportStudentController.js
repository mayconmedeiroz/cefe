class ImportStudentController {
    "use strict";

	constructor(userLevel) {
		this.loadSearch();
		this.onSubmit(userLevel);
		this.onChangeEvents(userLevel);
	}

	loadSearch() {
		$(document).on('change', '#import_students', function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	}

	onSubmit(userLevel) {
		$(document).on('submit', '#import_form', function(e){

			e.preventDefault();

			let formData = new FormData(this);
			formData.append('school_year', $('#school_year').val());
			formData.append('school', $('#school').val());

			let html = '<div class="alert alert-warning">Enviando, não saia da página!<br/>Este processo pode demorar mais de um minuto.</div>';

			$('#form-result').html(html);

			$.ajax({
				url: `/${userLevel}/import_students`,
				method: 'POST',
				data: formData,
				contentType: false,
				cache: false,
				processData: false,
				dataType: "json",
				success: function (data) {
                    let html = `<div class="alert alert-${(data.error) ? 'danger' : 'success'}">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <p>${data.messages}</p>
                        </div>`;

					$('#form-result').html(html);
				}
			});
		});
	}

	onChangeEvents(userLevel) {
		if (userLevel === 'admin') {
			$(document).on('change', '#school', function() {
				$('.import-row').fadeIn('slow');
			});
		}

		$(document).on('change', '#school_year', () => {
			if (userLevel === 'admin') {
				$('.import-row').fadeOut('slow');
				$('#school').prop('disabled', false);
				$('#school_class').prop('disabled', true);
				$('#school option:first').prop('selected', true);
			} else {
				$('.import-row').fadeIn('slow');
			}
		});
	}
}
