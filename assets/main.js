/* eslint-disable */
jQuery(document).ready(function(){
    (function ($) {
    //listing slider
    $("#listing-carousel .all-listings-carousel").owlCarousel({
        items: 1,
        nav: true,
        navText: [
        '<span class="la la-angle-left"></span>',
        '<span class="la la-angle-right"></span>',
        ],
        dots: false,
        margin: 30,
        responsive: {
        0: {
            items: 1,
        },
        400: {
            items: 1,
        },
        575: {
            items: 1,
        },
        767: {
            items: 2,
        },
        991: {
            items: 3,
        },
        },
    });

    /*
        wp.editor.initialize("custom-textarea-2", {
            tinymce: true,
            quicktags: true
        });
    */

    //Trigger responsive menu from settings value
    const navCollapse = Number(responsiveObj.width);
    const windowWidth = window.innerWidth;
    if(navCollapse >= windowWidth){
        document.querySelector('body').classList.add('trigger-res-nav');
    }

    })(jQuery);
});