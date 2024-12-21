const umPayBtn = document.querySelector('.um-pay__btn');
const umPayBtnIcon = document.querySelector('.um-pay__btn i');
const umPayBtnAdd = document.querySelector('.um-pay__btn-add');
const umPayBtnNone = document.querySelector('.um-pay__btn-none');
const umAddCart = document.querySelector('.um-addcart');
const umPayForm = document.querySelector('#um-pay-form');
const umPayPopapCode = document.querySelector('.um-pay-popap-code');
const umPayPopapCodeBtnClose = document.querySelector('.um-pay-popap-code__btn-close');


umPayBtn.addEventListener('click', () => {
    umPayBtnIcon.classList.toggle('icon-um-pluse4')
    umPayBtnIcon.classList.toggle('icon-um-minus')
    umPayBtn.classList.toggle('um-pay__btn--black')
    umPayBtnAdd.classList.toggle('um-pay__btn--block')
    umPayBtnNone.classList.toggle('um-pay__btn--block')
    umAddCart.classList.toggle('um-addcart--show')
})

umPayForm.addEventListener('submit', () => {
    umPayPopapCode.classList.add('um-pay-popap-code--active')
})

umPayPopapCodeBtnClose.addEventListener('click', () => {
    umPayPopapCode.classList.remove('um-pay-popap-code--active')
})