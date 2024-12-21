// HEADER

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
    });
}
showWindow('#headerCity', '#cityWindow');


if (document.documentElement.clientWidth < 600
    && document.querySelector('.header__city'
    || document.querySelector('.header__phone a') )){
    document.querySelector('.header__city').textContent = '';
    document.querySelector('.header__phone a').textContent = '';
}

function clickcity(city, input, itog){
    document.querySelectorAll(city).forEach(item => {
        item.addEventListener('click', ()=>{
            item.classList.remove('active');
            document.querySelector(input).value = item.textContent;
            document.querySelector(itog).textContent = item.textContent;
            document.querySelectorAll(city).forEach(block => {
                block.classList.remove('active');
                item.classList.add('active');
            });
            if (document.documentElement.clientWidth > 800){
                document.querySelector('.header__city').textContent = item.textContent;
            }
        });
    });
}
clickcity('.cityPosition', '#citySearch', '#cityItog');

function closeWindow(trigger, window){
    if (!document.querySelector(trigger)) return;
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelectorAll(window).forEach(item=>{
            item.style.display = 'none';
        });
        if (trigger == '.catalog__btn--two'){
            document.querySelector(trigger).style.display = 'none';
            document.querySelector('.catalog__btn--one').style.display = 'block';
        }
    });
}
 closeWindow('#windowClose', '#headerWindow');
// closeWindow('#cityClose', '#cityWindow');
// closeWindow('#signInBtn', '#signInBlock');
// closeWindow('#signInReg', '#signInBlock');
// closeWindow('#signinClose', '#signInBlock');
// closeWindow('#regSignClose', '#regSign');
// closeWindow('#regSignEmail', '#regSign');
// closeWindow('#pochtaBlockClose', '#pochtaBlock');
// closeWindow('#numberBlockClose', '#numberBlock');
// closeWindow('#numberBlockEmail', '#numberBlock');
// closeWindow('#mailBlockClose', '#mailBlock');
// closeWindow('#profileZakazClose', '#profileZakazId');

// function showKatalog(trigger, window){
//     document.querySelector(trigger).addEventListener('click', (e)=>{
//         e.preventDefault();
//         document.querySelector(window).style.display = 'flex';
//     });
// }
// try{
//     showKatalog('#headerA', '#headerWindow');
// } catch{}

// try{
//     showKatalog('#headerMobMenu', '#headerWindow');
// } catch{};


function clickKat(items, block){
    document.querySelectorAll(items).forEach(function(item, index){
        if ((block == '.windowItem' && document.documentElement.clientWidth > 800) ||
            (block == '.windowPosMob' && document.documentElement.clientWidth < 800)){
            if (document.documentElement.clientWidth < 800){
                if (index == 0){
                    item.classList.remove('active');
                }
                item.addEventListener('click', (e)=>{
                    e.preventDefault();
                    if (item.classList.contains('active')){
                        document.querySelectorAll(block).forEach(function(one, num){
                            if (index == num){
                                one.style.display = 'none';
                                item.classList.remove('active');
                            }
                        });
                    } else {
                        document.querySelectorAll(items).forEach(function(some){
                            some.classList.remove('active');
                        });
                        item.classList.add('active');
                        document.querySelectorAll(block).forEach(function(one, num){
                            if (index !== num){
                                one.style.display = 'none';
                            } else {
                                one.style.display = 'block';
                            }
                        });
                    }
                    // document.querySelectorAll(items).forEach(function(some){
                    //     some.classList.remove('active');
                    // });
                });
            } else {
                item.addEventListener('click', (e)=>{
                    e.preventDefault();
                    document.querySelectorAll(items).forEach(function(some){
                        some.classList.remove('active');
                    });
                    item.classList.add('active');
                    document.querySelectorAll(block).forEach(function(one, num){
                        if (index !== num){
                            one.style.display = 'none';
                        } else {
                            one.style.display = 'block';
                        }
                    });
                });
            }
        }
    });
}
clickKat('.clickKat', '.windowItem');
// clickKat('.clickKat', '.windowPosMob');

// END HEADER





