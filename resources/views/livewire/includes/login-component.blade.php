<div class="header__lk">
    {{--                    <div class="header__bonus">--}}
    {{--                        <a href="#">--}}
    {{--                            <div class="header__img">--}}
    {{--                                <img src="{{ asset('images/bonus.svg') }}" alt="bonus">--}}
    {{--                            </div>--}}
    {{--                            <div class="header__name">Бонус</div>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    <div class="header__main">
        <a href="/">
            <div class="header__img">
                <img src="{{asset('images/headerLogo.svg')}}" alt="logo">
            </div>
        </a>
    </div>

    @if(Route::has('login'))
        @auth
            @if(Auth::user()->utype === 'ADM')
                <div class="header__profile" style="display: block !important;margin: 0;">
                    <a href="{{ route('admin.dashboard') }}">
                        <div class="header__img">
                            <svg width="34" height="53" viewBox="0 0 34 53" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle class="colorBorder" cx="17" cy="15" r="14" fill="white"
                                        stroke="#BFC6E0" stroke-width="2"/>
                                <mask id="mask0" style="mask-type:alpha"
                                      maskUnits="userSpaceOnUse"
                                      x="2" y="0" width="30" height="30">
                                    <circle cx="17" cy="15" r="15" fill="white"/>
                                </mask>
                                <g mask="url(#mask0)">
                                    <circle class="colorCircle" cx="17" cy="36.5895" r="16.1364"
                                            fill="#BFC6E0"/>
                                </g>
                                <circle class="colorCircle" cx="17" cy="12.2738" r="6.36364"
                                        fill="#BFC6E0"/>
                            </svg>
                        </div>
                        {{--                                        <div class="header__name">Профиль</div>--}}
{{--                        @if($new_orders_count)--}}
{{--                            <div class="profile__circle">{{ $new_orders_count }}</div>--}}
{{--                        @endif--}}
                    </a>
                    {{--                                    <div class="profileZakaz" id="profileZakazId">--}}
                    {{--                                        <div class="profileZakaz__name">Новое уведомление:</div>--}}
                    {{--                                        <div class="profileZakaz__description">Изменения по Вашему заказу</div>--}}
                    {{--                                        <div class="profileZakaz__link">--}}
                    {{--                                            <a href="#">Перейти к сообщению</a>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="profileZakaz__close" id="profileZakazClose">--}}
                    {{--                                            <img src="images/close.svg" alt="">--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    <div class="item__profile">
                        <ul>
                            <li><a href="{{ route('admin.products') }}">Загрузка товаров
                                    (услуг)</a>
                            </li>
                            <li><a href="{{ route('admin.settings') }}">Настройки профиля</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders') }}">Заказы({{ $new_orders_count }}
                                    )</a></li>
                            {{--                                            <li><a href="#">Склад</a></li>--}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="header__profile" style="display: block !important">
                    <a href="{{ route('user.dashboard') }}">
                        <div class="header__img">
                            <svg width="34" height="53" viewBox="0 0 34 53" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <circle class="colorBorder" cx="17" cy="15" r="14" fill="white"
                                        stroke="#BFC6E0" stroke-width="2"/>
                                <mask id="mask0" style="mask-type:alpha"
                                      maskUnits="userSpaceOnUse"
                                      x="2" y="0" width="30" height="30">
                                    <circle cx="17" cy="15" r="15" fill="white"/>
                                </mask>
                                <g mask="url(#mask0)">
                                    <circle class="colorCircle" cx="17" cy="36.5895" r="16.1364"
                                            fill="#BFC6E0"/>
                                </g>
                                <circle class="colorCircle" cx="17" cy="12.2738" r="6.36364"
                                        fill="#BFC6E0"/>
                            </svg>
                        </div>
                        {{--                                        <div class="header__name">Профиль</div>--}}
                        {{--                                        <div class="profile__circle">0</div>--}}
                    </a>
                    <div class="item__profile">
                        <ul>

                            <li><a href="{{ route('user.settings') }}">Настройки профиля</a>
                            </li>
                            @unless(session()->has('domain'))
                                <li><a href="{{ route('user.notifications') }}">Уведомления (
                                        <div class="item__uved">0</div>
                                        )</a></li>
                                <li><a href="{{ route('user.orders-history') }}">История заказов</a>
                                </li>
                                <li><a href="{{ route('user.bonus') }}">Бонусы</a></li>
                            @endunless
                            <li>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        @else
            <div class="header__login" id="headerLogin1">
                @unless(session()->has('domain'))
                    <a href="{{route('auth')}}">
                        @else
                            <a href="{{route('login')}}">
                                @endunless
                                <div class="header__img">
                                    <svg width="18" height="19" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M3.631 13.373c1.563-.9 3.45-1.373 5.37-1.373 1.919 0 3.805.474 5.368 1.373 1.562.9 2.75 2.197 3.3 3.738a1 1 0 01-1.883.672c-.361-1.01-1.182-1.967-2.415-2.676C12.14 14.397 10.603 14 9.001 14c-1.604 0-3.14.398-4.372 1.107-1.232.709-2.053 1.665-2.415 2.677a1 1 0 11-1.883-.673c.55-1.54 1.738-2.839 3.3-3.738zM9 2a3 3 0 100 6 3 3 0 000-6zM4 5a5 5 0 1110 0A5 5 0 014 5z"/>
                                    </svg>
                                </div>
                                <div class="header__name">Войти</div>
                            </a>
            </div>
        @endif
    @endif
    @livewire('includes.wishlist-count-component')
    @livewire('includes.cart-count-component')

</div>
