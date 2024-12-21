@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
@endpush
<div class="wrapper" wire:ignore.self>
    <div class="content">
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active"></div>
                    <div class="profile__wrapper">
                        <div class="set__inner">
                            <div class="set__one">
                                <div class="set__form">
                                    <div class="set__pos">Выберите тип вашей организации:</div>
                                    <div class="reg__del">
                                        <label class="label__block label__block--no" style="color: #3a3a3e;">
                                            <input type="radio" name="partner_type" class="reg__place" value="ooo"
                                                   wire:model="partner_type">
                                            <span style="background: #3657C8;"></span>Общество с ограниченной
                                            ответственностью.</label>
                                    </div>
                                    <div class="reg__del">
                                        <label class="label__block label__block--no" style="color: #3a3a3e;">
                                            <input type="radio" name="partner_type" class="reg__place" value="ipr"
                                                   wire:model="partner_type">
                                            <span style="background: #3657C8;"></span>Индивидуальный
                                            Предприниматель.</label>
                                    </div>
                                    <div class="reg__del">
                                        <label class="label__block label__block--no" style="color: #3a3a3e;">
                                            <input type="radio" name="partner_type" class="reg__place" value="sam"
                                                   wire:model="partner_type">
                                            <span style="background: #3657C8;"></span>Самозанятый.</label>
                                    </div>
                                    <form wire:submit.prevent="sendPartnerData">
                                        @csrf
                                        {{--                                    Форма для ООО--}}
                                        @if($partner_type ==='ooo')
                                            <div class="set__step">Информация о вашей организации:</div>
                                            <div class="set__pos">Сфера услуг/товаров:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" list="direction" wire:model="direction"
                                                   placeholder="Доставка цветов">
                                            <datalist id="direction">
                                                @foreach($directions as $direction_partner)
                                                    <option>{{$direction_partner->name}}</option>
                                                @endforeach
                                            </datalist>
                                            @error('direction')
                                            <div><span class="error">{{ $message }}</span></div>@enderror
                                            <div class="set__pos">Город:<span class="label__partner"></span></div>
                                            <input type="text" list="city" wire:model="city_name"
                                                   placeholder="Зеленоград">
                                            <datalist id="city">
                                                @foreach($cities as $city_partner)
                                                    <option>{{$city_partner->real_name}}</option>
                                                @endforeach
                                            </datalist>
                                            @error('city_name')
                                            <div><span class="error">{{ $message }}</span></div>@enderror
                                            <div class="set__pos">Полное наименование организации:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="org_full_name"
                                                   placeholder="Общество с ограниченной ответственностью Василёк">
                                            @error('org_full_name')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Сокращенное наименование:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="org_short_name"
                                                   placeholder="ООО Василёк">
                                            @error('org_short_name')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Название которое будет отображаться на сайте:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="shop_name"
                                                   placeholder="Салон цветов Fantasy">
                                            @error('shop_name')
                                            <div><span class="error">{{ $message }}</span></div>
                                            @enderror

                                            <div class="set__pos">Юридический адрес<span class="label__partner"></span>
                                            </div>
                                            <input type="text" wire:model="legal_address"
                                                   placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                            @error('legal_address')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Фактический адрес:<span class="label__partner"></span>
                                            </div>
                                            <input type="text" wire:model="actual_address"
                                                   placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                            @error('actual_address')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Почтовый адрес (а/я):<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="post_address"
                                                   placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                            @error('post_address')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Генеральный Директор:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="director_name"
                                                   placeholder="Иванов Иван Иванович">
                                            @error('director_name')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Главный бухгалтер:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="bohalter_name"
                                                   placeholder="Иванова Ирина Викторовна">
                                            @error('bohalter_name')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">ИНН<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="inn" placeholder="От 10 до 12 цифр"
                                                   onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                            @error('inn')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">КПП<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="kpp" placeholder="9 цифр"
                                                   onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                            @error('kpp')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">ОГРН<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="ogrn" placeholder="13 цифр"
                                                   onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                            @error('ogrn')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Наименование Банка:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="bank_name" placeholder="Тинькофф Банк">
                                            @error('bank_name')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Расчетный счет (р/c)<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="bank_account"
                                                   placeholder="20 цифр"
                                                   onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                            @error('bank_account')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Корреспондентский счет(к/с)<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="kor_account" placeholder="20 цифр"
                                                   onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                            @error('kor_account')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">БИК<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="bik" placeholder="9 цифр"
                                                   onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                            @error('bik')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Электронный почтовый адрес (E-mail):<span
                                                    class="label__partner"></span></div>
                                            <input type="email" wire:model="email"
                                                   placeholder="unitedmarket@um.ru">
                                            @error('email')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Телефон организации:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="org_tel"
                                                   placeholder="8 (812) 74-59-28">
                                            @error('org_tel')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Номер телефона владельца:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="mobile_tel_owner"
                                                   placeholder="+7 (937) 564-87-83">
                                            @error('mobile_tel_owner')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Соц. сети</div>
                                            <input type="text" wire:model="socials"
                                                   placeholder="https://onionmarket.ru можете написать несколько через запятую.">
                                            @error('socials')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Адрес точки самовывоза:<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="delivery_address"
                                                   placeholder="Адрес самовывоза товара.">
                                            @error('delivery_address')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            <div class="set__pos">Цена доставки руб.<span
                                                    class="label__partner"></span></div>
                                            <input type="text" wire:model="delivery_price"
                                                   placeholder="Цена доставки по городу от ..   число."
                                                   onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                            @error('delivery_price')
                                            <div><span class="error">{{ $message }}</span></div>@enderror

                                            {{--                                            <x-honey/>--}}
                                            {{--                                            <x-honey recaptcha/>--}}
                                            {{--                                            <div class="reg__flex">--}}
                                            {{--                                                <button type="submit">Отправить</button>--}}
                                            {{--                                                --}}{{--                                            <a href="#" class="set__logout">Выйти</a>--}}
                                            {{--                                            </div>--}}
                                            {{--                                        </form>--}}

                                            {{--                                    Форма для ИП--}}

                                        @elseif($partner_type ==='ipr')

