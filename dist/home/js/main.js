// const p = new Promise((r)=>{
//     setTimeout(()=>{
//         console.log(1);
//         r();
//     }, 2000);
// });

// p.then(()=>{
//     return new Promise((r1) =>{
//         setTimeout(()=>{
//             console.log(2);
//             r1();
//         }, 2000);
//     })
// }).then(()=>{
//     setTimeout(()=>{
//         console.log(3);
//     }, 2000);
// });

function changeRub(blocks){
    if (document.documentElement.clientWidth < 500){
        document.querySelectorAll(blocks).forEach(item=>{
            let rubStroka = item.textContent;
            item.textContent = rubStroka.replace('₽', 'P');
            console.log(rubStroka);
        });
    }
}
try{
    changeRub(".popular__price");
} catch{}
try{
    changeRub(".popular__oldprice");
} catch{}


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
try{
    showWindow('.catalog__btn--one', '.catalog__hide');
} catch{}

try{
    showWindow('#reviewArrow1', '#reviewItems')
} catch{}
try{
    showWindow('#reviewArrow2', '#reviewCategory')
} catch{}
try{
    showWindow('#addNewCard', '#newCard')
} catch{}
try{
    showWindow('#newCardClose', '#cardExit')
} catch{}

showWindow('.header__city', '.city');


function copyText(input, btn){
    document.querySelector(btn).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelector(input).select();
        document.execCommand("copy");
    });
}

try{
    copyText('.ref__form input', '.ref__btn')
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
    copyTextAll('.promo__name input', '.promo__btn')
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
try{
    changeWidth('.popular__img', '.popular__like');
} catch{}

function closeWindow(trigger, window){
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
try{
    closeWindow('.catalog__btn--two', '.catalog__hide');
} catch{}
try{
    closeWindow('#exitYes', '#newCard');
    closeWindow('#exitYes', '#cardExit');
    closeWindow('#exitClose', '#cardExit');
} catch{}
try{
    closeWindow('#exitNo', '#cardExit');
} catch{}
closeWindow('.window__close', '.header__window');
closeWindow('.city__close', '.city');


function openCloseFiler(trigger, window){
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        if (document.querySelector(trigger).classList.contains('clicked')){
            document.querySelectorAll(window).forEach(item=>{
                item.style.display = 'none';
                document.querySelector(trigger).classList.remove('clicked')
            });
        } else {
            document.querySelector(trigger).classList.add('clicked')
            document.querySelectorAll(window).forEach(item=>{
                item.style.display = 'block';
            });
        }
    });
}
try {
    openCloseFiler('.promotions__choose', '.promotions__hide');
} catch{}
try {
    openCloseFiler('.menu__arrow--one', '.hide__list--one');
} catch{}
try {
    openCloseFiler('.menu__arrow--two', '.hide__list--two');
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
try{ 
    clickKati('.footer__title', '.footer__list');
} catch {}


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
                }
            });
        });
    });
}
try{ 
    clickMob('.promotions__mobClick', '.promotions__one');
} catch {}


function showBlock(input, block, values) {
    document.querySelector(input).addEventListener('input',function() {
        document.querySelector(block).style.display = 'block';
        if (document.querySelector(input).value.length == 0){
            document.querySelectorAll(values).forEach(item => {
                item.style.display = 'block';
            });
        }
        document.querySelectorAll(values).forEach(function(item){
            let k = 0;
            for (i = 0; i < document.querySelector(input).value.length; i++){
                console.log(item.textContent[i]);
                if (item.textContent[i].toUpperCase() == document.querySelector(input).value[i].toUpperCase()){
                    k++;
                } 
            }
            if (k == document.querySelector(input).value.length){
                item.style.display = 'block';
            } else{
                item.style.display = 'none';
            }
        });
    });
}

showBlock('.city__search', '.city__list', '.city__position');

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
clickcity('.city__position', '.city__search', '.city__itog');


function clickKat(items, block){
    document.querySelectorAll(items).forEach(function(item, index){
        if ((block == '.window__item' && document.documentElement.clientWidth > 800) || 
            (block == '.window__posmob' && document.documentElement.clientWidth < 800)){
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
clickKat('.click__kat', '.window__item');
clickKat('.click__kat', '.window__posmob');


function clickText(trigger){
    document.querySelectorAll(trigger).forEach(item => {
        item.addEventListener('click', ()=>{
            textnum = item.childNodes.length-2;
            if (item.childNodes[textnum].style.display == 'block'){
                item.childNodes[textnum].style.display = 'none';
            } else{
                item.childNodes[textnum].style.display = 'block';
            }
        });
    });
}
try{
    clickText('.flowers__list li');
} catch{}

if (document.documentElement.clientWidth < 600){
    document.querySelector('.header__city').textContent = '';
    document.querySelector('.header__phone a').textContent = '';
}

function showKatalog(trigger, window){
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelector(window).style.display = 'flex';
    });
}
try{
    showKatalog('.header__a', '.header__window');
} catch{}

try{
    showKatalog('.header__mobmenu', '.header__window');
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
    changeColorPink('.popular__like');
} catch {}

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
    // document.querySelectorAll(all).forEach(item=>{
    //     if (item.checked == true){
    //         document.querySelector(checkbox).checked = true;
    //     }
    // });
}
try{
    selectAll('.basket__everything input', '.basket__item input');
} catch{}

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
    radioChange('.reg__del input', '.another__city');
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
    changeChecked('.reg__who input', '.another__man');
} catch{}

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
    changeInput('.reg__choose input', '.another__me');
    changeInput('.reg__him', '.another__man');
} catch{}

// function cardForm(card){
//     console.log(12);
//     let card = document.querySelector(card);
//     card.addEventListener('change', ()=>{
//         card.value = /(\d{4}([-]|)\d{4}([-]|)\d{4}([-]|)\d{4})/;
//     })
// }
// try{
//     cardForm('.reg__card input');
// } catch{}

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
    changeColor('.flowers__sort ul li a')
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