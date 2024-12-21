
<div class="profile__menu" wire:ignore>
    <div class="profile__menu--close" onclick="document.querySelector('.profile__menu').classList.remove('profile__menu--active');"><img src="{{ asset('/images/close.svg') }}" alt="close"></div>
    <ul>
        @if(!Str::contains(Request::path(),  'admin/site'))
            <li class="user @if(Route::is('admin.dashboard')) active @endif "><a href="{{ route('admin.dashboard') }}">Профиль</a>
            </li>
            <li @if(Route::is('admin.products')) class="active" @endif><a href="{{ route('admin.products') }}">Загрузка
                    товаров (услуг)</a></li>
            <li @if(Route::is('admin.settings')) class="active" @endif><a href="{{ route('admin.settings') }}">Настройка
                    профиля</a></li>
            <li @if(Route::is('admin.orders')) class="active" @endif><a href="{{ route('admin.orders') }}">Заказы</a></li>
            <li @if(Route::is('admin.categories')) class="active" @endif><a href="{{ route('admin.categories') }}">Категории</a></li>
{{--            <li><a href="{{ route('soc.auth', ['service' => 'vk']) }}">привязать vk.com</a></li>--}}
{{--            <li><a href="{{ route('soc.auth', ['service' => 'ya']) }}">привязать yandex.ru</a></li>--}}
{{--            <li><a href="{{ route('soc.auth', ['service' => 'google']) }}">привязать google.com</a></li>--}}
{{--            <li><a href="{{ route('soc.auth', ['service' => 'ok']) }}">привязать ok.ru</a></li>--}}

            @if (session()->has('partner_info') and session('partner_info')['type'])
{{--                <li><a href="{{ route('download.contract') }}">Скачать договор</a></li>--}}
            @endif
        @endif

{{--        Меню для настрое сайтов клонов --}}
        @if(Str::contains(Request::path(),  'admin/site') )
            <li @if(Route::is('admin.site.settings')) class="active" @endif><a
                    href="{{ route('admin.site.settings') }}">Информация на сайте</a></li>
            <li @if(Route::is('admin.shop.slider')) class="active" @endif><a
                    href="{{ route('admin.shop.slider') }}">Настройки слайдера</a></li>
                            <li @if(Route::is('admin.seo.settings')) class="active" @endif><a
                                    href="{{ route('admin.seo.settings') }}">Настройки SEO</a></li>
        @else
{{--        @if(Route::is('admin.products'))--}}
{{--            {{$site_status}}--}}
{{--            @if(session()->has('partner_info') and session('partner_info')['site_status']=='ALLOWED')--}}
                <li @if(Route::is('admin.site.settings')) class="active" @endif>
                    <a href="{{ route('admin.site.settings') }}">Настройки сайта</a></li>
{{--        @endif--}}


{{--        @endif--}}
{{--        @if(Route::is('admin.settings'))--}}
            @if (!is_numeric($hash = Auth::user()->telegram_id))
                <li><a href="http://t.me/umhelp_bot?start={{$hash}}">Телеграм уведомления</a></li>
            @else
                <li><a href="" disabled style="color: #2bbf69">Телеграм уведомления Активны</a></li>
            @endif
{{--        @endif--}}
            @endif
        {{--        <li><a href="#">Склад</a></li>--}}

        <li class="exit">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Выйти</button>
            </form>
            {{--            <a href="{{ route('logout') }}">Выйти</a>--}}
        </li>
    </ul>
</div>
