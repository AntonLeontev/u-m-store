<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>HTML Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            line-height: 100%;
        }

        [style*="Open Sans"] {font-family: 'Open Sans', arial, sans-serif !important;}

        img {
            outline: none;
            text-decoration: none;
            border:none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%!important;
            margin: 0;
            padding: 0;
            display: block;
        }

        table td {
            border-collapse: collapse;
        }

        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        .logo{
            padding-top: 21px;
            padding-bottom: 15px;
        }
        .header-td{
            border-bottom: 1px solid #EAEDF6;
        }
        .new__title{
            font-weight: bold;
            font-size: 22px;
            line-height: 160%;
            text-align: center;
            letter-spacing: 0.05em;
            color: #3657C8;
            padding-top: 12px;
            padding-bottom: 2px;
        }
        .new__yes{
            font-weight: 600;
            font-size: 16px;
            line-height: 160%;
            text-align: center;
            letter-spacing: 0.03em;
            color: #0B1331;
            padding-bottom: 28px;
        }
        .new__info{
            font-weight: bold;
            font-size: 16px;
            line-height: 140%;
            text-align: center;
            letter-spacing: 0.05em;
            color: #0B1331;
            padding-bottom: 20px;
        }
        .table__name{
            padding-top: 18px;
            padding-bottom: 23px;
            font-weight: bold;
            font-size: 14px;
            line-height: 140%;
            text-align: center;
            letter-spacing: 0.05em;
            color: #0B1331;
        }
        .tovar__name{
            font-size: 14px;
            line-height: 140%;
            color: #3657C8;
            width: 114px;
        }
        .table__kol{
            font-size: 14px;
            line-height: 140%;
            text-align: right;
            width: 50px;
            color: #0B1331;
        }
        .table__price{
            font-size: 14px;
            line-height: 140%;
            text-align: right;
            width: 80px;
            color: #0B1331;
        }
        .table-465 td:first-child{
            padding-left: 13px;
        }
        .table-465 td:last-child{
            padding-right: 13px;
        }
        .table-465 td{
            padding-bottom: 16px;
        }
        .table__sum{
            text-align: left;
            font-weight: bold;
            font-size: 14px;
            line-height: 140%;
            letter-spacing: 0.05em;
            color: rgba(13, 36, 60, 0.67);
        }
        .table__allprice{
            text-align: right;
        }
        .table-two{
            border-bottom: 1px solid rgba(0, 0, 0, 0.09);
        }
        .table__one{
            float: right;
            font-weight: bold;
            font-size: 12px;
            line-height: 140%;
            text-align: right;
            letter-spacing: 0.05em;
            color: #22B07D;
            padding-top: 12px;
        }
        td.padding__none{
            padding-bottom: 0 !important;
        }
        .table__finalprice{
            font-weight: bold;
            font-size: 19px;
            line-height: 140%;
            text-align: right;
            letter-spacing: 0.05em;
            color: #0D243C;
        }
        .last__tr{
            padding-bottom: 23px;
        }
        .table-500{
            margin-bottom: 24px;
        }
        .table__naming{
            font-size: 14px;
            line-height: 140%;
            color: #8F94A9;
            float: left;
            padding-left: 30px;
            padding-top: 16px;
        }
        .table__position{
            font-size: 14px;
            line-height: 140%;
            color: #0B1331;
            text-align: left;
            width: 206px;
            padding-top: 16px;
        }
        .table-500-two tr:first-child td{
            padding-top: 20px;
        }
        .table-500-two tr:last-child td{
            padding-bottom: 20px;
        }
        .table-500{
            margin-left: auto;
            margin-right: auto;
        }
        .table-465{
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
{{--<div style="font-size:0px;font-color:#ffffff;opacity:0;visibility:hidden;width:0;height:0;display:none;">Тестовое письмо</div>--}}
<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
    <tr>
        <td>
            <table class="main table-540" cellpadding="0" cellspacing="0" width="540" align="center">
                <tr>
                    <td heigth="21" width="540"></td>
                </tr>
                <tr>
                    <td class="header-td" bgcolor="#ffffff">
                        <table class="table-85" cellpadding="0" cellspacing="0" width="88" align="center">
                            <tr>
                                <td align="center" class="logo">
{{--                                    <img src="{{asset('images/logo.svg')}}" alt="">--}}
                                    <svg width="151" height="71" viewBox="0 0 151 71" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M89.0986 0.0183999C86.5849 0.0161828 84.1025 0.575904 81.833 1.65662C79.5635 2.73733 77.5643 4.31171 75.9816 6.26457C73.7886 3.55083 70.8079 1.58408 67.4502 0.635386C64.0926 -0.313311 60.5234 -0.197249 57.2344 0.967574C53.9455 2.1324 51.0989 4.28864 49.0868 7.13911C47.0747 9.98959 45.9962 13.394 46 16.8831V44.3662C46 46.3541 46.7897 48.2606 48.1954 49.6663C49.601 51.0719 51.5075 51.8616 53.4954 51.8616V16.8831C53.4954 14.3982 54.4825 12.0151 56.2396 10.258C57.9967 8.50092 60.3798 7.51381 62.8647 7.51381C65.3496 7.51381 67.7327 8.50092 69.4897 10.258C71.2468 12.0151 72.2339 14.3982 72.2339 16.8831V38.7447C72.2339 39.7386 72.6288 40.6919 73.3316 41.3947C74.0344 42.0975 74.9877 42.4924 75.9816 42.4924C76.9756 42.4924 77.9288 42.0975 78.6317 41.3947C79.3345 40.6919 79.7293 39.7386 79.7293 38.7447V16.8831C79.7293 14.3982 80.7164 12.0151 82.4735 10.258C84.2306 8.50092 86.6137 7.51381 89.0986 7.51381C91.5835 7.51381 93.9666 8.50092 95.7237 10.258C97.4807 12.0151 98.4678 14.3982 98.4678 16.8831V51.8616C100.456 51.8616 102.362 51.0719 103.768 49.6663C105.174 48.2606 105.963 46.3541 105.963 44.3662V16.8831C105.963 12.4103 104.186 8.12068 101.024 4.95795C97.861 1.79521 93.5714 0.0183999 89.0986 0.0183999Z" fill="#1955A0"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M85.3507 12.5117V37.4964C85.3507 39.9813 84.3636 42.3644 82.6065 44.1215C80.8494 45.8785 78.4663 46.8657 75.9814 46.8657C73.4965 46.8657 71.1134 45.8785 69.3564 44.1215C67.5993 42.3644 66.6122 39.9813 66.6122 37.4964V12.5117C64.6243 12.5117 62.7178 13.3014 61.3121 14.7071C59.9065 16.1127 59.1168 18.0192 59.1168 20.0071V37.4964C59.1168 41.9692 60.8936 46.2588 64.0563 49.4215C67.219 52.5843 71.5086 54.3611 75.9814 54.3611C80.4542 54.3611 84.7438 52.5843 87.9065 49.4215C91.0693 46.2588 92.8461 41.9692 92.8461 37.4964V20.0071C92.8461 18.0192 92.0564 16.1127 90.6507 14.7071C89.2451 13.3014 87.3386 12.5117 85.3507 12.5117Z" fill="#E61D4D"/>
                                        <path d="M8.79474 60.4986V66.7265C8.83766 67.3037 8.7594 67.8835 8.565 68.4287C8.37061 68.9739 8.06437 69.4725 7.66593 69.8923C6.74842 70.6428 5.5787 71.0142 4.3963 70.9303C3.21438 71.0102 2.04607 70.6393 1.12667 69.8923C0.733191 69.4696 0.431036 68.9703 0.239056 68.4256C0.0470774 67.8809 -0.0306078 67.3025 0.0108413 66.7265V60.4986H2.11275V66.6097C2.05938 67.2903 2.25282 67.9673 2.65768 68.517C3.12771 68.919 3.72589 69.14 4.3444 69.14C4.96292 69.14 5.56109 68.919 6.03112 68.517C6.43598 67.9673 6.62942 67.2903 6.57606 66.6097V60.4727L8.79474 60.4986Z" fill="#1955A0"/>
                                        <path d="M22.1193 60.4961V70.7721H19.6541L16.0601 64.7259L15.1778 63.0521H15.1648L15.2167 64.8297V70.7721H13.2964V60.4961H15.7357L19.3297 66.5164L20.225 68.2161H20.2509L20.186 66.4385V60.4961H22.1193Z" fill="#1955A0"/>
                                        <path d="M28.9821 60.4961H26.8282V70.7721H28.9821V60.4961Z" fill="#1955A0"/>
                                        <path d="M41.7916 60.4961V62.2217H38.3533V70.7721H36.2124V62.2217H32.7482V60.4961H41.7916Z" fill="#1955A0"/>
                                        <path d="M45.5769 70.7721V60.4961H53.2839V62.2217H47.7177V64.7778H52.1032V66.4255H47.7177V69.0464H53.5045V70.7721H45.5769Z" fill="#1955A0"/>
                                        <path d="M65.1569 61.8338C64.6547 61.3752 64.0645 61.0236 63.422 60.8005C62.7796 60.5775 62.0985 60.4876 61.4202 60.5363H57.4499V70.8123H61.4202C62.0985 70.8611 62.7796 70.7712 63.422 70.5481C64.0645 70.3251 64.6547 69.9735 65.1569 69.5149C66.0136 68.4329 66.4797 67.0933 66.4797 65.7132C66.4797 64.3332 66.0136 62.9936 65.1569 61.9116V61.8338ZM63.5091 68.1914C63.2332 68.4929 62.8926 68.7277 62.5127 68.8783C62.1329 69.0289 61.7238 69.0913 61.3164 69.0607H59.6037V62.2101H61.3164C61.7247 62.1821 62.1342 62.2469 62.5139 62.3997C62.8937 62.5525 63.2339 62.7893 63.5091 63.0924C64.0617 63.8397 64.3287 64.7602 64.2616 65.6873C64.307 66.5838 64.0412 67.4685 63.5091 68.1914Z" fill="#1955A0"/>
                                        <path d="M88.6305 60.4961V70.7721H86.6973V65.4135L86.8011 62.4163H86.7622L83.9207 70.7721H82.1561L79.3277 62.4163H79.2887L79.4055 65.4135V70.7721H77.4593V60.4961H80.5732L82.4156 66.1012L83.0773 68.4237H83.1033L83.778 66.1142L85.6074 60.4961H88.6305Z" fill="#1955A0"/>
                                        <path d="M98.4891 60.4961H95.8942L92.1445 70.7721H94.3372L95.1806 68.268H99.073L99.9293 70.7721H102.161L98.4891 60.4961ZM95.7385 66.6721L96.7375 63.7528L97.1657 62.2217L97.6328 63.7787L98.5929 66.6721H95.7385Z" fill="#1955A0"/>
                                        <path d="M111.903 66.5057C112.547 66.3538 113.117 65.9786 113.511 65.4466C113.906 64.9146 114.099 64.2602 114.057 63.5994C114.074 63.1704 113.991 62.7433 113.816 62.3516C113.64 61.9599 113.376 61.6142 113.044 61.3418C112.266 60.7436 111.3 60.4444 110.32 60.4984H105.792V70.7744H107.907V66.882H109.801L112.214 70.7744H114.627L111.903 66.5057ZM110.073 65.2082H107.907V62.2241H110.073C111.267 62.2241 111.864 62.7171 111.864 63.7161C111.864 64.7152 111.267 65.1953 110.073 65.1953V65.2082Z" fill="#1955A0"/>
                                        <path d="M120.545 60.4961V65.3746L124.775 60.4961H127.266L123.568 64.6869L127.382 70.7721H124.93L122.011 66.0752L120.545 67.736V70.7721H118.404V60.4961H120.545Z" fill="#1955A0"/>
                                        <path d="M130.989 70.7721V60.4961H138.696V62.2217H133.143V64.7778H137.516V66.4255H133.143V69.0464H138.917V70.7721H130.989Z" fill="#1955A0"/>
                                        <path d="M151 60.4961V62.2217H147.562V70.7721H145.408V62.2217H141.957V60.4961H151Z" fill="#1955A0"/>
                                    </svg>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="info-td" bgcolor="#ffffff">
                        <table class="table-165" cellpadding="0" cellspacing="0" width="100%" align="center">
                            <tr>
                                <td class="new__title" style="font-family: 'Open Sans', sans-serif;">Новый заказ</td>
                            </tr>
                            <tr>
                                <td class="new__yes" style="font-family: 'Open Sans', sans-serif;">Заказ принят и подтвержден</td>
                            </tr>
                            <tr>
                                <td class="new__info" style="font-family: 'Open Sans', sans-serif;">Информация о заказе</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="table__tovar" bgcolor="#ffffff">
                        <table class="table-500" cellpadding="0" cellspacing="0" width="500" align="center" bgcolor="#F4F6FA">
                            <tr>
                                <td class="table__name" align="center" style="font-family: 'Open Sans', sans-serif;">Товары</td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table-465" cellpadding="0" cellspacing="0" width="465" align="center">
                                        @if($order_products)
                                            @foreach($order_products as $item)
                                                <tr>
                                                    <td class="tovar__name" style="font-family: 'Open Sans', sans-serif;">{{ $item->name }}</td>
                                                    <td class="table__kol" style="font-family: 'Open Sans', sans-serif;">{{ $item->quantity }} шт</td>
                                                    <td class="table__price" style="font-family: 'Open Sans', sans-serif;">{{ number_format($item->price, 0, '','') }} ₽</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table-465" cellpadding="0" cellspacing="0" width="465" align="center">
                                        <tr>
                                            <td class="padding__none">
                                                <table class="table-465 table-two" cellpadding="0" cellspacing="0" width="465" align="center">
                                                    <tr>
                                                        <td class="table__sum" style="font-family: 'Open Sans', sans-serif;">Сумма</td>
                                                        <td class="table__sum table__allprice" style="font-family: 'Open Sans', sans-serif;">{{ $options->subtotal }} ₽</td>
                                                    </tr>
{{--                                                    <tr>--}}
{{--                                                        <td class="table__sum" style="font-family: 'Open Sans', sans-serif;">Доставка</td>--}}
{{--                                                        <td class="table__sum table__allprice" style="font-family: 'Open Sans', sans-serif;">250 ₽</td>--}}
{{--                                                    </tr>--}}
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="padding__none">
                                    <table class="table-465" cellpadding="0" cellspacing="0" width="465" align="center">
                                        <tr>
                                            <td class="padding__none">
                                                @if(session('coupon'))
                                                <table class="table-465" cellpadding="0" cellspacing="0" width="465" align="center">
                                                    <tr>
                                                        <td class="table__one" style="font-family: 'Open Sans', sans-serif;">- {{ session('checkout')['discount'] }} ₽</td>
                                                    </tr>
                                                </table>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="last__tr">
                                <td class="padding__none">
                                    <table class="table-465" cellpadding="0" cellspacing="0" width="465" align="center">
                                        <tr>
                                            <td class="table__sum" style="font-family: 'Open Sans', sans-serif;">Итого</td>
                                            <td class="table__sum table__finalprice" style="font-family: 'Open Sans', sans-serif;">{{ $options->total }}  ₽</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table class="table-500 table-500-two" cellpadding="0" cellspacing="0" width="500" align="center" bgcolor="#F4F6FA">
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Номер заказа</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">{{ $options->id }}</td>
                            </tr>
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Дата заказа</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">{{ $options->created_at }}</td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Способ оплаты</td>--}}
{{--                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;"></td>--}}
{{--                            </tr>--}}
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Способ доставки</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">
                                    {{ $options->is_shipping_different === \App\Enums\StatusEnum::SELF_DELIVERY? 'Самовывоз': 'Курьерская доставка'}}
                                </td>
                            </tr>
                            @if($options->email != null)
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">E-mail</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">{{ $options->email }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Телефон</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">{{ $options->mobile }}</td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">IP-адрес</td>--}}
{{--                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">192.168.0.1</td>--}}
{{--                            </tr>--}}
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Состояние заказа</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">Подтвержден</td>
                            </tr>
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Получатель</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">{{ $options->firstname }} {{ $options->lastname }}</td>
                            </tr>
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Комментарий</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">{{ $options->comment }}</td>
                            </tr>
                            <tr>
                                <td class="table__naming" style="font-family: 'Open Sans', sans-serif;">Адрес доставки</td>
                                <td class="table__position" style="font-family: 'Open Sans', sans-serif;">
                                    @if($options->is_shipping_different === \App\Enums\StatusEnum::DELIVERY)
                                        {{ $options->city }},
                                    @endif
                                        {{ $options->address }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>




