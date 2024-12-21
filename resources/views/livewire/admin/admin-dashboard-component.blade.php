@push('head')
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
@endpush

<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <a href="#" class="major__btn-prev"></a>
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><span>Профиль партнера</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{--
            Профиль инвестора,
            нужно подставить данные,
            изменить путь к картинкам
        --}}
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">ПРОФИЛЬ ПАРТНЕРА</div>
                    <div class="profile__wrapper">
                        @include('livewire.admin.includes.main-menu')

                        <div class="profile__bigboxing">
                            @include('livewire.admin.includes.mobile-main-menu')

                            <div class="profile__info profile__info--investor">
{{--                                <div class="profile__welcome" style="padding-bottom: 25px;">--}}
{{--                                    <div class="investor__welcomeback">С возвращением, Иван!</div>--}}
{{--                                    <div class="investor__bottom">--}}
{{--                                        <img src="images/investorBottom.svg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="investor__logo">--}}
{{--                                        <img src="images/investorLogo.svg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="investor__image">--}}
{{--                                        <div class="investor__photo">--}}
{{--                                            <img src="images/investorPhoto.png" alt="">--}}
{{--                                        </div>--}}
{{--                                        <div class="investor__newphoto">--}}
{{--                                            <img src="images/investorAddPhoto.png" alt="">--}}
{{--                                        </div>--}}
{{--                                        <div class="investor__addPhoto">--}}
{{--                                            <div class="investor__addPhoto--text">Обновить фото профиля</div>--}}
{{--                                            <div class="investor__addPhoto--add">--}}
{{--                                                <input type="file" class="investor__addPhoto--download">--}}
{{--                                                <a href="#" class="investor__addPhoto--fake">Загрузить фото</a>--}}
{{--                                            </div>--}}
{{--                                            <div class="investor__addPhoto--close">--}}
{{--                                                <img src="images/close.svg" alt="">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="profile__investor">
                                    <div class="investor__item">
                                        <div class="profile__description">Организация</div>
                                        <div class="profile__row profile__row--top">
                                            <div class="profile__one">Город:</div>
                                            <div class="profile__one">{{ $store_city }}</div>
                                        </div>
                                        <div class="profile__row">
                                            <div class="profile__one">Название:</div>
                                            <div class="profile__one">{{ $partner->organisation_name }}</div>
                                        </div>
                                        <div class="profile__row">
                                            <div class="profile__one">Телефон:</div>
                                            <div class="profile__one">{{ $partner->telephone }}</div>
                                        </div>
                                        <div class="profile__row">
                                            <div class="profile__one">E-mail:</div>
                                            <div class="profile__one">{{ $partner->email }}</div>
                                        </div>

                                        <div class="profile__set">
                                            <a href="{{ route('admin.settings') }}">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.25 9H15.75" stroke="#ACB1C8" stroke-width="2" stroke-linecap="round"/>
                                                    <path d="M11.25 13.5L15.75 9L11.25 4.5" stroke="#ACB1C8" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    @if($last_saved_product)
                                        <div class="investor__item">
                                            <div class="profile__description">Последние загрузки</div>
                                            <div class="profile__row profile__row--top">
                                                <div class="profile__one">Дата:</div>
                                                <div class="profile__one">{{ Date::parse($last_saved_product->created_at)->format('d.m.Y') }}</div>
                                            </div>
                                            <div class="profile__row">
                                                <div class="profile__one">Количетсво товара:</div>
                                                <div class="profile__one">{{ $saved_products_count }}</div>
                                            </div>
                                            <div class="profile__row">
                                                <div class="profile__one">Статус:</div>
                                                <div class="profile__one">{{ $last_saved_product->moderated ? 'Опубликован': 'На рассмотрении' }}</div>
                                            </div>
                                            <!-- <div class="profile__more">
                                                <a class="profile__exit" href="#">
                                                    <img src="images/arrow.svg" alt="">
                                                </a>
                                            </div> -->
                                            <div class="profile__set">
                                                <a href="{{ route('admin.products') }}">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M2.25 9H15.75" stroke="#ACB1C8" stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M11.25 13.5L15.75 9L11.25 4.5" stroke="#ACB1C8" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @if($order_last)
                                        <div class="investor__item">
                                            <div class="profile__description">Заказы</div>
                                            <div class="profile__row profile__row--top">
                                                <div class="profile__one">Дата:</div>
                                                <div class="profile__one">{{ Date::parse($order_last->created_at)->format('d.m.Y') }}</div>
                                            </div>
                                            <div class="profile__row">
                                                <div class="profile__one">Номер заказа:</div>
                                                <div class="profile__one">{{ $order_last->id }}</div>
                                            </div>
                                            <div class="profile__row">
                                                <div class="profile__one">Сумма:</div>
                                                <div class="profile__one">{{ number_format($order_last->total, 0,' ',' ') }} <span class="ruble-icon">₽</span></div>
                                            </div>
                                            <div class="profile__row">
                                                <div class="profile__one">Доставка:</div>
                                                <div class="profile__one profile__one_tiny">{{ $order_last->address }}</div>
                                            </div>
                                            <!-- <div class="profile__more">
                                                <a class="profile__exit" href="#">
                                                    <img src="images/arrow.svg" alt="">
                                                </a>
                                            </div> -->
                                            <div class="profile__set">
                                                <a href="{{ route('admin.orders') }}">
                                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M2.25 9H15.75" stroke="#ACB1C8" stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M11.25 13.5L15.75 9L11.25 4.5" stroke="#ACB1C8" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="investor__item" style="visibility: hidden">
                                        <div class="profile__description">Остатки товара</div>
                                        <div class="profile__row profile__row--top">
                                            <div class="profile__one">Роза белая кустовая</div>
                                            <div class="profile__one">менее 10 шт.</div>
                                        </div>
                                        <!-- <div class="profile__more">
                                            <a class="profile__exit" href="#">
                                                <img src="images/arrow.svg" alt="">
                                            </a>
                                        </div> -->
                                        <div class="profile__set">
                                            <a href="#">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.25 9H15.75" stroke-width="2" stroke-linecap="round"/>
                                                    <path d="M11.25 13.5L15.75 9L11.25 4.5" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