//FOOTER

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
    clickKati('.footerTitle', '.footerList');
} catch {}



// END FOOTER



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


// function closeWindow(trigger, window){
//     document.querySelector(trigger).addEventListener('click', (e)=>{
//         e.preventDefault();
//         document.querySelectorAll(window).forEach(item=>{
//             item.style.display = 'none';
//         });
//         if (trigger == '.catalog__btn--two'){
//             document.querySelector(trigger).style.display = 'none';
//             document.querySelector('.catalog__btn--one').style.display = 'block';
//         }
//     });
// }
// try{
//     closeWindow('#exitYes', '#newCard');
//     closeWindow('#exitYes', '#cardExit');
//     closeWindow('#exitClose', '#cardExit');
// } catch{}
// try{
//     closeWindow('#exitYes', '#tovarDownload');
//     closeWindow('#exitYes', '#cardExit');
//     closeWindow('#exitClose', '#cardExit');
// } catch{}
// try{
//     closeWindow('#exitNo', '#cardExit');
// } catch{}
// try{
//     closeWindow('#hood', '#iamPartner');
// } catch{}
// try{
//     closeWindow('#thanksBtn', '#thanks');
// } catch{}
// try{
//     closeWindow('#thanksClose', '#thanks');
// } catch{}

const addClick = (item, input) => {

    document.querySelector(item).addEventListener('click', () => {
        console.log('click');
        document.querySelector(input).select();
        document.querySelector(input).mousedown();
        document.querySelector(input).click();
        // document.querySelector(input).change();
        document.querySelector(input).input();
    });
}

try{
    addClick('#basket__image', '.datepicker-here')
} catch {}

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

// const showDate = (date) => {
//     const myDate = document.querySelector(date)
//     myDate.addEventListener('change', () => {
//         if (myDate.value){
//             myDate.parentElement.classList.add('active');
//         }
//     })
// }
// try{
//     showDate('.basket__date input')
// } catch{}

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

