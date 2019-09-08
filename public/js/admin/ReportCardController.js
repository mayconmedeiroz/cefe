class ReportCardController {

	constructor(userLevel) {
		this.onChangeEvents(userLevel);
	}

	onChangeEvents(userLevel) {
		$(document).on('change', '#school_year', function() {
			$('#school').change().prop('disabled', false);
			$('.export-row').fadeOut('slow');
			$('#school_class, #evaluation').prop('disabled', true);
			$('#school option:first, #school_class option:first, #evaluation option:first').prop('selected', true);
		});

		$(document).on('change', '#school', function() {
			let schoolId = $(this).val();
			if(schoolId) {
				$.ajax({
					url: `/${userLevel}/report_cards/getSchoolClasses/${schoolId}`,
					type: 'GET',
					success:function(data) {
						console.log(data);
						$('#school_class').empty().append('<option value="" disabled selected hidden>Escolha a Turma:</option><option value="0">Todas as Turmas</option>').removeAttr("disabled");
						$.each(data, function(key, value){
							$('#school_class').append(`<option value="${value.id}">${value.class}</option>`);
						});
						$('.export-row').fadeOut('slow');
					}
				});
			}
		});

		$(document).on('change', '#school_class', function() {
			$('#evaluation').prop('disabled', false);
			$('#evaluation option:first').prop('selected', true);
			$('.export-row').fadeOut('slow');
		});
	
		$(document).on('change', '#evaluation', function() {
			let school_year = $('#school_year').val();
			let school = $('#school').val();
			let school_class = $('#school_class').val();
			let evaluation = $('#evaluation').val();
			$('.export-button').attr('href', `/${userLevel}/report_cards/export/${school_year}/${school}/${school_class}/${evaluation}`);
			$('.export-row').fadeIn('slow');
		});
	}


}
