@push('head')
    <link rel="stylesheet" href="{{asset('css/um-style/um-main.css?1')}}">
    <link rel="stylesheet" href="{{asset('css/um-style/um-icon-style.css?1')}}">
    <link rel="stylesheet" href="{{asset('css/franchise.css?1')}}">
    <link rel="stylesheet" href="{{asset('css/another.css?1')}}">

@endpush
@push('footer')
    <script src="{{asset('js/franchise.js?1')}}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js?1') }}"></script>
    <script src="{{ asset('js/um-js/um-calculator.js?1') }}"></script>
    <script src="{{ asset('js/um-js/um-franchise-popup.js?1') }}"></script>

    <script>
        $(document).ready(function () {
            window.livewire.on('alert_remove', () => {
                setTimeout(function () {
                    $(".alert-success").fadeOut('fast');
                }, 2000); // 3 secs
            });
        });
    </script>
@endpush
<div>
<div class="page-section">
    <div class="franchise">
        <div class="container">
            <section class="franchise__hero">
                <div class="franchise__container">
                    <div class="franchise__text-wrapper">
                        <h1 class="franchise__title">
                            Стань партнером Onion Market
                        </h1>

                        <p class="franchise__desc">
                            Партнер - уникальный партнер электронной экосистемы на технологии Блокчейн
                        </p>
                    </div>

                    <div class="franchise__buttons-wrapper">
                        <button class="franchise__button um-js-get-popup" data-target="#franchise-popup">Стать Партнером</button>
{{--                        <a href="{{asset('pdf/franchise/Франшиза UM__.pdf')}}" class="franchise__button franchise__button_blue">Скачать брендбук</a>--}}
                    </div>
                </div>

                <div class="franchise__hero-img">
                    <img src="{{asset('images/franchise_redesign/franchise-hero.png')}}" alt="#">
                </div>
            </section>
        </div>

        <section class="franchise__adv franchise__section">
            <div class="container">
                <h2 class="franchise__section-title">Что вы получите</h2>

                <div class="franchise__adv-wrapper">
                    <div class="franchise__adv-item franchise__adv-item_indent-top">

                        <div class="franchise__adv-decor">
                            <img src="{{asset('images/franchise_redesign/adv-1.png')}}" alt="#">
                        </div>

                        <div class="franchise__adv-title">Наша команда – Ваша команда</div>

                        <div class="franchise__adv-desc">
                            С Вами будет работать команда профессионалов: Программисты, дизайнеры,
                            маркетологи, менеджеры по продажам
                        </div>
                    </div>

                    <div class="franchise__adv-item franchise__adv-item_indent-top">
                        <div class="franchise__adv-title">CRM система</div>

                        <div class="franchise__adv-decor">
                            <img src="{{asset('images/franchise_redesign/adv-2.png')}}" alt="#">
                        </div>

                        <div class="franchise__adv-desc">
                            Своим партнерам мы предоставляем готовую систему для ведения бизнеса
                        </div>
                    </div>

                    <div class="franchise__adv-item franchise__adv-item_indent-top">
                        <div class="franchise__adv-title">CMS система</div>

                        <div class="franchise__adv-decor">
                            <img src="{{asset('images/franchise_redesign/adv-3.png')}}" alt="#">
                        </div>

                        <div class="franchise__adv-desc">
                            Мы предоставляем вам индивидуальный интернет-магазин – партнер
                            unitedmarket.org
                        </div>
                    </div>

                    <div class="franchise__adv-item franchise__adv-item_indent-top">
                        <div class="franchise__adv-title">Один город – один партнер</div>

                        <div class="franchise__adv-decor">
                            <img src="{{asset('images/franchise_redesign/um-adv-4.png')}}" alt="#">
                        </div>

                        <div class="franchise__adv-desc">
                            Мы не создаем конкуренцию среди партнеров в городе, каждый наш партнер уникален. Для городов миллионников один партнер – один район города.
                        </div>
                    </div>

                    <div class="franchise__adv-item franchise__adv-item_indent-top">
                        <div class="franchise__adv-title">Вывеска и промоматериалы за наш счет</div>

                        <div class="franchise__adv-decor">
                            <img src="{{asset('images/franchise_redesign/adv-5.png')}}" alt="#">
                        </div>

                        <div class="franchise__adv-desc">Фирменная вывеска и рекламные материалы с логотипом Onion Market</div>
                    </div>

                    <div class="franchise__adv-item franchise__adv-item_indent-top">
                        <div class="franchise__adv-title">Интеграция с другими маркетплейс</div>

                        <div class="franchise__adv-decor">
                            <img src="{{asset('images/franchise_redesign/um-adv-6.png')}}" alt="#">
                        </div>

                        <div class="franchise__adv-desc">
                            Для своих партнеров мы разрабатываем систему интеграции с другими маркетплейсами для упрощенной загрузки товаров сразу на несколько площадок
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- <section class="franchise__adv franchise__section">
            <div class="container">
                <h2 class="franchise__section-title">Выгода сотрудничества</h2>

                <div class="franchise__adv-wrapper--flex">
                    <div class="franchise__adv-item">
                        <div class="franchise__adv-title">Один город – один партнер</div>

                        <div class="franchise__adv-desc">
                            Мы не создаем конкуренцию среди партнеров в городе, каждый наш партнер уникален. Для городов
                            миллионников один партнер –
                            один район города
                        </div>
                    </div>

                    <div class="franchise__adv-item">
                        <div class="franchise__adv-title">Узнаваемость бренда</div>

                        <div class="franchise__adv-desc">
                            Мы сотрудничаем уже с 200+ предпринимателями. В наших планах сотрудничество с партнерами во всех города
                            России
                        </div>
                    </div>

                    <div class="franchise__adv-item">
                        <div class="franchise__adv-title">Пониженная комиссия</div>

                        <div class="franchise__adv-desc">
                            Для Генерального партнера у нас самые выгодные условия. Комиссия за оплаченный заказ составляет 10%
                        </div>
                    </div>

                    <div class="franchise__adv-item">
                        <div class="franchise__adv-title">Цифровые активы</div>

                        <div class="franchise__adv-desc">
                            Генеральному партнеры при заключении договора сотрудничества мы дарим цифровые активы компании, благодаря которым можно получать пассивный ходох
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="franchise__section">
            <div class="franchise__wrapper" style="background: linear-gradient(90.24deg, #0057FF 32.18%, rgba(0, 87, 255, 0.11) 99.79%),
            url( {{asset('images/franchise_redesign/section_bg.jpg')}}) center right / 68% auto no-repeat;">
                <div class="container">
                    <h2 class="franchise__section-title franchise__section-title_white">Этапы сотрудничества</h2>

                    <ol class="franchise__list">
                        <li>
                            01. Переговоры
                        </li>
                        <li>
                            02. Заключение договора
                        </li>
                        <li>
                            03. Регистрация на unitedmarket.org
                        </li>
                        <li>
                            04. Загрузка товара и установка цен на сайт
                        </li>
                        <li>
                            05. Монтаж вывески
                        </li>
                        <li>
                            06.Заказы на unitedmarket.org
                        </li>
                        <li>
                            07. Выплаты за заказы на unitedmarket.org
                        </li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- Добавлена секция Правила сотрудничества 18.05.2022  -->
        <section class="franchise__adv franchise__section">
            <div class="container">
                <h2 class="franchise__section-title">Правила сотрудничества</h2>

                <div class="franchise__adv-wrapper franchise__adv-wrapper--grid">
                    <div class="franchise__adv-item">
                        <div class="franchise__adv-title">Вывеска Onion Market</div>

                        <div class="franchise__adv-desc">
                            Мы предоставляем вывеску с логотипом Onion Market, которую партнер должен повесить на своем магазине или офисе
                        </div>
                    </div>

                    <div class="franchise__adv-item">
                        <div class="franchise__adv-title">Использование сайта unitedmarket.org</div>

                        <div class="franchise__adv-desc">
                            Партнер в Интернет продает свои товары или услуги только через сайт unitedmarket.org
                        </div>
                    </div>

                    <div class="franchise__adv-item">
                        <div class="franchise__adv-title">Продвижение бренда Onion Market</div>

                        <div class="franchise__adv-desc">
                            Партнер продвигает бренд Onion Market: дает ссылку на свои товары на unitedmarket.org и брендированные материалы Onion Market своим клиентам
                        </div>
                    </div>

                    <div class="franchise__adv-item">
                        <div class="franchise__adv-title">Передача своего сайта в администрирование UM</div>

                        <div class="franchise__adv-desc">
                            Если у Вас уже есть сайт, мы берем на себя его техническую поддержку и продвижение, точно так же, как и созданный на нашем CMS индивидуальный сайт.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Добавлена секция Условия сотрудничества 24.05.2022  -->
        <section class="franchise__table">
            <h2 class="franchise__table-title">Условия сотрудничества</h2>
            <ul class="franchise__table-list">
                <li class="franchise__table-item">
                    <span class="franchise__table-elem"></span>
                    <span class="franchise__table-elem franchise__elem-title">Партнер</span>
                    <span class="franchise__table-elem franchise__elem-title">Генеральный партнер</span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Неограниченное количество товаров или услуг</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">CMS система</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Индивидуальный сайт</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Наша команда – ваша команда</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Техническая поддержка для партнеров</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Поддержка и обслуживание unitedmarket.org</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Обеспечение вывеской и рекламными материалами за счет нашей компании</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Программа лояльности: кэшбек, реферальная программа</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Один партнер - один город</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Интеграция с другими маркетплейсами</span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Комиссия с продаж на Маркетплейс</span>
                    <span class="franchise__table-elem franchise__table-elem--green">25%</span>
                    <span class="franchise__table-elem franchise__table-elem--green">15%</span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Гарантия сотрудничества с партнером*</span>
                    <span class="franchise__table-elem"><i class="icon-um-close"></i></span>
                    <span class="franchise__table-elem"><i class="icon-um-ok"></i></span>
                </li>
                <li class="franchise__table-item">
                    <span class="franchise__table-elem franchise__elem-text">Взнос</span>
                    <span class="franchise__table-elem franchise__table-elem--green">от  20 000
                        &#8381; товаром</span>
                    <span class="franchise__table-elem franchise__table-elem--green">от 40 000
                        &#8381;</span>
                </li>
            </ul>
            <p class="franchise__text">*Генеральный партнер имеет гарантию сотрудничества, его нельзя поменять. Часть обязательств за Партнера берет на себя Инвестор, поэтому, если Инвестор считает данного Партнера недобросовестным, например, вовремя не наполняет сайт, не дает гарантию качества на свой продукт, то Инвестор в прраве выбрать другого Партнера</p>
        </section>


        <!-- <section class="franchise__section">
            <div class="container">
                <h2 class="franchise__section-title">Калькулятор доходности</h2>

                <div class="franchise__calc">
                    <div class="franchise__calc-item">
                        <div class="franchise__calc-title">Стоимость</div>
                        <div class="franchise__calc-value">40 000₽</div>
                    </div>

                    <div class="franchise__calc-item">
                        <div class="franchise__calc-title">Зарплата специалистам</div>
                        <div class="franchise__calc-value">0₽</div>
                    </div>

                    <div class="franchise__calc-item">
                        <div class="franchise__calc-title">Аренда площадки</div>
                        <div class="franchise__calc-value">0₽</div>
                    </div>

                    <div class="franchise__calc-item" style="visibility: hidden">
                        <div class="franchise__calc-title">Затраты на маркетинг и рекламу</div>
                        <div class="franchise__calc-value">0₽</div>
                    </div>

                    <div class="franchise__calc-item">
                        <div class="franchise__calc-title">Товарооборот</div>

                        <label for="range">
                            <input class="franchise__calc-range"  type="range" name="range" id="range" min="10000" max="100000" step="100"  value="10000">
                        </label>
                        <output for="range" class="franchise__calc-output js-output"></output>
                    </div>

                    <div class="franchise__calc-item">
                        <div class="franchise__calc-title-result">Сумма средств к выводу</div>
                        <div class="franchise__calc-value-result" id="revenue"></div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Добавлена секция калькулятор 26.05.2022  -->
        <div class="franchise-um-commission">
            <h2 class="franchise-um-commission__title">Распределение комиссии с продаж</h2>
            <p class="franchise-um-commission__text">Onion Market – открытая платформа, на которой все транзакции прозрачны</p>
            <ul class="franchise-um-commission__list" >
                <li class="franchise-um-commission__item"><button class="franchise-um-commission__link franchise-um-commission__link--active" data-tabs-path="commission-general-partner">Генеральный партнер</button></li>
                <li class="franchise-um-commission__item"><button class="franchise-um-commission__link" data-tabs-path="commission-partner">Партнер</button></li>
            </ul>
            <div class="franchise-um-commission__content franchise-um-commission__content--active" data-tabs-target="commission-general-partner">
                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/commission-screen-general-partner-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/commission-screen-general-partner-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/commission-screen-general-partner-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="franchise-um-commission__img" src="{{asset('images/img/jpg/commission-screen-general-partner-mob.jpg')}}" alt="фото"/>
                </picture>
            </div>
            <div class="franchise-um-commission__content" data-tabs-target="commission-partner">
                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/commission-screen-partner-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/commission-screen-partner-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/commission-screen-partner-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="franchise-um-commission__img" src="{{asset('images/img/jpg/commission-screen-partner-mob.jpg')}}" alt="фото"/>
                </picture>
            </div>
        </div>


        <!-- Добавлена секция калькулятор 18.05.2022  -->
        <section class="um-calculator um-franchise__um-calculator">
            <h2 class="um-calculator__title">Калькулятор экономии</h2>
            <p class="um-calculator__text">Оцените, какой бюджет наших партнеров мы экономим. Цены в калькуляторе использованы средние по рынку</p>
            <div class="um-calculator__wrap">
                <ul class="um-calculator__list">
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">Аренда площадки, в месяц</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value1" value="5000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">5000&#8381;</span>
                        </label>
                    </li>
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">Вывеска и брендированные промоматериалы</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value2" value="20000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">20000&#8381;</span>
                        </label>
                    </li>
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">CRM</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value3" value="50000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">50000&#8381;</span>
                        </label>
                    </li>
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">Внедрение платежной системы</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value4" value="4000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">4000&#8381;</span>
                        </label>
                    </li>
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">Индивидуальная CMS, в месяц</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value5" value="5000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">5000&#8381;</span>
                        </label>
                    </li>
                </ul>
                <ul class="um-calculator__list">
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">Зарплата специалистам, в месяц</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value6" value="150000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">Дизайнеры</span>
                        </label>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value7" value="50000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">Front end специалист</span>
                        </label>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value8" value="150000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">Back end специалист</span>
                        </label>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value9" value="40000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">Контент менеджер</span>
                        </label>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value10" value="30000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">Оператор call центра</span>
                        </label>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value11" value="150000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">Маркетолог</span>
                        </label>
                    </li>
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">Затраты на маркетинг и рекламу, в месяц</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value12" value="30000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">30000&#8381;</span>
                        </label>
                    </li>
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">Автоматизированная система обзвона клиентов</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value13" value="10000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">10000&#8381;</span>
                        </label>
                    </li>
                    <li class="um-calculator__item">
                        <span class="um-calculator__item-title">Разработка блокчейн</span>
                        <label class="um-calculator__item-label">
                            <input class="um-calculator__item-input" type="checkbox" id="um-value14" value="2100000" checked>
                            <span class="um-calculator__icon-checkbox"></span>
                            <span class="um-calculator__item-value">2100000&#8381;</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div class="um-calculator__savings">
                <span>Ваша экономия</span>
                <span><span id="um-summa">2794000</span>&#8381;</span>
            </div>
            <button class="um-calculator__button um-js-get-popup">Стать  Партнером</button>
        </section>

        <div class="container">
            <div class="franchise__wrapper" style="background: #3657C8; border-radius: 20px;">
                <h2 class="franchise__section-title franchise__section-title_white">Остались вопросы?</h2>

                <form class="franchise__form" action="#" method="POST" wire:submit.prevent="questionsRemain">
                    <div class="franchise__form-content franchise__form-content_section">
                        <input type="hidden" name='ИСТОЧНИК' value="ОСТАЛИСЬ ВОПРОСЫ ФРАНШИЗА!">
                        <div class="franchise__form-input franchise__form-input_necessarily">Имя</div>
                        <input type="text" name="Фамилия и Имя" wire:model="questions_name" maxlength="60" required>

                        <div class="franchise__form-input franchise__form-input_necessarily">Номер телефона</div>
                        <input name="Номер телефона" type="tel" wire:model="questions_phone" required maxlength="20" placeholder="7(900)800 55 55" onkeyup="this.value=this.value.replace(/[^\d]/,'')">

                        <div class="franchise__form-input franchise__form-input_necessarily">Email</div>
                        <input type="email" name="Email" wire:model="questions_email" maxlength="60" required>

                        <div class="franchise__form-input franchise__form-input_necessarily">Сообщение</div>
                        <textarea wire:model="questions_message" maxlength="250" required></textarea>

                        <button type="submit" class="franchise__button franchise__button_blue">Отправить</button>
{{--                        @if(count($errors)>0)--}}
{{--                            <div style="margin-top:10px ">--}}
{{--                                @foreach($errors->all() as $error)--}}
{{--                                    <div><span class="error">{{ $error }}</span></div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        @if(session()->has('success_question'))
                            <div class="alert-success" style="max-width: 450px; margin-top: 15px; text-align: center"><span>Данные успешно отправлены</span>
                            </div>
                        @elseif(session()->has('error_question'))
                            <div class="error" style="max-width: 550px; margin-top: 15px; text-align: center"><span>Ошибка отправки данных</span>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <div class="franchise__popup js-franchise-popup" id="franchise-popup" wire:ignore.self>
    <div class="franchise__popup-wrapper js-popup-wrapper">
        <div class="franchise__close-wrapper">
            <button class="franchise__popup-close js-close-popup" onclick="document.querySelector('#franchise-popup').style.display = 'none'">
                <img src="{{asset('images/closeBlack.svg')}}" alt="#">
            </button>
        </div>

        <form class="franchise__form">
            <input type="radio" id="card-pay" name="pay" class="franchise__form-radio">
            <label for="card-pay" class="franchise__form-label">
                <span class="franchise__form-title">
                     Выставить счет на оплату Сотрудничества
                </span>
            </label>
            <div class="franchise__form-content">
                <input type="hidden" name="Источник" value="Форма покупки франшизы">
                <div class="franchise__form-input">ФИО</div>
                <input type="text" wire:model='fio' maxlength="90">
                <div>
                    @error('fio') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="franchise__form-input">ИНН</div>
                <input type="text" wire:model='inn' onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                <div>
                    @error('inn') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">ОГРН</div>
                <input type="text" wire:model='ogrn' onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                <div>
                    @error('ogrn') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">КПП</div>
                <input type="text" wire:model='kpp' onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                <div>
                    @error('kpp') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">БИК</div>
                <input type="text" wire:model='bik' onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                <div>
                    @error('bik') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">кор. счет №</div>
                <input type="text" wire:model='kor_account' onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                <div>
                    @error('kor_account') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">cчет №</div>
                <input type="text" wire:model='bank_account' onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                <div>
                    @error('bank_account') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">Юридический адрес</div>
                <input type="text" wire:model='legal_address'>
                <div>
                    @error('legal_address') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">Фактический адрес</div>
                <input type="text" wire:model='actual_address'>
                <div>
                    @error('actual_address') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">Телефон</div>
                <input type="text" wire:model='phone'>
                <div>
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="franchise__form-input">Email</div>
                <input type="email" wire:model='email'>
                <div>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <button class="franchise__button franchise__button_blue" wire:click.prevent="InvoiceForPayment" wire:loading.class='cursorOff'>Отправить</button>
                @if(session()->has('success'))
                    <div class="alert-success" style="max-width: 550px; margin-top: 15px;"><span>Данные успешно отправлены</span>
                    </div>
                @elseif(session()->has('error'))
                    <div class="error" style="max-width: 550px; margin-top: 15px;"><span>Ошибка отправки данных</span>
                    </div>
                @endif
            </div>
            <input type="radio" id="sum-pay" name="pay" class="franchise__form-radio">
            <label for="sum-pay" class="franchise__form-label">
          <span class="franchise__form-title">
            Оплата через <img src="{{asset('images/kassa.png')}}" alt="#">
          </span>
            </label>
            <div class="franchise__form-content">

                <div class="franchise__form-input">Назначение платежа</div>
                <input type="text" wire:model='description' maxlength="90" readonly>
                <div>
                    @error('description') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="franchise__form-input">Ваш город</div>
                <input type="text" wire:model='city' required>
                <div>
                    @error('city') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="franchise__form-input">Номер телефона для связи</div>
                <input type="text" wire:model='phone_pay' onkeyup="this.value=this.value.replace(/[^\d\(\)]/,'')" required placeholder="7(900)666 00 00">
                <div>
                    @error('phone_pay') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="franchise__form-input">Сумма оплаты</div>
                <input type="text" wire:model='pay_sum' readonly>
                <div>
                    @error('pay_sum') <span class="error">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="franchise__button franchise__button_blue" wire:click.prevent="franchisePay" wire:loading.class='cursorOff'>Оплатить</button>

            </div>
        </form>
    </div>
</div> -->
<div class="franchise-um-popup franchise-um-popup-main">
    <button class="franchise-um-popup__close">
        <span class="visually-hidden">Закрыть</span>
        <i class="icon-um-city-close"></i>
    </button>
    <p class="franchise-um-popup__title">Выберете вариант сотрудничества</p>
    <ul class="franchise-um-popup__list" >
        <li class="franchise-um-popup__item"><a class="franchise-um-popup__link one franchise-um-popup__link--active" href="#">Генеральный партнер</a></li>
        <li class="franchise-um-popup__item"><a class="franchise-um-popup__link two" href="#">Партнер</a></li>
    </ul>
    <button class="franchise-um-popup__btn-next">Продолжить</button>
</div>

<div class="franchise-um-popup franchise-um-popup-gp fb-none">
    <button class="franchise-um-popup__close">
        <span class="visually-hidden">Закрыть</span>
        <i class="icon-um-city-close"></i>
    </button>
    <p class="franchise-um-popup__title">Заявка на вариант сотрудничества Партнер и выставление счета</p>
    <p class="franchise-um-popup__text"><span class="franchise-um-popup__elem franchise-um-popup__elem--active"></span>Выставить счет на оплату Сотрудничества</p>
    <form action="#">
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">ФИО</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">ИНН</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">ОГРН</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">КПП</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">БИК</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">кор. счет №</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">счет №</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">Юридический адрес</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">Фактический адрес</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">Телефон</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <label class="franchise-um-popup__label">
            <span class="franchise-um-popup__label-text">Email</span>
            <input class="franchise-um-popup__input" type="text">
        </label>
        <button class="franchise-um-popup__btn-send">Отправить</button>
    </form>
</div>

<div class="franchise-um-popup franchise-um-popup-p fb-none">
    <button class="franchise-um-popup__close">
        <span class="visually-hidden">Закрыть</span>
        <i class="icon-um-city-close"></i>
    </button>
    <p class="franchise-um-popup__text">Если вы уже готовы к сотрудничеству, заполните реквизиты и мы выставим счет для оплаты паушального взноса</p>
    <p class="franchise-um-popup__title">Выберете систему налогооблажения</p>
    <ul class="franchise-um-popup__list-menu">
        <li class="franchise-um-popup__item-menu" data-tabs-path="franchise-ooo">ООО</li>
        <li class="franchise-um-popup__form" data-tabs-target="franchise-ooo">
            <form action="#">
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Сфера услуг/товаров: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Город</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Полное наименование организации: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Сокращенное наименование: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Юридический адрес: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Фактический адрес: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Почтовый адрес (а/я): </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Генеральный Директор: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Главный бухгалтер: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">ИНН</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">КПП</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">ОГРН</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Наименование Банка: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Расчётный счет (р/с) : </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Корреспондентский счёт: (к/c) </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">БИК</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Электронный почтовый адрес (E-mail):</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Мобильный номер телефона:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Сайт/соц.сети:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <button class="franchise-um-popup__btn-send">Отправить</button>
            </form>
        </li>
        <li class="franchise-um-popup__item-menu" data-tabs-path="franchise-ip">ИП</li>
        <li class="franchise-um-popup__form" data-tabs-target="franchise-ip">
            <form action="#">
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Сфера услуг/товаров: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Город</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Полное наименование организации: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Сокращенное наименование: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Юридический адрес: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Фактический адрес: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Почтовый адрес (а/я): </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">ИНН</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">КПП</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">ОГРН</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Наименование Банка: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Расчётный счет (р/с) : </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Корреспондентский счёт: (к/c) </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">БИК</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Электронный почтовый адрес (E-mail):</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Мобильный номер телефона:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Сайт/соц.сети:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <button class="franchise-um-popup__btn-send">Отправить</button>
            </form>
        </li>
        <li class="franchise-um-popup__item-menu" data-tabs-path="franchise-self">Самозанятый</li>
        <li class="franchise-um-popup__form" data-tabs-target="franchise-self">
            <form action="#">
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Сфера услуг/товаров: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Город</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">ФИО:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Серия и номер паспорта:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Когда и кем выдан:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Адрес регистрации:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Фактический адрес ведения деятельности: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">ИНН</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Почтовый адрес (а/я):</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Наименование Банка: </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Расчётный счет (р/с) : </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Корреспондентский счёт: (к/c) </span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">БИК</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Электронный почтовый адрес (E-mail):</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Мобильный номер телефона:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <label class="franchise-um-popup__label">
                    <span class="franchise-um-popup__label-text">Сайт/соц.сети:</span>
                    <input class="franchise-um-popup__input" type="text">
                </label>
                <button class="franchise-um-popup__btn-send">Отправить</button>
            </form>
        </li>
    </ul>
</div>
</div>
