document.addEventListener("DOMContentLoaded", ()=>{
    document.querySelectorAll('.popular__buy a').forEach(item => {
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            let srcImage;
            if (!item.parentElement.classList.contains('none')){
                if (item.classList.contains('active')){
                    item.classList.remove('active')
                    srcImage = 'images/basket(1).svg';
                    item.style.backgroundColor = '#395DD0';
                } else {
                    item.style.backgroundColor = '#6ACDF8';
                    item.classList.add('active')
                    srcImage = 'images/doneBuy.svg';
                }
                item.childNodes[1].src = srcImage;
            }
        });
    });
});

function clickText(trigger){
    document.querySelectorAll(trigger).forEach(item => {
        item.addEventListener('click', ()=>{
            console.log(item.parentElement.children[1]);
            textnum = item.parentElement.children[1];
            if (textnum.style.display == 'block'){
                textnum.style.display = 'none';
                item.classList.remove('active');
            } else{
                textnum.style.display = 'block';
                item.classList.add('active');
            }
        });
    });
}
try{
    clickText('.flowersHideClick');
} catch{}

function changeColor(items){
    document.querySelectorAll(items).forEach(item=>{
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            document.querySelectorAll(items).forEach(one=>{
                if (item == one){
                    one.style.color = '#000';
                } else {
                    one.style.color = '#BFC6E0';
                }
            });
        });
    });
}

try{
    changeColor('#flowersSort ul li a')
} catch{} 


function closeWindow(trigger, window, third = 'none'){
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelectorAll(window).forEach(item=>{
            item.style.display = 'none';
        });
        if (trigger == '.catalog__btn--two'){
            document.querySelector(trigger).style.display = 'none';
            document.querySelector('.catalog__btn--one').style.display = 'block';
        }
        if (third !== 'none'){
            document.querySelector(third).classList.remove('active');
            document.querySelector(trigger).classList.add('active');
        }
        if (trigger == '.addCard__bank a'){
            document.querySelector('.addCard__card a').classList.remove('active');
        }
        if (trigger == '.addCard__card a'){
            document.querySelector('.addCard__bank a').classList.remove('active');
        }
    });
}
try{
    closeWindow('#exitYes', '#newCard');
    closeWindow('#exitYes', '#cardExit');
    closeWindow('#exitClose', '#cardExit');
} catch{}
try{
    closeWindow('#exitYes', '#tovarDownload');
    closeWindow('#exitYes', '#cardExit');
    closeWindow('#exitClose', '#cardExit');
} catch{}
try{
    closeWindow('#exitNo', '#cardExit');
} catch{}
try{
    closeWindow('#hood', '#iamPartner');
} catch{}
try{
    closeWindow('#thanksBtn', '#thanks');
} catch{}
try{
    closeWindow('#thanksClose', '#thanks');
} catch{}

try{
    closeWindow('.wallet__tranz a', '.wallet__choose', '.wallet__add a');
} catch{}
try{
    closeWindow('.wallet__add a', '.wallet__tranzaction', '.wallet__tranz a');
} catch{}
try{
    closeWindow('.wallet__add a', '.wallet__outmoney');
} catch{}
try{
    closeWindow('.wallet__tranz a', '.wallet__outmoney');
} catch{}
try{
    closeWindow('.addCard__card a', '.addCard__form--two');
} catch{}
try{
    closeWindow('.addCard__bank a', '.addCard__form--one');
} catch{}
try{
    closeWindow('.addCard__close', '.payments__addCard');
} catch{}
try{
    closeWindow('.payments__delClose', '.payments__delete');
} catch{}

function deleteBlock(item, block){
    document.querySelector(item).addEventListener('click', ()=>{
        document.querySelector(block).remove();
    });
}

try{
    deleteBlock('#setDelete', '#setCard');
    deleteBlock('#setDeleteTwo', '#setCard');
    deleteBlock('#setDelete', '#setNew');
    deleteBlock('#setDeleteTwo', '#setNew');
} catch{}

