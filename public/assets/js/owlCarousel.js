$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 4000,  // ⏱ Delay between slides (4 sec)
        autoplaySpeed: 800,     // 🎞 Speed of slide transition during autoplay
        smartSpeed: 800,        // 🎞 General speed (for nav arrows, drag, etc.)
        responsive: {
            0: { items: 1 },
            576: { items: 2 },
            768: { items: 3 },
            992: { items: 4 }
        }
    });
});
