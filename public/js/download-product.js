const fileUploader = document.getElementById('file-uploader');
const imageGrid = document.querySelector('.download-product__file-grid');

const tabButtons = document.querySelectorAll('.js-tab-btn');
const tabItems = document.querySelectorAll('.js-tab-item');

const prevBtn = document.querySelector('.js-prev-btn');
const nextButtons = document.querySelectorAll('.js-next-btn');

const allSelect = document.querySelectorAll('.js-download-product-select');
const checkboxes = document.getElementById("checkboxes");
const body = document.body;

// если есть таб-кнопки и таб-элементы
// то используем функцию таба
if (tabButtons && tabItems) {
  makeTad(tabButtons, tabItems);
}

// если есть предыдущая кнопка
if (prevBtn) {
  // при нажатии на кнопку
  prevBtn.addEventListener('click', () => {
    const prev = document.querySelector('.js-tab-btn.is-active').previousSibling.previousSibling;
    const prevItem = document.querySelector('.js-tab-item.is-visible').previousSibling.previousSibling;

    // не выполняем код, если это первый таб-элемент
    if (!prev || !prevItem) return;

    // удаляем у всех items/табов класс активности (видимости)
    tabButtons.forEach((btn) => {
      btn.classList.remove('is-active');
    });

    tabItems.forEach((item) => {
      item.classList.remove('is-visible');
    });

    // добавляем класс активности и видимости предыдущему табу
    prev.classList.add('is-active');
    prevItem.classList.add('is-visible')

    // скролит наверх
    window.scrollTo(0, 0)

  })
}

// если нажата кнопка следующий таб
if (nextButtons) {
  nextButtons.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      // предотварщаем стандатное событие при нажатии по кнопки
      e.preventDefault();
      const next = document.querySelector('.js-tab-btn.is-active').nextSibling.nextSibling;
      const nextItem = document.querySelector('.js-tab-item.is-visible').nextSibling.nextSibling;
      // не выполняем код, если это последний таб-элемент
      if (!next || !nextItem) return;

      // удаляем у всех items/табов класс активности (видимости)
      tabButtons.forEach((btn) => {
        btn.classList.remove('is-active');
      });

      tabItems.forEach((item) => {
        item.classList.remove('is-visible');
      });

      // добавляем класс активности и видимости предыдущему табу
      next.classList.add('is-active');
      nextItem.classList.add('is-visible')

      // скролит наверх
      window.scrollTo(0, 0)

    })
  })
}

// // если есть загрузик файлов и сетка для загруженных фотографий
// if (fileUploader && imageGrid) {
//   // при добавлении фотографий
//   fileUploader.addEventListener('change', (event) => {
//
//     const files = event.target.files;
//
//     // не выполняем код, если нет загруженных фотографий
//     if (!files || !files.length) return;
//
//     // добавляем необходимые стили
//     if (files || files.length) {
//       document.querySelector('.plug').style.display = 'none'
//     } else {
//       document.querySelector('.plug').style.display = 'flex'
//     }
//
//     for (let file of files) {
//       const img = document.createElement('img');
//       const item = document.createElement('div');
//       const setting = document.createElement('div');
//       const del = document.createElement('div');
//
//       const input = document.createElement('input');
//       input.setAttribute('type', 'hidden');
//       input.setAttribute('name', `Review[files][${file.name}]`);
//       input.setAttribute('id', file.lastModified);
//
//       item.setAttribute('data-id', file.lastModified);
//       item.classList.add('download-product__file-item');
//       img.classList.add('download-product__file-img');
//       setting.classList.add('download-product__file-setting');
//       del.classList.add('download-product__file-del');
//       setBase64(file, input);
//       imageGrid.append(input);
//       // imageGrid.prepend(item);
//       // item.append(img);
//       // item.append(setting);
//       // item.append(del);
//       // img.src = URL.createObjectURL(file)
//       // img.alt = file.name;
//
//       del.addEventListener('click', (e) => {
//         e.stopPropagation();
//         item.remove();
//         input.remove();
//
//         if (document.querySelectorAll('.download-product__file-item').length &&
//           document.querySelectorAll('.download-product__file-item').length >= 9) {
//           fileUploader.removeAttribute('disabled');
//         }
//       });
//
//       if (imageGrid.children.length >= 10) {
//         fileUploader.setAttribute('disabled', 'disabled');
//       }
//     };
//   });
// }

function makeTad(buttons, items) {
  buttons.forEach((btn) => {
    // опеределяем item, на который необходимо переключиться
    const tabContent = document.querySelector(btn.dataset.target);

    if (tabContent) {
      // при нажатии на определенный таб
      btn.addEventListener('click', () => {
        // удаляем у всех элементов видимость и активность
        items.forEach((el) => {
          el.classList.remove('is-visible');
        });

        buttons.forEach((btnEl) => {
          btnEl.classList.remove('is-active');
        });
        // добавляем конкретному элементому видимость и активность
        btn.classList.add('is-active');
        tabContent.classList.add('is-visible');
      });
    }
  });
}

function toggleEl(buttons, body) {
  buttons.forEach((button) => {
    // при нажатии на определенный cелект
    button.addEventListener('click', (event) => {
        const checkboxes = button.nextElementSibling
        if(checkboxes.style.display === "block") {
            checkboxes.style.display = "none"
        } else {
            checkboxes.style.display = "block"
        }
    });
  });
}

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

// если есть cелекты
if (allSelect) {
  // то запускаем для них функцию селектов
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

const downloadProductUmColor = document.querySelector('.download-product__um-color');
const downloadProductUmColorInput = document.querySelector('.download-product__um-color-input');
const downloadProductUmColorSpan = document.createElement('span')


const spanStyle = downloadProductUmColorSpan.style.cssText = `
	width: 30px;
	height: 30px;
	border-radius: 50px;
    position: absolute;
    top: 38px;
    left: 43px;
`;
downloadProductUmColor.addEventListener('click', () => {
  downloadProductUmColorInput.after(downloadProductUmColorSpan)
  downloadProductUmColorSpan.style.background = downloadProductUmColorInput.value
});

