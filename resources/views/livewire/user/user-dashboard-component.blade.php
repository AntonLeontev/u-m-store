@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>Профиль</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Профиль</div>
                    <div class="profile__wrapper">
                        @include('livewire.user.includes.user-menu')
                        <div class="profile__bigboxing">
                            <div class="promotions__choose" id="promotionsChoose">Меню</div>
                            @include('livewire.user.includes.user-mobile-menu')
                            <div class="profile__info">
                                <div class="profile__item">
                                    <div class="profile__description">Личная информация</div>
                                    <div class="profile__row">
                                        <div class="profile__one">Имя:</div>
                                        <div class="profile__one">{{ $user->name }}</div>
                                    </div>
                                    <div class="profile__row">
                                        <div class="profile__one">Фамилия:</div>
                                        <div class="profile__one">{{ $user->surname }}</div>
                                    </div>
                                    <div class="profile__row">
                                        <div class="profile__one">Телефон:</div>
                                        <div class="profile__one">{{ $user->phone }}</div>
                                    </div>
                                    <div class="profile__row">
                                        <div class="profile__one">E-mail:</div>
                                        <div class="profile__one">{{ $user->email }}</div>
                                    </div>
                                    <div class="profile__more">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class="profile__exit" type="submit">Выйти</button>
                                        </form>
                                    </div>
                                    <div class="profile__set">
                                        <a href="{{ route('user.settings') }}"><img src="{{ asset('images/set.svg') }}"
                                                                                    alt="set"></a>
                                    </div>
                                </div>
                                <div class="profile__item">
                                    <div class="profile__description">Доставки</div>
                                    @if($orders)
                                        @foreach($orders as $order)
                                            <div class="profile__row">
                                                <div class="profile__one">Дата:</div>
                                                <div
                                                    class="profile__one">{{ Date::parse($order->created_at)->format('d.m.Y') }}</div>
                                            </div>
                                            <div class="profile__row">
                                                <div class="profile__one">Номер заказа:</div>
                                                <div class="profile__one">{{ $order->id }}</div>
                                            </div>
                                        @endforeach
                                        <div class="profile__more">
                                            <a href="{{ route('user.delivery') }}">Подробнее</a>
                                        </div>

                                    @endif
                                </div>
                                <div class="profile__item">
                                    <div class="profile__description">Бонусы</div>
                                    <div class="profile__row">
                                        <div class="profile__one">Количество бонусов:</div>
                                        <div class="profile__one">{{ $user_bonuses_count }}</div>
                                    </div>
                                    <div class="profile__row">
                                        <div class="profile__one profile__italic">Вы можете оплатить ими до 50% заказа
                                        </div>
                                    </div>
{{--                                    <div class="profile__row">--}}
{{--                                        <div class="profile__one profile__active">Активные промокоды:</div>--}}
{{--                                        <div class="profile__one">--}}

{{--                                        </div>--}}

{{--                                    </div>--}}
                                    <div class="profile__more">
                                        <a href="{{ route('user.bonus') }}">Подробнее</a>
                                    </div>
                                </div>

                                <div class="profile__item">
                                    <div class="profile__description">Активные промокоды</div>
                                    <div class="profile__nochek" style="display: block">
                                    </div>
                                    @if($active_promo)
                                        @foreach($active_promo as $promo)
                                            <div class="profile__chek">
                                                <div class="profile__row">
                                                    <div class="profile__one">Промокод:</div>
                                                    <div class="profile__one">{{ $promo->code }}</div>
                                                </div>
                                                <div class="profile__row">
                                                    <div class="profile__one">Скидка:</div>
                                                    <div
                                                        class="profile__one">
                                                        {{ $promo->discount}} @if($promo->type === 'F') <span class="ruble-icon">₽</span> @else % @endif
                                                        </div>
                                                </div>
                                                <div class="profile__row">
                                                    <div class="profile__one">Доступен до:</div>
                                                    <div
                                                        class="profile__one">{{ Date::parse($promo->date_end)->format('d.m.Y') }}</div>
                                                </div>
                                                <br>
                                                @endforeach

												<div class="profile__more">
												   <a href="{{ route('user.promo') }}">Подробнее</a>
												</div>
                                            </div>
                                            @endif
                                </div>
                                {{--                                <div class="profile__item">--}}
                                {{--                                    <div class="profile__description">Электронные чеки</div>--}}
                                {{--                                    <div class="profile__nochek" style="display: block">--}}
                                {{--                                        <div class="profile__row">--}}
                                {{--                                            <div class="profile__one profile__active">Все Ваши чеки будут отображаться в этом разделе</div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="profile__chek" style="display: none">--}}
                                {{--                                        <div class="profile__row">--}}
                                {{--                                            <div class="profile__one">Дата:</div>--}}
                                {{--                                            <div class="profile__one">20.06.2021</div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="profile__row">--}}
                                {{--                                            <div class="profile__one">Номер заказа:</div>--}}
                                {{--                                            <div class="profile__one">123456</div>--}}
                                {{--                                        </div>--}}
                                {{--                                        <div class="profile__row">--}}
                                {{--                                            <div class="profile__one">Сумма:</div>--}}
                                {{--                                            <div class="profile__one">100 000 р</div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="profile__more">--}}
                                {{--                                        <a href="#">Подробнее</a>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
}
