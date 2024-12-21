var swiper = new Swiper(".mySwiper", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
            spaceBetween: 20
        },
        // when window width is >= 480px
        768: {
            slidesPerView: 2,
            spaceBetween: 30
        }
    },
});


document.querySelector('.menu-burger').addEventListener('click', ()=> {
    document.querySelector('.main-menu').classList.toggle('main-menu--active');
    document.querySelector('.menu-burger').classList.toggle('menu-burger--active');
    document.body.classList.toggle('overflow--active');
    console.log(window.innerWidth);
    
});