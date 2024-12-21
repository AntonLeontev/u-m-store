document.addEventListener('DOMContentLoaded', () => {

    const umInvestorLp = document.querySelector('.um-investor-lp-features__list');
    const umInvestorLpFeaturesItemBtn = document.querySelectorAll('.um-investor-lp-features__item-btn');
    const umInvestorLpFeaturesItemBtnI = document.querySelectorAll('.um-investor-lp-features__item-btn i');
    const umInvestorLpFeaturesItemContent = document.querySelectorAll('.um-investor-lp-features__item-content');

    if (umInvestorLp) {
        umInvestorLp.addEventListener('click', (e) => {
            if (e.target.classList.contains('um-investor-lp-features__item-btn')) {
                const tabsPath = e.target.dataset.tabsPath;
                umInvestorLpFeaturesItemBtn.forEach(el => {el.classList.remove('um-investor-lp-features__item-btn--active')});
                document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('um-investor-lp-features__item-btn--active');
                umInvestorLpFeaturesHandler(tabsPath);
            }
            if (e.target.classList.contains('icon-um-arrow-part')) {
                const tabsPath = e.target.dataset.tabsPath;
                umInvestorLpFeaturesItemBtn.forEach(el => {el.classList.remove('um-investor-lp-features__item-btn--active')});
                document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('um-investor-lp-features__item-btn--active');
                umInvestorLpFeaturesHandler(tabsPath);
            }
        });
    }
    
    const umInvestorLpFeaturesHandler = (path) => {
        umInvestorLpFeaturesItemContent.forEach(el => {el.classList.remove('um-investor-lp-features__item-content--active')});
        document.querySelector(`[data-tabs-target="${path}"]`).classList.add('um-investor-lp-features__item-content--active');
    };







    const formUmInvestorLpPopapFb = document.querySelector('#formUmInvestorLpPopapFb')
    const umInvestorLpPopapFb = document.querySelector('.um-investor-lp-popap-fb')
    const umInvestorLpPopapSg = document.querySelector('.um-investor-lp-popap-sg')
    const umInvestorLpPopap = document.querySelectorAll('.um-investor-lp-popap')
    const umInvestorLpBtn = document.querySelectorAll('.um-investor-lp-btn')
    const btnCloseJs = document.querySelectorAll('.btn-close-js')
    const body = document.body

    umInvestorLpBtn.forEach(function(event) {
        event.addEventListener('click', function() {
            umInvestorLpPopapFb.classList.add('um-investor-lp-popap--active')

            body.style.overflow = "hidden"

            umInvestorLpPopapFb.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            })
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


    const swiper = new Swiper('.um-investor-lp-swiper', {
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

});