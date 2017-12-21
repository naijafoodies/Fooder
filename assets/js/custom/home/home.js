$(document).ready(function() {

    // activate the main carousel

    $('.flexslider').flexslider({

        animation: "slide",
        animationLoop : true,
        slideshow: true,
        controlNav: false,

    });

    // activate menu for vendors
    $('#vendor-flex').owlCarousel({
        center:true,
        loop:false,
        margin:2,
        autoplay:false,
        autoplayHoverPause:true,
        nav:false,
        items : 2,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });

    // Activate slides for categories

    $('#category-flex').owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        nav:false,
        items : 7,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });

    // Remove text from slider navigation

    $('.flex-prev').text('');
    $('.flex-next').text('');

});



