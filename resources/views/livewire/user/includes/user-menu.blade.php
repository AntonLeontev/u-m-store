<div class="profile__menu">
    <ul>
        <li class="user @if (Route::is('user.dashboard')) active @endif"><a
                href="{{ route('user.dashboard') }}">Профиль</a></li>
        <li class="@if (Route::is('user.settings')) active @endif"><a href="{{ route('user.settings') }}">Настройки
                Профиля</a></li>
        <li class="@if (Route::is('user.notifications')) active @endif"><a
                href="{{ route('user.notifications') }}">Уведомления</a></li>
        @if (!session()->has('domain'))
            <li id="menuArrowOne" class="menu__arrow menu__arrow--one">
                <a class="@if (Route::is('user.delivery') || Route::is('user.orders-history')) clicked @endif" href="#">Заказы</a>
                <div id="hideListOne" class="hide__list hide__list--one">
                    <ul>
                        <li class="@if (Route::is('user.delivery')) active @endif"><a
                                href="{{ route('user.delivery') }}">Доставки</a></li>
                        <li class="@if (Route::is('user.orders-history')) active @endif"><a
                                href="{{ route('user.orders-history') }}">История заказов</a></li>
                        {{--                    <li class="@if (Route::is('user.review')) active @endif"><a href="{{route('user.review')}}">Отзывы</a></li> --}}
                    </ul>
                </div>
            </li>
            <li id="menuArrowTwo" class="menu__arrow menu__arrow--two"><a
                    class="@if (Route::is('user.delivery') || Route::is('user.orders-history')) clicked @endif" href="#">Бонусы и промокоды</a>
                <div id="hideListTwo" class="hide__list hide__list--two">
                    <ul>
                        <li class="@if (Route::is('user.bonus')) active @endif"><a
                                href="{{ route('user.bonus') }}">Бонусы</a></li>
                        <li class="@if (Route::is('user.promo')) active @endif"><a
                                href="{{ route('user.promo') }}">Промокоды</a></li>
                    </ul>
                </div>
            </li>
            <li class="@if (Route::is('user.referral')) active @endif">
				<a href="{{ route('user.referral') }}">Реферальная программа</a>
			</li>
			@if (auth()->user()->partner_id)
				<li class="@if (Route::is('admin.dashboard')) active @endif">
					<a href="{{ route('admin.dashboard') }}">Кабинет партнера</a>
				</li>
			@endif
        @endif
        <li class="exit"><a href="{{ route('logout') }}">Выйти</a></li>
    </ul>
</div>

@push('footer')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush

@if (Route::is('user.delivery') || Route::is('user.orders-history') || Route::is('user.review'))
    @push('footer')
        <script>
            document.querySelector('#hideListOne').style.display = 'block';
        </script>
    @endpush
@elseif(Route::is('user.promo') || Route::is('user.bonus'))
    @push('footer')
        <script>
            document.querySelector('#hideListTwo').style.display = 'block';
        </script>
    @endpush
@endif
