$(function () {
    //localhost сайта или локалки.
    let localhost = (window.location.origin);
    // console.log(localhost)
// мультивыбор категорий из скиска без нажатия ctrl
    $('.myselect > option').mousedown(function (e) {
        e.preventDefault();
        $(this).prop('selected', !$(this).prop('selected'));
        return false;
    });
    // end ctrl

    var optVal = $('#optionValueProduct').hide()
    optVal.show(2000)
    // .animate({
    //     'font-size': '40px'
    //
    // }, 1000);

    var options = $('#option').on()

// Подстановка партнера в зависимости от выбранного города для цен
    $('[name=selectCity]').change(function () {
        let store_id = $(this).val();
        let product_id = ($(this).attr('id'));
        // $('[name=selectCity] option:selected').text();
        $.ajax({
            url: localhost+'/backend/products/get_partners',
            type: "POST",
            data: {store_id: store_id}
            ,
            headers: {
                'X-CSRF-Token':
                    $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                let partners = $.parseJSON(data);
                // console.log($.each(partners, function (key, partner){'<option value="' + partner.id + '">' + partner.organisation_name + '</option>'}));
                // console.log(partner.organisation_name);
                if (partners) {

                    $('[name=selectPartner]').empty()
                    //Добавляем партнеров в select
                    $.each(partners, function (key, partner) {
                        $('[name=selectPartner]').append('<option value="' + partner.id + '">' + partner.organisation_name + '</option>');
                    });
                } else alert('В данном городе нет партнера!\nВыберите другой город.' +
                    '')

            },


        });


    });
    //    Добавление цены в выбранный город.
    $('#addPrice').on('click', function (e) {
        e.preventDefault();
        let selectCity = $('[name=selectCity]');
        let selectPatner = $('[name=selectPartner]');
        let store_id = $('[name^=store_name]');
        let partner_id = $('[name^=partner_id_price]')
        if (store_id) {
            let check = true;
            console.log(store_id)
            $.each(store_id, function (key, store) {
                 // console.log(store.id)
                if (store.id == selectCity.find(':selected').val()) {
                    $.each(partner_id, function (key, partner) {
                        if (partner.id == selectPatner.find(':selected').val()) {
                            alert('Данный город и партнер уже есть в списке.\nНайдите его и установите цену если нужно.')
                            return check = false;
                        }
                    });

                }
            });
            if (selectCity.val() > 0 && check) {
                $('#storesPrice').append('<div class="input-group mb-3">\n' +
                    '<input type="hidden" class="form-control" name="store_id_price[' + selectPatner.val() + ']"\n' +
                    'value="' + selectCity.val() + '" readOnly="true">\n' +
                    '            <input type="text" class="form-control" name="store_name[' + selectCity.val() + ']" className=""\n' +
                    '                   id="' + selectCity.val() + '" placeholder=""\n' +
                    '                   value="' + selectCity.find(':selected').text() + '" readonly="true">\n' +
                    '                <input type="text" class="form-control" name="partner_id_price[' + selectPatner.val() + ']" className=""\n' +
                    '                       id="' + selectPatner.val() + '" placeholder=""\n' +
                    '                       value="' + selectPatner.find(':selected').text() + '" readonly="true">\n' +
                    '                    <input type="text" class="form-control" name="partner_price_new[' + selectPatner.val() + ']"\n' +
                    '                           value="" placeholder="Для удалинея цены оставте поле пустым" size="36">\n' +
                    '                        <input type="text" class="form-control" name=""\n' +
                    '                               value="Наценка из таб. partners" size="24" readonly="true">\n' +
                    '        </div>');
            } else if (check) alert('Выберите город и партнера!')

        }

        // console.log(store_id)
        // alert(store_id);
        //Если выбран город и партнер то добавляем.


        // console.log('addPrice')

    });


});

//Опции в товарах
$('option#option').click(function () {
    var optionSelectId = $(this).val();
    var optionValueSelected = $('select#optionValueSelected');
    console.log(optionSelectId);
    // optionValueSelected.append('<option value="0">arr[i]</option>');
    $.ajax({
        url: localhost+'/backend/products/get_options',
        type: "POST",
        data: {id: optionSelectId}
        ,
        headers: {
            'X-CSRF-Token':
                $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {

            options = $.parseJSON(data)
            console.log(options);
            let arrOption = data.option_value;

            // console.log(arr);
            // optionValueSelected.empty()
            // // arrOption.forEach (function (arr){
            // //     optionValueSelected.append('<option value="'+arr['id']+'">'+arr['name']+'</option>');
            //     // console.log(arr[i]['id']);
            //     // console.log(arr[i]['name']);
            // });
            // for(item in data.option_value){
            //     console.log(item['id']);
            //     console.log(item['name']);
            //     optionValueSelected.append('<option value="'+item['id']+'">'+item['name']+'</option>');
            // };
        },


    });
});



