<b>{{ $appName }}</b> ({{ $level_name }})
Адрес сайта: {{config('app.url')}}

===============================

<b>ТЕХНИЧЕСКАЯ ИНФ.</b>
##############################
Текущий URL: {{url()->previous()}}
IP пользователя: {{request()->ip()}}
Session_id: {{session()->getId()}}

##############################
@if (Auth::check())
    <b>ДАННЫЕ ПОЛЬЗОВАТЕЛЯ:</b>
    _________________________________
    Имя: <b>{{auth()->user()->name}}</b>
    Телефон: <b>{{auth()->user()->phone}}</b>
    E-mail: <b>{{auth()->user()->email}}</b>
    Id пользователя: <b>{{auth()->user()->id}}</b>
    Id партнера: <b>{{auth()->user()->partner_id ? auth()->user()->partner_id : 'Не партнер или не активирован'}}</b>
    Зарегистрирован: <b>{{auth()->user()->created_at->format('d-m-Y H:i:s')}}</b>
    _________________________________
    @if(auth()->user()->partner_id)
        @php
            $partner = \App\Models\Partners::find(auth()->user()->partner_id);
            if ($partner)
            {
                $city = \App\Models\Store::find($partner->store_id);
                if($city) $city = $city->real_name;
                $direction = \App\Models\Directions::find($partner->direction_id);
                if($direction) $direction=$direction->name;

            }

        @endphp
        <b>ДАННЫЕ ПАРТНЕРА</b>
        ================================
        Id партнера: <b>{{auth()->user()->partner_id}}</b>
        Город: <b>{{$city}}</b>
        Телефон Магазина: <b>{{$partner->telephone}}</b>
        Название на сайте: <b>{{$partner->organisation_name}}</b>
        Название организации: <b>{{$partner->partner_name}}</b>
        E-mail: <b>{{$partner->email}}</b>
        Тип: <b>{{$partner->partner_type}}</b>
        Cфера услуг: <b>{{$direction}}</b>
        ================================
    @endif
@endif

Env: {{ $appEnv }}
[{{ $datetime->format('d-m-Y H:i:s') }}] {{ $appEnv }}.{{ $level_name }} {{ $formatted }}

