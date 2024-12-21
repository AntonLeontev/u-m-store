@push('head')
    <link rel="stylesheet" href="{{ asset('css/another.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/file.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
@endpush
<div>
    <div>
        <div class="wrapper">
            <div class="content">
                <section class="major">
                    <div class="container">
                        <div class="major__inner">
                            <div class="major__breadcrumbs">
                                <ul>
                                    {{--                                    <li><a href="/">Главная</a></li>--}}
                                    {{--                                    <li><span>{{$article_name}}</span></li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="pay">
                    <div class="container">
                        <div class="pay__inner">
                            <h2 class="pay__title">Оплата</h2>
                            <div class="pay__point">1. Банковской картой</div>
                            <div class="pay__text">
                                <p>При оформлении заказа выберите Онлайн банковской картой и нажмите Перейти к оплате
                                    онлайн. Введите данные карты и нажмите Подтвердить заказ. Минимальная сумма оплаты
                                    &mdash; 1 рубль.</p>
                                <p>Мы принимаем платежи с сайта по следующим банковским картам:</p>
                            </div>
                            <div class="pay__screen"><img
                                    src="https://onionmarket.ru/images/Visa_2014_logo_detail.svg" alt=""/> <img
                                    src="https://onionmarket.ru/images/Visa_Electron.svg" alt=""/> <img
                                    src="https://onionmarket.ru/images/Maestro_logo.svg" alt=""/> <img
                                    src="https://onionmarket.ru/images/MasterCard_Logo.svg" alt=""/>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@push('footer')
    <script src="{{asset('js/main.js')}}"></script>
@endpush
