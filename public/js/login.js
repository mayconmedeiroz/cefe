$(document).ready(function(){
    $('.forget-pass-div').click(function(event){
        event.preventDefault();
        $('#login').addClass('d-none d-sm-none');
        $('#forget-password').removeClass('d-none d-sm-none');
    });
    $('.login-div').click(function(event){
        event.preventDefault();
        $('#forget-password').addClass('d-none d-sm-none');
        $('#register').addClass('d-none d-sm-none');
        $('#login').removeClass('d-none d-sm-none');
    });
    $('.register-div').click(function(event){
        event.preventDefault();
        $('#login').addClass('d-none d-sm-none');
        $('#forget-password').addClass('d-none d-sm-none');
        $('#register').removeClass('d-none d-sm-none');
    });
});