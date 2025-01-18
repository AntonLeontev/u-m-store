
<div class="profile__menu" wire:ignore>
    <div class="profile__menu--close" onclick="document.querySelector('.profile__menu').classList.remove('profile__menu--active');"><img src="{{ asset('/images/close.svg') }}" alt="close"></div>
    <ul>
        @if(!Str::contains(Request::path(),  'admin/site'))
            <li class="user @if(Route::is('admin.dashboard')) active @endif "><a href="{{ route('admin.dashboard') }}">Профиль</a>
            </li>
            <li @if(Route::is('admin.products')) class="active" @endif><a href="{{ route('admin.products') }}">Загрузка
                    товаров</a></li>
            <li @if(Route::is('admin.settings')) class="active" @endif><a href="{{ route('admin.settings') }}">Настройка
                    профиля</a></li>
            <li @if(Route::is('admin.orders')) class="active" @endif><a href="{{ route('admin.orders') }}">Заказы</a></li>
            <li @if(Route::is('admin.categories')) class="active" @endif><a href="{{ route('admin.categories') }}">Категории</a></li>
			
			<li><span href="" disabled>Реклама</span></li>
			<li><span href="" disabled>Маркетплейсы</span></li>
			<li><a href="{{ route('admin.accounting') }}">Бухгалтерия бесплатно</a></li>
			<li><a href="{{ route('admin.partners') }}">Партнеры</a></li>
        @endif

{{--        Меню для настрое сайтов клонов --}}
        @if(Str::contains(Request::path(),  'admin/site') )
            <li @if(Route::is('admin.site.settings')) class="active" @endif><a
                    href="{{ route('admin.site.settings') }}">Информация на сайте</a></li>
            <li @if(Route::is('admin.shop.slider')) class="active" @endif>
				<a href="{{ route('admin.shop.slider') }}">Настройки верхнего слайдера</a>
			</li>
            <li @if(Route::is('admin.shop.slider-bottom')) class="active" @endif>
				<a href="{{ route('admin.shop.slider-bottom') }}">Настройки нижнего слайдера</a>
			</li>
            <li @if(Route::is('admin.shop.promotion')) class="active" @endif>
				<a href="{{ route('admin.shop.promotion') }}">Настройки акций</a>
			</li>
			<li @if(Route::is('admin.seo.settings')) class="active" @endif>
				<a href="{{ route('admin.seo.settings') }}">Настройки SEO</a>
			</li>
        @else
			<li @if(Route::is('admin.site.settings')) class="active" @endif>
				<a href="{{ route('admin.site.settings') }}">Настройки сайта</a>
			</li>
            @if (!is_numeric($hash = Auth::user()->telegram_id))
                <li><a href="https://t.me/umhelp_bot?start={{$hash}}" target="_blank">Телеграм уведомления</a></li>
            @else
                <li><a href="" disabled style="color: #2bbf69">Телеграм уведомления Активны</a></li>
            @endif
		@endif

        <li class="exit">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Выйти</button>
            </form>
        </li>
    </ul>
</div>
