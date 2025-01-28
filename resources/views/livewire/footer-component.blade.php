<div>
    <footer class="footer">
        <div class="container">
            <div class="footer__inner">
                <div class="footer__wrapper">
                    <div class="footer__major">
                        <div class="footer__logo">
                            <a href="/">
								@if (request()->fullUrlIs('*onionmarket*') || request()->fullUrlIs('*u-m.loc*'))
									<img height="70" src="{{asset('/onion/img/logo_m.webp')}}" alt="logo">
								@else	
									<img src="{{ asset('images/footerlogo-notext.svg') }}" alt="logo">
								@endif
                            </a>
                            <div class="footer__description">
                                Конструктор интернет-магазинов
                            </div>
                        </div>
                    </div>
                    <div class="footer__buy">
                        <div class="footer__title footerTitle">Покупателям</div>
                        <ul class="footer__list footerList">
                            {{-- <li><a href="{{route('info',['slug'=> 'katalog'])}}">Каталог</a></li> --}}
{{--                            <li><a href="{{route('info',['slug'=> 'dostavka'])}}">Доставка</a></li>--}}
                            <li><a href="{{route('info',['slug'=> 'oplata'])}} ">Оплата</a></li>
{{--                            <li><a href="#">Как сделать заказ</a></li>--}}
{{--                            <li><a href="{{route('info',['slug'=> 'politika-konfidencialnosti'])}}">Политика--}}
{{--                                    Конфиденциальности</a></li>--}}
                            {{-- <li><a href="#">Гарантия качества</a></li> --}}
                            {{-- <li><a href="{{route('info',['slug'=> 'referalnaya-programma'])}}">Реферальная программа</a> --}}
                            </li>
                        </ul>
                        <div class="footer__title footerTitle footer__none" style="margin-top: 32px;">партнерам</div>
                        <ul class="footer__list footerList footer__none">
                            <li><a href="{{route('info',['slug'=> 'o-nas'])}}">О нас</a></li>
                            <li><a href="{{route('partner.form.registration')}}">Регистрация партнера</a></li>
{{--                            <li><a href="{{route('info',['slug'=> 'sotrudnichestvo'])}}">Сотрудничество</a></li>--}}
 {{--                            <li><a href="{{route('info.cooperation.nooption')}}">Сотрудничество</a></li>--}}
{{--                            <li><a href="{{route('info.cooperation')}}">Сотрудничество</a></li>--}}
{{--                            <li><a href="{{route('info.cooperation')}}">Сотрудничество</a></li>--}}
{{--                               <li><a href="{{route('partner.info')}}">Новым партнерам</a>--}}
                            {{-- <li><a href="{{route('investor.page')}}">Инвесторам</a></li> --}}
{{--                              <li><a href="{{route('new.cms')}}">CMS</a></li>--}}
                        </ul>
                    </div>
                    <div class="footer__partner">
                        <div class="footer__title footerTitle">партнерам</div>
                        <ul class="footer__list footerList">
                            <li><a href="{{route('info',['slug'=> 'o-nas'])}}">О нас</a></li>
                            <li><a href="{{route('partner.form.registration')}}">Регистрация партнера</a></li>
                            {{-- <li><a href="{{route('info.cooperation.nooption')}}">Сотрудничество</a></li> --}}

{{--                            <li><a href="{{route('info',['slug'=> 'sotrudnichestvo'])}}">Сотрудничество</a></li>--}}

{{--                            <li><a href="{{route('info.cooperation')}}">Сотрудничество</a></li>--}}

