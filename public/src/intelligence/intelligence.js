const toggleEl = (buttons, body) => {
  buttons.forEach((button) => {
    button.addEventListener('click', (event) => {
      const selectItems = button.querySelectorAll('.intelligence__select-item');
      const input = button.querySelector('.intelligence__form-input');

      event.preventDefault();
      event._isClickWithinDropDown = true;

      buttons.forEach((el) => {
        el.classList.remove('opened');
      });

      button.classList.add('opened');

      body.addEventListener('click', (event) => {
        const target = event.target;
        selectItems.forEach((item) => {
          if (target === item) {
            input.value = item.textContent;
            button.classList.remove('opened');
          }
        });

        if (event._isClickWithinDropDown) return;
        button.classList.remove('opened');
      });
    });
  });
};

const allSelect = document.querySelectorAll('.js-intelligence-select');
const body = document.body;

toggleEl(allSelect, body);
