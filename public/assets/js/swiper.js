new Swiper('.mySwiper', {
    slidesPerView: 5,
    slidesPerGroup: 1,
    spaceBetween: 30,
    loop: true,
    speed: 800,
    autoplay: {
        delay: 3000, // ⏱ move every 3 seconds
        disableOnInteraction: false, // ✅ keeps autoplay active
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        320: { slidesPerView: 1 },
        640: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 },
        1280: { slidesPerView: 5 }
    }
});