{{--                            <li><a href="{{route('info',['slug'=> 'dejstvuyushim-partneram'])}}">Действующим--}}
{{--                                    партнерам</a>---}}
{{--                            </li>--}}
{{--                             <li><a href="{{route('partner.info')}}">Новым партнерам</a>--}}
                            {{-- <li><a href="{{route('investor.page')}}">Инвесторам</a></li> --}}
 {{--                            <li><a href="{{route('new.cms')}}">CMS</a></li>--}}
                            </li>
                        </ul>
                    </div>
                    <div class="footer__partner footer__info">
                        <div class="footer__title footerTitle">Информация</div>
                        <ul class="footer__list footerList footer__info">
                            {{--                        <li><a href="#">Блог</a></li>--}}
                            {{--                        <li><a href="#">Вопросы и ответы</a></li>--}}
                            <li><a href="{{route('info',['slug'=> 'politika-konfidencialnosti'])}}">Политика
                                    Конфиденциальности</a></li>
                            <li><a href="{{route('info',['slug'=> 'polzovatelskoe-soglashenie'])}}">Пользовательское
                                    соглашение</a></li>
                            <li><a href="{{route('info',['slug'=> 'dejstvuyushim-partneram'])}}">Wiki</a>

                            </li>
                        </ul>
                    </div>
                    <div class="footer__contact">
                        <div class="footer__title footerTitle">контакты</div>
                        <ul class="footer__list footerList">
                            <li><a href="tel:{{ setting('site.phone') }}">{{ setting('site.phone') }}</a></li>
							@if (!empty(setting('site.mail')))
                                <li><a href="mailto:{{ setting('site.mail') }}">{{ setting('site.mail') }}</a></li>
							@endif
                            <li>ООО "Симтек"</li>
                            <li>ИНН 7801624606</li>
                            <li>г. Санкт-Петербург</li>
                            <li>
                                <div class="footer__social">
{{--                                    <div class="footer__one">--}}
{{--                                        <a href="https://www.instagram.com/unitedmarketorg/" target="_blank">--}}
{{--                                            <img src="{{ asset('images/inst.svg') }}" alt="instagram">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                    {{-- <div class="footer__one">
                                        <a href="https://vk.com/unitedmarketorg" target="_blank">
                                            <img src="{{ asset('images/vk.svg') }}" alt="vk">
                                        </a>
                                    </div> --}}
{{--                                    <div class="footer__one">--}}
{{--                                        <a href="https://www.facebook.com/United-Market-160182772502217"--}}
{{--                                           target="_blank">--}}
{{--                                            <img src="{{ asset('images/facebook.svg') }}" alt="facebook">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                    {{-- <div class="footer__one">
                                        <a href="https://www.youtube.com/channel/UCns7aIJwqWZFPPwWXd6iq6g"
                                           target="_blank">
                                            <img src="{{ asset('images/youtube.svg') }}" alt="youtube">
                                        </a>
                                    </div> --}}
                                    <div class="footer__one">
                                        <a href="https://t.me/onionmp" target="_blank">
                                            <img src="{{ asset('images/telegram.svg') }}" alt="telegram">
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="footer__soc">
                        <div class="footer__social">
{{--                            <div class="footer__one">--}}
{{--                                <a href="https://www.instagram.com/unitedmarketorg/" target="_blank">--}}
{{--                                    <img src="{{ asset('images/inst.svg') }}" alt="instagram">--}}
{{--                                </a>--}}
{{--                            </div>--}}
                            {{-- <div class="footer__one">
                                <a href="https://vk.com/unitedmarketorg" target="_blank">
                                    <img src="{{ asset('images/vk.svg') }}" alt="vk">
                                </a>
                            </div> --}}
{{--                            <div class="footer__one">--}}
{{--                                <a href="https://www.facebook.com/United-Market-160182772502217" target="_blank">--}}
{{--                                    <img src="{{ asset('images/facebook.svg') }}" alt="facebook">--}}
{{--                                </a>--}}
{{--                            </div>--}}
                            {{-- <div class="footer__one">
                                <a href="https://www.youtube.com/channel/UCns7aIJwqWZFPPwWXd6iq6g" target="_blank">
                                    <img src="{{ asset('images/youtube.svg') }}" alt="youtube">
                                </a>
                            </div> --}}
                            <div class="footer__one">
                                <a href="https://t.me/onionmp" target="_blank">
                                    <img src="{{ asset('images/telegram.svg') }}" alt="telegram">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="footer__rights">©ООО интернет-компания “Умные решения”, 2022</div>--}}
                {{-- <div class="footer__rights">©ИП Лихая Елизавета Руслановна, 2022</div> --}}
            </div>
        </div>
        @if(Cookie::get('cookie')!='yes' and Route::currentRouteName()=='home')
{{--        <div class="cookie__inner" id="cookie" style="z-index: 1001" wire:ignore.self> --}}
{{--            <div class="cookie__wrapper">--}}
{{--                 <div class="cookie__text">Сайт unitedmarket.org использует файлы cookie и другие технологии для
{{--                        вашего--}}
{{--                     удобства пользования сайтом, анализа использования наших товаров и услуг и повышения качества--}}
{{--                     рекомендаций. Оставаясь на нашем сайте, вы соглашаетесь с использованием файлов cookie. <a--}}
{{--                         href="cookieInfo.html" target="_blank">Подробнее.</a></div>--}}
{{--                <div class="cookie__btn" id="cookieBtn" wire:click.prevent="cookie" style="cursor: pointer">--}}
{{--                     <a>Понятно</a>--}}
{{--                 </div>--}}
{{--             </div>--}}
{{--         </div>--}}
             <div class="cookie__inner" id="cookie" style="z-index: 1001" wire:ignore.self>
                <div class="cookie__wrapper">
                    <div class="cookie__text">Пользуясь нашим сайтом, вы соглашаетесь с тем, что мы  <a
                            href="cookieInfo.html" target="_blank">используем cookies.</a></div>
                    <div class="cookie__btn" id="cookieBtn" wire:click.prevent="cookie" style="cursor: pointer">
                        <a>Ок</a>
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('needCity') and Cookie::has('city_name'))
            @php
                session()->put('city', ['name' => Cookie::get('city_name'), 'slug' => Cookie::get('city_slug')] );
                session()->forget('needCity')
            @endphp
        @elseif(session()->has('needCity') and Route::currentRouteName()!='home' and Route::currentRouteName()!='info' and Route::currentRouteName()!='info.cooperation' and Route::currentRouteName()!='general.partner')
            {{-- <div class="gorod" style="display: block !important;" wire:ignore.self>
                <div class="gorod__title">Ваш город {{$location_city}}?</div>

                <div class="gorod__choose">
                    <div class="gorod__da"
                         wire:click.prevent="city('{{$location_city}}', '{{$city_slug}}', '{{session('url')}}')">да
                    </div>
                    <div id="noCity" class="gorod__net"
                         onclick="document.querySelector('#cityWindow').style.display = 'block'; document.querySelector('.gorod').style.display = 'none';">
                        нет
                    </div>
                </div>
            </div> --}}
        @endif


        {{-- <div class="city" id="cityWindow" wire:ignore.self>
            <div class="city__name">Ваш город:
                <div class="city__itog" id="cityItog">
                    @if(session()->has('city'))
                        {{ session('city')['name']}}
                    @endif
                </div>
            </div>
            <div class="city__searching" style="position: relative">
                <input class="city__search" id="citySearch" type="text" placeholder="Поиск города"
                       wire:keyup="searchCity($event.target.value)">
                @if($search_city)
                    <div class="city__search-list">
                        @foreach($search_city as $city)
                            <div class="searchlist-city city__position cityPosition" tabindex="1"
                                 wire:click.prevent="city('{{$city->real_name}}', '{{ $city->slug }}', '{{ $city->url }}')">{{ $city->real_name }}</div>
                        @endforeach
                    </div>
                @endif
                <button class="city__btn"></button>
            </div>
            <div class="city__list" wire:ignore>
                <ul>
                    @foreach($stores as $store)
                        <li class="city__position cityPosition"
                            wire:click.prevent="city('{{$store->real_name}}', '{{ $store->slug }}', '{{ $store->url }}')"
                            style="word-wrap: normal">{{ $store->real_name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="city__close" id="cityClose"
                 onclick="document.querySelector('#cityWindow').style.display = 'none'">
                <img src="{{ asset('images/close.svg') }}" alt="close">
            </div>
        </div> --}}
{{--        @if(!Cookie::has('beta_test') and Route::currentRouteName()=='product.details')--}}
{{--            <div class="betatest">--}}
{{--                <div class="beta__window" id="betaWindow" style="z-index: 500">--}}
{{--                    <div class="beta__title">В данный момент сайт проходит бета-тестирование</div>--}}
{{--                    <div class="beta__description">Мы делаем все, чтобы процесс заказа и получения--}}
{{--                        товара--}}
{{--                        был максимально удобен для наших клиентов и партнеров. Мы принимаем заказы в обычном режиме, но--}}
{{--                        возможны некоторые задержки. Заранее приносим свои извинения.--}}
{{--                    </div>--}}
{{--                    <div class="beta__btn">--}}
{{--                        --}}{{--                    <a href="{{route('product.shop', [session('city')['slug'],'flowers', 81 ])}}" wire:click.prevent="beta_test">Перейти к покупкам</a>--}}
{{--                        <a href="#" wire:click.prevent="beta_test()">Продолжить</a>--}}
{{--                    </div>--}}
{{--                    <div class="beta__close" wire:click.prevent="beta_test()">--}}
{{--                        <img src="{{ asset('images/closeBlack.svg') }}" alt="close">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
        {{--    @unless(session()->has('beta_test'))--}}

        {{--    @unless(session()->has('cookie')--}}

    </footer>

</div>







