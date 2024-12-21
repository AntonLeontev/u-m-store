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


// Подстановка партнера в зависимости от выбранного города для цен
    $('[name=selectCity]').change(function () {
        let store_id = $(this).val();
        let product_id = ($(this).attr('id'));
        // $('[name=selectCity] option:selected').text();
        $.ajax({
            url: localhost + '/backend/products/get_partners',
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
    // Добавление цены в выбранный город.
    // Реакция на кнопку добавить опцию
    $('#addOption').on('click', function (e) {
        e.preventDefault();
        let selectOption = $('[name=selectOption]');
        let selectValue = $('[name=selectValue]');
        let options = $('[name^=option_id]');
        let options_value = $('[name^=option_value_id]')
        if (options) {
            let check = true;
            console.log(options, options_value)
            $.each(options, function (key, option) {
                console.log(option.id)
                if (option.id == selectOption.find(':selected').val()) {
                    $.each(options_value, function (key, value) {
                        if (value.id == selectValue.find(':selected').val()) {
                            return check = false;
                        }
                    });

                }
            });
            if (!check) alert('Данная опция уже существует');
            if (selectOption.val() > 0 && check) {
                $('#optionValueProduct').append('<div class="input-group mb-3">\n' +
                    '<input type="hidden" class="form-control" name="option_id_new[' + selectValue.val() + ']" \n' +
                    '      id="' + selectOption.val() + '" value="' + selectOption.val() + '">\n' +
                    '            <input type="text" class="form-control" name="option_id_new[' + selectOption.val() + ']" \n' +
                    '                   id="' + selectOption.val() + '" value="' + selectOption.find(':selected').text().trim() + '" readonly="true">\n' +
                    '                <input type="text" class="form-control" name="option_value_id_new[' + selectValue.val() + ']" className=""\n' +
                    '                       id="' + selectValue.val() + '" placeholder=""\n' +
                    '                       value="' + selectValue.find(':selected').text() + '" readonly="true">\n' +
                    '                    <input type="text" class="form-control" name="option_price_new[' + selectValue.val() + ']"\n' +
                    '                           value="" placeholder="Для удалиния оставьте поле пустым" size="35" onkeyup="this.value=this.value.replace(/[^0-9.]/g,\'\')">\n' +
                    '        </div>');
            } else if (check) alert('Выберите опции.')

        }

        // console.log(store_id)
        // alert(store_id);
        //Если выбран город и партнер то добавляем.


        // console.log('addPrice')

    });
//Значения опций для выбранной опции.
    $('[name=selectOption]').change(function (e) {
        // optionValueSelected.append('<option value="0">arr[i]</option>');
        let option_value_id = $(this).val();
        console.log(option_value_id)

        $.ajax({
            url: localhost + '/backend/products/get_option_value',
            type: "POST",
            data: {option_value_id: option_value_id}
            ,
            headers: {
                'X-CSRF-Token':
                    $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                let option_value = $.parseJSON(data);
                console.log(option_value)

                if (option_value) {

                    $('[name=selectValue]').empty()
                    //Добавляем партнеров в select
                    $.each(option_value, function (key, value) {
                        $('[name=selectValue]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                } else alert('У данной опции нет значений');

            },


        });


    });
    //Реакция на нажатие удалить опцию
    $('.delOption').on('click', function (e) {
        e.preventDefault();
        if(confirm("Вы точно хотите удалить эту опцию?")){
            // console.log($(this).attr('id'));
            option_value_id = $(this).attr('id');
            $.ajax({
                url: localhost + '/backend/products/del_option_value',
                type: "POST",
                data: {option_value_id: option_value_id},
                headers: {
                    'X-CSRF-Token':
                        $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    let option = data;
                    console.log(option)
                    if (option) {
                        $('div#'+option_value_id).empty()
                    } else alert('При удалении опции возникла ошибка!')
                },
            });

        };
    });


//Реакция на нажатие добавить цену в город
    $('#addPrice').on('click', function (e)
    {
        e.preventDefault();
        let selectCity = $('[name=selectCity]');
        let selectPatner = $('[name=selectPartner]');
        let store_id = $('[name^=store_name]');
        let partner_id = $('[name^=partner_id_price]')
        if(selectCity.find(':selected').val() == 0)
        {
            $('#storesPrice').append(
               '<div class="input-group mb-3">\n' +
               '<input type="text" class="form-control"' + 'value="Одна цена во всех городах" readOnly="true">\n' +
               '<input type="text" class="form-control" name="total_price"' + 'value="" onkeyup="this.value=this.value.replace(/[^0-9.]/g,\'\')">'+
               ' </div>');
        }
        else
        {

        if (store_id) {
            let check = true;
            console.log(store_id)
            $.each(store_id, function (key, store) {
                // console.log(store.id)
                if (store.id == selectCity.find(':selected').val())
                {
                    $.each(partner_id, function (key, partner) {
                        if (partner.id == selectPatner.find(':selected').val()) {
                            alert('Данный город и партнер уже есть в списке.\nНайдите его и установите цену если нужно.')
                            return check = false;
                        }
                    });

                }
            });

            if (selectCity.val() >= 0 && check)
            {
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
                    '                           value="" placeholder="Для удаления оставьте поле пустым" size="36" onkeyup="this.value=this.value.replace(/[^0-9.]/g,\'\')">\n' +
                    '                        <input type="text" class="form-control" name=""\n' +
                    '                               value="Наценка из таб. partners" size="24" readonly="true">\n' +
                    '        </div>');
            } else if (check) alert('Выберите город и партнера!')

        }
        }
    });


});