function openCloseFiler(trigger, window) {
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



// function regKol(min, plus, kol){
//     document.querySelectorAll(min).forEach((item, index) =>{
//         item.addEventListener('click', ()=>{
//             document.querySelectorAll(kol).forEach((one, num) =>{
//                 if (index == num){
//                     let k = one.textContent;
//                     if (k > 0){
//                         k--;
//                         one.textContent = k;
//                     }
//                 }
//             });
//         });
//     });
//     document.querySelectorAll(plus).forEach((item, index) =>{
//         item.addEventListener('click', ()=>{
//             document.querySelectorAll(kol).forEach((one, num) =>{
//                 if (index == num){
//                     let k = one.textContent;
//                     k++;
//                     one.textContent = k;
//                 }
//             });
//         });
//     });
// }
// try{
//     regKol('.basket__min', '.basket__plus', '.basket__num');
// } catch{}

function showWindow2(trigger, window){
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
        if (trigger == '.reg__plus'){
            if (document.querySelector(trigger).classList.contains('clicked')){
                document.querySelector(trigger).textContent = 'Добавить адрес';
                document.querySelector(trigger).classList.remove('clicked');
                document.querySelector(window).style.display = 'none';
                document.querySelector('.reg__town').style.color = '';
            } else{
                document.querySelector(window).style.display = 'block';
                document.querySelector(trigger).textContent = 'Скрыть';
                document.querySelector(trigger).classList.add('clicked');
                document.querySelector('.reg__town').style.color = '#BFC6E0';
            }
        }
        if (trigger == '.reg__plus__card'){
            if (document.querySelector(trigger).classList.contains('clicked')){
                document.querySelector(trigger).textContent = 'Добавить карту';
                document.querySelector(trigger).classList.remove('clicked');
                document.querySelector('.mine__card').style.color = '';
                document.querySelector(window).style.display = 'none';
            } else{
                document.querySelector(window).style.display = 'block';
                document.querySelector(trigger).textContent = 'Скрыть';
                document.querySelector('.mine__card').style.color = '#BFC6E0';
                document.querySelector(trigger).classList.add('clicked');
            }
        }

        if (trigger == '.reg__persone--edit'){
            if (document.querySelector(trigger).classList.contains('clicked')){
                document.querySelector(trigger).classList.remove('clicked');
                document.querySelector(window).style.display = 'none';
                document.querySelector('.reg__persone--edit img').src = 'images/edit.svg'
                document.querySelector('.reg__persone--done').style.display = 'block';
            } else {
                document.querySelector(trigger).classList.add('clicked');
                document.querySelector(window).style.display = 'block';
                document.querySelector('.reg__persone--edit img').src = 'images/personeChange.svg'
                document.querySelector('.reg__persone--done').style.display = 'none';
            }

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
    showWindow2('#tovadAdd', '#tovarDownload')
} catch{}
try{
    showWindow2('#tovarDownloadClose', '#cardExit')
} catch{}
try{
    showWindow2('#productButton', '#reviewProduct')
} catch{}
try{
    showWindow2('#addNewCard', '#newCard')
} catch{}
try{
    showWindow2('#setNew', '#newCard')
} catch{}
try{
    showWindow2('#newCardClose', '#cardExit')
} catch{}
try{
    showWindow2('.wallet__tranz a', '.wallet__tranzaction');
} catch{}
try{
    showWindow2('.wallet__add a', '.wallet__choose');
} catch{}
try{
    showWindow2('.wallet__kassaOne a', '.add__wallet');
} catch{}
try{
    showWindow2('.wallet__kassaTwo a', '.wallet__bank');
} catch{}
try{
    showWindow2('.wallet__schetOne a', '.wallet__personalData');
} catch{}
try{
    showWindow2('.wallet__schetTwo a', '.viv__schet');
} catch{}
try{
    showWindow2('.wallet__viv a', '.wallet__outmoney');
} catch{}
try{
    showWindow2('.addCard__card a', '.addCard__form--one');
} catch{}
try{
    showWindow2('.addCard__bank a', '.addCard__form--two');
} catch{}
try{
    showWindow2('.payments__add', '.payments__addCard');
} catch{}
try{
    showWindow2('.investor__delete a', '.payments__delete');
} catch{}
try{
    showWindow2('.address__add a', '.payments__addAddress');
} catch{}
try{
    showWindow2('.investor__newphoto', '.investor__addPhoto');
} catch{}
try{
    showWindow2('#photoProduct', '#productImagePopup');
} catch{}
try{
    showWindow2('.reg__plus', '.reg__plus__form');
} catch{}
try{
    showWindow2('.reg__plus__card', '.cardFormReg');
} catch{}
// try{
//     showWindow2('.reg__persone--edit', '.reg__persone--change');
// } catch{}


document.addEventListener("DOMContentLoaded", ()=>{
    document.querySelectorAll('.popular__buy a').forEach(item => {
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            let srcImage;
            const host = window.location.host;
            if (!item.parentElement.classList.contains('none')){
                if (item.classList.contains('active')) {
                    item.classList.remove('active')
                    // srcImage = 'https://unitedmarket.org/images/basket(1).svg';
                    item.style.backgroundColor = '#395DD0';
                    location.href = `https://${host}/cart`;
                } else {
                    item.style.backgroundColor = '#6ACDF8';
                    item.classList.add('active')
                    item.href = `https://${host}/cart`
                    srcImage = `https://${host}/images/doneBuy.svg`;
                }
                item.childNodes[1].src = srcImage;
            }
        });
    });
});

function showList(trigger, block){
    document.querySelector(trigger).addEventListener('click', (e)=> {
        e.preventDefault();
        e._isClickWithinDropDown = true;


    if (!document.querySelector(trigger).classList.contains('active')) {
            document.querySelectorAll('.downloadTovar__block').forEach((el) => {
                el.style.display = 'none';
            });
            document.querySelectorAll('.downloadTovar__arrow').forEach((btnEl) => {
                btnEl.classList.remove('active');
            });

            document.querySelector(trigger).classList.add('active');
            document.querySelector(block).style.display = 'block';

            document.querySelector(block).addEventListener('click', (e) => {
                e._isClickWithinDropDown = true;
            })

            document.body.addEventListener('click', (e) => {
                if (e._isClickWithinDropDown === true) return;

                document.querySelectorAll('.downloadTovar__block').forEach((el) => {
                        el.style.display = 'none';
                });
                    document.querySelectorAll('.downloadTovar__arrow').forEach((btnEl) => {
                        btnEl.classList.remove('active');
                });
            })


            return
        } else {
            document.querySelector(trigger).classList.remove('active');
            document.querySelector(block).style.display = 'none';
        }

    });
}

