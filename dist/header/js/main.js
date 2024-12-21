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
showWindow('#headerLogin', '#signInBlock');
showWindow('#headerSignInId', '#signInBlock');
showWindow('#signInBtn', '#regSign');
showWindow('#signInReg', '#regSign');
showWindow('#regSignEmail', '#pochtaBlock');
showWindow('#numberBlockEmail', '#pochtaBlock');

if (document.documentElement.clientWidth < 600){
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
closeWindow('#cityClose', '#cityWindow');
closeWindow('#signInBtn', '#signInBlock');
closeWindow('#signInReg', '#signInBlock');
closeWindow('#signinClose', '#signInBlock');
closeWindow('#regSignClose', '#regSign');
closeWindow('#regSignEmail', '#regSign');
closeWindow('#pochtaBlockClose', '#pochtaBlock');
closeWindow('#numberBlockClose', '#numberBlock');
closeWindow('#numberBlockEmail', '#numberBlock');
closeWindow('#mailBlockClose', '#mailBlock');
closeWindow('#profileZakazClose', '#profileZakazId');

function showHideBlock(block){
    document.getElementById(block).style.display = 'block';
}

// try{
//     showHideBlock('profileZakazId');
// } catch{}
// try{
//     showHideBlock('headerSignInId');
// } catch{}

function showKatalog(trigger, window){
    document.querySelector(trigger).addEventListener('click', (e)=>{
        e.preventDefault();
        document.querySelector(window).style.display = 'flex';
    });
}
try{
    showKatalog('#headerA', '#headerWindow');
} catch{}

try{
    showKatalog('#headerMobMenu', '#headerWindow');
} catch{};

function ShowMyCity(input, cities){
    document.querySelector(input).addEventListener('input', ()=>{
        let inputValue = document.querySelector(input).value;
        document.querySelectorAll(cities).forEach(item =>{
            let myItem = item.textContent.toLowerCase();
            let myReg = new RegExp(inputValue.toLowerCase());
            let result = myItem.match(myReg);
            if (result !== null){
                item.style.display = 'block';
                document.querySelector('.city ul').style.columnCount = 'auto';
            } else {
                item.style.display = 'none';
            }
        });
    });
}
try{
    ShowMyCity('.city__search', '.city__position');
} catch{}

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
clickKat('.clickKat', '.windowPosMob');

function numberCode(){
    let k = 0;
    $('.number input').keyup(function(){
        if($(this).val().match(/^\d{1}$/)){
          $(this).next('input').focus();
        }else{
          $(this).val('');
        }
        if($(this).val().length !== 0){
            k++;
        } else {
            k--;
        }
    });
}
try{
    numberCode();
} catch{}


function codeAgain(block, parentBlock, anotherBlock){
    setInterval(() => {
        if (document.querySelector(block).textContent >= 1){
            let time = document.querySelector(block).textContent - 1;
            if (time < 10){
                time = `0${time}`;
            }
            document.querySelector(block).textContent = time;
        } else {
            document.querySelector(parentBlock).style.display = 'none';
            document.querySelector(anotherBlock).style.display = 'block';
        }
    }, 1000);
}
try{
    codeAgain('.number__time', '.number__new', '.number__again');
} catch{}