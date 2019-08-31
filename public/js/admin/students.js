$(document).ready(function () {

	function changeClass(html){
		$('#sport_class').val(html);
	}

	function changeSchoolClass(html){
		$('#school_class').val(html);
	}

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
});
