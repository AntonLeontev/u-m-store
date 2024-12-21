@push('head')
    <link rel="stylesheet" href="{{ asset('css/doc.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('product.cart') }}">Корзина</a></li>
                            <li><span>Оформление заказа</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="reg">
            <div class="container">
                <div class="reg__inner">
                    <form wire:submit.prevent="create()">
                        @csrf
                    <div class="reg__title">Оформление заказа</div>
                    <div class="reg__wrapper">
                        @php($counter = 0)
                        <div class="reg__info">
                            @unless(Auth::check())
                            <div class="reg__step">{{++$counter}}. Ваши данные:</div>
                            <div class="reg__description">Авторизуйтесь, необходима авторизация</div>
                            <div class="reg__choose" id="regChoose">

{{--                                <div class="promotion__br">--}}
{{--                                    <input class="custom-checkbox" id="checkbox1" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox1">Новый пользователь</label>--}}
{{--                                </div>--}}
                                <!-- <label><input type="checkbox">Новый пользователь</label> -->
                                <div class="reg__signin">
                                    <a href="{{ route('auth') }}">Войти</a>
                                </div>
                            </div>
{{--                            <div class="reg__another another__me" id="anotherMe">--}}
{{--                                <form>--}}
{{--                                    <div class="reg__point">--}}
{{--                                        <div class="reg__information">Имя</div>--}}
{{--                                        <input type="text" name="name" placeholder="Иван">--}}
{{--                                    </div>--}}
{{--                                    <div class="reg__point">--}}
{{--                                        <div class="reg__information">Фамилия</div>--}}
{{--                                        <input type="text" placeholder="Иванов">--}}
{{--                                    </div>--}}
{{--                                    <div class="reg__point">--}}
{{--                                        <div class="reg__information">Номер телефона</div>--}}
{{--                                        <input type="text" placeholder="+79999999">--}}
{{--                                    </div>--}}
{{--                                    <div class="reg__point">--}}
{{--                                        <div class="reg__information">E-mail</div>--}}
{{--                                        <input type="text" placeholder="kizhukova@gmail.com">--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
                            @endunless
                            <div class="reg__step">{{++$counter}}. Получатель:</div>
                            <div class="reg__who" id="regWho">
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox2" name="recipient" value="0" wire:model="recipient" class="promotions__mobClick" type="radio"><label for="checkbox2">Я</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox reg__him promotions__mobClick regHim" id="checkbox3" name="recipient" wire:model="recipient" value="1" class="promotions__mobClick" type="radio"><label for="checkbox3">Другой человек</label>
                                </div>
                                <!-- <label><input type="checkbox" name="reg__who">Я</label>
                                <label><input type="checkbox" name="reg__who" class="reg__him">Другой человек</label> -->

                            </div>
                                @error('recipient')<span class="error">Выберите получателя*</span> @enderror
                            @if($recipient)
                                    <div class="reg__another another__man" id="anotherMan" style="display: block !important">
                                            <div class="reg__point">
                                                <div class="reg__information">Имя</div>
                                                <input type="text" name="recipient_name"  :value="old('recipient_name')" wire:model="recipient_name"placeholder="Иван" >
                                                @error('recipient_name')<span class="error">Введите имя получателя</span> @enderror
                                            </div>
                                            <div class="reg__point">
                                                <div class="reg__information">Фамилия</div>
                                                <input type="text" name="recipient_surname" :value="old('recipient_surname')" wire:model="recipient_surname"placeholder="Иванов" >
                                                @error('recipient_surname')<span class="error">Введите фамилию получателя</span> @enderror
                                            </div>
                                            <div class="reg__point">
                                                <div class="reg__information">Номер телефона</div>
                                                <input type="text" name="recipient_phone" :value="old('recipient_phone')" wire:model="recipient_phone" wire:keyup="inputMusk('recipient_phone')" placeholder="+7">
                                                @error('recipient_phone')<span class="error">Введите телефон получателя</span> @enderror
                                            </div>
                                    </div>
                                @endif
                            <div class="reg__step">{{++$counter}}. Способ оплаты:</div>
                            <div class="reg__how">
                                <label><input name="payment-type" value="0" wire:model="card" checked="true" type="radio">YooMoney</label>
                            </div>
{{--                            <div class="reg__how">--}}
{{--                                <label><input name="payment-type" value="1" wire:model="card" type="radio">Онлайн банковской картой</label>--}}
{{--                            </div>--}}
                                @error('card')<span class="error">Выберите способ оплаты*</span> @enderror
                            <div class="reg__zar">
                                <div class="reg__how">
                                    <label><input type="radio">Онлайн банковской картой</label>
                                </div>
                                <div class="reg__how">
                                    <label><input type="radio">Онлайн новой банковской картой</label>
                                </div>
                            </div>
                            @if($card)
                            <div class="reg__op">
                                <div class="reg__one reg__card">
                                    <div class="reg__name">Номер карты</div>
                                    <input type="hidden" id="token" value="{{ $token }}" wire:model="token">
                                    <input type="text" class="onChange" id="card_number" wire:model="card_number" wire:keyup="inputMusk('card_number')"  placeholder="0000 0000 0000 0000" autocomplete="off" required>
{{--                                       @error('card_number')<>#card_number{border-color: red}</style><span style="color: red">Некорректные данные</span> @enderror--}}

                                </div>
                                <div class="reg__one reg__small">
                                    <div class="reg__name">Срок действия</div>
                                    <div class="date" style="display: flex;">
                                    <input type="text" id="expiry_month" class="onChange" wire:model="expiry_month" class="reg__data" wire:keyup="inputMusk('expiry_month')" placeholder="00" style="padding: 10px 15px" required>
                                        <input type="text" id="expiry_year" class="onChange" wire:model="expiry_year" class="reg__data" wire:keyup="inputMusk('expiry_year')" placeholder="00" style="padding: 10px 15px" required>
                                    </div>
                                </div>
                            </div>
                                    <div class="error">
                                        @if (session()->has('invalid_number')) <span> {{ session('invalid_number') }}</span>@endif
                                        @if (session()->has('invalid_expiry_month'))  <span class="error" style="float: right">{{ session('invalid_expiry_month') }}</span>@endif
                                        @if (session()->has('invalid_expiry_year'))  <span class="error" style="float: right">{{ session('invalid_expiry_year') }}</span>@endif
                                        @error('card_number')<span class="error">Номер карты состоит из 16 цифр</span> @enderror
                                        @error('invalid_expiry_month')<span class="error">Не корректные данные</span> @enderror
                                        @error('invalid_expiry_year')<span class="error">Не корректные данные</span> @enderror
                                    </div>
                            <div class="reg__op">
                                <div class="reg__one reg__persone">
                                    <div class="reg__name">Имя и фамилия держателя карты</div>
                                    <input type="text" wire:model="card_name" wire:keyup="inputMusk('card_name')" placeholder="GDJDLDLDODODKKDLLL GDJDLDLDODODKKDLLL">
                                </div>
                                <div class="reg__one reg__small">
                                    <div class="reg__name">CVC код</div>
                                    <input type="text" class="reg__save onChange" id="cvc" wire:model="cvc" wire:keyup="inputMusk('cvc')"  placeholder="000" required>
                                    @if (session()->has('invalid_cvc'))  <span class="error">{{ session('invalid_cvc') }}</span>@endif
                                </div>
                            </div>
                               @if (session()->has('error_code'))  <span class="error">{{ session('error_code') }}</span>@endif
{{--                            <div class="promotion__br">--}}
{{--                                <input class="custom-checkbox" id="checkbox4" name="reg__who"  class="promotions__mobClick" type="checkbox"><label for="checkbox4" class="reg__memory">Запомнить карту</label>--}}
{{--                            </div>--}}
                            @endif
                            <!-- <label class="reg__memory"><input type="checkbox">Запомнить карту</label> -->
                            <div class="reg__step">{{++$counter}}. Способ доставки (для товаров):</div>
                            <div class="reg__del" id="regDel">
                                @if($partner)
                                <label><input type="radio" name="reg__del" wire:model="delivery"  value="0">Самовывоз<br><span> {{ $partner->actual_address }}</span></label>
                                @endif
                                <label><input type="radio" name="reg__del" class="reg__place" wire:model="delivery" value="1">Доставка по адресу</label>
                                @error('delivery')<span class="error">Выберите способ доставки*</span> @enderror
                            </div>
                             @if($delivery)
                            <div id="anotherCity" class="reg__another another__city" style="display: block !important">
                                    <div class="reg__point">
                                        <div class="reg__information">Город</div>
                                        <input type="text" name="delivery_city" wire:model="delivery_city" placeholder="Москва" readonly>
                                        @error('delivery_city')<span class="error">Введите город*</span> @enderror
                                    </div>
                                    <div class="reg__point">
                                        <div class="reg__information">Адрес</div>
                                        <input type="text" name="delivery_street" wire:model="delivery_address" placeholder="Тимирязевская 8/38">
                                        @error('delivery_address')<span class="error">Введите адрес*</span> @enderror
                                     </div>
                             </div>
                                @endif
                                <div class="reg__point">
                                    <div class="reg__information">Комментарий</div>
                                    <input type="text" name="recipient_message" :value="old('recipient_message')" wire:model="recipient_message"placeholder="Комментарий...">
                                </div>
                        </div>
                        @if(Session::get('checkout'))
                            <div class="reg__right">
                            <div class="reg__schet">
                                <div class="reg__finally">
                                    <div class="reg__itog">Итого</div>
                                    <div class="reg__money" wire:model="amount" value="{{ Session::get('checkout')['total'] }}">{{ Session::get('checkout')['total'] }} руб.</div>
                                </div>
                                <div class="reg__row">
                                    <div class="reg__pos">Товары (услуги), шт.</div>
                                    <div class="reg__znac">{{ Session::get('checkout')['qty'] }}</div>
                                </div>
                                @if(Session::get('checkout')['discount'] > 0)
                                <div class="reg__row">
                                    <div class="reg__pos">Скидка, руб.</div>
                                    <div class="reg__znac">{{ Session::get('checkout')['discount'] }}</div>
                                </div>
                                @endif
                                @if(Session('checkout')['delivery_price'])
                                <div class="reg__row">
                                    <div class="reg__pos">Доставка, руб.</div>
                                    <div class="reg__znac">{{ Session('checkout')['delivery_price'] }}</div>
                                </div>
                                @endif
{{--                                @if(session::has('error_city')) {{ session('error_city') }} @endif--}}
                                <div class="reg__click">
                                    <button type="submit" class="reg__btn">Подтвердить заказ</button>
                                </div>
                                @if(session()->has('error_pay')) <span class="error">{{ session('error_pay') }}</span> @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
            @if(session()->has('error_city'))
                <div id="thanks" class="thanks" style="display: block !important;box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1);">
                    <h3 class="thanks__title">{{ session('error_city') }}</h3>
                    <div id="thanksClose" class="thanks__close" onclick="document.querySelector('#thanks').style.display = 'none'"><img src="{{ asset('images/closePartner.svg') }}" alt="close" /></div>
                    <div id="thanksBtn" class="main__btn thanks__btn" onclick="document.querySelector('#thanks').style.display = 'none'">Закрыть</div>
                </div>
            @endif
        </section>


        <section class="reg">
            <div class="container">
                <div class="reg__inner">
                    <div class="reg__title">Оформление заказа</div>
                    <div class="basket__inner">
                        <div class="basket__wrapper">
                            @foreach(Cart::instance('cart')->content() as $item)



                                <div class="basket__item">
                                    <div class="basket__info">
                                        <div class="basket__img" onclick="location.href= '{{route('product.details', [session('city')['slug'], 'slug'=>$item->id])}}'">
                                            <img src="{{ asset('storage/') }}/{{ $item->options['image'] }}" alt="{{$item->name}}" style="max-width: 60px;">
                                        </div>
                                        <div class="basket__uno">
                                            <div class="basket__name" onclick="location.href='{{route('product.details', [session('city')['slug'], 'slug'=>$item->id])}}'">{{$item->name}}
                                                @if(isset($item->options['option_name']))
                                                    <br> <span style="font-size: 12px"> {{ $item->options['option_name'] }}</span>
                                                @endif
                                            </div>
                                            <div class="basket__someClass">
                                                <div class="basket__kol">
                                                    <div class="basket__min" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')">
                                                        <img src="{{ asset('images/min.svg')}}" alt="minus">
                                                    </div>
                                                    <div class="basket__num">
                                                        <span class="basket__kolvo">{{ $item->qty }}</span>
                                                        <div class="basket__list">
                                                            @for($i = 1; $i <= 20; $i++)
                                                                <div class="basket__var" wire:click.prevent="setQuantity('{{$item->rowId}}', '{{ $i }}')">{{ $i }}</div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="basket__plus" wire:click.prevent="increaseQuantity('{{$item->rowId}}')">
                                                        <img src="{{ asset('images/plus.svg')}}" alt="plus">
                                                    </div>
                                                </div>
                                                <div class="basket__price">{{ number_format($item->subtotal, 0,'','')}} <span class="ruble-icon">₽</span></div>
                                                <div class="basket__delete" wire:click.prevent="destroy('{{$item->rowId}}')">
                                                    <img src="{{ asset('images/basket(2).svg')}}" alt="delete">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        <div class="basket__schet basket__schet--no">
                            <div class="basket__cover">
                                <div class="basket__row">
                                    <div class="basket__pos">Товары (<span class="basket__tovar__kol">{{ Cart::instance('cart')->count() }}</span>)</div>
                                    <div class="basket__znac">{{ Cart::instance('cart')->total() }} <span class="ruble-icon">₽</span></div>
                                </div>
{{--                                @if(Session::get('checkout')['discount'] > 0)--}}
                                    <div class="basket__row">
                                        <div class="basket__pos">Скидка, руб.</div>
                                        <div class="basket__znac basket__skidka"> –{{ Session::get('checkout')['discount'] }} <span class="ruble-icon">₽</span></div>
                                    </div>
{{--                                @endif--}}
{{--                                @if(Session('checkout')['delivery_price'])--}}
                                    <div class="basket__row">
                                        <div class="basket__pos">Доставка, руб.</div>
                                        <div class="basket__znac">{{ session('checkout')['delivery_price'] }} <span class="ruble-icon">₽</span></div>
                                    </div>
{{--                                @endif--}}
                                <div class="basket__finally">
                                    <div class="basket__itog">Итого</div>
                                    <div class="basket__money">{{ Session::get('checkout')['total'] }} <span class="ruble-icon">₽</span></div>
                                </div>
                            </div>

                            <div class="basket__cover">
                                <div class="reg__step">Получатель</div>

                                <div class="reg__person--signin">
                                    <div class="reg__persone--edit" id="regPersoneEdit">
                                        <img src="{{ asset('images/edit.svg') }}" alt="edit">
                                    </div>
                                    <div class="reg__persone--done" id="regPersoneDone">
                                        <div class="reg__person--name">{{ Auth::user()->name }}</div>
                                        <div class="reg__person--contacts">
                                            <div class="reg__person--phone">{{ Auth::user()->phone }}</div>
                                            <div class="reg__person--mail">{{ Auth::user()->email }}</div>
                                        </div>
                                    </div>
                                    <div class="reg__persone--change" id="regPersoneChange">
                                        <div class="reg__person--name">
                                            <input type="text" placeholder="ФИО">
                                        </div>
                                        <div class="reg__person--contacts">
                                            <div class="reg__person--phone">
                                                <input type="tel" placeholder="Телефон">
                                            </div>
                                            <div class="reg__person--mail">
                                                <input type="email" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="reg__need">Необходимо авторизоваться</div>
                                <div class="common__buy reg__signin">
                                    <a href="#">Войти</a>
                                </div>
                                <div class="reg__step">Адрес</div>
                                <div class="reg__del" id="regDel">
                                    <label class="label__block"><input type="radio" name="reg__del" class="address__yourself"><span></span>Самовывоз<p class="hide__address"><br>г. Москва, ул. Тимирязевская, 25</p></label>
                                    <label class="label__block label__block--no"><input type="radio" name="reg__del" class="reg__place"><span></span>Доставка по адресу</label>
                                </div>
                                <div class="reg__another another__city" id="anotherCity">
                                    <div class="reg__town">г. Москва, ул. Тимирязевская, 25</div>
                                    <div class="reg__plus" id="regPlus">Добавить адрес</div>
                                    <form class="reg__plus__form" id="regPLusForm">
                                        @csrf
                                        <div class="reg__point">
                                            <!-- <div class="reg__information">Город</div> -->
                                            <input type="text" placeholder="Город">
                                        </div>
                                        <div class="reg__point">
                                            <!-- <div class="reg__information">Улица</div> -->
                                            <input type="text" placeholder="Адрес">
                                        </div>
                                    </form>
                                </div>
                                <div class="reg__comment">
                                    <div class="comment__name">Комментарий к заказу</div>
                                    <div class="comment__input">
                                        <textarea name="" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="basket__cover">
                                <div class="reg__bottom">
                                    <div class="reg__step">Оплата</div>
                                    <div class="reg__how">
                                        <label class="label__block"><input type="radio" class="reg__how__choose" name="reg__pay__input"><span></span>Картой</label>
                                    </div>
                                    <div class="reg__one__choose">
                                        <div class="mine__card">Visa **1234</div>
                                        <div class="reg__plus__card" id="regPlusCard">Добавить карту</div>
                                        <div class="addCard__form addCard__form--one cardFormReg">
                                            <form>
                                                @csrf
                                                <div class="addCard__pay">
                                                    <div class="addCard__logos">
                                                        <div class="addCard__logo">
                                                            <img src="images/cardOne.svg" alt="">
                                                        </div>
                                                        <div class="addCard__logo">
                                                            <img src="images/cardTwo.png" alt="">
                                                        </div>
                                                        <div class="addCard__logo">
                                                            <img src="images/cardThree.png" alt="">
                                                        </div>
                                                        <div class="addCard__logo">
                                                            <img src="images/cardFour.svg" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="addCard__num">
                                                        <div class="addCard__top">Номер карты</div>
                                                        <div class="addCard__input">
                                                            <input type="text" id="addCardCard" placeholder="0000 0000 0000 0000">
                                                        </div>
                                                    </div>
                                                    <div class="addCard__inner">
                                                        <div class="addCard__one">
                                                            <div class="addCard__top">Срок действия</div>
                                                            <div class="addCard__wrapper">
                                                                <div class="addCard__input">
                                                                    <input type="text" id="addCardTwo" placeholder="MM">
                                                                </div>
                                                                <div class="addCard__input">
                                                                    <input type="text" id="addCardFour" placeholder="YYYY">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="addCard__one">
                                                            <div class="addCard__three">
                                                                <div class="addCard__top">CVV/CVV</div>
                                                                <div class="addCard__input">
                                                                    <input type="password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="addCard__num">
                                                        <div class="addCard__top">Держатель карты</div>
                                                        <div class="addCard__input">
                                                            <input type="text" placeholder="Ivan Ivanov">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="promotion__br">
                                                    <input class="custom-checkbox" id="checkbox4" name="reg__who" class="promotions__mobClick" type="checkbox"><label for="checkbox4" class="reg__memory">Запомнить карту</label>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                    <div class="reg__how reg__how--cash">
                                        <label class="label__block"><input type="radio" class="reg__how--two" name="reg__pay__input"><span></span>UM Кошелек</label>
                                    </div>
                                    <div class="reg__how--two--block">
                                        Баланс: <div class="reg__balance">2500 <span class="ruble-icon">₽</span></div>
                                        <div class="reg__none__money">
                                            Недостаточно средств
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>


@push('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://static.yoomoney.ru/checkout-js/v1/checkout.js"></script>
<script src="{{asset('js/main.js')}}"> </script>

<script>

    document.addEventListener('livewire:load', function () {
    @this.on('cardReady', ()=> {
        getToken();
    });
    })

function getToken() {
    let number = @this.card_number
    let cvc = @this.cvc
    let month = @this.expiry_month
    let year = @this.expiry_year
    if(number.length === 19 && year.length === 2 && month.length === 2 && cvc.length === 3)
    {

     const checkout = YooMoneyCheckout(814947, {
         language: 'ru'
     });
     checkout.tokenize({
         number: number,
         cvc: cvc,
         month: month,
         year: year
     }).then(res => {
         if (res.status === 'success') {
             const { paymentToken } = res.data.response;
         @this.set('token', paymentToken);

         } else if (res.status === 'error') {
             const { type } = res.error;
            @this.emit('cardErrorMessage', res.error.params);

         }
     });
     }
    }
</script>

@endpush

