document.addEventListener('DOMContentLoaded', () => {
    const umdpSection = document.querySelector('.umdp-section');
    const umdpBtn = document.querySelectorAll('.umdp-menu__btn');
    const blockContent = document.querySelectorAll('.umdp-section__content');

    const umdpMenuBtn = document.querySelector('.umdp-button-menu')
    const umdpMenuBlock = document.querySelector('.umdp-menu')


    if (umdpSection) {
        umdpSection.addEventListener('click', (e) => {
            if (e.target.classList.contains('umdp-menu__btn')) {
                const tabsPath = e.target.dataset.tabsPath;
                umdpBtn.forEach(el => {el.classList.remove('umdp-menu__btn--active')});
                document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('umdp-menu__btn--active');
                tabsUmdpHandler(tabsPath);
            }
        });
    }

    const tabsUmdpHandler = (path) => {
        blockContent.forEach(el => {el.classList.remove('umdp-section__content--active')});
        document.querySelector(`[data-tabs-target="${path}"]`).classList.add('umdp-section__content--active');
        document.querySelector('.umdp-section__text').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        })
    };

    umdpMenuBtn.addEventListener('click', function() {
        umdpMenuBlock.classList.toggle('umdp-menu--active')
    })


    const umdpMenuBtnList = document.querySelector('.umdp-menu__btn:nth-child(1)');
    const umdpMenuList = document.querySelector('.umdp-menu__list');
    const umdpMenuIconUmArrow = document.querySelector('.icon-um-arrow');


    umdpMenuBtnList.addEventListener('click', function() {
        umdpMenuBtnList.classList.toggle('umdp-menu__main-btn--active')
        umdpMenuList.classList.toggle('umdp-menu__list--active')
        umdpMenuIconUmArrow.classList.toggle('icon-um-arrow--active')
    })

    umdpMenuIconUmArrow.addEventListener('click', function() {
        umdpMenuBtnList.classList.toggle('umdp-menu__main-btn--active')
        umdpMenuList.classList.toggle('umdp-menu__list--active')
        umdpMenuIconUmArrow.classList.toggle('icon-um-arrow--active')
    })

    const umdpMenuBtnClose = document.querySelector('.umdp-menu__btn-close');

    umdpMenuBtnClose.addEventListener('click', function() {
        umdpMenuBlock.classList.toggle('umdp-menu--active')
    })
})