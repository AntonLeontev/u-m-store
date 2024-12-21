@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <!-- подключение стилей слайдера -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <!-- подключение стилей калькулятора -->
    <link rel="stylesheet" href="{{asset('css/air-datepicker.css')}}">
    <!-- подключение общих стилей -->
    <link rel="stylesheet" href="{{asset('css/um-main.css')}}">
    <!-- подключение иконочных шрифтов -->
    <link rel="stylesheet" href="{{asset('css/um-icon-style.css')}}">
    <!-- подключение стилей блока -->
    <link rel="stylesheet" href="{{asset('css/um-user-settings.css')}}">
    <!-- https://dadata.ru/ -->
    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">Профиль</a></li>
                            <li><span>Настройки профиля</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Профиль</div>
                    <div class="profile__wrapper">
                        @include('livewire.user.includes.user-menu')
                        <div class="set__inner">

                            @include('livewire.user.includes.user-mobile-menu')

                            <!-- Секция редактировать профиль -->
                            <div class="umsp-block">
                                    <!-- Блок информация пользователя -->
                                    <div class="umsp-user-info umsp-block__umsp-user-info">

                                        <button class="umsp-btn-edit umsp-block__umsp-btn-edit" onclick="document.querySelector('#umspPopapEditor').style.display = 'flex'">
                                            <span class="visually-hidden">Редактировать профиль</span>
                                            <i class="icon-um-edit"></i>
                                        </button>

                                        <div class="umsp-user-photo umsp-user-info__umsp-user-photo">

                                            <picture>
                                                @if($tmp_avatar)
                                                    <img class="umsp-user-photo__img" src="{{ $tmp_avatar->temporaryUrl() }}" alt="фото"/>
                                                @else
                                                    @if($avatar)
                                                        <img class="umsp-user-photo__img" src="{{ asset('storage/'. $avatar) }}" alt="фото"/>
                                                    @else
                                                        <img class="umsp-user-photo__img" src="{{ asset('images/png/photo-profil-plug.png') }}" alt="фото"/>
                                                    @endif
                                                @endif
                                            </picture>

