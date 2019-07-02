$(document).ready(function () {
	$(document).on('change', '#sport', function() {
		let sportId = $(this).val();
		if(sportId) {
			$.ajax({
				url: '/grades/getSportClasses/'+sportId,
				type: 'GET',
				success:function(data) {
					$('#sport_class').empty().append('<option value="" disabled selected hidden>Escolha a Turma:</option>').removeAttr("disabled");
					$.each(data, function(key, value){
						$('#sport_class').append(`<option value="${value.id}">${value.name}</option>`);
					});
					$('.list-div').addClass("d-none");
					$('#evaluation option:first').prop('selected', true);
					$('#evaluation').attr('disabled', true);
				}
			});
		}
	});

	$(document).on('change', '#sport_class', function() {
		$('.list-div').addClass("d-none");
		$('#evaluation option:first').prop('selected', true);
		$('#evaluation').removeAttr("disabled");
	});

	let attendance, recuperation;

	$(document).on('change', '#evaluation', async function () {
		let sportClass = $('#sport_class').val();
		let evaluation = $(this).val();

		await $.ajax({
			url: '/grades/getEvaluationColumns/'+evaluation,
			type: 'GET',
			success: function(data) {
				attendance = data.attendance;
				recuperation = data.recuperation;
			}
		});

		let columns = [
			{data: "id", name: "id"},
			{data: "name", name: "name"},
			{data: "grade", name: "grade"},
		];

		if (attendance) {
			columns.splice(2, 0, {data: "attendance", name: "attendance"});
			$('thead th:eq(2)').removeClass('d-none');
		} else {
			$('thead th:eq(2)').addClass('d-none');
		}

		if (recuperation) {
			columns.push({data: "recuperation", name: "recuperation"});
			$('thead th:eq(4)').removeClass('d-none');
		} else {
			$('thead th:eq(4)').addClass('d-none');
		}

		$('#list').DataTable().clear().destroy();
		await $('#list').DataTable({
			processing: true,
			serverSide: true,
			autoWidth: false,
			pageLength: -1,
			ajax: {
				url: `/grades/getData/${sportClass}/${evaluation}`,
				type: 'POST',
			},
			drawCallback: function() {
				$('.grade, .recuperation').inputmask({
					alias: "decimal",
					rightAlign: false,
					placeholder: "0",
					digits: 2,
					min:0,
					max:10,
					digitsOptional: false,
					radixPoint: ",",
					allowPlus: false,
					allowMinus: false,
					clearMaskOnLostFocus: false,
					autoUnmask: true,
					onUnMask: function(maskedValue, unmaskedValue) {
						if (unmaskedValue != '') {
							let x = maskedValue.split(',');
							return x[0] + '.' + x[1];
						}
					}
				});
				$('.attendance').inputmask({
					alias: 'decimal',
					rightAlign: false,
					placeholder: "0",
					digits: 2,
					min:0,
					max:100,
					digitsOptional: false,
					radixPoint: ",",
					allowPlus: false,
					allowMinus: false,
					clearMaskOnLostFocus: false,
					autoUnmask: true,
					suffix: "%",
					onUnMask: function(maskedValue, unmaskedValue) {
						if (unmaskedValue != '') {
							let x = maskedValue.slice(0,-1).split(',');
							return x[0] + '.' + x[1];
						}
					}
				});
			},
			columns: columns,
			dom: "<'row'<'col-sm-12'tr>>",
			buttons: [],
			language: {
				url: '/js/portuguese.datatable.json'
			}
		});
		$('.list-div').removeClass("d-none");
	});

	$('#form-grade').on('submit', function(e) {
		e.preventDefault();
		$('#list').find('tbody tr').each(function(){
			let obj={}, attendanceTd, gradeTd, recuperationTd;
			obj.id=$(this).find("td:eq(0)").text();
			obj.evaluation=$('#evaluation').val();

			if (attendance && recuperation) {
				attendanceTd = 2;
				gradeTd = 3;
				recuperationTd = 4;
			} else {
				if (attendance) {
					attendanceTd = 2;
					gradeTd = 3;
				} else if (recuperation) {
					gradeTd = 2;
					recuperationTd = 3;
				} else {
					gradeTd = 2;
				}
			}

			obj.attendance=$(this).find(`td:eq(${attendanceTd}) input`).val();
			obj.grade=$(this).find(`td:eq(${gradeTd}) input`).val();
			obj.recuperation_grade=$(this).find(`td:eq(${recuperationTd}) input`).val();

			 $.ajax({
				data: obj,
				url: '/grades/',
				type: 'POST',
				success:function(data) {

				}
			});
		});
		$('#list').DataTable().ajax.reload();
	});

	$(document).on('change', '.grade', function() {
		let nextTd = $(this).parent().next().children('input');

		if($(this).val() < 6 && $(this).val() !== '') {
			$(nextTd).prop('disabled', false);
		} else {
			$(nextTd).prop('disabled', true);
		}
	});
});