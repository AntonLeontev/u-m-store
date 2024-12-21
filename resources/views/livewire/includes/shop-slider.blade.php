@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css" integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<section class="slider">
<div class="container">
    <div class="slider__inner">
        <div class="slider__slider">
            <div class="swiper-container swiper-container-3">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide swiper-slide-small">
                        <div class="slider__item slider__item--one">
                            <div class="container container__slider">
                                <div class="slider__left">
                                    <div class="slider__title">Доставка за <br class="title__break"> 40 минут</div>
                                    <div class="slider__description">Не успеваете подготовить подарок любимому человеку, а недостаток времени дает о себе знать? Доставка букета <span>за 40 минут</span> решит ваш вопрос!</div>
                                    <!-- <div class="slider__btn">
                                        <a href="#">Перейти к покупкам</a>
                                    </div> -->
                                </div>
                                <div class="slider__right">
                                    <div class="slider__img">
                                        <img src="{{ asset('images/car.png') }}" alt="car">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-small">
                        <div class="slider__item slider__item--two">
                            <div class="container container__slider">
                                <div class="slider__left">
                                    <div class="slider__title slider__title--up">Скидка 15% на <br class="title__break"> следующий заказ</div>
                                    <div class="slider__description slider__description--bold">при покупке букета из <img src="{{ asset('images/101.svg') }}" alt="101"></div>
                                </div>
                                <div class="slider__right">
                                    <div class="slider__img">
                                        <img src="{{ asset('images/101.png') }}" alt="101">
                                    </div>
                                    <div class="slider__img slider__img--mobile">
                                        <img src="{{ asset('images/flowers.png') }}" alt="flowers">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-small">
                        <div class="slider__item slider__item--two slider__item--three">
                            <div class="container container__slider">
                                <div class="slider__left slider__left---box">
                                    <div class="slider__smallText">на Монобукеты</div>
                                    <div class="slider__title slider__title--up slider__title--third">скидка 7%</div>
                                    <div class="slider__description slider__description--third">весь октябрь</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .slider__item--three::before{
                            left: auto !important;}
                    </style>
                    <div class="swiper-slide swiper-slide-small">
                        <div class="slider__item slider__item--two slider__item--four">
                            <div class="container container__slider container__four">
                                <div class="slider__left">
                                    <div class="slider__title slider__title--four">
                                        <span class="sliderTitle--four">при покупке букетов из 51 Розы</span>
                                        <span class="sliderTitle--sale">Скидка 10% на следующий заказ</span>
                                    </div>
                                </div>
                                <div class="slider__right">
                                    <div class="slider__img">
                                        <img src="{{ asset('images/yellow.png') }}" alt="yellow">
                                    </div>
                                    <div class="slider__img slider__img--mobile">
                                        <img src="{{ asset('images/yellow.png') }}" alt="yellow">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-small">
                        <div class="slider__item slider__item--two slider__item--five">
                            <div class="container container__slider">
                                <div class="slider__left slider__left---box slider__left---five">
                                    <div class="slider__smallText slider__smallText--five">при заказе 2х букетов</div>
                                    <div class="slider__title slider__title--up slider__title--five">скидка 7%</div>
                                    <div class="slider__description slider__description--five">на весь заказ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
        </div>
    </div>
</div>
</section>
@push('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/7.0.0/swiper-bundle.min.js"></script>
    <script>
        const swiper3 = new Swiper('.swiper-container-3', {
            loop: true,
            slidesPerView: 1,
            pagination: {
                el: ".swiper-pagination",
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush
