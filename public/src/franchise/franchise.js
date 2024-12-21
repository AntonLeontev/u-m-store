const togglePopup = (buttons, popups, closeButtons = null, body = null) => {
  buttons.forEach((btn) => {
    const dropDownContent = document.querySelector(btn.dataset.target);

    if (dropDownContent) {
      btn.addEventListener('click', (event) => {
        event.preventDefault();
        event._isClickWithinDropDown = true;
        if (dropDownContent.classList.contains('is-active')) {
          dropDownContent.classList.remove('is-active');
          if (body) {
            body.classList.remove('no-scrolling');
            body.style.paddingRight = '';
          }
          return;
        }

        if (closeButtons && closeButtons.length) {
          closeButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
              dropDownContent.classList.remove('is-active');
              if (body) {
                body.classList.remove('no-scrolling');
                body.style.paddingRight = '';
              }
            });
          });
        }

        dropDownContent.classList.add('is-active');
        if (body) {
          body.style.paddingRight = `${window.innerWidth - document.documentElement.clientWidth}px`;
          body.classList.add('no-scrolling');
        }
      });

      popups.forEach((popup) => {
        popup.querySelector('.js-popup-wrapper').addEventListener('click', (event) => {
          event._isClickWithinDropDown = true;
        });

        body.addEventListener('click', (event) => {
          if (event._isClickWithinDropDown) return;
          popup.classList.remove('is-active');
          if (body) {
            body.classList.remove('no-scrolling');
            body.style.paddingRight = '';
          }
        });
      });

      body.addEventListener('keyup', (event) => {
        if (event.code !== 'Escape') return;
        dropDownContent.classList.remove('is-active');
        if (body) {
          body.classList.remove('no-scrolling');
          body.style.paddingRight = '';
        }
      });
    }
  });
};

const popups = document.querySelectorAll('.js-get-popup');
const popupsWrapper = document.querySelectorAll('.js-franchise-popup');

if (popups.length > 0 && popupsWrapper.length > 0) {
  const closePopupButtons = document.querySelectorAll('.js-close-popup');
  const bodyEl = document.body;

  togglePopup(popups, popupsWrapper, closePopupButtons, bodyEl);
}

