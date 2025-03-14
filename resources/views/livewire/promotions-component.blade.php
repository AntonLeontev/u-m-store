@section('title')
    <title>{{$seo['title']}}</title>
@endsection
@section('meta.description.keywords')
    <meta name="description" content="{{$seo['meta_description']}}"/>
    <meta name="keywords" content="{{$seo['meta_keywords']}}"/>
@endsection
@push('head')
    <link rel="stylesheet"href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <nav>
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>Акции</span></li>
                        </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="promotions">
            <div class="container">
                <div class="promotions__inner">
                    <div class="promotions__title">Акции</div>
                    <div class="promotions__choose" id="promotionsChoose">Фильтры</div>
                    <div class="promotions__hide" id="promotionsHide">
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox1" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox1">Доставка букетов</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox2" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox2">Авто</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox3" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox3">Детские игрушки</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox4" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox4">Дизайн интерьеров</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox5" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox5">Доставка еды</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox6" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox6">Доставка овощей и фрутов</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox7" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox7">Зоотовары</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox8" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox8">Кальянные</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox9" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox9">Клининг</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox10" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox10">Кузнечные мастерские</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbo11" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbo11">Мелкий ремонт- муж на час</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox12" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox12">Организация праздников</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox13" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox13">Подарки ручной работы</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox14" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox14">Пошив и ремонт одежды</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox15" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox15">Салон красоты</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox16" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox16">Сервисный центр – ремонт техники</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox16" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox16">Столярные мастерские</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox17" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox17">Строительство</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox18" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox18">Товары 18+</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox19" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox19">Туры и Отели</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox20" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox20">Фитнес и спорт</label>
                        </div>
                        <div class="promotion__br">
                            <input class="custom-checkbox" id="checkbox21" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox21">Фотоуслуги и видео услуги</label>
                        </div>
                    </div>
                    <div class="promotions__click">
                        <div class="promotions__akc">Акции</div>
                        <ul class="promotions__list">
                            @foreach($directions as $direction)

                            <li>
                                <a href="{{route('promotions',['direction_slug'=>$direction->id, 'city'=>session('city')['slug']])}}" class="promotions__touch {{Request::query('direction_slug')==$direction->id ? 'promotions__flowers' : '' }}">{{$direction->name}}</a>
                            </li>
                            @endforeach
{{--                            {{Request::query('direction_slug')}}--}}

                        </ul>
                    </div>
                    <div class="promotions__window">
                        <div class="promotions__one">
                            <div class="promotions__month">Ноябрь 2021</div>
                            <div class="promotion__all">
                                @foreach()
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions1.png" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 16.11.2021 по 30.11.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span> Закажи букет из 101 розы с 16 по 31 ноября 2021года и получи купон со скидкой 15% на следующий заказ. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions3.svg" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.11.2021 по 15.07.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span> Закажи букет из 51 розы с 1 по 15 ноября 2021года и получи купон со скидкой 15% на следующий заказ. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions5.svg" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.11.2021 по 30.11.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span> Закажи букет с 1 по 30 ноября 2021 года и получи купон со скидкой на следующий заказ. При заказе букета на сумму 1900-2899₽ – купон на 500₽,  при заказе букета на сумму 2900-3899₽ – купон на 1000₽,  при заказе букета на сумму от 3900₽ – купон на 1500₽. Срок действия купона - 3 месяца с момента его получения, купоном можно оплатить до 40% заказа. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions6.svg" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.11.2021 по 30.11.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span> Скидка на все букеты с хризантемами 10% при покупке на нашем сайте с 1 по 30 ноября 2021года. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="promotions__all">
                                <div class="promotions__month">Октябрь 2021</div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions1.png" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 05.10.2021 по 25.10.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Закажи букет из 101 розы с 5 по 25 октября 2021года и получи купон со скидкой 15% на следующий заказ. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/stock6.png" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.10.2021 по 31.10.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Покупай букеты из одного вида цветов с 1 по 31 октября 2021года на нашем сайте со скидкой 7%. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions3.svg" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.10.2021 по 04.10.21, 26.10.2021 по 31.10.2021</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Закажи букет из 51 розы с 1 по 4 октября и с 26 по 31 октября 2021года и получи купон со скидкой 15% на следующий заказ. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="promotions__all">
                                <div class="promotions__month">Сентябрь 2021</div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions3.svg" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 29.09.2021 по 30.09.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span> Закажи букет из 51 розы с 21 по 30 сентября 2021года и получи купон со скидкой 15% на следующий заказ. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions1.png" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.09.2021 по 20.09.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Закажи букет из 101 розы с 1 по 20 сентября 2021года и получи купон со скидкой 15% на следующий заказ. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions4.svg" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.09.2021 по 30.09.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Скидка на все букеты с герберами 10% при покупке на нашем сайте с 1 по 30 сентября 2021года. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions5.svg" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.09.2021 по 30.09.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Закажи букет с 1 по 30 сентября 2021 года и получи купон со скидкой на следующий заказ. При заказе букета на сумму 1900-2899₽ – купон на 500₽,  при заказе букета на сумму 2900-3899₽ – купон на 1000₽,  при заказе букета на сумму от 3900₽ – купон на 1500₽. Срок действия купона - 3 месяца с момента его получения, купоном можно оплатить до 40% заказа. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="promotions__one">
                            <div class="promotions__month">Июль 2021</div>
                            <div class="promotion__all">
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions1.png" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 05.07.2021 по 25.07.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Закажи букет из 101 розы с 5 по 25 июля 2021года и получи купон со скидкой 15% на следующий заказ. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/stock6.png" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.07.2021 по 31.07.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Покупай букеты из одного вида цветов с 1 по 31 июля 2021года на нашем сайте со скидкой 7%. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                                <div class="promotions__item">
                                    <div class="promotions__img">
                                        <img src="images/promotions3.svg" alt="">
                                    </div>
                                    <div class="promotions__info">
                                        <div class="promotions__data"><span>Срок действия: </span>с 01.07.2021 по 04.07.21</div>
                                        <div class="promotions__text"><span>Условия проведения: </span>Закажи букет из 51 розы с 1 по 4 июля 2021года и получи купон со скидкой 15% на следующий заказ. Скидки не суммируются и действуют на заказ на 1 адрес доставки.</div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
