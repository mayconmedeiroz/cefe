$(document).ready(function () {
	$('#list').DataTable({
		processing: true,
		serverSide: true,
		autoWidth: false,
		ajax: {
			url: '/teacher/sport_classes/getData',
			type: 'POST'
		},
		lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos'] ],
		columns: [
			{data: 'id', name: 'id'},
			{data: 'sport_name', name: 'sport_name'},
			{data: 'name', name: 'name'},
			{data: 'sport_time', name: 'sport_time'},
			{data: 'vacancies', name: 'vacancies'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
		],
		dom:
			 "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
			 "<'row'<'col-sm-12'tr>>" +
			 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
		buttons: [],
		select: {
			selector: 'td:not(:last-child)'
		},
		language: {
			url: '/js/portuguese.datatable.json'
		}
	});
});