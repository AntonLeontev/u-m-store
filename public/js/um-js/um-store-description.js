document.addEventListener('DOMContentLoaded', () => {

    const umProductWrap = document.querySelector('.um-store-description__wrap');
    const umProductPreviewItem = document.querySelectorAll('.um-store-description-preview__img');
    const umProductImagesImg = document.querySelectorAll('.um-store-description-images__img');

    if (umProductWrap) {
        umProductWrap.addEventListener('click', (e) => {
            if (e.target.classList.contains('um-store-description-preview__img')) {
                const tabsPath = e.target.dataset.tabsPath;
                umProductPreviewItem.forEach(el => {el.classList.remove('um-store-description-preview__img--active')});
                document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('um-store-description-preview__img--active');
                tabsProductImg(tabsPath);
            }
        });
    }

    const tabsProductImg = (path) => {
        umProductImagesImg.forEach(el => {el.classList.remove('um-store-description-images__img--active')});
        document.querySelector(`[data-tabs-target="${path}"]`).classList.add('um-store-description-images__img--active');
    };

    const formUmInvestorLpPopapFb = document.querySelector('#formUmInvestorLpPopapFb')
    const umInvestorLpPopapFb = document.querySelector('.um-investor-lp-popap-fb')
    const umInvestorLpPopapSg = document.querySelector('.um-investor-lp-popap-sg')
    const umInvestorLpPopap = document.querySelectorAll('.um-investor-lp-popap')
    const umInvestorLpBtn = document.querySelector('.um-store-description-info__add-basket')
    const btnCloseJs = document.querySelectorAll('.btn-close-js')
    const body = document.body


    umInvestorLpBtn.addEventListener('click', function() {
        umInvestorLpPopapFb.classList.add('um-investor-lp-popap--active')

        body.style.overflow = "hidden"

        umInvestorLpPopapFb.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        })
    })

    btnCloseJs.forEach(function(event) {
        event.addEventListener('click', function() {
            umInvestorLpPopap.forEach(function(event) {
                event.classList.remove('um-investor-lp-popap--active')
                body.style.overflow = "visible"
            })
        })
    })


    function formUmInvestorLpPopapFbCheck() {
        if(document.querySelector('.error') === null) {
            umInvestorLpPopap.forEach(function(event) {
                event.classList.remove('um-investor-lp-popap--active')
                umInvestorLpPopapSg.classList.add('um-investor-lp-popap--active')
            })
        }
    }


    formUmInvestorLpPopapFb.addEventListener('submit', function() {
        setTimeout(() => formUmInvestorLpPopapFbCheck(), 1000)
    })

    const umStoreDescriptionEye = document.querySelectorAll('.um-store-description-eye')
    const umStoreDescriptionEyeClose = document.querySelectorAll('.um-store-description-eye__close')

    umStoreDescriptionEyeClose.forEach(function(event) {
        event.addEventListener('click', function() {
            umStoreDescriptionEye.forEach(function(event) {
                event.style.display = "none"
            })
        })
    })

})

var swiper = new Swiper(".um-store-description-slider", {
    pagination: {
        el: ".swiper-pagination",
    },
});

var swiper = new Swiper('.um-investor-lp-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
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
        },
        // when window width is >= 640px
        1240: {
            slidesPerView: 3,
            spaceBetween: 40
        }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

