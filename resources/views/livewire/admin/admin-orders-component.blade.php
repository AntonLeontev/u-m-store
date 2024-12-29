@push('head')
    <link rel="stylesheet" href="{{asset('css/file.css')}}">
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <a href="#" class="major__btn-prev"></a>
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><span>Профиль</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Заказы</div>
                    <div class="profile__wrapper">
                        @include('livewire.admin.includes.main-menu')
                        <div class="tovar__inner">

                            @include('livewire.admin.includes.mobile-main-menu')



                            <div class="tovar__wrapper tovar__wrapper--partner">
                                <div class="investorOrder__month">
                                    <div class="map__block map__block--partner">
                                        <div class="map__input map__input--partner">
                                            <select name="" id="" style="color: #0B1331;
                                                    border: 2px solid #BFC6E0;
                                                    border-radius: 4px;
                                                    padding: 13px 22px;"
                                                    selected="0" wire:change="selectMonth($event.target.value)">
                                                <option value="0">Все</option>
                                                <option value="1">Январь</option>
                                                <option value="2">Февраль</option>
                                                <option value="3">Март</option>
                                                <option value="4">Апрель</option>
                                                <option value="5">Май</option>
                                                <option value="6">Июнь</option>
                                                <option value="7">Июль</option>
                                                <option value="8">Август</option>
                                                <option value="9">Сентябрь</option>
                                                <option value="10">Октябрь</option>
                                                <option value="11">Ноябрь</option>
                                                <option value="12">Декабрь</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if($orders)
                                <div class="investorOrder__final">
                                    <div class="investorOrder__uno">
                                        <div class="investorOrder__pos">Количество заказов</div>
                                        <div class="investorOrder__pos">{{ count($orders) }}</div>
                                    </div>
                                    <div class="investorOrder__uno">
                                        <div class="investorOrder__pos">Сумма</div>
                                        <div class="investorOrder__pos">{{ $total }} ₽</div>
                                    </div>
{{--                                    <div class="investorOrder__uno">--}}
{{--                                        <div class="investorOrder__pos">Начислено на балланс</div>--}}
{{--                                        <div class="investorOrder__pos">0 ₽</div>--}}
{{--                                    </div>--}}
                                </div>
                                @endif
                                <div class="tovar__item tovar__top tovar__item--partner">
                                    <div class="tovar__one">Дата</div>
                                    <div class="tovar__one">№ заказа</div>
                                    <div class="tovar__one">Название</div>
                                    <div class="tovar__one">Количество</div>
                                    <div class="tovar__one">Сумма</div>
                                    <div class="tovar__one">Доставка</div>
                                </div>
                            </div>
                                @if($orders)
                                    @foreach($orders as $order)

                                    <div class="tovar__unit">

                                        <div class="tovar__item tovar__item--partner" @if(!$order->read_status) style="font-weight: bold" @endif>
                                            <div class="tovar__data">{{ Date::parse($order->created_at)->format('d.m.Y, H:i') }}</div>
                                            <div class="tovar__num">{{ $order->id }}</div>


                                            <div class="tovar__name">
                                                @foreach($order->products as $product)
                                                    <a href="{{ $product->link }}" target="_blank"> {{ $product->name }}</a>
                                                    <br>
                                                @endforeach
                                            </div>
                                            <div class="tovar__kategory">
                                                @foreach($order->products as $product)
                                                    {{ $product->quantity }} <br>
                                                @endforeach
                                            </div>
                                            <div class="tovar__price">
                                                @foreach($order->products as $product)
                                                {{ $product->total }} <span class="ruble-icon">₽</span> <br>
                                                @endforeach
                                            </div>

                                            <div class="tovar__delivery">
                                                <select id="status" class="form-control" wire:change="updateStatus({{$order->id}},$event.target.value)" style="background: #fff;
                                                            {{$order->status === \App\Enums\StatusEnum::DELIVERED || $order->status === \App\Enums\StatusEnum::PAYED ? 'color: green' : 'color: red'}}
                                                    ">
                                                    @if ($order->status === \App\Enums\StatusEnum::PAYED)
                                                        <option selected value="{{ \App\Enums\StatusEnum::PAYED }}" style="color: yellowgreen;">Оплачен</option>
                                                        <option value="{{ \App\Enums\StatusEnum::DELIVERED }}" style="color: green;">Доставлен</option>
                                                        <option value="{{ \App\Enums\StatusEnum::CANCELED }}" style="color: red;">Отменён</option>
                                                    @elseif($order->status === \App\Enums\StatusEnum::DELIVERED)
                                                        <option  value="{{ \App\Enums\StatusEnum::PAYED }}" style="color: yellowgreen;">Оплачен</option>
                                                        <option selected value="{{ \App\Enums\StatusEnum::DELIVERED }}" style="color: green;">Доставлен</option>
                                                        <option value="{{ \App\Enums\StatusEnum::CANCELED }}" style="color: red;">Отменён</option>
                                                    @elseif($order->status === \App\Enums\StatusEnum::ORDERED)
                                                        <option value="{{ \App\Enums\StatusEnum::ORDERED }}" style="color: yellowgreen;">Новый</option>
                                                        <option value="{{ \App\Enums\StatusEnum::PAYED }}" style="color: yellowgreen;">Оплачен</option>
                                                        <option value="{{ \App\Enums\StatusEnum::DELIVERED }}" style="color: green;">Доставлен</option>
                                                        <option value="{{ \App\Enums\StatusEnum::CANCELED }}" style="color: red;">Отменён</option>
                                                    @else
                                                        <option  value="{{ \App\Enums\StatusEnum::PAYED }}" style="color: yellowgreen;">Оплачен</option>
                                                        <option  value="{{ \App\Enums\StatusEnum::DELIVERED }}" style="color: green;">Доставлен</option>
                                                        <option selected value="{{ \App\Enums\StatusEnum::CANCELED }}" style="color: red;">Отменён</option>

                                                    @endif

                                                </select>
                                               {{ $order->city }} {{ $order->is_shipping_different === \App\Enums\StatusEnum::SELF_DELIVERY ? 'Самовывоз: ' . $order->address : 'Доставка: '. $order->address }}
                                                <br>
                                                Телефон покупателя: {{ $order->user_phone }}
                                                Телефон получателя: {{ $order->mobile }}
                                                <br>
                                                @if($order->comment)
                                                    Комментарий к заказу:  {{ $order->comment }}
                                                @endif
                                                Время доставки:
                                                @if($order->delivery_date)
                                                    {{ Date::parse($order->delivery_date)->format('d.m.Y, H:i') }}
                                                @else
                                                    По готовности
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tovar__mob tovar__mob--partner">
                                            <div class="tovar__one">
                                                <div class="tovar__info" @if(!$order->read_status) style="font-weight: bold" @endif>
                                                    <div class="tovar__row">
                                                        <div class="tovar__data">Дата</div>
                                                        <div class="tovar__when">{{ Date::parse($order->created_at)->format('d.m.Y, H:i') }}</div>
                                                    </div>
                                                    <div class="tovar__row">
                                                        <div class="tovar__naz">Название</div>
                                                        <div class="tovar__name">
                                                            @foreach($order->products as $product)
                                                                <a href="{{ $product->link }}" target="_blank" style="white-space: normal;"> {{ $product->name }}</a>
                                                                <br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="tovar__row">
                                                        <div class="tovar__data">Количество</div>
                                                        <div class="tovar__kategory">
                                                            @foreach($order->products as $product)
                                                                {{ $product->quantity }} <br>
                                                            @endforeach</div>
                                                    </div>

                                                    <div class="tovar__row">
                                                        <div class="tovar__sum">Сумма</div>
                                                        <div class="tovar__money">
                                                            @foreach($order->products as $product)
                                                                {{ $product->total }} <span class="ruble-icon">₽</span> <br>
                                                            @endforeach</div>
                                                    </div>
                                                    <div class="tovar__row">
                                                        <div class="tovar__pos">Статус</div>
                                                        <div class="tovar__description">
                                                            <select id="status" class="form-control" wire:change="updateStatus({{$order->id}},$event.target.value)" style="background: #fff;
                                                            {{$order->status === \App\Enums\StatusEnum::DELIVERED || $order->status === \App\Enums\StatusEnum::PAYED ? 'color: green' : 'color: red'}}
                                                                        ">
                                                                @if ($order->status === \App\Enums\StatusEnum::PAYED)
                                                                    <option selected value="{{ \App\Enums\StatusEnum::PAYED }}" style="color: yellowgreen;">Оплачен</option>
                                                                    <option value="{{ \App\Enums\StatusEnum::DELIVERED }}" style="color: green;">Доставлен</option>
                                                                    <option value="{{ \App\Enums\StatusEnum::CANCELED }}" style="color: red;">Отменён</option>
                                                                @elseif($order->status === \App\Enums\StatusEnum::DELIVERED)
                                                                    <option  value="{{ \App\Enums\StatusEnum::PAYED }}" style="color: yellowgreen;">Оплачен</option>
                                                                    <option selected value="{{ \App\Enums\StatusEnum::DELIVERED }}" style="color: green;">Доставлен</option>
                                                                    <option value="{{ \App\Enums\StatusEnum::CANCELED }}" style="color: red;">Отменён</option>
                                                                @else
                                                                    <option  value="{{ \App\Enums\StatusEnum::PAYED }}" style="color: yellowgreen;">Оплачен</option>
                                                                    <option  value="{{ \App\Enums\StatusEnum::DELIVERED }}" style="color: green;">Доставлен</option>
                                                                    <option selected value="{{ \App\Enums\StatusEnum::CANCELED }}" style="color: red;">Отменён</option>

                                                                @endif

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="tovar__row">
                                                        <div class="tovar__dos">Доставка</div>
                                                        <div class="tovar__description" style="white-space: normal;">
                                                            {{ $order->is_shipping_different === \App\Enums\StatusEnum::SELF_DELIVERY ? 'Самовывоз: ' . $order->address : 'Доставка: '. $order->address }}
                                                            <br>
                                                            Телефон покупателя: {{ $order->user_phone }} <br>
                                                            Телефон получателя: {{ $order->mobile }}
                                                            <br>
                                                            @if($order->comment)
                                                                    Комментарий к заказу:  {{ $order->comment }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
