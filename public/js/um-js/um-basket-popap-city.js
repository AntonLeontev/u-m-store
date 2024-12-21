document.addEventListener('DOMContentLoaded', () => {

    const umBasketPopapCity = document.querySelector('.um-basket-popap-city');
    const umBasketPopapCityClose = document.querySelector('.um-basket-popap-city__close');
    const umBasketPopapCityBtnYes = document.querySelector('.um-basket-popap-city__btn-yes');
    const umBasketPopapCityBtnNo = document.querySelector('.um-basket-popap-city__btn-no');
    const umBasketPopapCityList = document.querySelector('.city');
    
    umBasketPopapCity.classList.add('um-basket-popap-city--active')
    umBasketPopapCityClose.addEventListener('click', function() {
        umBasketPopapCity.classList.remove('um-basket-popap-city--active')
    })


    umBasketPopapCityBtnYes.addEventListener('click', function() {
        umBasketPopapCity.classList.remove('um-basket-popap-city--active')
    })

    umBasketPopapCityBtnNo.addEventListener('click', function() {
        umBasketPopapCity.classList.remove('um-basket-popap-city--active')
        umBasketPopapCityList.style="display: block;"
    })


});