{{--                                            <form wire:submit.prevent="sendPartnerData">--}}
{{--                                                @csrf--}}
                                                <div class="set__step">Информация о вашем предприятии:</div>
                                                <div class="set__pos">Сфера услуг/товаров:<span
                                                        class="label__partner"></span></div>
                                                <input type="text" list="direction" wire:model="direction"
                                                       placeholder="Доставка букетов цветов">
                                                <datalist id="direction">
                                                    @foreach($directions as $direction_partner)
                                                        <option>{{$direction_partner->name}}</option>
                                                    @endforeach
                                                </datalist>
                                                @error('direction')
                                                <div><span class="error">{{ $message }}</span></div>@enderror
                                                <div class="set__pos">Город:<span class="label__partner"></span></div>
                                                <input type="text" list="city" wire:model="city_name"
                                                       placeholder="Зеленоград">
                                                <datalist id="city">
                                                    @foreach($cities as $city_partner)
                                                        <option>{{$city_partner->real_name}}</option>
                                                    @endforeach
                                                </datalist>
                                                @error('city_name')
                                                <div><span class="error">{{ $message }}</span></div>@enderror
                                                <div class="set__pos">Полное наименование предприятия:<span
                                                        class="label__partner"></span></div>
                                                <input type="text" wire:model="org_full_name"
                                                       placeholder="Индивидуальный предприниматель Иванов Иван Иванович">
                                                @error('org_full_name')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Сокращенное наименование:<span
                                                        class="label__partner"></span></div>
                                                <input type="text" wire:model="org_short_name"
                                                       placeholder="ИП Иванов Иван Иванович">
                                                @error('org_short_name')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Название которое будет отображаться на сайте:<span
                                                        class="label__partner"></span></div>
                                                <input type="text" wire:model="shop_name"
                                                       placeholder="Салон цветов Fantasy">
                                                @error('shop_name')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Юридический адрес<span
                                                        class="label__partner"></span>
                                                </div>
                                                <input type="text" wire:model="legal_address"
                                                       placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                                @error('legal_address')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Фактический адрес:<span
                                                        class="label__partner"></span>
                                                </div>
                                                <input type="text" wire:model="actual_address"
                                                       placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                                @error('actual_address')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Почтовый адрес (а/я):</div>
                                                <input type="text" wire:model="post_address"
                                                       placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                                @error('post_address')
                                                <div><span class="error">{{ $message }}</span></div>@enderror


                                                <div class="set__pos">ИНН</div>
                                                <input type="text" wire:model="inn" placeholder="От 10 до 12 цифр"
                                                       onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                @error('inn')
                                                <div><span class="error">{{ $message }}</span></div>@enderror


                                                <div class="set__pos">ОГРНИП</div>
                                                <input type="text" wire:model="ogrn_ip" placeholder="15 цифр"
                                                       onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                @error('ogrn_ip')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Наименование Банка:</div>
                                                <input type="text" wire:model="bank_name" placeholder="Тинькофф Банк">
                                                @error('bank_name')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Расчетный счет (р/c)</div>
                                                <input type="text" wire:model="bank_account"
                                                       placeholder="20 цифр"
                                                       onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                                @error('bank_account')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Корреспондентский счет(к/с)</div>
                                                <input type="text" wire:model="kor_account" placeholder="20 цифр"
                                                       onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                @error('kor_account')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">БИК</div>
                                                <input type="text" wire:model="bik" placeholder="9 цифр"
                                                       onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                @error('bik')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Электронный почтовый адрес (E-mail):<span
                                                        class="label__partner"></span></div>
                                                <input type="email" wire:model="email"
                                                       placeholder="unitedmarket@um.ru">
                                                @error('email')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Телефон предприятия:<span
                                                        class="label__partner"></span></div>
                                                <input type="text" wire:model="org_tel" placeholder="8 (812) 74-59-28">
                                                @error('org_tel')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Номер телефона владельца:<span
                                                        class="label__partner"></span></div>
                                                <input type="text" wire:model="mobile_tel_owner"
                                                       placeholder="+7 (937) 564-87-83">
                                                @error('mobile_tel_owner')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Соц. сети</div>
                                                <input type="text" wire:model="socials"
                                                       placeholder="https://onionmarket.ru можете написать несколько через запятую.">
                                                @error('socials')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Адрес точки самовывоза:</div>
                                                <input type="text" wire:model="delivery_address"
                                                       placeholder="Адрес самовывоза товара.">
                                                @error('delivery_address')
                                                <div><span class="error">{{ $message }}</span></div>@enderror

                                                <div class="set__pos">Цена доставки руб.</div>
                                                <input type="text" wire:model="delivery_price"
                                                       placeholder="Цена доставки по городу от ..   число."
                                                       onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                @error('delivery_price')
                                                <div><span class="error">{{ $message }}</span></div>@enderror



                                                {{--                                    Форма самозанятый--}}
                                                @elseif($partner_type ==='sam')