function tovarDelete(del, block){
    document.querySelectorAll(del).forEach((item, index) => {
        item.addEventListener('click', ()=>{
            item.parentElement.remove();
        });
    });
}
try{
    tovarDelete('.tovar__delete');
} catch{}

function openCloseFiler(trigger, window){
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        if (document.querySelector(trigger).classList.contains('clicked')){
            document.querySelectorAll(window).forEach(item=>{
                item.style.display = 'none';
                document.querySelector(trigger).classList.remove('clicked');
                if (trigger == '#tovarPlus'){
                    document.querySelector(trigger).textContent = 'Добавить конфигурацию';
                }
            });
        } else {
            document.querySelector(trigger).classList.add('clicked')
            document.querySelectorAll(window).forEach(item=>{
                item.style.display = 'block';
                if (trigger == '#tovarPlus'){
                    document.querySelector(trigger).textContent = 'Убрать конфигурацию';
                }
            });
        }
    });
}
try {
    openCloseFiler('#promotionsChoose', '#promotionsHide');
} catch{}
try {
    openCloseFiler('#flowersSorting', '#sortingHide');
} catch{}
try {
    openCloseFiler('#menuArrowOne a', '#hideListOne');
} catch{}
try {
    openCloseFiler('#menuArrowTwo a', '#hideListTwo');
} catch{}
try {
    openCloseFiler('#reviewArrow1', '#reviewItems');
} catch{}
try {
    openCloseFiler('#reviewTheme', '#reviewItems');
} catch{}
try{
    openCloseFiler('#reviewArrow2', '#reviewCategory')
} catch{}
try{
    openCloseFiler('#reviewInput', '#reviewCategory')
} catch{}
try{
    openCloseFiler('#tovarPlus', '#tovarHideBlock')
} catch{}


function basketDelete(del, block){
    document.querySelectorAll(del).forEach((item, index) => {
        item.addEventListener('click', ()=>{
            item.parentElement.parentElement.remove();

            // document.querySelectorAll(block).forEach((one, num) => {
            //     console.log(index, num);
            //     if (index == num){
            //         one.remove();
            //     }
            // });
        });
    });
}
try{
    basketDelete('.basket__delete', '.basket__item');
} catch{}

function regKol(min, plus, kol){
    document.querySelectorAll(min).forEach((item, index) =>{
        item.addEventListener('click', ()=>{
            document.querySelectorAll(kol).forEach((one, num) =>{
                if (index == num){
                    let k = one.textContent;
                    if (k > 0){
                        k--;
                        one.textContent = k;
                    }
                }
            });
        });
    });
    document.querySelectorAll(plus).forEach((item, index) =>{
        item.addEventListener('click', ()=>{
            document.querySelectorAll(kol).forEach((one, num) =>{
                if (index == num){
                    let k = one.textContent;
                    k++;
                    one.textContent = k;
                }
            });
        });
    });
}
try{
    regKol('.basket__min', '.basket__plus', '.basket__num');
} catch{}

function chooseBlock(click, items){
    document.querySelectorAll(click).forEach((item, index)=>{
        item.classList.remove('active');
        item.addEventListener('click', ()=>{
            document.querySelectorAll(click).forEach((od)=>{
                od.classList.remove('active');
            });
            document.querySelectorAll(items).forEach((one, num)=>{
                if (index == num){
                    one.style.display = 'block';
                    item.classList.add('active');
                } else {
                    one.style.display = 'none';
                }
            });
        });
    });
}

try{
    chooseBlock('.review__item', '.review__block');
    document.querySelectorAll('.review__item').forEach((item, index)=>{
        if (index == 0){
            item.click();
        }
    });
} catch{}

try{
    chooseBlock('.product__name', '.product__review');
    document.querySelectorAll('.product__name').forEach((item, index)=>{
        if (index == 0){
            item.click();
        }
    });
} catch{}


function showList(trigger, block){
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        if (document.querySelector(block).style.display == 'block'){
            document.querySelector(trigger).classList.remove('active');
            document.querySelector(block).style.display = 'none';
        } else {
            document.querySelector(trigger).classList.add('active');
            document.querySelector(block).style.display = 'block';
        }
    });
}

