<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>unitedmarket.org – сервис по доставке товаров и оказанию услуг. Интернет-магазин Onion Market.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />

    <link rel="stylesheet" href="{{ asset('css/main/main.css') }}">
{{--    <style>--}}
{{--        .header:nth-child(1),.footer:nth-child(1){display: none}--}}
{{--    </style>--}}
</head>
<body>

    <header class="header">
        <div class="um-container d-flex align-items-center justify-content-between pt-4 pb-2">

            <a class="header__logo" href="/">
                <img src="{{asset('images/main/logo.svg')}}" alt="unitedmarket.org">
            </a>

            <ul class="header__about h-about">
                <li><a class="hover--link" href="#um-advantages">Возможности</a></li>
                <li><a class="hover--link" href="#um-response">Условия</a></li>
{{--                <li><a class="hover--link" href="#um-case">Кейс</a></li>--}}
            </ul>

            <a class="header__lk-enter lk-enter" href="{{ route('auth') }}">Войти</a>

            <button type="button" class="header__h-feedback h-feedback hover--btn-header" data-bs-toggle="modal" data-bs-target="#lidModal">
                Стать партнером
            </button>

            <button class="header__menu-burger menu-burger blue-bg-1B4AC5 d-flex flex-column justify-content-center align-items-center">
                <span></span>
                <span class="my-1"></span>
                <span></span>
            </button>
        </div>
    </header>


    <section class="hero">
        <div class="um-container">
            <div class="mb-70">
                <h2 class="hero__title">Вырасти свой <span class="output-blue-hero">бизнес</span> <span class="nowrap">с помощью</span> наших IT разработок</h2>
            </div>

            <div class="hero__wrap d-md-flex justify-content-md-between">

                <div class="hero__block-1 rounded mb-40 mb-md-0 me-xl-2 white-bg-FBFBFB">

                    <h3 class="hero__title-block">Загруженность сети</h3>
                    <div class="d-flex mb-3 mb-xl-2 mxh-50">
                        <div class="fb-20 me-2">
                            <img src="{{ asset('images/main/icon-hero-1.svg') }}" alt="icon">
                        </div>
                        <ul class="d-flex me-2 fb-40 flex-column justify-content-between">
                            <li class="hero-section-title-text">Количество партнеров</li>
                            <li class="hero-section-text-1">111,111,11</li>
                        </ul>
                        <ul class=" d-flex fb-40 flex-column justify-content-between">
                            <li class="hero-section-title-text">24ч</li>
                            <li class="hero-section-text-2">+184,567</li>
                        </ul>
                    </div>

                    <div class="d-flex mb-3 mb-xl-2 mxh-50">
                        <div class="fb-20 me-2">
                            <img src="{{ asset('images/main/icon-hero-2.svg') }}" alt="icon">
                        </div>
                        <ul class="d-flex me-2 fb-40 flex-column justify-content-between">
                            <li class="hero-section-title-text">Количество транзакций</li>
                            <li class="hero-section-text-1">777,777,777</li>
                        </ul>
                        <ul class=" d-flex fb-40 flex-column justify-content-between">
                            <li class="hero-section-title-text">24ч</li>
                            <li class="hero-section-text-2">+5,878,456</li>
                        </ul>
                    </div>

                    <div class="d-flex mb-3 mb-xl-2 mxh-50">
                        <div class="fb-20 me-2">
                            <img src="{{ asset('images/main/icon-hero-3.svg') }}" alt="icon">
                        </div>
                        <ul class="d-flex me-2 fb-40 flex-column justify-content-between">
                            <li class="hero-section-title-text">Количество пользователей</li>
                            <li class="hero-section-text-1">4,444,444,444</li>
                        </ul>
                        <ul class=" d-flex fb-40 flex-column justify-content-between">
                            <li class="hero-section-title-text">24ч</li>
                            <li class="hero-section-text-2">+123,587,845</li>
                        </ul>
                    </div>

                    <div class="d-flex mb-3 mb-xl-2 mxh-50">
                        <div class="fb-20 me-2">
                            <img src="{{ asset('images/main/icon-hero-4.svg') }}" alt="icon">
                        </div>
                        <ul class="d-flex me-2 fb-40 flex-column justify-content-between">
                            <li class="hero-section-title-text">Количество товаров</li>
                            <li class="hero-section-text-1">5,555,555,555</li>
                        </ul>
                        <ul class=" d-flex fb-40 flex-column justify-content-between">
                            <li class="hero-section-title-text">24ч</li>
                            <li class="hero-section-text-2">+123,587,845</li>
                        </ul>
                    </div>

                </div>

                <div class="hero__block-2 rounded d-xl-flex flex-xl-column white-bg-FBFBFB ">

                    <h3 class="hero__title-block">Транзакции</h3>
                    <div class="hero__h-performed-operations h-performed-operations border-bottom d-xl-flex justify-content-xl-between mb-xl-5 mb-xxl-2">
                        <div>
                            <div class="h-performed-operations__key">f6904e10911...62015b92223</div>
                            <div class="h-performed-operations__ago-time">6 sec ago</div>
                        </div>
                        <div>
                            <div class="h-performed-operations__from">
                                <span>From</span>
                                <span>TB1mb4VNmsG2Kd6wdX78kKN6u1ph2Zeq3S</span>
                            </div>
                            <div class="h-performed-operations__to">
                                <span>To</span>
                                <span>TB1mb4VNmsG2Kd6wdX78kKN6u1ph2Zeq3S</span>
                            </div>
                        </div>
                        <div class="h-performed-operations__lead-time">0,004</div>
                    </div>

                    <div class="hero__h-performed-operations h-performed-operations border-bottom d-xl-flex justify-content-xl-between mb-xl-5 mb-xxl-2">
                        <div>
                            <div class="h-performed-operations__key">f6904e10911...62015b92223</div>
                            <div class="h-performed-operations__ago-time">6 sec ago</div>
                        </div>
                        <div>
                            <div class="h-performed-operations__from">
                                <span>From</span>
                                <span>TB1mb4VNmsG2Kd6wdX78kKN6u1ph2Zeq3S</span>
                            </div>
                            <div class="h-performed-operations__to">
                                <span>To</span>
                                <span>TB1mb4VNmsG2Kd6wdX78kKN6u1ph2Zeq3S</span>
                            </div>
                        </div>
                        <div class="h-performed-operations__lead-time">0,004</div>
                    </div>

                    <div class="hero__h-performed-operations h-performed-operations border-bottom d-xl-flex justify-content-xl-between mb-0">
                        <div>
                            <div class="h-performed-operations__key">f6904e10911...62015b92223</div>
                            <div class="h-performed-operations__ago-time">6 sec ago</div>
                        </div>
                        <div>
                            <div class="h-performed-operations__from">
                                <span>From</span>
                                <span>TB1mb4VNmsG2Kd6wdX78kKN6u1ph2Zeq3S</span>
                            </div>
                            <div class="h-performed-operations__to">
                                <span>To</span>
                                <span>TB1mb4VNmsG2Kd6wdX78kKN6u1ph2Zeq3S</span>
                            </div>
                        </div>
                        <div class="h-performed-operations__lead-time">0,004</div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <main>

        <section class="um-advantages" id="um-advantages">
            <div class="um-container">
                <div class="mb-40">
                    <h2 class="um-advantages__title">Что вы <span class="el-border-bottom"> получите</span>, сотрудничая с нами</h2>
                </div>
                <!-- Slider main container -->
                <div class="swiper mySwiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="advantages-card">
                                <h3 class="advantages-card__title d-inline-block">Индивидуальный <span class="output-green-advantages">сайт</span></h3>
                                <p class="advantages-card__text">У вас есть уникальная возможность создать свой сайт: заполните информацию о магазине, привяжите свой домен</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="advantages-card">
                                <h3 class="advantages-card__title d-inline-block">Наша команда – <span class="el-border-advantages">ваша</span> команда</h3>
                                <p class="advantages-card__text">С Вами будет работать команда профессионалов: Программисты, дизайнеры, маркетологи, менеджеры по продажам</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="advantages-card">
                                <h3 class="advantages-card__title">Интеграция с мессенджерами</h3>
                                <p class="advantages-card__text">Получайте заказы с сайта и общайтесь с клиентами напрямую в мессенджере</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="advantages-card">
                                <h3 class="advantages-card__title output-blue-advantages">Маркетинг</h3>
                                <p class="advantages-card__text">В личном кабинете у нашего партнера будет возможность пополнить баланс для продвижения своего интренет-магазина в Яндекс директ, Google Ads, Вконтакте и т.д.</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="advantages-card">
                                <h3 class="advantages-card__title">Интеграция с маркетплейсами</h3>
                                <p class="advantages-card__text">Одной кнопкой управляйте возможностью размещения товаров сразу на нескольких маркетплейсах</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="advantages-card">
                                <h3 class="advantages-card__title">Вывод средств</h3>
                                <p class="advantages-card__text">Партнер может выводить средства, которые начисляются за каждый заказ на кошелек в личном кабинете Onion Market</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="advantages-card">
                                <h3 class="advantages-card__title">Статистика заказов</h3>
                                <p class="advantages-card__text">В личном кабинете вы можете смотреть статистику заказов и выплаты по ним</p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="advantages-card">
                                <h3 class="advantages-card__title">Блокчейн</h3>
                                <p class="advantages-card__text">Безопасные, быстрые и прозрачные транзакции по технологии Блокчейн, отсутствие влияния контролирующего органа</p>
                            </div>
                        </div>
                    </div>

                    <!-- If we need navigation buttons -->
                    <div class="um-advantages__swiper-btn-wrap" >
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="um-information">
            <div class="um-container" style="">
                <p class="um-information__text">
                    Onion Market – интернет-платформа для электронной коммерции, созданная с применением <span class="output-blue-information">блокчейн</span> технологии Российскими IT разработчиками. Используя нашу платформу, вы сможете быстро создать интернет-магазин, наполнить его товарами, привязать домен, развивать сайт и продавать товары и услуги онлайн.
                </p>
            </div>
        </section>

        <section class="um-conditions">
            <div class="um-container">
                <h3 class="um-conditions__title">
                    Мы полностью отвечаем за сопровождение вашего бизнеса в интернете
                </h3>
                <p class="um-conditions__text">От стратегии развития до рекламных кампаний</p>
                <button type="button" class="um-conditions__btn hover--btn-conditions" data-bs-toggle="modal" data-bs-target="#lidModal">
                    Стать партнером
                </button>
            </div>
        </section>

        <section class="um-service">
            <div class="service-container-grid um-container mb-60 d-md-flex flex-wrap justify-content-md-between">

                <div class="block-1 um-service__um-article um-article">
                    <h3 class="um-article__title">Разработка <span class="output-green-service">стратегии</span> развития вашего бизнеса</h3>
                    <p class="um-article__text">Анализ конкурентов, составление портрета ЦА, развитие социальных сетей: прогрев аудитории, план постов, тексты, сценарии для видео роликов, разработка CJM, рекламные каналы и т.д.</p>
                </div>
                <div class="block-2 um-service__um-article um-article">
                    <h3 class="um-article__title">Техническая поддержка вашего сайта</h3>
                    <p class="um-article__text">При создании или переносе вашего сайта на нашу CMS мы оказываем всю необходимую техническую поддержку: обслуживание хостинга, защиту от взлома, устранение багов и т.д.</p>
                </div>
                <div class="block-3 um-service__um-article um-article elem-circle">
                    <h3 class="um-article__title">Автоматическое обновление новых функций</h3>
                    <p class="um-article__text">Наша команда дизайнеров и разработчиков постоянно создают новые функции для продуктивной работы вашего сайта: новые шаблоны, реферальная программа, кабинет маркетинга и рекламы, CRM и другие.</p>
                </div>
                <div class="block-4 um-service__um-article um-article">
                    <h3 class="um-article__title">Настройка и сопровождение рекламных кампаний</h3>
                    <p class="um-article__text">Мы настроим Яндекс Директ, ВК, Telegram, Авито, MyTarget и их обеспечим дальнейшее сопровождение.Составляем список ключевых фраз, готовим тексты и баннеры для рекламных объявлений, система аналитики, тестирование, анализ и корректировки.</p>
                </div>
                <div class="block-5 um-service__um-article um-article">
                    <h3 class="um-article__title mw-100">Интеграция с   <span class="el-border-bottom el-border-bottom--bottom">маркетплейсами</span></h3>
                    <div>
                        <p class="um-article__text">
                            Чтобы разместить товары на маркетплейс, предпринимателю приходится вносить информацию о товарах в учетную систему, а потом дублировать ее в своем личном кабинете на онлайн-площадке. А если таких онлайн-площадок несколько? На это уходит много времени, когда продаж становится много трудно контролировать бизнес-процессы и не допускать ошибок.
                        </p>
                        <p class="um-article__text mb-60">
                            Наши исследования подтвердили необходимость интеграции нашей площадки с различными маркетплейсами. В результате мы решили создать возможность загрузки товара, заполнить информацию о товаре, установки цены, а затем с помощью одной кнопки разместить свои товары на других площадках: Яндекс Маркет, СберМаркет, Wildberries, OZON
                        </p>
                    </div>
                    <p class="mt-auto">
                        <picture>
                            <source srcset="{{ asset('images/main/logo-market-dest.png') }}" media="(min-width: 768px)">
                            <img src="{{ asset('images/main/logo-market-mob.png') }}" alt="лого">
                        </picture>
                    </p>
                </div>
            </div>
        </section>

        <section class="um-response" id="um-response">
            <div class="um-container">
                <div >
                    <h2 class="um-response__title">Что мы ждем от <span class="output-green-response">вас</span></h2>
                </div>

                <p class="um-response__text">
                    Полная вовлеченность в процессы своего бизнеса, желание и возможность развиваться вместе с нами
                </p>

                <ul class="um-response__list d-md-flex flex-wrap flex-xl-nowrap justify-content-md-between">
                    <li class="um-response__item">
                        <img src="images/response-hero-1.svg" alt="">
                        <p>Загрузка карточек товаров и актуализация ассортимента</p>
                    </li>
                    <li class="um-response__item">
                        <img src="images/response-hero-2.svg" alt="">
                        <p>Установка интернет-эквайринга, <span class="green-color-00AD6D">обязательное наличие рекламного бюджета</span></p>
                    </li>
                    <li class="um-response__item">
                        <img src="images/response-hero-3.svg" alt="">
                        <p>Возможность своевременного реагирования на запрос клиента</p>
                    </li>
                    <li class="um-response__item">
                        <img src="images/response-hero-4.svg" alt="">
                        <p>Предоставление необходимой информации по запросу нашей команды, необходимой для рекламы и продвижения</p>
                    </li>
                </ul>
            </div>
        </section>



    </main>

    <section class="main-menu">
        <div class="um-container">
            <ul class="main-menu__list">
                <li class="main-menu__item"><a class="hover--link main-menu__link main-menu__link--active" href="https://umclone.pp.ua/" target="_blank">Главная</a></li>
                <li class="main-menu__item"><a class="hover--link main-menu__link" href="https://umclone.pp.ua/info/o-nas" target="_blank">О нас</a></li>
                <li class="main-menu__item"><a class="hover--link main-menu__link" href="https://umclone.pp.ua/partner" target="_blank">Новым партнерам</a></li>
                <li class="main-menu__item"><a class="hover--link main-menu__link" href="https://umclone.pp.ua/investor_page" target="_blank">Инвесторам</a></li>
                <li class="main-menu__item"><a class="hover--link main-menu__link" href="https://umclone.pp.ua/info/dejstvuyushim-partneram" target="_blank">Wiki</a></li>
            </ul>

            <button type="button" class="main-menu__btn h-feedback hover--btn-header" data-bs-toggle="modal" data-bs-target="#lidModal">
                Стать партнером
            </button>

        </div>
    </section>

    <!-- Модальное окно Заявки -->
    <section class="modal fade lid-modal" id="lidModal" tabindex="-1" aria-labelledby="lidModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="lid-modal__btn-close btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <div class="lid-modal__content">
                        <h3 class="lid-modal__title">
                            Заявка на сотрудничество
                        </h3>
                        <p class="lid-modal__text">
                            Оставьте свои контакты, мы с вами свяжемся для обсуждения деталей сотрудничества
                        </p>
                        <div class="lid-modal__form f-form">
                            <form class="d-flex flex-column f-form align-items-start">
                                @csrf
                                <input class="f-form__input f-form__input--width border-bottom" type="text" placeholder="Имя" wire:model.defer="questions_name">
                                <input class="f-form__input f-form__input--width border-bottom" type="text" placeholder="Email" wire:model.defer="questions_email" required>
                                <input class="f-form__input f-form__input--width border-bottom" type="text" placeholder="Сообщение" wire:model.defer="questions_message" required>
                                <!-- <button class="f-form__btn-send" type="submit">Отправить</button> -->
                                <button wire:click.prevent="submitPartner()" class="f-form__btn-send" type="button" data-bs-toggle="modal" data-bs-target="#thankYouModal">Отправить</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Модальное окно Благодарности -->
    <section wire:ignore class="modal fade thank-modal" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="thank-modal__btn-close btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center">
                    <div class="thank-modal__content">
                        <p class="thank-modal__text w-75 m-auto">
                            Спасибо, Ваша заявка принята!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="um-container">

            <ul class="footer__block-1 f-block">
                <li>
                    <h3 class="f-block__title">Остались вопросы?</h3>
                </li>
                <li>
                    <p class="f-block__text">Можете задать их здесь или связаться по телефону, указанному в разделе контакты</p>
                </li>
                <li>
                    <form class="d-flex flex-column f-form align-items-start">
                        <input class="f-form__input border-bottom mb-4" type="text" placeholder="Email" wire:model.defer="questions_email">
                        <input class="f-form__input border-bottom" type="text" placeholder="Сообщение"  wire:model.defer="questions_message">
                        <button wire:click.prevent="submitPartner()" class="f-form__btn-send hover--btn-case" type="button" data-bs-toggle="modal" data-bs-target="#thankYouModal">Отправить</button>
                    </form>
                </li>
            </ul>

            <ul class="footer__block-2 f-block text-md-end text-xxl-start">
                <li>
                    <h3 class="f-block__title">Контакты</h3>
                </li>
                <li>
                    <a class="f-block__link" href="tel:79055554469">+7 905 555 44 69</a>
                </li>
                <li>
                    <a class="f-block__link" href="mailto:hello@unitedmarket.org">hello@unitedmarket.org</a>
                </li>
            </ul>

            <div class="footer__block-3 f-block-bottom border-top mt-45">

                <ul class="footer_menu f-menu">
                    <li><a class="hover--link" href="https://umclone.pp.ua/info/o-nas" target="_blank">О нас</a></li>
                    <li><a class="hover--link" href="https://umclone.pp.ua/partner" target="_blank">Новым партнерам</a></li>
                    <li><a class="hover--link" href="https://umclone.pp.ua/investor_page" target="_blank">Инвесторам</a></li>
                    <li><a class="hover--link" href="https://umclone.pp.ua/info/dejstvuyushim-partneram" target="_blank">Wiki</a></li>
                    <li><a class="hover--link" href="https://umclone.pp.ua/info/politika-konfidencialnosti" target="_blank">Политика конфиденциальности</a></li>
                </ul>

                <ul class="footer__social mw-180 justify-content-between">
                    <li class="footer__one">
                        <a class="hover--social" href="https://vk.com/unitedmarketorg" target="_blank">
                            <img src="images/vk.svg" alt="vk">
                        </a>
                    </li>

                    <li class="footer__one">
                        <a class="hover--social" href="https://www.youtube.com/channel/UCns7aIJwqWZFPPwWXd6iq6g" target="_blank">
                            <img src="images/youtube.svg" alt="youtube">
                        </a>
                    </li>

                    <li class="footer__one">
                        <a class="hover--social" href="https://t.me/unitedmarket" target="_blank">
                            <img src="{{asset('images/main/telegram.svg')}}" alt="telegram">
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/main/app.js') }}"></script>
    <script>

    </script>
    @livewireScripts
</body>
</html>


