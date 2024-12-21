<b>{{$title}}</b>
##########################
<b>ИНФОРМАЦИЯ О ЗАКАЗЕ.</b>
@foreach($order_info as $key=>$value)
<b>{{$key}}:</b> {!!$value!!}
@endforeach
##########################
##########################
@if($partner_info)
<b>ИНФОРМАЦИЯ О ПАРТНЕРЕ.</b>
@foreach($partner_info as $key=>$value)
<b>{{$key}}:</b> {!! $value !!}
@endforeach
##########################
##########################
@endif
<b>ИНФОРМАЦИЯ О ТОВАРЕ в заказе.</b>
@foreach($order_product_array as $key=>$value)
№{{$key+1}}
    @foreach($value as $key_in=>$value_in)
    <b>{{$key_in}}:</b> {!! $value_in !!}
    @endforeach
@endforeach
*********************************
<b>СТОИМОСТЬ ДОСТАВКИ ДЛЯ КЛИЕНТА:</b>
<b>{{$order_info['ЦЕНА ДОСТАВКИ ДЛЯ КЛИЕНТА']}}</b>
<b>ЗАКАЗ НА ОБЩУЮ СУММУ:</b>
<b>{{$order_info['ЗАКАЗ НА СУММУ']}}</b>

