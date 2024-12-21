<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>United Markeт</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,300;1,500&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/um-icon-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/um_plug/main.css') }}">
</head>

<body>

    <!-- <header class="header">
    <div class="d-flex justify-content-between align-items-center container">
        <a href="index.html" class="header__logo bg-cirgle">
            <img class="" src="./images/logo.png" alt="">
        </a>
        <div class="menu">
            <ul class="menu__list">
                <li class="menu__item"><a class="menu__link btn-hover" href="#section1">видеостудия</a></li>
                <li class="menu__item"><a class="menu__link btn-hover" href="#section2">Аренда</a></li>
                <li class="menu__item"><a class="menu__link btn-hover" href="#section3">МОНТАЖ</a></li>
                <li class="menu__item"><a class="menu__link btn-hover" href="#section4">ФОТО</a></li>
                <li class="menu__item"><a class="menu__link btn-hover" href="#section5">ВИДЕОПРОДАКШН</a></li>
            </ul>
            <div class="menu__adrees">
                <a href="tel:+79921753085">+7 (992) 175-30-85</a>
            </div>
        </div>
        <button type="button" class="menu-burger color-green d-flex flex-column justify-content-center align-items-center">
            <div class="open">
                <span></span>
                <span class="my-1"></span>
                <span></span>
            </div>
            <i class="icon-close color-white d-none"></i>
        </button>
        <div class="header__adrees">
            <a href="tel:+79921753085">+7 (992) 175-30-85</a>
        </div>
    </div>