try{
    showList('#downloadTovarArrow1', '#downloadTovarBlock1');
} catch{}
try{
    showList('#downloadTovarArrow2', '#downloadTovarBlock2');
} catch{}

try{
    showList('#downloadOptionArrow', '#downloadOptionBlock');
} catch{}


function activePosition(inputs, block){
    document.querySelectorAll(inputs).forEach(item =>{
        item.addEventListener('change', ()=>{
            if (item.checked) {
                console.log(item.parentElement.children[1].innerText);
                if (document.querySelector(block).value.length > 0) {
                    document.querySelector(block).value = document.querySelector(block).value + ', ' + item.parentElement.children[1].innerText;
                } else
                {
                    document.querySelector(block).value = item.parentElement.children[1].innerText;
                }
            }
        });
    });
}


try{
    activePosition('.downloadTovar__block--two .promotion__br input', '#downloadTovarKategoryTwo');
} catch {}

function showWindow(trigger, window) {
    if (!document.querySelector(trigger)) return;
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelectorAll(window).forEach(item=>{
            item.style.display = 'block';
        });
        if (trigger == '.catalog__btn--one'){
            document.querySelector(trigger).style.display = 'none';
            document.querySelector('.catalog__btn--two').style.display = 'block';
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
    showWindow('#photoProduct', '#productImagePopup');
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
// try{
//     radioChange('#regDel input', '#anotherCity');
// } catch{}

function changeChecked(items, block){
    document.querySelectorAll(items).forEach(item=>{
        item.addEventListener('change', ()=>{
            document.querySelectorAll(items).forEach(one=>{
                if ((item.checked) && (one.checked) && (one !== item)){
                    one.checked = false;
                }
                console.log(item);
                if (item.classList.contains('regHim') && (item.checked)){

                    document.querySelector(block).style.display = 'block';
                } else {
                    document.querySelector(block).style.display = 'none';
                }
            });
        });
    });
}
// try{
//     changeChecked('#regWho input', '#anotherMan');
// } catch{}

function changeInput(input, block){
    document.querySelector(input).addEventListener('change', ()=>{
        if (document.querySelector(input).checked == true){
            document.querySelector(block).style.display = 'block';
        } else {
            document.querySelector(block).style.display = 'none';
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
    changeInput('.reg__time__now--two', '.basket__time');
    changeInput('.reg__time__now', null, '.basket__time');
} catch{}

try{
    const regBalance = document.querySelector('.reg__balance').textContent;
    const num = parseInt(regBalance.replace(/\D+/g,""));
    console.log(num);
    if (num <= 0){
        document.querySelector('.reg__none__money').style.display = 'block';
    }
} catch{}

const stylesChange = (arrow, input, list) => {
    const myArrow = document.querySelector(arrow);
    const myInput = document.querySelector(input);
    myArrow.addEventListener('click', ()=>{
        if (myArrow.classList.contains('active')){
            myInput.style.borderRadius = '26px';
            document.querySelector(list).style.display = 'none';
            myArrow.classList.remove('active');
        } else {
            myInput.style.borderRadius = '21px 21px 0 0';
            document.querySelector(list).style.display = 'block';
            myArrow.classList.add('active');
        }
    })
}

try{
    stylesChange('.time__arrow', '.basket__hour input', '.basket__hours');
} catch {}

const selectTime = (item, input, list, arrow) => {
    document.querySelectorAll(item).forEach(elem => {
        elem.addEventListener('click', () => {
            document.querySelector(list).style.display = 'none';
            document.querySelector(arrow).classList.remove('active');
            document.querySelector(input).value = elem.textContent;
            document.querySelector(input).style.borderRadius = '26px';
        })
    });
}

try{
    selectTime('.basket__onetime', '.basket__hour input', '.basket__hours', '.time__arrow')
} catch {}

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


// function checkedInput(inputs) {
//     document.querySelectorAll(inputs).forEach(item=>{
//         item.addEventListener('change', ()=>{
//             if (item.checked){
//                 document.querySelectorAll(inputs).forEach(one=>{
//                     if (item !== one){
//                         one.checked = false;
//                     }
//                 });
//             }
//         });
//     });
// }
//
// try{
//     checkedInput('.downloadTovar__block--one .promotion__br input');
//     checkedInput('.downloadTovar__block--two .promotion__br input');
// } catch {}

// try{
//     checkedInput('#productFlower #productChoose input');
// } catch {}


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


//
// function clickMob(items, block){
//     document.querySelectorAll(items).forEach(function(item, index){
//         item.addEventListener('change', (e)=>{
//             e.preventDefault();
//             document.querySelectorAll(block).forEach(function(one, num){
//                 if (index == num){
//                     if (e.target.checked == true){
//                         one.style.display = 'block';
//                     } else {
//                         one.style.display = 'none';
//                     }
//                 } else {
//                     if (items == '.basket__input'){
//                         one.style.display = 'none';
//                     }
//                 }
//             });
//         });
//     });
// }
// try{
//     clickMob('.promotions__mobClick', '.promotions__one');
// } catch {}
// try{
//     clickMob('#checkbox12', '#tovarHideBlock');
// } catch {}

// try{
//     clickMob('.basket__input', '.basket__two');
// } catch{}

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


function chooseText(input, textBlocks, block){
    document.querySelectorAll(textBlocks).forEach(item =>{
        item.addEventListener('click', ()=>{
            document.querySelector(input).value = item.textContent;
            document.querySelector(block).style.display = 'none';
        });
    });
}

try{
    chooseText('.kategory__choose', '.my__city', '.kategory__list')
} catch{}

function changeWidth(img, block){
    window.addEventListener('DOMContentLoaded', () => {
        if (document.documentElement.clientWidth < 500 && document.querySelector(img)){
            let myWidth = document.querySelector(img).offsetWidth;
            document.querySelectorAll(block).forEach(item => {
                item.style.left = myWidth + 10 + 'px';
            });
        }
    });
}
try{
    changeWidth('.popularImg', '.popularLike');
} catch{}


function checkedDlina(inputs, label){
    document.querySelectorAll(inputs).forEach(item=>{
        item.addEventListener('change', ()=>{
            if (item.checked){
                item.nextElementSibling.style.backgroundColor = "#0B1331";
                item.nextElementSibling.style.color = "#fff";
                document.querySelectorAll(inputs).forEach(one=>{
                    if (item !== one){
                        one.checked = false;
                        one.nextElementSibling.style.backgroundColor = "#F8F9FC";
                        one.nextElementSibling.style.color = "#0B1331";
                    }
                });
            }
        });
    });
}


try{
    checkedDlina('#productFlower #productChoose input', '.product .promotion__br .custom-checkbox + label');
} catch {}

const thumbsSlider = document.querySelector('.js-thumbs-slider');
const productSlider = document.querySelector('.js-product-slider');

if (thumbsSlider && productSlider) {
    const thumbs = new Swiper(thumbsSlider, {
        spaceBetween: 16,
        slidesPerView: 'auto',
        // loop: true,
        // loopedSlides: 'auto',
        direction: 'vertical',
        // freeMode: true,
        watchSlidesProgress: true,
    });
    const productInit = new Swiper(productSlider, {
        // loop: true,
        slidesPerView: 1,
        spaceBetween: 24,
        thumbs: {
            swiper: thumbs,
        }
    });
}


const promotionsBtnMenu = document.querySelector('.promotions__btn-menu')
const profileMenu = document.querySelector('.profile__menu')

promotionsBtnMenu.addEventListener('click', () => {
    profileMenu.classList.toggle('profile__menu--active')
})
