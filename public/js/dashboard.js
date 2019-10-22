$(document).ready(function () {
    $('.aside-brand-aside-toggler').on('click', function (e) {
        e.preventDefault();
        $('.aside').toggleClass('toggled');
        $('body').toggleClass('aside-enabled');
        $('.toggle-open').toggleClass('toggled-open');
    });

    $('.header-mobile-toggler').on('click', function (e) {
        e.preventDefault();
        $('.aside').toggleClass('aside-on');
        $('body').toggleClass('aside-on');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
