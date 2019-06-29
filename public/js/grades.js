$(document).ready(function () {

	let sport_class;

	$(document).on('change', '#sport', function() {
		let sportId = $(this).val();
		if(sportId) {
			$.ajax({
				url: '/grades/getSportClasses/'+sportId,
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

	$(document).on('change', '#sport_class', function() {
		$('#evaluation').removeAttr("disabled");
	} );

	$(document).on('change', '#evaluation', function() {
		$('.list-div').removeClass("d-none");
		let sportclass = $('#sport_class').val();
		let evaluation = $(this).val();
		$('#list').DataTable({
			processing: true,
			serverSide: true,
			autoWidth: false,
			ajax: {
				url: `/grades/getData/${sportclass}/${evaluation}`,
				type: 'POST'
			},
			lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
			columns: [
				{data: "id", name: "id"},
				{data: "name", name: "name"},
				{data: "attendance", name: "attendance"},
				{data: "grade", name: "grade"},
				{data: "recuperation", name: "recuperation"},
			],
			dom: "<'row'<'col-sm-12 mb-3'B>>" +
				"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				{
					text: '<i class="fas fa-plus"></i> Salvar',
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
		let array=[];
		$('#list').find('tbody tr').each(function(){
			let obj={};
			obj.id=$(this).find("td:eq(0)").text();
			obj.name=$(this).find("td:eq(1)").text();
			obj.attendance=$(this).find("td:eq(2) input").val();
			obj.grade=$(this).find("td:eq(3) input").val();
			obj.recuperation_grade=$(this).find("td:eq(4) input").val();

			array.push(obj);
		});
		console.log(JSON.stringify(array));
	});
});