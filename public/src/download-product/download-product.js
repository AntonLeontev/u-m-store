const fileUploader = document.getElementById('file-uploader');
const imageGrid = document.querySelector('.download-product__file-grid');

const tabButtons = document.querySelectorAll('.js-tab-btn');
const tabItems = document.querySelectorAll('.js-tab-item');

const prevBtn = document.querySelector('.js-prev-btn');
const nextButtons = document.querySelectorAll('.js-next-btn');

const allSelect = document.querySelectorAll('.js-download-product-select');
const body = document.body;

if (tabButtons && tabItems) {
  makeTad(tabButtons, tabItems);
}

if (prevBtn) {
  prevBtn.addEventListener('click', () => {
    const prev = document.querySelector('.js-tab-btn.is-active').previousSibling.previousSibling;
    const prevItem = document.querySelector('.js-tab-item.is-visible').previousSibling.previousSibling;

    if (!prev || !prevItem) return;

    tabButtons.forEach((btn) => {
      btn.classList.remove('is-active');
    });

    tabItems.forEach((item) => {
      item.classList.remove('is-visible');
    });

    prev.classList.add('is-active');
    prevItem.classList.add('is-visible')
  })
}

if (nextButtons) {
  nextButtons.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const next = document.querySelector('.js-tab-btn.is-active').nextSibling.nextSibling;
      const nextItem = document.querySelector('.js-tab-item.is-visible').nextSibling.nextSibling;
  
      if (!next || !nextItem) return;
  
      tabButtons.forEach((btn) => {
        btn.classList.remove('is-active');
      });
  
      tabItems.forEach((item) => {
        item.classList.remove('is-visible');
      });
  
      next.classList.add('is-active');
      nextItem.classList.add('is-visible')
    })
  })
}

if (fileUploader && imageGrid) {
  fileUploader.addEventListener('change', (event) => {
    const files = event.target.files;

    if (!files || !files.length) return;

    if (files || files.length) {
      document.querySelector('.plug').style.display = 'none'
    } else {
      document.querySelector('.plug').style.display = 'flex'
    }
    
    for (let file of files) {
      const img = document.createElement('img');
      const item = document.createElement('div');
      const setting = document.createElement('div');
      const del = document.createElement('div');

      const input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', `Review[files][${file.name}]`);
      input.setAttribute('id', file.lastModified);

      item.setAttribute('data-id', file.lastModified);
      item.classList.add('download-product__file-item');
      img.classList.add('download-product__file-img');
      setting.classList.add('download-product__file-setting');
      del.classList.add('download-product__file-del');
      setBase64(file, input);
      imageGrid.append(input);
      imageGrid.prepend(item);
      item.append(img);
      item.append(setting);
      item.append(del);
      img.src = URL.createObjectURL(file)
      img.alt = file.name;

      del.addEventListener('click', (e) => {
        e.stopPropagation();
        item.remove();
        input.remove();

        if (document.querySelectorAll('.download-product__file-item').length &&
          document.querySelectorAll('.download-product__file-item').length >= 9) {
          fileUploader.removeAttribute('disabled');
        }
      });

      if (imageGrid.children.length >= 10) {
        fileUploader.setAttribute('disabled', 'disabled');
      }
    };
  });
}

function makeTad(buttons, items) {
  buttons.forEach((btn) => {
    const tabContent = document.querySelector(btn.dataset.target);

    if (tabContent) {
      btn.addEventListener('click', () => {

        items.forEach((el) => {
          el.classList.remove('is-visible');
        });

        buttons.forEach((btnEl) => {
          btnEl.classList.remove('is-active');
        });

        btn.classList.add('is-active');
        tabContent.classList.add('is-visible');
      });
    }
  });
}

function toggleEl (buttons, body) {
  buttons.forEach((button) => {
    button.addEventListener('click', (event) => {
      const selectItems = button.querySelectorAll('.download-product__select-item');
      const input = button.querySelector('.download-product__form-input');

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

function setBase64(file, input) {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => {
    input.setAttribute('value', reader.result);
  };
  reader.onerror = (error) => {
    console.log('Error: ', error);
  };
}

if (allSelect) {
  toggleEl(allSelect, body);
}

const buttons = document.querySelectorAll('.js-acc-action');

buttons.forEach((btn) => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const accordionItem = btn.nextElementSibling;

    btn.classList.toggle('is-active');
    accordionItem.classList.toggle('is-visible');
  });
});