$(document).ready(function () {
    $('.aside-brand-aside-toggler').on('click', function (e) {
        e.preventDefault();
        $('.aside').toggleClass('toggled');
        $('body').toggleClass('aside-enabled');
        $('.toggle-open').toggleClass('toggled-open');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
