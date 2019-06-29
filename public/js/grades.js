$(document).ready(function () {

	let sport_class;

	$(document).on('change', '#sport', function() {
		let sportId = $(this).val();
		if(sportId) {
			$.ajax({
				url: '/grades/getSportClasses/'+sportId,
				type: 'GET',
				success:function(data) {
					$('#sport_class').empty().append('<option value="" disabled selected hidden>Escolha uma Turma:</option>');
					$.each(data, function(key, value){
						$('#sport_class').append(`<option value="${value.id}">${value.name}</option>`);
					});
					$('.list-div').addClass("d-none");
					$('#sport_class').removeAttr("disabled");
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
	} );

	$(document).on('change', '#evaluation', function() {
		$('.list-div').removeClass("d-none");
		let sportclass = $('#sport_class').val();
		let evaluation = $(this).val();
		$('#list').DataTable().clear().destroy();
		$('#list').DataTable({
			processing: true,
			serverSide: true,
			autoWidth: false,
			pageLength: -1,
			ajax: {
				url: `/grades/getData/${sportclass}/${evaluation}`,
				type: 'POST'
			},
			columns: [
				{data: "id", name: "id"},
				{data: "name", name: "name"},
				{data: "attendance", name: "attendance"},
				{data: "grade", name: "grade"},
				{data: "recuperation", name: "recuperation"},
			],
			dom: "<'row'<'col-sm-12 mb-3'B>>" +
				"<'row'<'col-sm-12'tr>>",
			buttons: [
				{
					text: '<i class="fas fa-plus"></i> Salvar Notas',
					attr: {
						id: 'savebutton'
					}
				}
			],
			language: {
				url: '/js/portuguese.datatable.json'
			}
		});
	});

	$(document).on('click', '#savebutton', function(){
		$('#list').find('tbody tr').each(function(){
			let obj={};
			obj.id=$(this).find("td:eq(0)").text();
			obj.attendance=$(this).find("td:eq(2) input").val();
			obj.grade=$(this).find("td:eq(3) input").val();
			obj.recuperation_grade=$(this).find("td:eq(4) input").val();
			obj.evaluation=$('#evaluation').val();

			$.ajax({
				data: obj,
				url: '/grades/',
				type: 'POST',
				success:function(data) {
					console.log(data);
					console.log(obj);
					let html = '';
					if(data.errors) {
						html = '<div class="alert alert-danger">' + data.errors + '</div>';
					}
					if(data.success) {
						html = '<div class="alert alert-success">' + data.success + '</div>';
					}
					$('.form-result').html(html);
				}
			});
		});
		$('#list').DataTable().ajax.reload();
	});
});