{{--                                            <label class="umsp-user-photo__btn">--}}
{{--                                                <input class="umsp-user-photo__input" type="file" wire:model="tmp_avatar">--}}
{{--                                                <span class="visually-hidden">Загрузить фото</span>--}}
{{--                                                <i class="icon-um-photo"></i>--}}
{{--                                            </label>--}}

                                        </div>

                                        <div class="umsp-user-info__wrap">
                                            <div class="umsp-user-info__user-name">{{ $fullname }}</div>

                                            <div class="umsp-user-data umsp-user-info__umsp-user-data">
                                                <ul class="umsp-user-data__list">
                                                    <li class="umsp-user-data__item umsp-user-data__item-title">Телефон</li>
                                                    <li class="umsp-user-data__item umsp-user-data__item-text">{{ $phone }}</li>
                                                </ul>
                                                <ul class="umsp-user-data__list">
                                                    <li class="umsp-user-data__item umsp-user-data__item-title">Email</li>
                                                    <li class="umsp-user-data__item umsp-user-data__item-text umsp-user-data__item-text--line">{{ $email }}</li>
                                                </ul>
                                                <ul class="umsp-user-data__list">
                                                    <li class="umsp-user-data__item umsp-user-data__item-title">Дата рождения</li>
                                                    <!-- Если есть дата рождения необходимо убрать класс umsp-user-data__item-text--add-text -->
                                                    <li class="umsp-user-data__item umsp-user-data__item-text @if(empty($birthdate)) umsp-user-data__item-text--add-text @endif">
                                                    {{ $birthdate }}</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Блок социальных сетей -->
                                    <div class="umsp-user-social umsp-block__umsp-user-social">
                                        <h3 class="umsp-user-social__title">Привязать социальные сети</h3>
                                        <p class="umsp-user-social__text">Вы можете привязать свои социальные сети, нажав на иконку. Это даст возможность авторизации с помощью социальных сетей, а так же ускорит процесс оформления заказа с мощью социальных сетей</p>
                                        <ul class="umsp-user-social__list">
                                            <li class="umsp-user-social__item">
                                                <!-- При активации соц. сети добавляется класс umsp-user-social__link--activ-vk -->
                                                <a class="umsp-user-social__link {{ in_array('vk', $socials) ? 'umsp-user-social__link--activ-vk' : '' }}" href="{{ route('soc.auth', ['service' => 'vk']) }}">
                                                    <i class="umsp-user-social__icon icon-um-vk"></i>
                                                    <span class="visually-hidden">Вконтакте</span>
                                                </a>
                                            </li>
                                            <li class="umsp-user-social__item">
                                                <!-- При активации соц. сети добавляется класс umsp-user-social__link--activ-cs -->
                                                <a class="umsp-user-social__link {{ in_array('ok', $socials) ? 'umsp-user-social__link--activ-cs' : '' }}"  href="{{ route('soc.auth', ['service' => 'ok']) }}">
                                                    <i class="umsp-user-social__icon icon-um-classmates"></i>
                                                    <span class="visually-hidden">Одноклассники</span>
                                                </a>
                                            </li>
                                            <!-- телеграм позволяет использовать только свою кнопку -->
{{--                                            {!! Socialite::driver('telegram')->getButton() !!}--}}
{{--                                            <li class="umsp-user-social__item">--}}
{{--                                                <!-- При активации соц. сети добавляется класс umsp-user-social__link--active-tm -->--}}
{{--                                                <a class="umsp-user-social__link" {{ in_array('tg', $socials) ? 'umsp-user-social__link--active-tm' : '' }} href="{{ route('soc.auth', ['service' => 'tg']) }}">--}}
{{--                                                    <i class="umsp-user-social__icon icon-um-telegram"></i>--}}
{{--                                                    <span class="visually-hidden">Телеграм</span>--}}
{{--                                                </a>--}}
{{--                                            </li>--}}

                                        </ul>
                                    </div>

                                    <div class="umsp-user-adress umsp-block__umsp-user-address">
                                        <h3 class="umsp-user-adress__title">Адреса</h3>
                                        @if($addresses)
                                            @foreach($addresses as $key => $fullAddress)
                                                @if($key == 0)
                                                    <div class="umsp-user-adress__text-wrap">
                                                        <p class="umsp-user-adress__text-main">{{ $fullAddress->city }}, {{ $fullAddress->address }}</p>
                                                        <span class="umsp-user-adress__text-delet" wire:click="deleteAddress"><i class="icon-um-city-close"></i></span></div>
                                                @else
                                                   <div class="umsp-user-adress__text-wrap"><p class="umsp-user-adress__text">{{ $fullAddress->city }}, {{ $fullAddress->address }}</p>
                                                       <span class="umsp-user-adress__text-delet" wire:click="deleteAddress({{$key}})"><i class="icon-um-city-close"></i></span>
                                                   </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        @error('not_unique')<span class="error">{{ $message }}</span> @enderror
                                        <button class="umsp-user-adress__btn"  onclick="document.querySelector('#umspPopupAddAddress').style.display = 'block'">Добавить адрес</button>
                                    </div>

                                    <button class="umsp-btn-delet umsp-block__umsp-btn-delet" onclick="document.querySelector('#umspPopupDelet').style.display = 'block'">Удалить профиль</button>

                                </div>

                            <!-- попап редактирование -->
                            @include('livewire.includes.user-settings-edit-profile')

                            <!-- попап удалить страницу -->
                            @include('livewire.includes.user-settings-delete-profile')

                            <!-- попап добавить адрес -->
                            @include('livewire.includes.user-settings-add-address')

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<div class="data" id="newCard">
    <div class="set__form">
        <form>
            @csrf
            <div class="reg__op">
                <div class="reg__one reg__card">
                    <div class="reg__name" >Номер карты</div>
                    <input type="text" id="cardNumber2" placeholder="0000 0000 0000 0000">
                </div>
                <div class="reg__one reg__small">
                    <div class="reg__name">Срок действия</div>
                    <input type="text" class="reg__data" id="fourNumeral2" placeholder="00/00">
                </div>
            </div>
            <div class="reg__op">
                <div class="reg__one reg__persone">
                    <div class="reg__name">Имя держателя карты</div>
                    <input type="text" placeholder="GDJDLDLDODODKKDLLL GDJDLDLDODODKKDLLL">
                </div>
                <div class="reg__one reg__small">
                    <div class="reg__name">CVC код</div>
                    <input type="text" class="reg__save" id="threeNumeral2" placeholder="000">
                </div>
            </div>
            <div class="reg__op">
                <div class="reg__one reg__persone">
                    <div class="reg__name">Фамилия держателя карты</div>
                    <input type="text" placeholder="GDJDLDLDODODKKDLLL GDJDLDLDODODKKDLLL">
                </div>
            </div>
            <button>Сохранить</button>
        </form>
    </div>
    <div class="data__close" id="newCardClose">
        <img src="{{ asset('images/closeImage.svg') }}" alt="">
    </div>
</div>

<div class="exiting" id="cardExit">
    <div class="exiting__text">Вы уверены,что хотите выйти?</div>
    <div class="exiting__buttons">
        <div class="exiting__btn" id="exitNo">
            <a href="#">Отмена</a>
        </div>
        <div class="exiting__btn" id="exitYes">
            <a href="#">Да</a>
        </div>
    </div>
    <div class="exiting__close" id="exitClose">
        <img src="{{'images/closeImage.svg'}}" alt="">
    </div>
</div>

@push('footer')
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- подключение скрипта калькулятора -->
    <script src="{{asset('js/um-js/air-datepicker.js')}}"></script>
    <!-- подключение основного js -->
    <script src="{{asset('js/um-js/um-user-settings.js')}}"></script>
    <!-- https://dadata.ru/ -->
    <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>
    <script>
        $("#city").suggestions({
            token: "{{ env('DADATA_TOKEN') }}",
            type: "ADDRESS",
            hint: false,
            bounds: "city-settlement",
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            // onSelect: function(suggestion) {
            //     console.log(suggestion);
            // }
        });
        $("#address").suggestions({
            token: "{{ env('DADATA_TOKEN') }}",
            type: "ADDRESS",
            hint: false,
            bounds: "street",
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            // onSelect: function(suggestion) {
            //     console.log(suggestion);
            // }
        });
    </script>
@endpush
