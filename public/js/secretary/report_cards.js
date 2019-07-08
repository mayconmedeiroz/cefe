$(document).ready(function () {
	$('.export-row').hide();

	$(document).on('change', '#school_year', function() {
		$('.export-row').fadeOut('slow');
		$('#school_class, #evaluation').prop('disabled', true);
		$('#school_class option:first, #evaluation option:first').prop('selected', true);
		let schoolId = $('#school').val();
		if(schoolId) {
			$.ajax({
				url: '/secretary/report_cards/getSchoolClasses/'+schoolId,
				type: 'GET',
				success:function(data) {
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
		$('.export-button').attr('href', `/secretary/report_cards/export/${school_year}/${school}/${school_class}/${evaluation}`);
		$('.export-row').fadeIn('slow');
	});
});