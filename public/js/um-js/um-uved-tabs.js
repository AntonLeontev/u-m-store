new AirDatepicker('#airdatepicker-um-uved-tabs', {});

document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelector('.um-uved-tabs');
    const tabsBtn = document.querySelectorAll('.um-uved-tabs__tab-btn');
    const tabsContent = document.querySelectorAll('.um-uved-tabs__content');
    
    const btnPopup = document.querySelectorAll('.um-uved-btn-popup');
    const popupAddEvent = document.querySelector('.um-popup-reminders');
    const popupClose = document.querySelector('.um-popup-reminders__btn-close');

    
    if (tabs) {
      tabs.addEventListener('click', (e) => {
        if (e.target.classList.contains('um-uved-tabs__tab-btn')) {
          const tabsPath = e.target.dataset.tabsPath;
          tabsBtn.forEach(el => {el.classList.remove('um-uved-tab-btn--active')});
          document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('um-uved-tab-btn--active');
          tabsHandler(tabsPath);
        }
      });
    }
  
    const tabsHandler = (path) => {
      tabsContent.forEach(el => {el.classList.remove('um-uved-tabs--active')});
      document.querySelector(`[data-tabs-target="${path}"]`).classList.add('um-uved-tabs--active');
    };


    btnPopup.forEach(function(popupBtn) {
      popupBtn.addEventListener('click', function(event) {
        const path = event.target.dataset.path;

        popupAddEvent.classList.add('um-popup-reminders--active');
        
      })
    })

    popupClose.addEventListener('click', function(event) {
      popupAddEvent.classList.remove('um-popup-reminders--active')
    })



  });