AOS.init({
    duration: 800,
    easing: 'slide',
    once: !0
});
jQuery(document).ready(function($) {
    "use strict";
    let loader = function() {
        setTimeout(function() {
            if ($('#loader').length > 0) {
                $('#loader').removeClass('show')
            }
        }, 1)
    };
    loader();
    let siteMenuClone = function() {
        $('.js-clone-nav').each(function() {
            $(this).clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body')
        });
        setTimeout(function() {
            let counter = 0;
            $('.site-mobile-menu .has-children').each(function() {
                $(this).prepend('<span class="arrow-collapse collapsed">');
                $(this).find('.arrow-collapse').attr({
                    'data-toggle': 'collapse',
                    'data-target': '#collapseItem' + counter,
                });
                $(this).find('> ul').attr({
                    'class': 'collapse',
                    'id': 'collapseItem' + counter,
                });
                counter++
            })
        }, 1000);
        $('body').on('click', '.arrow-collapse', function(e) {
            let $this = $(this);
            if ($this.closest('li').find('.collapse').hasClass('show')) {
                $this.removeClass('active')
            } else {
                $this.addClass('active')
            }
            e.preventDefault()
        });
        $(window).resize(function() {
            let $this = $(this),
                w = $this.width();
            if (w > 768) {
                if ($('body').hasClass('offcanvas-menu')) {
                    $('body').removeClass('offcanvas-menu')
                }
            }
        });
        $('body').on('click', '.js-menu-toggle', function(e) {
            let $this = $(this);
            e.preventDefault();
            if ($('body').hasClass('offcanvas-menu')) {
                $('body').removeClass('offcanvas-menu');
                $this.removeClass('active')
            } else {
                $('body').addClass('offcanvas-menu');
                $this.addClass('active')
            }
        });
        $(document).mouseup(function(e) {
            let container = $(".site-mobile-menu");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('body').hasClass('offcanvas-menu')) {
                    $('body').removeClass('offcanvas-menu')
                }
            }
        })
    };
    siteMenuClone();
    let siteCarousel = function() {
        if ($('.hero-slide').length > 0) {
            $('.hero-slide').owlCarousel({
                items: 1,
                loop: !0,
                margin: 0,
                autoplay: !0,
                nav: !0,
                dots: !0,
                navText: ['<span class="fas fa-arrow-left">', '<span class="fas fa-arrow-right">'],
                smartSpeed: 1000
            })
        }
        if ($('.owl-slide-3').length > 0) {
            $('.owl-slide-3').owlCarousel({
                center: !1,
                items: 1,
                loop: !0,
                stagePadding: 10,
                margin: 30,
                autoplay: !0,
                smartSpeed: 500,
                nav: !0,
                dots: !0,
                navText: ['<span class="fas fa-arrow-left">', '<span class="fas fa-arrow-right">'],
                responsive: {
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    }
                }
            })
        }
    };
    siteCarousel();
    let siteSticky = function() {
        $(".js-sticky-header").sticky({
            topSpacing: 0
        })
    };
    siteSticky();
    let siteScroll = function() {
        $(window).scroll(function() {
            let st = $(this).scrollTop();
            if (st > 100) {
                $('.js-sticky-header').addClass('shrink')
            } else {
                $('.js-sticky-header').removeClass('shrink')
            }
        })
    };
    siteScroll()
})