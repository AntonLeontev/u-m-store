new AirDatepicker('#airdatepicker', {
    // position: 'right top'
});




document.addEventListener('DOMContentLoaded', () => {

    const umsPpopupAddAddressBtnSave = document.querySelector('.umsp-popup-add-address__btn-save')

    umsPpopupAddAddressBtnSave.addEventListener('click', function() {
        document.querySelector('#umspPopupAddAddress').style.display = 'none'
    })


    // const test = document.querySelector('#telegram-login-MarglebBot')
    //
    // const test2 = test.contentWindow.document
    //
    //
    // test2.addEventListener('DOMContentLoaded', () => {
    //     const qwe = document.querySelector('.tgme_widget_login_button')
    //     alert("DOM готов!");
    //     console.log(qwe)
    //     console.log(test2)
    // })


    // test2.classList.add('test')
    // const qwer = test2.getElementsByClassName('bdtn')


    // console.log(test)
    // console.log(test2)


})


