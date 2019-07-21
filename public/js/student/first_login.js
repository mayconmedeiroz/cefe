$(document).ready(function () {
	$(document).on('submit', '#first-login-form', function(e){
		e.preventDefault();

		$.ajax({
			url: '/student/first_login/',
			method: 'POST',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				let html = '';
				if (data.errors) {
					html = '<div class="alert alert-danger">' + data.errors + '</div>';
				}
				if (data.success) {
					html = '<div class="alert alert-success">' + data.success + '</div>';
				}
				$('#form-result').html(html);
				setTimeout(function(){
					location.reload();
				}, 3000);
			}
		});
	});
});