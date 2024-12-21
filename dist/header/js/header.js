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
clickKat('.clickKat', '.windowPosMob');