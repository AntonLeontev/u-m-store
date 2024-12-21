<div>
    @if (session()->has('clone_info'))
        <footer class="footer footer_partners">
            <div class="container">
                <div class="footer__inner">
                    <div class="footer__wrapper">
                        <div class="footer__major">
                            <div class="footer__logo">
                                <a href="#">
                                    <img src="{{ asset('storage/SiteClone/Logo') . '/' . session()->get('clone_info')['logo'] }}"
                                        alt="">
                                </a>
                                <div class="footer__description footer__description_partners">
                                    Официальный партнер
                                    <a href="https://onionmarket.ru/">Onion Market</a>
                                </div>
                            </div>
                        </div>
                        <div class="footer__buy">
                            <div class="footer__title footerTitle">Покупателям</div>
                            <ul class="footer__list footerList">
                                {{--                            <li><a href="#">Доставка</a></li> --}}
                                <li><a href="{{ route('clone.oplata') }}">Оплата</a></li>
                                {{--                            <li><a href="#">Как сделать заказ</a></li> --}}
                                {{--                            <li><a href="#">Гарантия качества</a></li> --}}
                            </ul>
                        </div>
                        <div class="footer__partner footer__partner_visible">
                            <div class="footer__title footerTitle">Информация</div>
                            <ul class="footer__list footerList" style="display: block !important;">

                                <li><a href="{{ route('clone.politic') }}">Политика Конфиденциальности</a></li>
                                <li><a href="{{ route('clone.soglashehie') }}">Пользовательское соглашение</a></li>

                                @if (session('clone_info')['city_name'] == 'Сочи')
                                    <li><a href="tel:7900288882">Сочи:+7 (900) 288-88-23</a></li>
                                    <li><a href="tel:79002881818">Туапсе:+7 (900) 288-18-18</a></li>
                                    <li><a href="tel:79881533302">Лазаревское:+7 (988) 153-33-02</a></li>
                                @endif

                            </ul>
                        </div>

                        <div class="footer__contact footer__contact_partners">
                            <div class="footer__title footerTitle">контакты</div>

                            <ul class="footer__list footerList">
                                <li><a href="tel:+79993335401">{{ session()->get('clone_info')['phone'] }}</a></li>
                                <li><a
                                        href="mailto:hello@united-market.ru">{{ session()->get('clone_info')['email'] }}</a>
                                </li>
                                <li>{{ session()->get('clone_info')['address'] }}</li>
                            </ul>

                            <div class="footer__soc footer__soc_partners">
                                <div class="footer__social">
                                    @if (session()->get('clone_info')['vk_link'])
                                        <div class="footer__one">
                                            <a href="{{ session()->get('clone_info')['vk_link'] }}" target="_blank">
                                                <img src="{{ asset('images/vk.svg') }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if (session()->get('clone_info')['inst_link'])
                                        <div class="footer__one">
                                            <a href="{{ session()->get('clone_info')['inst_link'] }}" target="_blank">
                                                <img src="{{ asset('images/inst.svg') }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if (session()->get('clone_info')['fb_link'])
                                        <div class="footer__one">
                                            <a href="{{ session()->get('clone_info')['fb_link'] }}" target="_blank">
                                                <img src="{{ asset('images/facebook.svg') }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    @if (session()->get('clone_info')['youtube_link'])
                                        <div class="footer__one">
                                            <a href="{{ session()->get('clone_info')['youtube_link'] }}"
                                                target="_blank">
                                                <img src="{{ asset('images/youtube.svg') }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="footer__one">
                                        <a href="" target="_blank">
                                            <img src="{{ asset('images/telegram.svg') }}" alt="">
                                        </a>
                                    </div>
                                    @if (session()->get('clone_info')['telegram_link'])
                                        <div class="footer__one">
                                            <a href="{{ session()->get('clone_info')['telegram_link'] }}"
                                                target="_blank">
                                                <img src="{{ asset('images/telegram.svg') }}" alt="">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                {{-- <a href="https://onionmarket.ru/" class="footer__item-link">Другие категории United
                                    Market</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="footer__rights">© {{ session()->get('clone_info')['company_name'] }},
                        {{ session()->get('clone_info')['year'] }}</div>
                </div>
            </div>
            @if (Cookie::get('cookie') != 'yes')
                <div id="cookie" class="cookie__inner" style="z-index: 1001" wire:ignore.self>
                    <div class="cookie__wrapper">
                        <div class="cookie__text">Пользуясь нашим сайтом, вы соглашаетесь с тем, что мы <a
                                href="cookieInfo.html" target="_blank">используем cookies.</a></div>
                        <div id="cookieBtn" class="cookie__btn" wire:click.prevent="cookie" style="cursor: pointer">
                            <a>Ок</a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="chatra" wire:ignore>
                <script>
                    window.ChatraSetup = {
                        chatWidth: 300,
                        /* ширина в пикселях */
                        chatHeight: 400 /* высота в пикселях */
                    };
                </script>
                <!-- Chatra {literal} -->
                <script>
                    (function(d, w, c) {
                        w.ChatraID = '5wuQ7euqHPjyCadw6';
                        var s = d.createElement('script');
                        w[c] = w[c] || function() {
                            (w[c].q = w[c].q || []).push(arguments);
                        };
                        s.async = true;
                        s.src = 'https://call.chatra.io/chatra.js';
                        if (d.head) d.head.appendChild(s);
                    })(document, window, 'Chatra');
                </script>
                <!-- /Chatra {/literal} -->
            </div>
        </footer>
    @endif
    <style>
        #chatra.chatra--side-bottom {
            bottom: 90px;
        }
    </style>
</div>