</header> -->
    <header class="header">
        <div class="um-container d-flex align-items-center justify-content-between pb-2 pt-4">

            <a class="header__logo" href="/">
                <img src="{{ asset('images/um_plug/logo.svg') }}" alt="onionmarket.ru">
            </a>

            <ul class="header__about h-about">
                <li><a class="hover--link p-2" href="#benefits">Преимущества</a></li>
                <li><a class="hover--link p-2" href="#services">Сервисы</a></li>
                <li><a class="hover--link p-2" href="#facilities">Услуги</a></li>
                <li><a class="hover--link p-2" href="#client">Клиенты</a></li>
                <li><a class="hover--link p-2" href="#sell">Каналы продаж</a></li>
                <li><a class="hover--link p-2" href="#step">Шаги</a></li>
            </ul>

            <!--            <a class="header__lk-enter lk-enter" href="{{ route('auth') }}">Войти</a>-->

            <a type="button" class="header__h-feedback h-feedback hover--btn-header" href="#form">
                Стать партнером
            </a>

            <!--            <button class="header__menu-burger menu-burger blue-bg-1B4AC5 d-flex flex-column justify-content-center align-items-center">-->
            <!--                <span></span>-->
            <!--                <span class="my-1"></span>-->
            <!--                <span></span>-->
            <!--            </button>-->
        </div>
    </header>
    <main>

        <section class="hero">
            <div class="d-md-flex align-items-center justify-content-between container">
                <div>
                    <div class="hero__h1">
                        <span class="hero__h1-1">United</span> <span class="hero__h1-2">Markeт-</span>
                    </div>
                    <div class="hero__h1-3">онлайн-дистрибьютор в России</div>
                    <div class="hero__text">Упрощаем продажу товара в интернете</div>
                </div>
                <div class="hero__img">
                    <picture>
                        <source srcset="{{ asset('images/um_plug/hero-dest.png') }}" media="(min-width: 768px)">
                        <img src="{{ asset('images/um_plug/hero-mob.png') }}" alt="Картинка с размерами">
                    </picture>
                </div>
            </div>
        </section>

        <section id="benefits" class="benefits">
            <div class="container">
                <h2>Наши преимущества</h2>
                <ul>
                    <li>Комплексное сопровождение бизнеса в интернете</li>
                    <li>Сами заберем товар, упакуем и доставим</li>
                    <li>Быстрый старт и поддержка</li>
                    <li>Выводим поставщиков с 0-ля</li>
                    <li>Продвижение товара в различных рекламных каналах</li>
                </ul>
            </div>
        </section>

        <section class="benefits">
            <div class="container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/3S1MMcaBZi0"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </section>

        <section id="services" class="services">
            <div class="container">
                <h2>Упакуем ваш бизнес и организуем бизнес-процессы</h2>
                <div class="services__text">Услуги для маркетплейсов</div>
                <ul>
                    <li>
                        <div class="services__item">
                            <h3>Сопровождение на маркетплейсах</h3>
                            <p>Оформим аккаунт продавца, подготовим карточки товара, пройдём все этапы до успешного
                                запуска продаж</p>
                        </div>
                    </li>
                    <li>
                        <div class="services__item">
                            <h3>Подбор товаров</h3>
                            <p>Маркетинговое исследование рынка и определение наиболее выгодного для продажи товара</p>
                        </div>
                    </li>
                    <li>
                        <div class="services__item">
                            <h3>Продвижение товаров</h3>
                            <p>Помощь с увеличением продаж уже существующего бизнеса на маркетплейсах</p>
                        </div>
                    </li>
                    <li>
                        <div class="services__item">
                            <h3>Брендинг и дизайн</h3>
                            <p>Создание визуального оформления бренда или магазина (фирменный стиль, дизайн упаковки), а
                                также оптимизация уже существующих материалов</p>
                        </div>
                    </li>
                    <li>
                        <div class="services__item">
                            <h3>Фото- видеосъемка товара</h3>
                            <p>Полный спектр услуг профессиональной фотостудии, создание продающих фото и видео в
                                собственной профессиональной студии контента</p>
                        </div>
                    </li>
                    <li>
                        <div class="services__item">
                            <h3>Оформление карточек товара</h3>
                            <p>Создание уникального запоминающегося дизайна, побуждающего к покупке</p>
                        </div>
                    </li>
                    <li>
                        <div class="services__item">
                            <h3>Регистрация ИП и открытие счёта</h3>
                            <p>Регистрация юридического лица. Помощь с регистрацией ИП и ООО, открытие счёта в банке</p>
                        </div>
                    </li>
                    <li>
                        <div class="services__item">
                            <h3>Услуги склада</h3>
                            <p>Собственный склад, помощь с логистикой, упаковкой и отправкой клиенту</p>
                        </div>
                    </li>
                </ul>
                <div class="services__block">
                    <img src="{{ asset('images/um_plug/block3-5.png') }}" class="services__block-1" alt="">
                    <span>Продвижение и реклама товара на маркетплейсе имеет свои особенности, мы готовы продавать ваш
                        товар другими способами.</span>
                    <img src="{{ asset('images/um_plug/block3-6.png') }}" class="services__block-2" alt="">
                    <div class="services__block-img">
                        <picture>
                            <source srcset="{{ asset('images/um_plug/block3-7-dest.png') }}"
                                media="(min-width: 768px)">
                            <img src="{{ asset('images/um_plug/block3-7-mob.png') }}" alt="Картинка с размерами">
                        </picture>
                    </div>
                </div>
            </div>
        </section>

        <section id="facilities" class="facilities">
            <div class="container">
                <h2>Услуги для онлайн-бизнеса</h2>
                <div class="facilities__text">Собственный склад, помощь с логистикой, упаковкой и отправкой клиенту
                </div>
                <ul class="row">
                    <li class="col-md-6 col-lg-3">
                        <div class="facilities__item">
                            <h3>Предоставим сайт</h3>
                            <p>Продающий лендинг с уникальным дизайном </p>
                        </div>
                    </li>
                    <li class="col-md-6 col-lg-3">
                        <div class="facilities__item">
                            <h3>Сделаем сообщество ВК</h3>
                            <p>Выстроим коммуникацию с клиентами</p>
                        </div>
                    </li>
                    <li class="col-md-6 col-lg-3">
                        <div class="facilities__item">
                            <h3>Оптимизируем Авито</h3>
                            <p>Объявление с вашим продуктом на популярной площадке</p>
                        </div>
                    </li>
                    <li class="col-md-6 col-lg-3">
                        <div class="facilities__item">
                            <h3>Привлечём целевую аудиторию</h3>
                            <p>Настроим рекламу с эффективным расходом бюджета</p>
                        </div>
                    </li>
                    <li class="col-md-6 col-lg-3">
                        <div class="facilities__item">
                            <h3>Сопровождаем ваш бизнес </h3>
                            <p>Выстраиваем стратегию продвижения продукта</p>
                        </div>
                    </li>
                    <li class="col-md-6 col-lg-3">
                        <div class="facilities__item">
                            <h3>Настроим рекламу </h3>
                            <p>Создаём рекламные кампании и объявления в релевантных рекламных каналах</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <section id="client" class="client">
            <div class="container">
                <h2>Наши компании-клиенты</h2>
                <div class="client__wrap">
                    <div class="client__block-img">
                        <picture>
                            <source srcset="{{ asset('images/um_plug/MOOOM-dest.png') }}" media="(min-width: 768px)">
                            <img src="{{ asset('images/um_plug/MOOOM.png') }}" alt="Картинка с размерами">
                        </picture>
                    </div>
                    <div class="client__block-img">
                        <picture>
                            <source srcset="{{ asset('images/um_plug/alifaplast-dest.png') }}"
                                media="(min-width: 768px)">
                            <img src="{{ asset('images/um_plug/alifaplast.png') }}" alt="Картинка с размерами">
                        </picture>
                    </div>
                    <div class="client__block-img">
                        <picture>
                            <source srcset="{{ asset('images/um_plug/amilion-dest.png') }}"
                                media="(min-width: 768px)">
                            <img src="{{ asset('images/um_plug/amilion.png') }}" alt="Картинка с размерами">
                        </picture>
                    </div>
                </div>
            </div>
        </section>

        <section id="step" class="step">
            <div class="container">
                <h2>Шаги</h2>
                <div class="text-center">
                    <picture>
                        <source srcset="{{ asset('images/um_plug/step-dest.png') }}" media="(min-width: 768px)">
                        <img src="{{ asset('images/um_plug/step-mob.png') }}" alt="Картинка с размерами">
                    </picture>
                </div>
            </div>
        </section>

        <section id="sell" class="sell">
            <div class="container">
                <h2>Задействуем каналы продаж</h2>
                <ul class="sell__list row">
                    <li class="sell__list-item col-md-6">
                        <div class="sell__item">
                            <h3>Сайт на CMS Onion Market</h3>
                            <ul>
                                <li>Интернет-магазин</li>
                                <li>Корпоративный сайт</li>
                                <li>Лендинг</li>
                            </ul>
                        </div>
                    </li>
                    <li class="sell__list-item col-md-6">
                        <div class="sell__item">
                            <h3>Социальные сети</h3>
                            <ul>
                                <li>ВК</li>
                                <li>Одноклассники</li>
                            </ul>
                        </div>
                    </li>
                    <li class="sell__list-item col-md-6">
                        <div class="sell__item">
                            <h3>Маркетплейсы</h3>
                            <ul>
                                <li>Яндекс Маркет</li>
                                <li>Озон</li>
                                <li>Wildberries</li>
                            </ul>
                        </div>
                    </li>
                    <li class="sell__list-item col-md-6">
                        <div class="sell__item">
                            <h3>Доски объявлений</h3>
                            <ul>
                                <li>Авито</li>
                                <li>Юла</li>
                            </ul>
                        </div>
                    </li>
                    <li class="sell__list-item col-md-6">
                        <div class="sell__item">
                            <h3>Яндекс</h3>
                            <ul>
                                <li>Яндекс Бизнес</li>
                                <li>Яндекс Директ</li>
                                <li>Дзен</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <section id="form" class="fb">
            <div class="container">
                <div class="fb__wrap">
                    <h2>Стань лучшим продавцом </h2>
                    <form>
                        <div>
                            <input type="text" class="form-control" name="Имя" placeholder="Имя">
                        </div>
                        <div>
                            <input type="text" class="form-control" name="Телефон" placeholder="Телефон">
                        </div>
                        <div>
                            <input type="text" class="form-control" name="Почта" placeholder="Почта">
                        </div>
                        <div>
                            <textarea id="" class="form-control mb-2" name="Описание" cols="20" rows="10"
                                placeholder="Описание"></textarea>
                        </div>
                        <div class="d-flex flex-column">
                            <button type="submit" class="">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>
    <footer class="footer">
        <div class="um-container">

            <!--            <ul class="footer__block-1 f-block">-->
            <!--                <li>-->
            <!--                    <h3 class="f-block__title">Остались вопросы?</h3>-->
            <!--                </li>-->
            <!--                <li>-->
            <!--                    <p class="f-block__text">Можете задать их здесь или связаться по телефону, указанному в разделе контакты</p>-->
            <!--                </li>-->
            <!--                <li>-->
            <!--                    <form class="d-flex flex-column f-form align-items-start">-->
            <!--                        <input class="f-form__input border-bottom mb-4" type="text" placeholder="Email" wire:model.defer="questions_email">-->
            <!--                        <input class="f-form__input border-bottom" type="text" placeholder="Сообщение" wire:model.defer="questions_message">-->
            <!--                        <button wire:click.prevent="submitPartner()" class="f-form__btn-send hover&#45;&#45;btn-case" type="button" data-bs-toggle="modal" data-bs-target="#thankYouModal">Отправить</button>-->
            <!--                    </form>-->
            <!--                </li>-->
            <!--            </ul>-->

            <ul class="footer__block-1 f-block text-md-end text-xxl-start">
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

            <div class="footer__block-2 f-block-bottom mt-45">

                <!--                <ul class="footer_menu f-menu">-->
                <!--                    <li><a class="hover&#45;&#45;link" href="https://umclone.pp.ua/info/o-nas" target="_blank">О нас</a></li>-->
                <!--                    <li><a class="hover&#45;&#45;link" href="https://umclone.pp.ua/partner" target="_blank">Новым партнерам</a></li>-->
                <!--                    <li><a class="hover&#45;&#45;link" href="https://umclone.pp.ua/investor_page" target="_blank">Инвесторам</a></li>-->
                <!--                    <li><a class="hover&#45;&#45;link" href="https://umclone.pp.ua/info/dejstvuyushim-partneram" target="_blank">Wiki</a></li>-->
                <!--                    <li><a class="hover&#45;&#45;link" href="https://umclone.pp.ua/info/politika-konfidencialnosti" target="_blank">Политика конфиденциальности</a></li>-->
                <!--                </ul>-->

                <ul class="footer__social mw-180 justify-content-between">
                    <li class="footer__one">
                        <a class="hover--social" href="https://vk.com/unitedmarketorg" target="_blank">
                            <img src="{{ asset('images/um_plug/vk.svg') }}" alt="vk">
                        </a>
                    </li>

                    <li class="footer__one">
                        <a class="hover--social" href="https://www.youtube.com/channel/UCns7aIJwqWZFPPwWXd6iq6g"
                            target="_blank">
                            <img src="{{ asset('images/um_plug/youtube.svg') }}" alt="youtube">
                        </a>
                    </li>

                    <li class="footer__one">
                        <a class="hover--social" href="https://t.me/unitedmarket" target="_blank">
                            <img src="{{ asset('images/um_plug/telegram.svg') }}" alt="telegram">
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </footer>


    <!-- <footer class="footer">
    <div class="container">
        <div class="row">
            <ul class="col-lg-6">
                <li>(с) Zakadrom 4K Studio, 2022-2023</li>
                <li>ИП Орлова Кристина Денисовна</li>
            </ul>
            <ul class="col-lg-6">
                <li>Медиа-холдинг Zakadrom Production</li>
                <li>ИНН: 780101701771</li>
            </ul>
        </div>
        <ul class="footer__list-2 d-md-flex justify-content-center mt-5">
            <li class="footer__item-2">
                <a href="polytica.html">Политика конфиденциальности</a>
            </li>
        </ul>
    </div>
</footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    {{-- <script src="js/jquery-3.6.3.min.js"></script> --}}
    <script src="{{ asset('js/um_plug/app.js') }}"></script>
    <script src="{{ asset('js/um_plug/jquery-3.6.3.min.js') }}"></script>
    @livewireScripts


</body>

</html>
