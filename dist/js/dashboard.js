$(document).ready(function () {
    $('.sidebar-toggle').on('click', function (e) {
        e.preventDefault();
        $('.sidebar').toggleClass('toggled');
    });

    $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
    });
});