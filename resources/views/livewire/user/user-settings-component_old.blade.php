@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
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
                            <div class="promotions__choose" id="promotionsChoose">Фильтры</div>
                            @include('livewire.user.includes.user-mobile-menu')
                            <div class="set__one">
                                <div class="set__step">1. Личная информация</div>
                                <div class="set__description">Заполните свой профиль</div>
                                <div class="set__form">
                                    <form wire:submit.prevent="setSettings">
                                        @csrf
                                        <div class="set__pos">Имя</div>
                                        <input type="text" placeholder="Иван" wire:model.defer="name">
                                        @error('name') <div class="error">Введите свое имя*</div> @enderror
                                        <div class="set__pos">Фамилия</div>
                                        <input type="text" placeholder="Иванов" wire:model.defer="surname">
                                        <div class="set__pos">Номер телефона</div>
                                        <input type="text" id="inputNumber" placeholder="9999999999" wire:model.defer="phone" wire:keyup="phoneMask" >
                                        @error('phone') <div class="error">Будьте внимательны, телефон нужен для входа в систему*</div> @enderror
                                        @if(session()->has('phone_not_unique'))  <div class="error"><span> Такой телефон уже зарегистрирован</span></div> @endif
                                        <div class="set__pos">E-mail</div>
                                        <input type="email" class="set__email" placeholder="name@mail.com" wire:model.defer="email">
                                        @error('email') <div class="error">Укажите свой e-mail*</div> @enderror
                                        @if(session()->has('email_not_unique'))  <div class="error"><span> Такой e-mail уже зарегистрирован</span></div> @endif
                                        <div class="set__pos">Город</div>
                                        <input type="text" placeholder="Москва"  wire:model.defer="city">
                                        @error('city') <div class="error">Укажите свой город*</div> @enderror
                                        <div class="set__pos">Адрес для доставки</div>
                                        <input type="text" placeholder="Тимирязевская д.8 кв. 48" wire:model.defer="address">
                                        @if(session()->has('success'))  <div class="alert-success" style="max-width: 550px; margin-top: 15px;"><span> Данные успешно сохранены </span></div> @endif
                                        <div class="reg__flex">
                                            <button type="submit">Сохранить</button>
{{--                                            <a href="{{ route('logout') }}" class="set__logout">Выйти</a>--}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="set__one" style="display: none">
                                <div class="set__step">2. Данные о картах:
                                    <div class="set__delete" id="setDeleteTwo">
                                        <img src=" {{ asset('images/basket(2).svg') }}" alt="">
                                    </div>
                                </div>
                                <div class="set__add">
                                    <a href="#" id="addNewCard">Добавить карту</a>
                                </div>
                                <div class="set__form" style="display: none">
                                    <form>
                                        @csrf
                                        <div class="set__card" id="setCard">
                                            <div class="set__pos">Logo visa</div>
                                            <div class="set__card--input">
                                                <input type="text" value="**33">
                                                <div class="set__delete" id="setDelete">
                                                    <img src="images/basket(2).svg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="set__new" id="setNew">
                                            <a href="#">Добавить карту</a>
                                        </div>
                                        <div class="reg__op">
                                            <div class="reg__one reg__card">
                                                <div class="reg__name" >Номер карты</div>
                                                <input type="text" id="cardNumber" placeholder="0000 0000 0000 0000">
                                            </div>
                                            <div class="reg__one reg__small">
                                                <div class="reg__name">Срок действия</div>
                                                <input type="text" class="reg__data" id="fourNumeral" placeholder="00/00">
                                            </div>
                                        </div>
                                        <div class="reg__op">
                                            <div class="reg__one reg__persone">
                                                <div class="reg__name">Имя и фамилия держателя карты</div>
                                                <input type="text" placeholder="GDJDLDLDODODKKDLLL GDJDLDLDODODKKDLLL">
                                            </div>
                                            <div class="reg__one reg__small">
                                                <div class="reg__name">CVC код</div>
                                                <input type="text" class="reg__save" id="threeNumeral" placeholder="000">
                                            </div>
                                        </div>

                                        <button>Сохранить</button>
                                    </form>
                                </div>
                            </div>
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
        <img src="images/closeImage.svg" alt="">
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
        <img src="images/closeImage.svg" alt="">
    </div>
</div>

{{--@push('footer')--}}
{{--<script>--}}
{{--    const swiper1 = new Swiper('.swiper-container-1', {--}}
{{--        loop: true,--}}
{{--        slidesPerView: 5,--}}
{{--        navigation: {--}}
{{--            nextEl: '.swiper-button-next',--}}
{{--            prevEl: '.swiper-button-prev',--}}
{{--        },--}}
{{--        breakpoints: {--}}
{{--            0: {--}}
{{--                slidesPerView: 1,--}}
{{--                spaceBetween: 20,--}}
{{--            },--}}
{{--            1000: {--}}
{{--                slidesPerView: 3,--}}
{{--            },--}}
{{--            1300: {--}}
{{--                slidesPerView: 5,--}}
{{--            },--}}
{{--        }--}}
{{--    });--}}
{{--    const swiper2 = new Swiper('.swiper-container-2', {--}}
{{--        loop: true,--}}
{{--        slidesPerView: 4,--}}
{{--        breakpoints: {--}}
{{--            0: {--}}
{{--                slidesPerView: 1,--}}
{{--                spaceBetween: 20,--}}
{{--                slidesPerView: 'auto'--}}
{{--            },--}}
{{--            768: {--}}
{{--                slidesPerView: 2,--}}
{{--                spaceBetween: 20,--}}
{{--            },--}}
{{--            1000: {--}}
{{--                slidesPerView: 3,--}}
{{--                spaceBetween: 20,--}}
{{--            },--}}
{{--            1050: {--}}
{{--                slidesPerView: 4,--}}
{{--                spaceBetween: 20,--}}
{{--            },--}}
{{--        }--}}
{{--    });--}}
{{--    const swiper3 = new Swiper('.swiper-container-3', {--}}
{{--        loop: true,--}}
{{--        slidesPerView: 1,--}}
{{--        navigation: {--}}
{{--            nextEl: '.swiper-button-next',--}}
{{--            prevEl: '.swiper-button-prev',--}}
{{--        },--}}
{{--    });--}}

{{--</script>--}}
{{--@endpush--}}
