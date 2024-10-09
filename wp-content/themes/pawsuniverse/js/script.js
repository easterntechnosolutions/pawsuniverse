jQuery(document).ready(function($) {
    // var swiper = new Swiper('.swiper-container', {
    //     loop: true,
    //     effect: 'slide', // Optional: You can also try 'fade' effect
    //     autoplay: {
    //         delay: 5000,
    //         disableOnInteraction: false,
    //     },
    //     pagination: {
    //         el: '.swiper-pagination',
    //         clickable: true,
    //     },
    //     navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     },
    // });

    var veterinary_swiper = new Swiper('.veterinary-swiper-container', {
        slidesPerView: 2,
        loop: true,
        loopAdditionalSlides: 1,
        effect: 'slide', // Optional: You can also try 'fade' effect
        autoplay: {
            delay: 2000,
            disableOnInteraction: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        }
    });

    
    // var veterinary_swiper = new Swiper('.veterinary-swiper-container', {
    //     slidesPerView: 1,
    //     spaceBetween: 10,
    //     loop: true,
    //     effect: 'slide', // Optional: You can also try 'fade' effect
    //     autoplay: {
    //         delay: 5000,
    //         disableOnInteraction: false,
    //     },
    //     pagination: {
    //         el: '.swiper-pagination',
    //         clickable: true,
    //     },
    //     navigation: {
    //         nextEl: '.swiper-button-next',
    //         prevEl: '.swiper-button-prev',
    //     },
    //     breakpoints: {
    //         640: {
    //             slidesPerView: 2,
    //             spaceBetween: 20,
    //         },
    //         768: {
    //             slidesPerView: 3,
    //             spaceBetween: 30,
    //         },
    //         1024: {
    //             slidesPerView: 4,
    //             spaceBetween: 40,
    //         },
    //     }
    // });
});