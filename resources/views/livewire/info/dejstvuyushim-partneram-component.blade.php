@push('head')
    <link rel="stylesheet" href="{{ asset('css/um-style/um-icon-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/um-style/um-main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/um-style/umdp-style.css') }}">
@endpush
@push('footer')
    <script src="{{ asset('js/um-js/umdp-block.js') }}"></script>
@endpush

    <div class="umdp-section">
        <div class="umdp-menu umdp-section__umdp-menu">
            <button class="umdp-menu__btn-close">
                <span class="visually-hidden">Закрыть</span>
                <i class="icon-um-city-close"></i>
            </button>
            <ul>
                <li class="umdp-menu__item"><button class="umdp-menu__btn umdp-menu__main-btn--active umdp-menu__btn--active">Партнерам</button><i class="icon-um-arrow icon-um-arrow--active"></i></li>
                <ul class="umdp-menu__list umdp-menu__list--active">
                    <li class="umdp-menu__item"><button class="umdp-menu__btn umdp-menu__btn--active" data-tabs-path="umdp-page-one">Как зарегистрироваться на сайте</button></li>
                    <li class="umdp-menu__item"><button class="umdp-menu__btn" data-tabs-path="umdp-page-two">Как установить приложение на рабочий экран</button></li>
                    <li class="umdp-menu__item"><button class="umdp-menu__btn" data-tabs-path="umdp-page-three">Как загрузить товар на сайт</button></li>
                    <li class="umdp-menu__item"><button class="umdp-menu__btn" data-tabs-path="umdp-page-four">Как правильно сделать фото товара для сайта</button></li>
                    <li class="umdp-menu__item"><button class="umdp-menu__btn" data-tabs-path="umdp-page-five">Как я узнаю, что поступил заказ на мой товар?</button></li>
                    <li class="umdp-menu__item"><button class="umdp-menu__btn" data-tabs-path="umdp-page-six">Информация о магазине</button> </li>
                </ul>
                <li class="umdp-menu__item"><button class="umdp-menu__btn">Покупателям</button><i class="icon-um-arrow"></i></li>
            </ul>
        </div>

        <div class="umdp-section__wrapp">
            <!-- Кнопка меню  -->
            <div class="umdp-section__wrapp-btn">
                <button class="umdp-button-menu">
                    <span class="visually-hidden">Кнопка меню</span>
                    <span class="umdp-button-menu__icon"></span>
                </button>
            </div>

            <p class="umdp-section__text">
                Если вы еще не являетесь партнером Onion Market, переходите в раздел <a class="umdp-section__text-link" href="https://onionmarket.ru/without_conditions_cooperation" target="_blank">Сотрудничество</a>
            </p>

            <!-- Страница как зарегистрироваться на сайте  -->
            <div class="umdp-content umdp-section__content umdp-section__content--active" data-tabs-target="umdp-page-one">
                <h2 class="umdp-content__title">как зарегистрироваться на сайте</h2>
                <p class="umdp-content__text"><strong>1. Войти или зарегистрироваться</strong></p>
                <p class="umdp-content__text">Для того, чтобы зарегистрироваться на сайте Вам нужно пройти по ссылке    <strong><a class="umdp-content__link" href="https://onionmarket.ru/register">https://onionmarket.ru</a></strong><br>(Для  работы с сайтом (личным кабинетом) используйте браузер Google Chrome)</p>

                <picture>
                    <source type="{{asset('image/webp" srcset="images/img/webp/dejstvuyushim-partneram1-dest.webp')}}" media="(min-width: 768px)">
                    <source type="{{asset('image/webp" srcset="images/img/webp/dejstvuyushim-partneram1-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram1-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram1-mob.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text">Нажать <strong>«Войти»</strong></p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram2-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram2-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram2-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram2-mob.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text">Чтобы зарегистрироваться, используйте <strong>«Вход по e-mail»</strong>.</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram3-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram3-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram3-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram3-mob.jpg')}}" alt="фото"/>
                </picture>

                <div class="umdp-content__block-hidden">
                    <p class="umdp-content__text">Выбрать <strong>«Новый пользователь? Зарегистрироваться»</strong></p>


                    <picture>
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram4-dest.webp')}}" media="(min-width: 768px)">
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram4-mob.webp')}}">
                        <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram4-dest.jpg')}}" media="(min-width: 768px)">
                        <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram4-mob.jpg')}}" alt="фото"/>
                    </picture>
                </div>

                <p class="umdp-content__text">Ввести необходимые данные. E-mail должен быть активным. Нажать <strong>«Регистрация»</strong>. На указанную почту приходит письмо</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram5-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram5-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram5-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram5-mob.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text">Нажать <strong>«Подтвердить электронный адрес»</strong><br>Если e-mail адрес еще не подтверждён, появляется такое сообщение</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram6-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram6-mob.webp')}}">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram6-dest.webp')}}">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram6-dest.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text">Нажать <strong>«Выслать повторно»</strong> для подтверждения электронного адреса.</p>

                <p class="umdp-content__text">Обновить страницу сайта. <span class="umdp-content__block-hidden"> Меню личного кабинета будет выглядеть следующим образом:</span> </p>

                <picture class="umdp-content__block-hidden">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram7-dest.webp')}}">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram7-dest.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text"><strong>2. После регистрации на сайте</strong> </p>
                <p class="umdp-content__text">Далее нужно будет заполнить данные о компании, это можно сделать по ссылке<br>
                    <a class="umdp-content__link-blue" href="https://onionmarket.ru/partner_form_registration">https://onionmarket.ru/partner_form_registration</a>
                </p>
                <p class="umdp-content__text">Данные необходимо заполнять внимательно, они используются для автоматической генерации договора. После отправки данных партнёр может приступить к загрузке букетов.</p>
            </div>

            <!-- Страница Как установить приложение на рабочий экран  -->
            <div class="umdp-content umdp-section__content" data-tabs-target="umdp-page-two">

                <h2 class="umdp-content__title">Как установить приложение на рабочий экран(Google Chrome, Safari)</h2>

                <p class="umdp-content__text"><strong>1. Войти или зарегистрироваться</strong></p>

                <p class="umdp-content__text">Зайти на сайт onionmarket.ru<br>
                    В строке ввода адреса сайта (адресная строка) нажать ярлык для установки приложения</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram8-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram8-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram8-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram8-mob.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text umdp-content__text-m--56">Нажать на кнопку Установить</p>

                <p class="umdp-content__text umdp-content__text-m--none"><strong>2. Для смартфона:</strong></p>
                <p class="umdp-content__text umdp-content__text-m--none">Открыть ссылку <a class="umdp-content__link-blue" href="https://onionmarket.ru">https://onionmarket.ru</a> с помощью браузера Google Chrome (Гугл Хром) </p>
                <p class="umdp-content__text umdp-content__text-m--none">Выбрать функцию: <strong>«Установить приложение»</strong></p>

                <div>

                    <picture>
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram9-1-dest.webp')}}">
                        <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram9-1-dest.jpg')}}" alt="фото"/>
                    </picture>

                    <picture>
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram9-2-dest.webp')}}">
                        <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram9-2-dest.jpg')}}" alt="фото"/>
                    </picture>

                </div>

                <p class="umdp-content__text umdp-content__text-m--none"><strong>3. Для айфона (Safari)</strong></p>
                <p class="umdp-content__text umdp-content__text-m--none">Пролистать вниз, выбрать <strong>«На экран Домой»</strong></p>

                <div class="umdp-content__flex" >
                    <picture>
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram10-1-dest.webp')}}">
                        <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram10-1-dest.jpg')}}" alt="фото"/>
                    </picture>

                    <picture>
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram10-2-dest.webp')}}">
                        <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram10-2-dest.jpg')}}" alt="фото"/>
                    </picture>

                    <picture>
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram10-3-dest.webp')}}">
                        <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram10-3-dest.jpg')}}" alt="фото"/>
                    </picture>

                </div>

                <p class="umdp-content__text">Альтернативное меню: выбрать функцию <strong>«Добавить на табло»</strong></p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram11-dest.webp')}}">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram11-dest.jpg')}}" alt="фото"/>
                </picture>

            </div>

            <!-- Страница Как загрузить товар на сайт?  -->
            <div class="umdp-content umdp-section__content" data-tabs-target="umdp-page-three">
                <h2 class="umdp-content__title">Как загрузить товар на сайт?</h2>
                <p class="umdp-content__text"><strong>1. Войти или зарегистрироваться</strong></p>
                <p class="umdp-content__text">Загрузить товар можно только в личном кабинете. Войдите или зарегистрируйтесь на Onion Market </p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram12-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram12-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram12-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram12-mob.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text umdp-content__text-m--none"><strong>2. Перейдите в личном кабинете в раздел Товаровы (Услуги)</strong></p>
                <p class="umdp-content__text umdp-content__text-m--none">Нажмите на кнопку <strong>Создать карточку</strong></p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram13-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram13-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram13-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram13-mob.jpg')}}" alt="фото"/>
                </picture>


                <p class="umdp-content__text umdp-content__text-m--none"><strong>3. Выполните все действия пошагово</strong></p>
                <p class="umdp-content__text umdp-content__text-m--none">В открывшемся окне загрузите фото товара (услуги) и заполните все поля с данными о товаре (услуге).</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram14-1-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram14-1-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram14-1-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram14-1-mob.jpg')}}" alt="фото"/>
                </picture>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram14-2-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram14-2-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram14-2-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram14-2-mob.jpg')}}" alt="фото"/>
                </picture>


                <p class="umdp-content__text umdp-content__text-m--none"><strong>4. Добавьте описание товара (услуги). </strong></p>
                <p class="umdp-content__text umdp-content__text-m--none">Чем подробнее Вы заполните все поля для ввода, тем удобнее клиенту будет найти товар (услугу) на сайте. После заполнения нажмите кнопку <strong>Продолжить</strong>.</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram15-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram15-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram15-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram15-mob.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text"><strong>5. Укажите стоимость товара</strong> такую же, как у Вас в магазине, система сама вычтет комиссию и покажет сумму, которую Вы получите при продаже товара. Вы можете самостоятельно добавлять размер скидки на товар при желании. Нажмите кнопку <strong>Сохранить</strong>.</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram16-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram16-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram16-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram16-mob.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text umdp-content__text-m--none"><strong>6. Модерация</strong></p>
                <p class="umdp-content__text umdp-content__text-m--none">По завершению загрузки данных о товаре (услуге), информация будет отправлена на рассмотрение модератора. После подтверждения модератором товары (услуги) появятся на сайте</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram17-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram17-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram17-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram17-mob.jpg')}}" alt="фото"/>
                </picture>

            </div>

            <!-- Страница как правильно сделать фото товара для сайта  -->
            <div class="umdp-content umdp-section__content" data-tabs-target="umdp-page-four">
                <h2 class="umdp-content__title">как правильно сделать фото товара для сайта</h2>

                <p class="umdp-content__text-title"><strong>1. Оборудование фото зоны</strong></p>
                <ul class="umdp-content__list">
                    <li class="umdp-content__item">Для этого Вам понадобится:</li>
                    <li class="umdp-content__item">- зеркальный фотоаппарат или телефон</li>
                    <li class="umdp-content__item">- штатив</li>
                    <li class="umdp-content__item">- белый или серый фон</li>
                    <li class="umdp-content__item">- стол или подоконник</li>
                    <li class="umdp-content__item">- дневной свет или профессиональный свет</li>
                </ul>

                <p class="umdp-content__text-title">2. Правила съемки</p>
                <ul class="umdp-content__list umdp-content__text-m--none">
                    <li class="umdp-content__item"><strong>- Важно!!! Перед съемкой протереть камеру</strong></li>
                    <li class="umdp-content__item">- Нельзя проводить съемку против света. Солнце (свет) должно находиться за спиной и немного сбоку от фотографа. </li>
                    <li class="umdp-content__item">- Букет (товар) должен быть полностью в кадре, не обрезаться</li>
                    <li class="umdp-content__item">- Если в кадре есть рука, нужно держать букет так, как на представленных примерах</li>
                    <li class="umdp-content__item">- Фотографии должны быть качественные, предмет продажи должен быть в фокусе и без искажений</li>
                    <li class="umdp-content__item">- На фотографиях не должно быть логотипов, бирок, акций, кусков лишнего фона или стороннего изображения.</li>
                    <li class="umdp-content__item">- Предмет продажи должен иметь презентабельный вид</li>
                    <li class="umdp-content__item">- Необходимо делать фото сразу в нескольких ракурсах, они понадобятся для загрузки в карусель</li>
                </ul>

                <div class="umdp-content__wrap-flowers">
                    <h3 class="umdp-content__text--blue">Пример правильной съемки</h3>
                    <ul class="umdp-content__list-flowers">
                        <li class="umdp-content__item-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers1.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers1.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers2.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers2.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers3.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers3.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers4.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers4.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                    </ul>
                </div>

                <div class="umdp-content__wrap-flowers">
                    <h3 class="umdp-content__text--red">Пример НЕправильной съемки</h3>
                    <ul class="umdp-content__list-flowers">
                        <li class="umdp-content__item-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers5.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers5.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers6.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers6.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers7.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers7.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers8.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers8.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                    </ul>
                </div>


                <p class="umdp-content__text-title">3. Формат изображений</p>
                <ul class="umdp-content__list">
                    <li class="umdp-content__item">- Фотографии должны иметь вертикальный формат и разрешение не менее 900*1200 px.</li>
                    <li class="umdp-content__item">- Формат фотографий jpg или png</li>
                </ul>

                <p class="umdp-content__text-title">4. Добавление несколько фото в карусель</p>
                <p class="umdp-content__text umdp-content__text-m--none">После того, как фото товара утвердит модератор и добавит на сайт в обработаном виде, необходимо загрузить фото в карусель: разные ракурсы, букет в руках и т.д.</p>

                <div class="umdp-content__wrap-flowers">
                    <h3 class="umdp-content__text--blue">Как фото выглядят на сайте после обработки</h3>
                    <ul class="umdp-content__list-flowers">
                        <li class="umdp-content__item-cart-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers-cart1.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers-cart1.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-cart-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers-cart2.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers-cart2.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-cart-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers-cart3.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers-cart3.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-cart-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers-cart4.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers-cart4.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                        <li class="umdp-content__item-cart-flowers">
                            <picture>
                                <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram-flowers-cart5.webp')}}">
                                <img src="{{asset('images/img/jpg/dejstvuyushim-partneram-flowers-cart5.jpg')}}" alt="фото"/>
                            </picture>
                        </li>
                    </ul>
                </div>

                <div class="umdp-content__сitation">
                    <span class="umdp-content__сitation-quotes1"></span>
                    <p class="umdp-content__сitation-text">Обращаем Ваше внимание на то что, фотографии не должны содержать заимствований, которые нарушают авторские, смежные, личные и иные права третьих лиц, в том числе в товарах не будут незаконно использованы элементы произведений третьих лиц.</p>
                    <span class="umdp-content__сitation-quotes2"></span>
                </div>
            </div>

            <!-- Страница Как я узнаю, что поступил заказ на мой товар?  -->
            <div class="umdp-content umdp-section__content" data-tabs-target="umdp-page-five">
                <h2 class="umdp-content__title">Как я узнаю, что поступил заказ на мой товар?</h2>
                <p class="umdp-content__text">Вам придет уведомление по смс на указанный номер, сообщение на электронную почту, указанную при регистрации, а так же, подписавшись на Телеграм бот, вы будете получать сообщения о заказе в Телеграм сообщении.</p>
                <p class="umdp-content__text">Для подключения Телеграм бота зайдите в <strong>Профиль партнера- Телеграм уведомления</strong></p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram18-1-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram18-1-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram18-1-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram18-1-mob.jpg')}}" alt="фото"/>
                </picture>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram18-2-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram18-2-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram18-2-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram18-2-mob.jpg')}}" alt="фото"/>
                </picture>

                <p class="umdp-content__text umdp-content__text--blue">Пример сообщения о заказе из Телеграм бота</p>

                <picture>
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram19-dest.webp')}}" media="(min-width: 768px)">
                    <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram19-mob.webp')}}">
                    <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram19-dest.jpg')}}" media="(min-width: 768px)">
                    <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram19-mob.jpg')}}" alt="фото"/>
                </picture>
            </div>

            <!-- Страница информация о магазине  -->
            <div class="umdp-content umdp-section__content" data-tabs-target="umdp-page-six">
                <h2 class="umdp-content__title">информация о магазине</h2>
                <p class="umdp-content__text umdp-content__text-m--25">Уважаемый партнер, для загрузки информации о магазине Вам нужно нажать на кнопку <strong>Загрузить информацию</strong></p>
                <p class="umdp-content__text">Чтобы это сделать перейдите в <strong>Профиль партнера - Настройка профиля</strong></p>
                <p class="umdp-content__text">Заполните все данные о Вашем магазине и добавьте фото</p>

                <div class="umdp-content__flex">
                    <picture>
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram20-1-dest.webp')}}" media="(min-width: 768px)">
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram20-1-mob.webp')}}">
                        <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram20-1-dest.jpg')}}" media="(min-width: 768px)">
                        <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram20-1-mob.jpg')}}" alt="фото"/>
                    </picture>

                    <picture>
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram20-2-dest.webp')}}" media="(min-width: 768px)">
                        <source type="image/webp" srcset="{{asset('images/img/webp/dejstvuyushim-partneram20-2-mob.webp')}}">
                        <source srcset="{{asset('images/img/jpg/dejstvuyushim-partneram20-2-dest.jpg')}}" media="(min-width: 768px)">
                        <img class="umdp-content__img" src="{{asset('images/img/jpg/dejstvuyushim-partneram20-2-mob.jpg')}}" alt="фото"/>
                    </picture>
                </div>

            </div>

        </div>

    </div>
