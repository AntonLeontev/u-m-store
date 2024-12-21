@push('head')
    <link rel="stylesheet" href="{{asset('css/franchise.css?1')}}">
    <link rel="stylesheet" href="{{asset('css/another.css?3')}}">

    @endpush
@push('footer')
    <script src="{{asset('js/franchise.js?2')}}"></script>
@endpush

<div>
    <div class="page-section">
        <div class="franchise">
            <section class="franchise__hero">
                <div class="franchise__container">
                    <h1 class="franchise__title">
                        хочешь стать партнером united Market и увеличить доходность своего бизнеса?
                    </h1>

                    <p class="franchise__desc">
                        Конверсионная франшиза – надежный способ вывести бизнес на новый уровень
                    </p>

                    <button class="franchise__button js-get-popup" data-target="#franchise-popup">Купить франшизу
                    </button>
                </div>
            </section>

            <!-- стили из файла index.css -->
            <section class="why why_items-6">
                <div class="container">
                    <div class="why__inner">
                        <h2 class="benefits__title">Преимущество</h2>

                        <div class="why__wrapper">
                            <div class="why__item">
                                <div class="why__name">
                                    Наша команда - Ваша команда
                                </div>

                                <div class="why__text">
                                    Мы возьмем на себя работу по увеличению показателей вашего бизнеса, пока вы будете
                                    заниматься своим
                                    любимым делом
                                </div>
                            </div>

                            <div class="why__item">
                                <div class="why__name">
                                    CRM система
                                </div>
                                <div class="why__text">
                                    Для оптимизации бизнес-процессов мы предоставляем CRM систему
                                </div>
                            </div>

                            <div class="why__item">
                                <div class="why__name">CMS система</div>

                                <div class="why__text">
                                    Нашим партнерам мы предоставляем готовую платформу для получения онлайн заказов
                                </div>
                            </div>

                            <div class="why__item">
                                <div class="why__name">АСЗ</div>

                                <div class="why__text">
                                    Нашим партнерам мы предоставляем автоматизированную систему записи клиентов на
                                    услуги и оповещения
                                    клиентов
                                </div>
                            </div>

                            <div class="why__item">
                                <div class="why__name">Поддержка</div>

                                <div class="why__text">
                                    Поддержку и обслуживание сайта мы берем на себя. Наши менеджеры ответят на все ваши
                                    вопросы и
                                    помогут решить проблемы в
                                    рабочее время в соответствии с вашим часовым поясом.
                                </div>
                            </div>

                            <div class="why__item">
                                <div class="why__name">Обеспечение рекламными материалами</div>

                                <div class="why__text">
                                    Мы предоставляем все рекламные и промо-материалы
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="franchise__map">
                <h2 class="benefits__title">С нами сотрудничают партнеры по всей стране</h2>

                <img src="{{asset('images/franchise/map.jpg')}}" class="franchise__map-img" alt="#">
            </section>

            <!-- стили из файла another.css -->
            <section class="benefits benefits_only-text">
                <div class="container">
                    <div class="benefits__inner">
                        <h2 class="benefits__title">Условия сотрудничества</h2>

                        <div class="benefits__wrapper">
                            <div class="benefits__item">
                                <div class="benefits__description">
                                    Размещение нашей вывески и промо-материалов в Вашем магазине
                                </div>
                            </div>

                            <div class="benefits__item">
                                <div class="benefits__description">
                                    Нам не важно, как ваш магазин называется оффлайн, в онлайн Ваш магазин должен
                                    работать под именем
                                    Onion Market
                                </div>
                            </div>

                            <div class="benefits__item">
                                <div class="benefits__description">
                                    На Яндекс картах или на Google maps Ваш магазин отмечен так же как Onion Market
                                </div>
                            </div>

                            <div class="benefits__item">
                                <div class="benefits__description">
                                    Своевременное реагирование и доставка заказа
                                </div>
                            </div>

                            <div class="benefits__item">
                                <div class="benefits__description">
                                    Начисление средств за заказ на личный кошелек на маркетплейс Onion Market, с
                                    которого партнер может
                                    вывести на свой
                                    банковский счет
                                </div>
                            </div>

                            <div class="benefits__item">
                                <div class="benefits__description">
                                    Качество загружаемых фотографий товаров
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- стили из файла another.css, common.css -->
            <section class="resume">
                <div class="container">
                    <div class="resume__inner">
                        <h2 class="benefits__title">Остались вопросы?</h2>
                        <div class="resume__form common__form">
{{--                            <form action="{{ route('send.mail')}}" method="POST">--}}
{{--                                <input type="hidden" name="Источник" value="ФРАНШИЗА. Остались вопросы.">--}}
{{--                                <div class="resume__pos label__partner">Имя</div>--}}
{{--                                <input type="text" name="Фамилия и Имя">--}}

{{--                                <div class="resume__pos label__partner">Номер телефона</div>--}}
{{--                                <input name="Номер телефона" type="text">--}}

{{--                                <div class="resume__pos label__partner">Email</div>--}}
{{--                                <input type="email" name="email">--}}
{{--                                --}}
{{--                            </form>--}}
                            <a class="resume__btn common__close" href="{{asset('pdf/franchise/Франшиза UM__.pdf')}}">
                                Получить презентацию
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="franchise__popup js-franchise-popup" id="franchise-popup" wire:ignore.self>
        <div class="franchise__popup-wrapper js-popup-wrapper">
            <div class="franchise__close-wrapper">
                <button class="franchise__popup-close js-close-popup">
                    <img src="{{asset('images/closeBlack.svg')}}" alt="#">
                </button>
            </div>

            <form class="franchise__form">
                <input type="radio" id="card-pay" name="pay" class="franchise__form-radio">
                <label for="card-pay" class="franchise__form-label">
                <span class="franchise__form-title">
                     Выставить счет на оплату паушального взноса
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
    </div>
</div>