try{
    showList('#downloadTovarArrow', '#downloadTovarBlock');
} catch{}
try{
    showList('#downloadTovarArrowTwo', '#downloadTovarBlockTwo');
} catch{}

function activePosition(inputs, block){
    document.querySelectorAll(inputs).forEach(item =>{
        item.addEventListener('change', ()=>{
            if (item.checked){
                console.log(item.parentElement.children[1].innerText);
                document.querySelector(block).value = item.parentElement.children[1].innerText;
            }
        });
    });
}

try{
    activePosition('.downloadTovar__block--one .promotion__br input', '#downloadTovarKategory');
} catch {}
try{
    activePosition('.downloadTovar__block--two .promotion__br input', '#downloadTovarKategoryTwo');
} catch {}

function showWindow(trigger, window){
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelectorAll(window).forEach(item=>{
            item.style.display = 'block';
        });
        if (trigger == '.catalog__btn--one'){
            document.querySelector(trigger).style.display = 'none';
            document.querySelector('.catalog__btn--two').style.display = 'block';
        }
        if (trigger == '.addCard__bank a' || trigger == '.addCard__card a'){
            document.querySelector(trigger).classList.add('active');
        }
        if (trigger == '.wallet__viv a'){
            document.querySelector('.wallet__add a').classList.remove('active');
            document.querySelector('.wallet__tranz a').classList.remove('active');
            document.querySelector('.wallet__choose').style.display = 'none';
            document.querySelector('.wallet__tranzaction').style.display = 'none';
        }
    });
}
// try{
//     showWindow('#reviewArrow1', '#reviewItems')
// } catch{}
// try{
//     showWindow('#reviewArrow2', '#reviewCategory')
// } catch{}
try{
    showWindow('#tovadAdd', '#tovarDownload')
} catch{}
try{
    showWindow('#tovarDownloadClose', '#cardExit')
} catch{}
try{
    showWindow('#productButton', '#reviewProduct')
} catch{}
try{
    showWindow('#productRuler', '#productChoose')
} catch{}
try{
    showWindow('#addNewCard', '#newCard')
} catch{}
try{
    showWindow('#setNew', '#newCard')
} catch{}
try{
    showWindow('#newCardClose', '#cardExit')
} catch{}
try{
    showWindow('.wallet__tranz a', '.wallet__tranzaction');
} catch{}
try{
    showWindow('.wallet__add a', '.wallet__choose');
} catch{}
try{
    showWindow('.wallet__kassaOne a', '.add__wallet');
} catch{}
try{
    showWindow('.wallet__kassaTwo a', '.wallet__bank');
} catch{}
try{
    showWindow('.wallet__schetOne a', '.wallet__personalData');
} catch{}
try{
    showWindow('.wallet__schetTwo a', '.viv__schet');
} catch{}
try{
    showWindow('.wallet__viv a', '.wallet__outmoney');
} catch{}
try{
    showWindow('.addCard__card a', '.addCard__form--one');
} catch{}
try{
    showWindow('.addCard__bank a', '.addCard__form--two');
} catch{}
try{
    showWindow('.payments__add', '.payments__addCard');
} catch{}
try{
    showWindow('.investor__delete a', '.payments__delete');
} catch{}
try{
    showWindow('.address__add a', '.payments__addAddress');
} catch{}
try{
    showWindow('.investor__newphoto', '.investor__addPhoto');
} catch{}
 

function showWindows(trigger, window){
    document.querySelectorAll(trigger).forEach(item =>{
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            document.querySelectorAll(window).forEach(item=>{
                item.style.display = 'block';
            });
            if (trigger == '.catalog__btn--one'){
                document.querySelector(trigger).style.display = 'none';
                document.querySelector('.catalog__btn--two').style.display = 'block';
            }
        });
    });
}
try{
    showWindows('.partnerBtn', '.iamPartner')
} catch{}

