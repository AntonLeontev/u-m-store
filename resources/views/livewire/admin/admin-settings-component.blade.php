@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
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
                    <div class="profile__title active">Профиль партнера</div>
                    <div class="profile__wrapper">
                        @include('livewire.admin.includes.main-menu')
                        <div class="set__inner">
                            @include('livewire.admin.includes.mobile-main-menu')

                            <div class="set__one">
                                <div class="set__step">Информация о вашей организации:</div>
                                <div class="set__form">
                                    <form wire:submit.prevent="setSettings" wire:ignore>
                                        @csrf
{{--                                        Новые поля ввода--}}
                                        {{-- <div class="set__pos" style="color: red">Эти данные изменяются через менеджера.<span
                                                class="label__partner"></span></div>
                                        <div class="set__pos">Сфера услуг/товаров:<span
                                                class="label__partner"></span></div>
                                        <input type="text" wire:model="direction"
                                               placeholder="Доставка цветов" readonly>
                                        <div class="set__pos">Город:<span class="label__partner"></span></div>
                                        <input type="text" wire:model="city_name"
                                               placeholder="Зеленоград" readonly>
                                        @if($partner_type ==='ООО')
                                            <div class="set__pos">Генеральный Директор:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="director_name"
                                                  readonly>
                                            <div class="set__pos">Главный бухгалтер:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="bohalter_name"
                                                   readonly>
                                        @endif

                                        @if($partner_type !='Самозанятый')
                                        <div class="set__pos">Полное наименование:<span
                                                class="label__partner"></span></div>
                                        <input type="text" wire:model="org_full_name" value="{{ $org_full_name }}" readonly>

                                        <div class="set__pos">Сокращенное наименование:<span
                                                class="label__partner"></span></div>
                                        <input type="text" wire:model="org_short_name"
                                               placeholder="ООО Василёк" readonly >
                                        @endif
                                        <div class="set__pos">Номер телефона владельца:<span
                                                class="label__partner"></span></div>
                                        <input type="text" wire:model="mobile_tel_owner" readonly>

                                        <div class="set__pos">ИНН:<span class="label__partner"></span></div>
                                        <input type="text" wire:model.defer="inn" readonly>
                                        @if($partner_type ==='ИП')
                                            <div class="set__pos">ОГРНИП</div>
                                            <input type="text" wire:model.defer="ogrn_ip" readonly>
                                        @endif
                                        @if($partner_type ==='ООО')
                                        <div class="set__pos">ОГРН:<span class="label__partner"></span></div>
                                        <input type="text" wire:model.defer="ogrn" readonly>
                                        @endif
                                        <div class="set__pos">Наименование Банка:<span class="label__partner"></span></div>
                                        <input type="text" wire:model="bank_name" readonly>
                                        <div class="set__pos">БИК:<span class="label__partner"></span></div>
                                        <input type="text" wire:model.defer="bik" readonly>
                                        <div class="set__pos">Кор. сч.<span class="label__partner"></span></div>
                                        <input type="text" wire:model.defer="kor_account" readonly>
                                        <div class="set__pos">Расчетный счет (р/c):<span class="label__partner"></span></div>
                                        <input type="text" wire:model.defer="bank_account" readonly>
                                        @if($partner_type !='Самозанятый')
                                        <div class="set__pos">Юридический адрес:<span class="label__partner"></span></div>
                                        <input type="text" wire:model.defer="legal_address" readonly>
                                        <div class="set__pos">Фактический адрес:<span
                                                class="label__partner"></span>
                                        </div>
                                        <input type="text" wire:model="actual_address"
                                               readonly>
                                        @endif
                                        <div class="set__pos">Почтовый адрес (а/я):<span class="label__partner"></span></div>
                                        <input type="text" wire:model="post_address"
                                               readonly>


                                        @if($partner_type ==='Самозанятый')
                                            <div class="set__pos">ФИО:<span class="label__partner"></span>
                                            </div>
                                            <input type="text" wire:model="fio"
                                                   readonly>

                                            <div class="set__pos">№ и серия Паспорта:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="passport_data" readonly>


                                            <div class="set__pos">Адрес регистрации:<span
                                                    class="label__partner"></span>
                                            </div>
                                            <input type="text" wire:model="reg_address" readonly>


                                            <div class="set__pos">Кем выдан:<span
                                                    class="label__partner"></span></div>

                                            <input type="text" wire:model="who_gave" readonly>


                                            <div class="set__pos">Фактический адрес ведения
                                                деятельности:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="actual_address" readonly>





                                        @endif --}}

                                        <div class="set__pos" style="color: #00bf3f">Эти данные можно изменить самостоятельно.</div>
                                        <div class="set__pos">Название которое будет отображаться на сайте:</div>
                                        <input type="text" wire:model="shop_name" placeholder="Салон цветов Fantasy">
                                        <div class="set__pos">E-mail</div>
                                        <input type="email" wire:model.defer="email" placeholder="admin@gmail.com">
                                        {{-- <div class="set__pos">Цена доставки руб.</div>
                                        <input type="text" wire:model.defer="delivery_price"> --}}
                                        @if($partner_type !='Самозанятый')
											<div class="set__pos">Номер телефона предприятия</div>
											<input type="text" wire:model.defer="telephone" placeholder="+7-999-99-99">
                                        @endif
                                        <div class="set__pos">Соц. сети</div>
                                        <input type="text" wire:model.defer="socials" placeholder="https://vk.com/flowerexpress">

										<style>
											.textarea {
												max-width: 550px;
												width: 100%;
												border: 2px solid #bfc6e0;
												border-radius: 38px;
												outline: none;
												padding: 10px 28px;
												font-weight: 600;
												font-size: 16px;
												line-height: 160%;
												letter-spacing: 0.05em;
												color: #0b1331;
											}
										</style>

                                        <div class="set__pos">Описание магазина</div>
                                        <textarea class="textarea" wire:model.defer="description">{{ $description }}</textarea>

										<div x-data="deliveryPrices">
											<template x-for="(price, key) in prices">
												<div class="">
													<div class="set__pos" x-text="'Цена доставки' + (key + 1)"></div>
													<input style="margin-bottom: 10px" 
														type="text" placeholder="По городу" 
														@change="setDeliveryPrices(key, 'region')"
														:value="price.region"
													>
													<input type="number" @change="setDeliveryPrices(key, 'price')" :value="price.price">
												</div>
											</template>
											<div class="reg__plus" @click="prices.push({region: '', price: 0})">Добавить стоимость доставки</div>
										</div>

										<script>
											document.addEventListener('alpine:init', () => {
												Alpine.data('deliveryPrices', () => ({
													prices: @json($delivery_prices),

													setDeliveryPrices(key, priceKey) {
														this.prices[key][priceKey] = this.$event.target.value;

														@this.set('delivery_prices', this.prices);
													},
												}))
											})
										</script>

                                        @foreach($delivery_addresses as $key=>$address)
                                            <div class="set__pos">Адрес для самовывоза#{{$key + 1}}</div>
                                            <input type="text" onchange="setAddress(this, {{ $key }})" value="{{ $address }}" placeholder="201234, г. Москва, ул. Тимирязевская, д.14, офис 56">
                                        @endforeach
                                        <div class="reg__plus" id="addAddress" onclick="addAddress()">Добавить адрес самовывоза</div>

                                        <script>
                                            let counter = {{ count($delivery_addresses)}} - 1;
                                            function addAddress()
                                            {
                                                counter ++;
                                                let html = '<div class="set__pos">Адрес для самовывоза</div>' +
                                                    '<input type="text" onchange="setAddress(this,' + counter + ')" placeholder="201234, г. Москва, ул. Тимирязевская, д.14, офис 56">';
                                                $('#addAddress').before(html);
                                            }
                                            function setAddress(input_address , key=false)
                                            {
												@this.set('delivery_addresses.'+ key, $(input_address).val());
												console.log(key);
                                            }
                                        </script>

                                        <div class="reg__flex">
                                            <button type="submit">Сохранить</button>
{{--                                            <a href="#" class="set__logout">Выйти</a>--}}
                                        </div>
                                    </form>
                                    @if(session()->has('success'))  <div class="alert-success" style="max-width: 550px; margin-top: 15px;"><span> Данные успешно сохранены </span></div> @endif
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
	<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