{{--                                                    <form wire:submit.prevent="sendPartnerData">--}}
{{--                                                        @csrf--}}
                                                        <div class="set__step">Информация о ваc:</div>
                                                        <div class="set__pos">Сфера услуг/товаров:<span
                                                                class="label__partner"></span></div>
                                                        <input type="text" list="direction" wire:model="direction"
                                                               placeholder="Доставка букетов цветов">
                                                        <datalist id="direction">
                                                            @foreach($directions as $direction_partner)
                                                                <option>{{$direction_partner->name}}</option>
                                                            @endforeach
                                                        </datalist>
                                                        @error('direction')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror
                                                        <div class="set__pos">Город:<span class="label__partner"></span>
                                                        </div>
                                                        <input type="text" list="city" wire:model="city_name"
                                                               placeholder="Зеленоград">
                                                        <datalist id="city">
                                                            @foreach($cities as $city_partner)
                                                                <option>{{$city_partner->real_name}}</option>
                                                            @endforeach
                                                        </datalist>
                                                        @error('city_name')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror
                                                        <div class="set__pos">Название которое будет отображаться на
                                                            сайте:<span
                                                                class="label__partner"></span></div>
                                                        <input type="text" wire:model="shop_name"
                                                               placeholder="Салон цветов Fantasy">
                                                        @error('shop_name')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror


                                                        <div class="set__pos">ФИО:<span class="label__partner"></span>
                                                        </div>
                                                        <input type="text" wire:model="fio"
                                                               placeholder="Иванов Иван Иванович">
                                                        @error('fio')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">№ и серия Паспорта:<span
                                                                class="label__partner"></span></div>
                                                        <input type="text" wire:model="passport_data" placeholder="">

                                                        @error('passport_data')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror
                                                        <div class="set__pos">Адрес регистрации:<span
                                                                class="label__partner"></span>
                                                        </div>
                                                        <input type="text" wire:model="reg_address"
                                                               placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                                        @error('reg_address')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Кем выдан:<span
                                                                class="label__partner"></span></div>

                                                        <input type="text" wire:model="who_gave"
                                                               placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                                        @error('who_gave')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Фактический адрес ведения
                                                            деятельности:<span
                                                                class="label__partner"></span></div>
                                                        <input type="text" wire:model="fact_actual_address"
                                                               placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                                        @error('fact_actual_address')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Почтовый адрес (а/я):</div>
                                                        <input type="text" wire:model="post_address"
                                                               placeholder="191123, город Зеленоград, ул. Маяковского, д. 3, офис. 24">
                                                        @error('post_address')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">ИНН</div>
                                                        <input type="text" wire:model="inn"
                                                               placeholder="От 10 до 12 цифр"
                                                               onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                        @error('inn')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Наименование Банка:</div>
                                                        <input type="text" wire:model="bank_name"
                                                               placeholder="Тинькофф Банк">
                                                        @error('bank_name')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Расчетный счет (р/c)</div>
                                                        <input type="text" wire:model="bank_account"
                                                               placeholder="20 цифр"
                                                               onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                                        @error('bank_account')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Корреспондентский счет(к/с)</div>
                                                        <input type="text" wire:model="kor_account"
                                                               placeholder="20 цифр"
                                                               onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                        @error('kor_account')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">БИК</div>
                                                        <input type="text" wire:model="bik" placeholder="9 цифр"
                                                               onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                        @error('bik')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Электронный почтовый адрес (E-mail):<span
                                                                class="label__partner"></span></div>
                                                        <input type="email" wire:model="email"
                                                               placeholder="unitedmarket@um.ru">
                                                        @error('email')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Номер телефона владельца:<span
                                                                class="label__partner"></span>
                                                        </div>
                                                        <input type="text" wire:model="mobile_tel_owner"
                                                               placeholder="+7 (937) 564-87-83">
                                                        @error('mobile_tel_owner')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Соц. сети</div>
                                                        <input type="text" wire:model="socials"
                                                               placeholder="https://onionmarket.ru можете написать несколько через запятую.">
                                                        @error('socials')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Адрес точки самовывоза:</div>
                                                        <input type="text" wire:model="delivery_address"
                                                               placeholder="Адрес самовывоза товара.">
                                                        @error('delivery_address')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror

                                                        <div class="set__pos">Цена доставки руб.</div>
                                                        <input type="text" wire:model="delivery_price"
                                                               placeholder="Цена доставки по городу от .. число"
                                                               onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                        @error('delivery_price')
                                                        <div><span class="error">{{ $message }}</span></div>@enderror
                                                        @endif
                                                        <div>
                                                            <x-honey/>
                                                        </div>
                                                        <div>
                                                            <x-honey recaptcha/>
                                                        </div>

                                                        <div class="reg__flex">
                                                            <button type="submit">Отправить</button>
                                                            {{--                                            <a href="#" class="set__logout">Выйти</a>--}}
                                                        </div>
                                                    </form>

                                                    @if(session()->has('success'))
                                                        <div class="alert-success"
                                                             style="max-width: 550px; margin-top: 15px;">
                                                            <span>Данные успешно отправлены</span>
                                                        </div>
                                                    @endif
                                                    @if(count($errors)>0)
                                                        <div style="margin-top:10px ">
                                                            @foreach($errors->all() as $error)
                                                                <div><span class="error">{{ $error }}</span></div>
                                                            @endforeach
                                                        </div>
                                    @endif
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

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}">


    </script>
@endpush