function copyTextAll(input, btn){
    document.querySelectorAll(btn).forEach((item, index)=>{
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            document.querySelectorAll(input).forEach((one, num)=>{
                if (index == num){
                    one.select();
                    document.execCommand("copy");
                }
            });
        });
    });
}

try{
    copyTextAll('.promoNameBtn', '.promoBtn')
} catch{}

function changeColorPink(item){
    document.querySelectorAll(item).forEach(one => {
        one.addEventListener('click', ()=>{
            if (one.classList.contains('active')){
                one.classList.remove('active');
            } else {
                one.classList.add('active');
            }
        });
    });
}
try{
    changeColorPink('.popularLike');
} catch {}

function changeRub(blocks){
    if (document.documentElement.clientWidth < 500){
        document.querySelectorAll(blocks).forEach(item=>{
            let rubStroka = item.textContent;
            item.textContent = rubStroka.replace('₽', 'P');
        });
    }
}
try{
    changeRub(".popularPrice");
} catch{}
try{
    changeRub(".popularOldPrice");
} catch{}
try{
    changeRub("#newUvedSum");
} catch{}
try{
    changeRub(".plusMoney");
} catch{}


function addActiveClass(items){
    document.querySelectorAll(items).forEach(item=>{
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            document.querySelectorAll(items).forEach(one=>{
                one.classList.remove('active');
            });
            item.classList.add('active');
        });
    });
}

try{
    addActiveClass('.sortingLink');
} catch{}


function copyText(input, btn){
    document.querySelector(btn).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelector(input).select();
        document.execCommand("copy");
    });
}

try{
    copyText('#refFormInput', '#refBtn');
} catch{}




function radioChange(radio, block){
    document.querySelectorAll(radio).forEach(item => {
        item.addEventListener('change', ()=>{
            if (item.classList.contains('reg__place')){
                document.querySelector(block).style.display = 'block';
            } else {
                document.querySelector(block).style.display = 'none';
            }
        });
    });
}
try{
    radioChange('#regDel input', '#anotherCity');
} catch{}

function changeChecked(items, block){
    document.querySelectorAll(items).forEach(item=>{
        item.addEventListener('change', ()=>{
            document.querySelectorAll(items).forEach(one=>{
                if ((item.checked) && (one.checked) && (one !== item)){
                    one.checked = false;
                }
                if ((item == '.reg__him') && (item.checked)){
                    document.querySelector(block).style.display = 'block';
                } else {
                    document.querySelector(block).style.display = 'none';
                }
            });
        });
    });
}
try{
    changeChecked('#regWho input', '#anotherMan');
} catch{}

function changeInput(input, block, third = 'none'){
    document.querySelector(input).addEventListener('change', ()=>{
        if (document.querySelector(input).checked == true){
            document.querySelector(block).style.display = 'block';
        } else {
            document.querySelector(block).style.display = 'none';
        }
        if (third !== 'none'){
            document.querySelector(third).style.display = 'none';
        }
    });
}
try{
    changeInput('#regChoose input', '#anotherMe');
    changeInput('.regHim', '.another__man');
} catch{}

try{
    changeInput('.reg__how--two', '.reg__how--two--block', '.reg__one__choose');
    changeInput('.reg__how__choose', '.reg__one__choose', '.reg__how--two--block');
} catch{}

try{
    const regBalance = document.querySelector('.reg__balance').textContent;
    const num = parseInt(regBalance.replace(/\D+/g,""));
    console.log(num);
    if (num <= 0){
        document.querySelector('.reg__none__money').style.display = 'block';
    }
} catch{}

function chooseInput(input, block, parent){
    document.querySelectorAll(block).forEach(item =>{
        item.addEventListener('click', ()=>{
            document.querySelector(input).value = item.textContent;
            document.querySelector(parent).style.display = 'none';
        });
    });
}
try{
    chooseInput('#reviewTheme', '#reviewPoint', '#reviewItems');
} catch {}
try{
    chooseInput('#reviewInput', '#reviewUnit', '#reviewCategory');
} catch {}

