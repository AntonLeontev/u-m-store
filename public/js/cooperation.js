$(document).on('click', '.cooperation__faq__item-top', function () {
  $(this).closest('.cooperation__faq__item').toggleClass('is-active');
  $(this).siblings('.cooperation__faq__dropdown').slideToggle(300);
});
function cooperation(type=false)
{
    if(type) $('#type_cooperation').val(type)
    $('#iamPartner').css("display", "block");

}
