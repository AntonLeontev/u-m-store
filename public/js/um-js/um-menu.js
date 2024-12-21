document.addEventListener('DOMContentLoaded', () => {
    const itemServicesGoods = document.querySelector('.um-menu__item:nth-child(2)');
    const listServicesGoods = document.querySelector('.um-menu__services-goods');
    const itemServicesGoodsIcon = document.querySelector('.icon-um-arrow');
    const buttonMenu = document.querySelector('.um-button-menu');
    const menuBlock =  document.querySelector('.um-menu');

    itemServicesGoods.addEventListener('click', function() {
        listServicesGoods.classList.toggle('um-menu__services-goods--active')
        itemServicesGoodsIcon.classList.toggle('icon-um-arrow--active')
    })

    buttonMenu.addEventListener('click', function() {
        menuBlock.classList.toggle('um-menu--active')
    })


})