function textContentItem(input, item){
    document.querySelector(input).value = document.querySelector(item).textContent;
}
try{
    textContentItem('#reviewKategoryItem', '#contentForBlock');
} catch{}


function downloadThing(btn, input){
    document.querySelector(btn).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelector(input).click();
    });
}

try{
    downloadThing('.downloadTovar__photo', '.downloadTovar__hide');
} catch{}

function selectAll(checkbox, all){
    document.querySelector(checkbox).addEventListener('change', (e)=>{
        if (e.target.checked == true){
            document.querySelectorAll(all).forEach(item=>{
                item.checked = true;
            });
        } else {
            document.querySelectorAll(all).forEach(item=>{
                item.checked = false;
            });
        }
    });
}
try{
    selectAll('.basket__everything input', '.basket__item input');
} catch{}


function checkedInput(inputs){
    document.querySelectorAll(inputs).forEach(item=>{
        item.addEventListener('change', ()=>{
            if (item.checked){
                document.querySelectorAll(inputs).forEach(one=>{
                    if (item !== one){
                        one.checked = false;
                    }
                });
            }
        });
    });
}

try{
    checkedInput('.downloadTovar__block--one .promotion__br input');
    checkedInput('.downloadTovar__block--two .promotion__br input');
} catch {}
try{
    checkedInput('#productFlower #productChoose input');
} catch {}


function deleteThis(btn, itemDel){
    document.querySelector(btn).addEventListener('click', ()=>{
        document.querySelectorAll(itemDel).forEach(item=>{
            if (item.checked == true){
                item.parentElement.remove();
            }
        });
    });
};
try{
    deleteThis('.basket__remove', '.basket__item input');
} catch{}



function clickMob(items, block){
    document.querySelectorAll(items).forEach(function(item, index){
        item.addEventListener('change', (e)=>{
            e.preventDefault();
            document.querySelectorAll(block).forEach(function(one, num){
                if (index == num){
                    if (e.target.checked == true){
                        one.style.display = 'block';
                    } else {
                        one.style.display = 'none'; 
                    }
                } else {
                    if (items == '.basket__input'){
                        one.style.display = 'none';
                    }
                }
            });
        });
    });
}
try{ 
    clickMob('.promotions__mobClick', '.promotions__one');
} catch {}
// try{ 
//     clickMob('#checkbox12', '#tovarHideBlock');
// } catch {}

try{
    clickMob('.basket__input', '.basket__two');
} catch{}

function downloadChange(input, block){

    const review = document.createElement('div');
    review.classList.add('review');
    const downloadTovar = document.querySelector('.downloadTovar')
    downloadTovar.prepend(review);

    document.querySelector(input).addEventListener('change', (e)=>{
        const files = Array.from(e.target.files);
        files.forEach(file=>{
            if (!file.type.match('image')){
                return
            }
            const reader = new FileReader();
            reader.onload = ev => {
                review.insertAdjacentHTML('afterbegin', `<img src="${ev.target.result}" />`);
            }
            reader.readAsDataURL(file);
        });
        document.querySelector(block).style.display = 'none';
    });
}
try{
    downloadChange('.downloadTovar__hide', '.downloadTovar__photo');
} catch{}


function chooseBlock(click, items){
    document.querySelectorAll(click).forEach((item, index)=>{
        item.classList.remove('active');
        item.addEventListener('click', ()=>{
            document.querySelectorAll(click).forEach((od)=>{
                od.classList.remove('active');
            });
            document.querySelectorAll(items).forEach((one, num)=>{
                if (index == num){
                    one.style.display = 'block';
                    item.classList.add('active');
                } else {
                    one.style.display = 'none';
                }
            });
        });
    });
}

try{
    chooseBlock('.review__item', '.review__block');
    document.querySelectorAll('.review__item').forEach((item, index)=>{
        if (index == 0){
            item.click();
        }
    });
} catch{}

