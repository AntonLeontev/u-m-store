document.addEventListener('DOMContentLoaded', () => {

    
    const franchisePopupP = document.querySelector('.franchise-um-popup-p');
    const franchisePopupGp = document.querySelector('.franchise-um-popup-gp');

    const franchisePopup = document.querySelectorAll('.franchise-um-popup');
    const franchisePopupBtn = document.querySelectorAll('.franchise-um-popup__item-menu');
    const franchisePopupForm = document.querySelectorAll('.franchise-um-popup__form');

    const popupLink = document.querySelectorAll('.franchise-um-popup__link')
    const popupNext = document.querySelector('.franchise-um-popup__btn-next');
    const popupMain = document.querySelector('.franchise-um-popup-main');
    const btnClose = document.querySelectorAll('.franchise-um-popup__close');
    const btnOpenPopup = document.querySelectorAll('.um-js-get-popup')


    if (franchisePopupP) {
        franchisePopupP.addEventListener('click', (e) => {
            if (e.target.classList.contains('franchise-um-popup__item-menu')) {
                const tabsPath = e.target.dataset.tabsPath;
                franchisePopupBtn.forEach(el => {el.classList.remove('franchise-um-popup__item-menu--active')});
                document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('franchise-um-popup__item-menu--active');
                tabsUmdpHandler(tabsPath);
            }
        });
    }
    
    const tabsUmdpHandler = (path) => {
        franchisePopupForm.forEach(el => {el.classList.remove('franchise-um-popup__form--active')});
        document.querySelector(`[data-tabs-target="${path}"]`).classList.add('franchise-um-popup__form--active');
    };

    popupLink.forEach(function(event) {
        event.addEventListener('click', function(event) {

            popupLink.forEach(function(event) {
                event.classList.remove('franchise-um-popup__link--active')
            })

            this.classList.add('franchise-um-popup__link--active')
        })
    })

    popupNext.addEventListener('click', function() {
        popupMain.classList.remove('franchise-um-popup--active')
        popupLink.forEach(function(event) {
            if(event.matches('.franchise-um-popup__link--active')) {
                if(event.innerHTML === "Партнер") {
                    franchisePopupP.classList.add('franchise-um-popup--active')
                } else {
                    franchisePopupGp.classList.add('franchise-um-popup--active')
                }
            }
        })
    })

    btnClose.forEach(function(event) {
        event.addEventListener('click', function(event) {
            franchisePopup.forEach(function(event) {
                event.classList.remove('franchise-um-popup--active')
            })
        })
    })

    btnOpenPopup.forEach(function(event) {
        event.addEventListener('click', function(event) {
            popupMain.classList.add('franchise-um-popup--active')

            popupMain.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            })
        })
    })


    const franchiseCommission = document.querySelector('.franchise-um-commission');
    const franchiseCommissionBtn = document.querySelectorAll('.franchise-um-commission__link');
    const franchiseCommissionContent = document.querySelectorAll('.franchise-um-commission__content');


    if (franchiseCommission) {
        franchiseCommission.addEventListener('click', (e) => {
            if (e.target.classList.contains('franchise-um-commission__link')) {
                const tabsPath = e.target.dataset.tabsPath;
                franchiseCommissionBtn.forEach(el => {el.classList.remove('franchise-um-commission__link--active')});
                document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('franchise-um-commission__link--active');
                tabsCommissionHandler(tabsPath);
            }
        });
    }
    


    const tabsCommissionHandler = (path) => {
        franchiseCommissionContent.forEach(el => {el.classList.remove('franchise-um-commission__content--active')});
        document.querySelector(`[data-tabs-target="${path}"]`).classList.add('franchise-um-commission__content--active');
    };

    const franchiseUmPopupForm = document.querySelectorAll('.franchise-um-popup form')
    const franchiseUmPopupBtnSend = document.querySelectorAll('.franchise-um-popup__btn-send')
    const franchiseUmPopupSendgood = document.querySelector('.franchise-um-popup__sendgood')

    function franchiseUmPopupFormCheck() {
        if(document.querySelector('.error') === null) {
            franchisePopup.forEach(function(event) {
                event.classList.remove('franchise-um-popup--active')
                franchiseUmPopupSendgood.classList.add('franchise-um-popup--active')
            })
        }
    }


    franchiseUmPopupForm.forEach(function(event) {
        event.addEventListener('submit', function(event) {
            setTimeout(() => franchiseUmPopupFormCheck(), 1000)
        })
    })


})