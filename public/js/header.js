// function showWindow(trigger, window){
//     document.querySelector(trigger).addEventListener('click', (e)=>{
//         e.preventDefault();
//         document.querySelectorAll(window).forEach(item=>{
//             item.style.display = 'block';
//         });
//         if (trigger == '.catalog__btn--one'){
//             document.querySelector(trigger).style.display = 'none';
//             document.querySelector('.catalog__btn--two').style.display = 'block';
//         }
//     });
// }
// showWindow('#headerCity', '#cityWindow');

if (document.documentElement.clientWidth < 600) {
    document.querySelector(".header__city").textContent = "";
    document.querySelector(".header__phone a").textContent = "";
}

function clickcity(city, input, itog) {
    document.querySelectorAll(city).forEach((item) => {
        item.addEventListener("click", () => {
            item.classList.remove("active");
            document.querySelector(input).value = item.textContent;
            document.querySelector(itog).textContent = item.textContent;
            document.querySelectorAll(city).forEach((block) => {
                block.classList.remove("active");
                item.classList.add("active");
            });
            if (document.documentElement.clientWidth > 800) {
                document.querySelector(".header__city").textContent =
                    item.textContent;
            }
        });
    });
}
clickcity(".cityPosition", "#citySearch", "#cityItog");

function closeWindow(trigger, window) {
    if (document.querySelector(trigger)) {
        document.querySelector(trigger).addEventListener("click", (e) => {
            e.preventDefault();
            document.querySelectorAll(window).forEach((item) => {
                item.style.display = "none";
            });
            if (trigger == ".catalog__btn--two") {
                document.querySelector(trigger).style.display = "none";
                document.querySelector(".catalog__btn--one").style.display =
                    "block";
            }

            const catalogBtn = document.getElementById("headerA");
            if (catalogBtn && catalogBtn.classList.contains("active"))
                catalogBtn.classList.remove("active");
        });
    }
}
closeWindow("#windowClose", "#headerWindow");

function showHideBlock(block) {
    document.getElementById(block).style.display = "block";
}

// try{
//     showHideBlock('profileZakazId');
// } catch{}
// try{
//     showHideBlock('headerSignInId');
// } catch{}

function showKatalog(trigger, window) {
    document.querySelector(trigger).addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector(window).style.display = "flex";
        if (document.querySelector(trigger).classList.contains("active")) {
            document.querySelector(trigger).classList.remove("active");
            document.querySelector(".header__window").style.display = "none";
        } else {
            document.querySelector(trigger).classList.add("active");
        }
    });
}
try {
    showKatalog("#headerA", "#headerWindow");
} catch {}

try {
    showKatalog("#headerMobMenu", "#headerWindow");
} catch {}

// function ShowMyCity(input, cities){
//     document.querySelector(input).addEventListener('input', ()=>{
//         let inputValue = document.querySelector(input).value;
//         document.querySelectorAll(cities).forEach(item =>{
//             let myItem = item.textContent.toLowerCase();
//             let myReg = new RegExp(inputValue.toLowerCase());
//             let result = myItem.match(myReg);
//             if (result !== null){
//                 item.style.display = 'block';
//                 document.querySelector('.city ul').style.columnCount = 'auto';
//             } else {
//                 item.style.display = 'none';
//             }
//         });
//     });
// }
// try{
//     ShowMyCity('.city__search', '.city__position');
// } catch{}

function clickKat(items, block) {
    document.querySelectorAll(items).forEach(function (item, index) {
        if (
            (block == ".windowItem" &&
                document.documentElement.clientWidth > 800) ||
            (block == ".windowPosMob" &&
                document.documentElement.clientWidth < 800)
        ) {
            if (document.documentElement.clientWidth < 800) {
                if (index == 0) {
                    item.classList.remove("active");
                }
                item.addEventListener("click", (e) => {
                    e.preventDefault();
                    if (item.classList.contains("active")) {
                        document
                            .querySelectorAll(block)
                            .forEach(function (one, num) {
                                if (index == num) {
                                    one.style.display = "none";
                                    item.classList.remove("active");
                                }
                            });
                    } else {
                        document
                            .querySelectorAll(items)
                            .forEach(function (some) {
                                some.classList.remove("active");
                            });
                        item.classList.add("active");
                        document
                            .querySelectorAll(block)
                            .forEach(function (one, num) {
                                if (index !== num) {
                                    one.style.display = "none";
                                } else {
                                    one.style.display = "block";
                                }
                            });
                    }
                });
            } else {
                item.addEventListener("click", (e) => {
                    e.preventDefault();
                    document.querySelectorAll(items).forEach(function (some) {
                        some.classList.remove("active");
                    });
                    item.classList.add("active");
                    document
                        .querySelectorAll(block)
                        .forEach(function (one, num) {
                            if (index !== num) {
                                one.style.display = "none";
                            } else {
                                one.style.display = "block";
                            }
                        });
                });
            }
        }
    });
}
clickKat(".clickKat", ".windowItem");
clickKat(".clickKat", ".windowPosMob");

const headerInfo = document.querySelector(".header__info");
const closeHeaderInfo = document.querySelector(".js-close-header-info");

if (headerInfo) {
    closeHeaderInfo.addEventListener("click", () => {
        headerInfo.remove();
    });
}
