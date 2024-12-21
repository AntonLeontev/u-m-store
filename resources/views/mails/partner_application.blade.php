<table>
    @if(session()->has('operator'))
        <tr style="background-color: #f8f8f8;">
            <td style="padding: 10px; border: #e9e9e9 1px solid;"><b>Ссылка оператора:</b></td>
            <td style="padding: 10px; border: #e9e9e9 1px solid;">{{session()->get('operator')}}</td>
        </tr>
    @endif
    @foreach($options as $key=>$value )
        @if($key=='_token')
            @continue
        @endif
        <tr style="background-color: #f8f8f8;">
            <td style="padding: 10px; border: #e9e9e9 1px solid;"><b> {{$key }}</b></td>
            <td style="padding: 10px; border: #e9e9e9 1px solid;">{!! $value !!}</td>
        </tr>
    @endforeach
</table>
