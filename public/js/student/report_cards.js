$(document).ready(function () {
	$('.grade').hide();

	$(document).on('change', '#school_year', function() {
		$('.grade').fadeOut('slow');
		$('#evaluation').prop('disabled', false);
		$('#evaluation option:first').prop('selected', true);
	});

	$(document).on('change', '#evaluation', function() {
		let formData = new FormData();
		formData.append('schoolYearId', $('#school_year').val());
		formData.append('evaluationId', $('#evaluation').val());
		$.ajax({
			url: '/student/getStudentReportCard/',
			method: 'GET',
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				if (!data.grade)
					data.grade = 'Não há';

				if (!data.absences)
					data.absences = 'Não há';

				if (!data.recuperation_grade)
					data.recuperation_grade = 'Não há';

				$('#grade').text(data.grade);
				$('#absence').text(data.absences);
				$('#recuperation_grade').text(data.recuperation_grade);
				$('.grade').fadeIn('slow');
			}
		});
	});
});