@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css"
          integrity="sha512-Ujn3LMQ8mHWqy7EPP32eqGKBhBU8v39JRIfCer4nTZqlsSZIwy5g3Wz9SaZrd6pp3vmjI34yyzguZ2KQ66CLSQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('um-basket-shipping.css') }}">
    <link rel="stylesheet" href="{{ asset('css/doc.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>Корзина</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="basket">
            <div class="container">
                @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <span> {{Session::get('success_message')}} </span>
                    </div>
                @endif
                @if(Cart::instance('cart')->count() > 0)
                    <div class="basket__top">
                        <div class="basket__title">Корзина</div>

                        <div class="basket__uno">
                            <div class="basket__remove" wire:click.prevent="destroyAll()">
                                Очистить корзину
                            </div>
                        </div>

                        @php
                            $wish_items = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp
                    </div>
                    <div class="basket__inner">
                        <div class="basket__wrapper">
                            <div class="basket__item">
                                    <div class="basket__info">
                                        {{-- @if($delivery_city_sochi)
                                            <span style="color: #00bf3f">При заказе на сумму от 2000 рублей доставка по г. Сочи бесплатная! <br> В других городах района Сочи доставка платная.
                                            <br>Доставка круглосуточная при размещении заказа до 18.00 по мск, все заказы размещенные после 18.00 будут доставлены на следующий день</span>
                                        @else
                                        <span style="color: #00bf3f">При заказе на сумму от 2000 рублей  доставка по городу бесплатная!</span>
                                        @endif --}}
                                    </div>

                                </div>
                                @if($gift_certificate_nominal<Cart::instance('cart')->total() and $gift_certificate_nominal)
                                    <div class="basket__item">
                                        <div class="basket__info">
                                            <span style="color: red ">Ваш сертификат на сумму {{$gift_certificate_nominal}}руб.<br> Но Вы можете доплатить сумму которой вам не хватает для покупки.</span>
                                        </div>

                                    </div>
                                @endif
                                @foreach(Cart::instance('cart')->content() as $item)
                                    <div class="basket__item">
                                        <div class="basket__info">
                                            <div class="basket__img"
                                                 onclick="location.href= '{{route('product.details', [session('city')['slug'], 'slug'=>$item->id])}}'">
                                                <img src="{{ asset('storage/') }}/{{ $item->options['image'] }}"
                                                     alt="{{$item->name}}" style="max-width: 60px;">
                                            </div>
                                            <div class="basket__uno">
                                                <div class="basket__name"
                                                     onclick="location.href='{{route('product.details', [session('city')['slug'], 'slug'=>$item->id])}}'">{{$item->name}}
                                                    @if(isset($item->options['option_name']))
                                                        <br> <span
                                                            style="font-size: 12px"> {{ $item->options['option_name'] }}</span>
                                                    @endif
                                                </div>
                                                <div class="basket__someClass">
                                                    <div class="basket__kol">
                                                        <div class="basket__min"
                                                             wire:click.prevent="decreaseQuantity('{{$item->rowId}}')">
                                                            <img src="{{ asset('images/min.svg')}}" alt="minus">
                                                        </div>
                                                        <div class="basket__num">
                                                            <span class="basket__kolvo">{{ $item->qty }}</span>
                                                            <div class="basket__list">
                                                                @for($i = 1; $i <= 20; $i++)
                                                                    <div class="basket__var"
                                                                         wire:click.prevent="setQuantity('{{$item->rowId}}', '{{ $i }}')">{{ $i }}</div>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <div class="basket__plus"
                                                             wire:click.prevent="increaseQuantity('{{$item->rowId}}')">
                                                            <img src="{{ asset('images/plus.svg')}}" alt="plus">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="basket__price">{{ number_format($item->subtotal, 0,'','')}}
                                                        <span class="ruble-icon">₽</span></div>
                                                    <div class="basket__delete"
                                                         wire:click.prevent="destroy('{{$item->rowId}}')">
                                                        <img src="{{ asset('images/basket(2).svg')}}" alt="delete">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="basket__schet">
                                @if(Session::has('discount'))
                                    <div class="basket__row">
                                        <div class="basket__pos">Товары (<span
                                                class="basket__tovar__kol">{{ Cart::instance('cart')->count() }}</span>)
                                        </div>
                                        <div class="basket__znac"> {{ Cart::instance('cart')->total() }} <span
                                                class="ruble-icon">₽</span></div>
                                    </div>
                                    <div class="basket__row">
                                        <div class="basket__pos">Скидка, руб.</div>
                                        <div class="basket__delete" style="flex-grow: 1;">
                                            <img src="{{ asset('images/basket(2).svg')}}" alt="del"
                                                 wire:click.prevent="removeDiscount">
                                        </div>
                                        <div class="basket__znac basket__skidka"> –{{ $discount }} <span
                                                class="ruble-icon">₽</span>
                                        </div>

                                    </div>
                                    @if($delivery_price && $delivery)
                                        <div class="basket__row">
                                            <div class="basket__pos">Доставка, руб.</div>
                                                <div class="basket__znac">{{ $delivery_price }}<span
                                                        class="ruble-icon">₽</span>
                                                </div>
                                        </div>
                                    @endif

                                    <div class="basket__finally">
                                        <div class="basket__itog">Итого</div>


                                        @if($delivery)
                                            <div class="basket__money"> {{ $totalAfterDiscount + $this->delivery_price}}
                                                <span class="ruble-icon">₽</span></div>
                                        @else
                                            <div class="basket__money test"> {{ $totalAfterDiscount}} <span
                                                    class="ruble-icon">₽</span></div>
                                        @endif
                                    </div>

                                @else
                                    <div class="basket__row">
                                        <div class="basket__pos">Товары (<span
                                                class="basket__tovar__kol">{{ Cart::instance('cart')->count() }}</span>)
                                        </div>
                                        <div class="basket__znac">  {{ Cart::instance('cart')->total()}} <span
                                                class="ruble-icon">₽</span></div>
                                    </div>
                                    @if($delivery_price && $delivery &&  Cart::instance('cart')->total()<2000 || $delivery_city_sochi == 2 && $delivery && $delivery_price)

                                        <div class="basket__row">
                                            <div class="basket__pos">Доставка, руб.</div>
                                            <div class="basket__znac">{{ $delivery_price }}<span
                                                    class="ruble-icon">₽</span>
                                            </div>
                                        </div>
                                        {{--                                Если сумма больше 2000руб то доставка бесплатная--}}
                                    @elseif($delivery_price && $delivery &&  Cart::instance('cart')->total()>2000)

                                        @if($delivery_city_sochi == 2)
{{--                                            В городах Сочи нет бесплатной доставки--}}
                                            <div class="basket__row">
                                                <div class="basket__pos">
                                                    Доставка, руб.
                                                </div>
                                                <div class="basket__znac">{{ $delivery_price }}
                                                    <span class="ruble-icon">₽</span>
                                                </div>
                                            </div>
										@else
											<div class="basket__row">
												<div class="basket__pos" style="color: red; text-decoration: line-through">
													Доставка, руб.
												</div>
												<div class="basket__znac"
													style="color: red; text-decoration: line-through">{{ $delivery_price }}
													{{--                                Обнуляем стоимость доставки перед выводом итоговой цены--}}
													@php($delivery_price = 0)
													<span class="ruble-icon">₽</span>
												</div>
											</div>
                                        @endif

                                    @endif
                                    <div class="basket__finally">
                                        <div class="basket__itog">Итого</div>
                                        @if($delivery)
                                            <div
                                                class="basket__money"> {{ Cart::instance('cart')->total() + $delivery_price-$gift_certificate_nominal>0? Cart::instance('cart')->total() + $delivery_price-$gift_certificate_nominal :0}}
                                                <span class="ruble-icon">₽</span></div>
                                        @else
                                            <div class="basket__money"> {{ Cart::instance('cart')->total()-$gift_certificate_nominal>0 ? Cart::instance('cart')->total()-$gift_certificate_nominal : 0}} <span
                                                    class="ruble-icon">₽</span></div>
                                        @endif
                                    </div>
                                @endif


                                <div class="basket__click" style="box-shadow: none;">

                                    @if($delivery_price>0 and !$gift_certificate_nominal)
                                        <label class="label__block">
                                            <input type="radio" name="basket__choose" id="basketOne"
                                                   class="basket__input"
                                                   checked="true" value="1" wire:model="haveCode">
                                            <span></span>Использовать купон или промокод
                                        </label>

                                        @if($bonuses_total > 0)
                                            <label class="label__block"><input type="radio" name="basket__choose"
                                                                               id="basketThree" class="basket__input"
                                                                               value="0"
                                                                               wire:model="haveCode"><span></span>Использовать
                                                бонусы</label>
                                        @endif

                                        @if($haveCode)
                                            <form wire:submit.prevent="haveCode">
                                                @csrf
                                                <label class="basket__two" for="basketOne" style="display: block;">
                                                    <input type="text" placeholder="Купон или Промокод"
                                                           wire:model="coupon_code" maxlength="20">

                                                    <button type="submit" class="common__close">Применить</button>
                                                </label>
                                                @error('coupon_code')<span class="error">{{$message}}</span> @enderror
                                            </form>
                                        @else
                                            <form wire:submit.prevent="useBonuses">
                                                @csrf
                                                <label class="basket__two" for="basketThree" style="display: flex;">
                                                    <input type="text" placeholder="{{$bonuses_total}}"
                                                           wire:model="bonuses"
                                                           onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"
                                                           maxlength="20">
                                                    <button type="submit" class="common__close"
                                                            style="align-self: flex-start;">
                                                        Применить
                                                    </button>
                                                </label>
                                            </form>
                                        @endif
                                    @endif
                                    <div class="basket__cover" style="box-shadow: none;">
                                        @if(Auth::check())
                                            <div class="reg__step">Получатель</div>
                                            <div class="reg__personget">
                                                <div class="reg__how">
                                                    <label class="label__block">
                                                        <input type="radio" class="reg__basket__who"
                                                               name="reg__basket__who"
                                                               wire:model="recipient" value="0"><span></span>Я</label>
                                                </div>
                                                <div class="reg__how">
                                                    <label class="label__block">
                                                        <input type="radio"
                                                               class="reg__basket__who--two"
                                                               name="reg__basket__who"
                                                               wire:model="recipient"
                                                               value="1"><span></span>Другой человек</label>
                                                </div>
                                            </div>
                                            <div class="reg__person--signin" style="margin-bottom: 20px">
                                                {{--                                                                            @if($recipient)--}}
                                                {{--                                                                                <div class="reg__persone--edit" id="regPersoneEdit" wire:click="editRecipient(false)">--}}
                                                {{--                                                                                    <img src="{{ asset('images/personeChange.svg') }}" alt="edit">--}}
                                                {{--                                                                                </div>--}}
                                                {{--                                                                            @else--}}
                                                {{--                                                                                <div class="reg__persone--edit clicked" id="regPersoneEdit" wire:click="editRecipient(true)">--}}
                                                {{--                                                                                    <img src="{{ asset('images/edit.svg') }}" alt="edit">--}}
                                                {{--                                                                                </div>--}}
                                                {{--                                                                            @endif--}}
                                                @if($recipient)
                                                    <div class="reg__persone--change" id="regPersoneChange"
                                                         style="display: block !important;">
                                                        <div class="reg__person--name">
                                                            <input type="text" wire:model.defer="recipient_name"
                                                                   placeholder="ФИО" maxlength="100">
                                                            @error('recipient_name')<span class="error">Введите имя получателя</span> @enderror
                                                        </div>
                                                        <div class="reg__person--contacts">
                                                            <div class="reg__person--phone">
                                                                <input type="tel" wire:model.defer="recipient_phone"
                                                                       wire:keyup="phoneMask()" placeholder="Телефон"
                                                                       onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"
                                                                       maxlength="15">
                                                                @error('recipient_phone')<span class="error">Введите телефон получателя</span> @enderror
                                                            </div>
                                                            <div class="reg__person--mail">
                                                                <input type="email" wire:model.defer="recipient_email"
                                                                       placeholder="Email">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- чекбокс для социальных сетей -->
                                                    <label class="reg__soc-label ">
                                                        <input class="reg__soc-checkbox js-soc-checkbox" type="checkbox"
                                                               wire:model="social_delivery">
                                                        <span
                                                            class="reg__soc-text">Связаться через социальные сети</span>
                                                    </label>

                                                    <!-- обертка соц-сетей -->
                                                    @if($social_delivery)
                                                        <div class="req__soc-wrapper js-soc-wrapper">
                                                            <div class="reg__soc">
                                                                <p class="reg__soc-desc">
                                                                    Вы можете использовать ссылки Вконтакте, OK.RU
{{--                                                                    Instagram,--}}
{{--                                                                    Facebook --}}
                                                                    или Телеграм.
                                                                </p>
                                                                <label class="reg__soc-label reg__soc-label_center">
                                                                    <input class="reg__soc-checkbox"
                                                                           type="checkbox"
                                                                           wire:model.debounce.500ms="social_telegram_recipient">
                                                                    <span class="reg__soc-text reg__soc-text_small">Указать никнейм Telegram получателя</span>
                                                                </label>
                                                                {{-- {{dd($social_delivery)}}--}}
                                                                @if(!$social_telegram_recipient)
                                                                    <label class="reg__soc-group">
                                                                        <div class="reg__soc-heading">Получатель</div>
                                                                        <input list="link_list" class="reg__soc-input"
                                                                               type="text"
                                                                               placeholder="https://vk.com/unitedmarketorg"
                                                                               wire:model.debounce.500ms="url_recipient">
                                                                        <datalist id="link_list">
                                                                            <option>https://vk.com/</option>
                                                                            <option>https://ok.ru/</option>
{{--                                                                            <option>https://www.facebook.com/</option>--}}
{{--                                                                            <option>https://www.instagram.com/</option>--}}
                                                                        </datalist>
                                                                    </label>
                                                                    <a href="{{$url_recipient}}" target="_blank">
                                                                        <button class="reg__soc-btn">Проверить ссылку
                                                                        </button>
                                                                    </a>
                                                                    @error('url_recipient')
                                                                    <div><span
                                                                            class="error">{{$message}}</span>
                                                                    </div> @enderror
                                                                @endif
                                                                @if($social_telegram_recipient)
                                                                    <label class="reg__soc-group">
                                                                        <div class="reg__soc-heading">Телеграм никнейм
                                                                            получателя
                                                                        </div>
                                                                        <input class="reg__soc-input" type="text"
                                                                               placeholder="@user_name"
                                                                               wire:model.debounce.500ms="telegram_recipient">
                                                                    </label>
                                                                    <a href="https://t.me/{{Str::after($telegram_recipient, '@')}}"
                                                                       target="_blank">
                                                                        <button class="reg__soc-btn">Проверить никнейм
                                                                        </button>
                                                                    </a>
                                                                    @error('telegram_recipient')
                                                                    <div><span
                                                                            class="error">{{$message}}</span>
                                                                    </div> @enderror
                                                                @endif
                                                                <label class="reg__soc-label reg__soc-label_center ">
                                                                    <input class="reg__soc-checkbox"
                                                                           type="checkbox"
                                                                           wire:model.debounce.500ms="social_telegram_sender">
                                                                    <span class="reg__soc-text reg__soc-text_small">Указать Telegram отправителя</span>
                                                                </label>
                                                                @if(!$social_telegram_sender)
                                                                    <label class="reg__soc-group">
                                                                        <div class="reg__soc-heading">Отправитель</div>
                                                                        <input list="link_list" class="reg__soc-input"
                                                                               type="text"
                                                                               placeholder="https://vk.com/unitedmarketorg"
                                                                               wire:model.debounce.500ms="url_sender">
                                                                        <datalist id="link_list">
                                                                            <option>https://vk.com/</option>
                                                                            <option>https://www.facebook.com/</option>
                                                                            <option>https://www.instagram.com/</option>
                                                                        </datalist>
                                                                    </label>
                                                                    <a href="{{$url_sender}}" target="_blank">
                                                                        <button class="reg__soc-btn">Проверить ссылку
                                                                        </button>
                                                                    </a>
                                                                    @error('url_sender')
                                                                    <div><span
                                                                            class="error">{{$message}}</span>
                                                                    </div> @enderror
                                                                @endif
                                                                @if($social_telegram_sender)
                                                                    <label class="reg__soc-group">
                                                                        <div class="reg__soc-heading">Телеграм никнейм
                                                                            отправителя
                                                                        </div>
                                                                        <input class="reg__soc-input" type="text"
                                                                               placeholder="@user_name"
                                                                               wire:model.debounce.500ms="telegram_sender">
                                                                    </label>
                                                                    <a href="https://t.me/{{Str::after($telegram_sender, '@')}}"
                                                                       target="_blank">
                                                                        <button class="reg__soc-btn">Проверить никнейм
                                                                        </button>
                                                                    </a>
                                                                    @error('telegram_sender')
                                                                    <div><span
                                                                            class="error">{{$message}}</span>
                                                                    </div> @enderror
                                                                @endif


                                                                <p class="reg__soc-footnote">
                                                                    Используя доставку другому человеку через социальные
                                                                    сети, Вы даете согласие на передачу получателю
                                                                    ссылки на
                                                                    свою социальную сеть
                                                                </p>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="reg__persone--done" id="regPersoneDone"
                                                         style="display: block !important;">
                                                        <div class="reg__person--name"> {{ Auth::user()->name }}</div>
                                                        <div class="reg__person--contacts">
                                                            @if(Auth::user()->phone)
                                                                <div
                                                                    class="reg__person--phone">{{ Auth::user()->phone }}</div>
                                                            @else
                                                                <div class="reg__point">
                                                                    <input type="tel" wire:model="user_phone"
                                                                           wire:keyup="phoneMask()"
                                                                           placeholder="Телефон 7 999 999 99 99"
                                                                           onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"
                                                                           maxlength="15">
                                                                    @error('user_phone')<span
                                                                        class="error">{{$message}}</span> @enderror
                                                                </div>
                                                            @endif

                                                        </div>
                                                        <div class="reg__person--mail">{{ Auth::user()->email }}</div>
                                                    </div>
                                            </div>
                                    @endif
                                    @if(!$social_delivery)
                                        <!-- обертка без соц-сетей -->
                                            <div class="js-reg-del-wrapper">
                                                <div class="reg__del" id="regDel">
                                                    <div class="reg__step">Адрес</div>

                                                    @if($partner_address && count($partner_address)>0)
                                                        <label class="label__block"
                                                               @if(!$delivery)
                                                               style="flex-wrap: wrap; color: #3a3a3e;"
                                                            @endif
                                                        >
                                                            <input
                                                                type="radio"
                                                                name="reg__del"
                                                                class="address__yourself"
                                                                value="0"
                                                                wire:model="delivery"
                                                                checked="true"
                                                            >
                                                            <span></span>
                                                            Самовывоз
                                                            @if(!$delivery)
                                                                @foreach($partner_address as $key=>$address)
                                                                    <label class="reg__pickup-address">
                                                                        <input
                                                                            type="radio"
                                                                            name="del"
                                                                            value="{{ $key }}"
                                                                            wire:model="partner_address_selected"
                                                                        >
                                                                        {{ $address->address }}
                                                                        <span
                                                                            class="reg__pickup-radio" @if($delivery)  @endif></span>
                                                                    </label>
                                                                    {{--                                                                                    <p class="hide__address" style="display: block !important; position: relative; bottom: auto;top: 0;margin-top: auto;"><br>{{ $delivery_city }}, {{  $address->address }}</p>--}}
                                                                    {{--                                                                                    <br>--}}
                                                                @endforeach
                                                            @endif
                                                        </label>
                                                    @endif
                                                    {{--{{dd($delivery)}}--}}
                                                    <label class="label__block label__block--no"
                                                           @if($delivery) style="color: #3a3a3e;" @endif>
                                                        <input type="radio" name="reg__del" class="reg__place" value="1"
                                                               wire:model="delivery">
                                                        <span @if($delivery)  @endif ></span>
                                                        Доставка по адресу
                                                    </label>
                                                </div>
                                                @if($delivery)
                                                    <div class="reg__another another__city" id="anotherCity"
                                                         style="display: block !important; margin-top: 8px;">
                                                        @if(count($delivery_prices) > 0)
                                                            <label class="um-basket-shipping__label">
                                                                {{-- <span class="um-basket-shipping__text">Города доставки<span class="um-basket-shipping__asterisk">&#42;</span></span> --}}
                                                                <select class="um-basket-shipping__input" placeholder="ID торговой точки" required wire:change="setCity($event.target.value)" wire:ignore >
																	@foreach ($delivery_prices as $delivery_price)
                                                                        <option value="Cочи-{{ $delivery_price['price'] }}">{{ $delivery_price['region'] }} - {{ $delivery_price['price'] }}₽</option>
																	@endforeach
                                                                </select>
                                                            </label>
                                                        @else
                                                            <div class="reg__town">
                                                                {{ $delivery_city }}, {{  $delivery_address }}
                                                            </div>
                                                        @endif
                                                        <br>
                                                        {{--<div class="reg__plus" id="regPlus">Добавить адрес</div>--}}
                                                        <form class="reg__plus__form" id="regPLusForm"
                                                              style="display: block !important">
                                                            @csrf
                                                            {{--<div class="reg__point">--}}
                                                            {{--<!-- <div class="reg__information">Город</div> -->--}}
                                                            {{--<input type="text" placeholder="Город" wire:model="delivery_city" readonly>--}}
                                                            {{--</div>--}}
                                                            <div class="reg__point">
                                                                <!-- <div class="reg__information">Улица</div> -->
                                                                <input type="text" placeholder="Адрес"
                                                                       wire:model.lazy="delivery_address">

                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                                @if(session()->has('delivery_address_error'))<span
                                                    class="error">{{ session('delivery_address_error') }}</span> @enderror
                                            @if($delivery)
                                                <div class="basket__cover basket__cover--time">
                                                    <div class="reg__bottom">
                                                        <div class="reg__step">Время доставки</div>
                                                        <div class="reg__how">
                                                            <label class="label__block">
                                                                <input type="radio"
																	class="reg__time__now"
																	name="reg__time__now"
																	wire:model="delivery_time"
																	value="0"><span></span>Как
                                                                можно скорее</label>
                                                        </div>
                                                        <div class="reg__how reg__how--cash">
                                                            <label class="label__block "><input type="radio"
                                                                                                 class="reg__time__now--two"
                                                                                                 name="reg__time__now"
                                                                                                 wire:model="delivery_time"
                                                                                                 value="1"><span></span>Ко
                                                                времени</label>
                                                        </div>
                                                        @if($delivery_time)
                                                            <div class="basket__time" style="display: flex;">
                                                                <div class="basket__hour">
                                                                    <input id="basket__hour-input" type="text" readonly
                                                                           placeholder="09:00" class=""
                                                                           wire:model="delivery_hour"
                                                                           onclick="$('.basket__hours').toggle();$(this).toggleClass('opened')">
                                                                    <div class="basket__hours">
                                                                        <div class="basket__onetime">09:00</div>
                                                                        <div class="basket__onetime">10:00</div>
                                                                        <div class="basket__onetime">11:00</div>
                                                                        <div class="basket__onetime">12:00</div>
                                                                        <div class="basket__onetime">13:00</div>
                                                                        <div class="basket__onetime">14:00</div>
                                                                        <div class="basket__onetime">15:00</div>
                                                                        <div class="basket__onetime">16:00</div>
                                                                        <div class="basket__onetime">17:00</div>
                                                                        <div class="basket__onetime">18:00</div>
                                                                        <div class="basket__onetime">19:00</div>
                                                                        <div class="basket__onetime">20:00</div>
                                                                        <div class="basket__onetime">21:00</div>
                                                                        <div class="basket__onetime">22:00</div>
                                                                    </div>
                                                                    <div class="time__arrow"
                                                                         onclick="$('.basket__hours').toggle(); $('#basket__hour-input').toggleClass('opened')">
                                                                        <img src="{{ asset('images/timeArrow.svg') }}"
                                                                             alt="time">
                                                                    </div>
                                                                </div>
                                                                <div class="basket__date">
                                                                    {{--                                                                                         <input type="date">--}}
                                                                    <input id="myDatepicker" type='text' readonly
                                                                           class="date"
                                                                           data-auto-close="true"
                                                                           data-position="right top"/>

                                                                    <div id="basket__image" class="basket__image">
                                                                        <img src="{{ asset('images/date.svg') }}"
                                                                             alt="date">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('delivery_date') <span class="error"> Укажите дату нажав на синюю иконку</span> @enderror
                                                            <script>


                                                                $('.date').datepicker({
                                                                    autoclose: true,
                                                                    minDate: new Date(),
                                                                    // timepicker: true,
                                                                    minHours: 9,
                                                                    maxHours: 22,
                                                                    onSelect: function (fd, date) {
                                                                    @this.set('delivery_date', fd);
                                                                    }
                                                                });

                                                                $('.basket__onetime').on('click', function () {
                                                                @this.set('delivery_hour', $(this).html());
                                                                    $('#basket__hour-input').toggleClass('opened');
                                                                    $('.basket__hours').hide();
                                                                });
                                                            </script>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                    @endif

                                    <!-- <script>
                                        const socCheckbox = document.querySelector('.js-soc-checkbox');

                                        if (socCheckbox) {
                                            const delWrapper = document.querySelector('.js-reg-del-wrapper');
                                            const socWrapper = document.querySelector('.js-soc-wrapper');
                                            socCheckbox.addEventListener('change', (e) => {
                                                e.target.checked ?
                                                    (socWrapper.style.display = "",
                                                        delWrapper.style.display = "none") :
                                                    (socWrapper.style.display = "none",
                                                        delWrapper.style.display = "")
                                            })
                                        }
                                    </script> -->

                                        <div class="reg__comment">
                                            <div class="comment__name">Комментарий к заказу</div>
                                            <div class="comment__input">
                                            <textarea name="" id="id" cols="30" rows="10"
                                                      wire:model="recipient_message" maxlength="250"></textarea>
                                                @error('recipient_message') <span
                                                    class="error"> {{$message}}</span> @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <button class="basket__btn common__close" wire:click.prevent="checkout" wire:loading.attr="disabled" wire:loading.class="cursorOff">Перейти к
                                        оформлению
                                    </button>
                                    @else
{{--                                        <div class="reg__need">Необходимо авторизоваться</div>--}}
{{--                                        <div class="common__buy reg__signin">--}}
{{--                                            <a href="{{ route('auth') }}">Войти</a>--}}
{{--                                        </div>--}}
                                        @livewire('auth-by-call')
                                            <style>
                                                .signReg__form input{padding-left: 20px !important;}
                                                .signReg__title{font-size: 18px;}
                                                .signReg__description,#regSignEmail{display: none}
                                                #regSign{margin-top: 0;padding: 40px !important;}
                                                .basket__cover{padding: 0;}
                                                .signReg{box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15)}
                                            </style>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                @else
                    <h2>Ваша корзина пуста</h2>
                @endif
            </div>
        </section>
    </div>
</div>


@push('footer')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"
            integrity="sha512-sM9DpZQXHGs+rFjJYXE1OcuCviEgaXoQIvgsH7nejZB64A09lKeTU4nrs/K6YxFs6f+9FF2awNeJTkaLuplBhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        document.addEventListener('livewire:load', function () {

            const basketClick = (item, block) => {
                if (document.documentElement.clientWidth < 500) {
                    document.querySelectorAll(item).forEach((one, index) => {
                        one.addEventListener('click', () => {
                            if (one.classList.contains('clicked')) {
                                one.classList.remove('clicked');
                                document.querySelectorAll(block)[index].style.display = 'none';
                            } else {
                                one.classList.add('clicked');
                                document.querySelectorAll(block)[index].style.display = 'block';
                            }
                        });
                    });
                }
            }
            try {
                basketClick('.basket__num', '.basket__list')
            } catch {
            }


            const chooseItem = (one, string, list) => {
                if (document.documentElement.clientWidth < 500) {
                    document.querySelectorAll(one).forEach((item, index) => {
                        item.addEventListener('click', () => {
                            document.querySelectorAll(list).forEach((some, num) => {
                                if (some == item.parentElement) {
                                    document.querySelectorAll(string)[num].textContent = item.textContent;
                                }
                            });
                        });
                    });
                }
            }
            try {
                chooseItem('.basket__var', '.basket__kolvo', '.basket__list');
            } catch {
            }

        });
    </script>
@endpush