function showDelFunc(trigger, del){
    const allDel = document.querySelectorAll(del);
    document.querySelectorAll(trigger).forEach((item, index)=>{
        item.addEventListener('click', ()=>{
            if (item.classList.contains('active')){
                item.classList.remove('active');
                allDel[index].style.display = 'none';
            } else{
                item.classList.add('active');
                allDel[index].style.display = 'block';
            }
        });
    });
}
try{
    showDelFunc('.payments__menu', '.payments__del')
} catch{}

function clickKati(items, block){
    document.querySelectorAll(items).forEach(function(item, index){
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            document.querySelectorAll(block).forEach(function(one, num){
                if (index == num){
                    one.style.display = 'block';
                } else {
                    one.style.display = 'none';
                }
            });
        });
    });
}
try{ 
    clickKati('.promotions__touch', '.promotions__one');
} catch {}

function inputFocus(input, block){
    document.querySelector(input).addEventListener('click', ()=>{
      document.querySelector(block).style.display = 'block';
      if (document.querySelector(block).classList.contains('active')){
        document.querySelector(block).style.display = 'none';
        document.querySelector(block).classList.remove('active');
      } else {
        document.querySelector(block).classList.add('active');
      }
    });
}
  
try{
  inputFocus('.kategory__choose', '.kategory__list');
} catch{}
try{
  inputFocus('.kategory__arrow', '.kategory__list');
} catch{}
try{
  inputFocus('.map__input input', '.map__list');
} catch{}
try{
  inputFocus('.map__arrow', '.map__list');
} catch{}


function chooseText(input, textBlocks, block){
  document.querySelectorAll(textBlocks).forEach(item =>{
    item.addEventListener('click', ()=>{
      document.querySelector(input).value = item.textContent;
      document.querySelector(block).style.display = 'none';
      document.querySelector(block).classList.remove('active');
    });
  });
}
try{
  chooseText('.map__input input', '.my__city', '.map__list')
} catch{}
try{
  chooseText('.kategory__choose', '.my__city', '.kategory__list')
} catch{}

function changeWidth(img, block){
    window.addEventListener('DOMContentLoaded', ()=>{
        if (document.documentElement.clientWidth < 500){
            let myWidth = document.querySelector(img).offsetWidth;
            document.querySelectorAll(block).forEach(item => {
                item.style.left = myWidth + 10 + 'px';
            });
        }
    });
}
// try{
//     changeWidth('.popularImg', '.popularLike');
// } catch{}

function addRmoveActiveClass(blocks){
    document.querySelectorAll(blocks).forEach(item => {
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            document.querySelectorAll(blocks).forEach(one => {
                one.classList.remove('active');
            });
            item.classList.add('active');
        });
    });
}
try{
    addRmoveActiveClass('.investorOrder__btn a')
} catch{}

function showAll(trigger, block){
    document.querySelectorAll(trigger).forEach(item=>{
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            document.querySelector(block).style.display = 'block';
        });
    });
}

try{
    showWindow('#messageCancellation', '#zakazCancellation');
    closeWindow('#cancellationClose', '#zakazCancellation');
    
    showAll('.timeItem', '#zakazConfirmation');

    closeWindow('#changedClose', '#zakazChanged');
    showWindow('#confirmationYes', '#zakazChanged');

    closeWindow('#confirmationNo', '#zakazConfirmation');
    closeWindow('#confirmationYes', '#zakazConfirmation');
} catch{}

try{
    closeWindow('.add__wallet__close', '.add__wallet');
} catch{}
try{
    closeWindow('.personalData__close', '.wallet__personalData');
} catch{}
try{
    closeWindow('.receipt__close', '.wallet__receipt');
} catch{}
try{
    closeWindow('.addAddress__close', '.payments__addAddress');
} catch{}
try{
    closeWindow('.investor__addPhoto--close', '.investor__addPhoto');
} catch{}
try{
    closeWindow('.vivBankClose', '.wallet__bank');
} catch{}
try{
    closeWindow('.vivSchetClose', '.viv__schet');
} catch{}

try{
    document.querySelector('.investor__addPhoto--fake').addEventListener('click', ()=>{
        document.querySelector('.investor__addPhoto--download').click();
    });
} catch{}