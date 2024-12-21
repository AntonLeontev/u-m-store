@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css" integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<section class="slider" wire:ignore>
    <div class="container">
        <div class="slider__inner js-main-slider">
            <div class="slider__slider">
                <div class="swiper-container swiper-container-3">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="slider__item slider__item--four">
                                <div class="container container__slider">
                                    <div class="slider__left">
                                        <div class="slider__title">Эксклюзивно на Onion Market</div>
                                        <div class="slider__btn">
                                            <a href="{{ route('shop', [session()->has('city') ? session('city')['slug']: 'moscow', 'flowers']) }}">Перейти к покупкам</a>
                                        </div>
                                    </div>
                                    <div class="slider__right">
                                        <div class="slider__img">
                                            <img src="{{ asset('images/main-slider-4.png') }}" alt="rich">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slider__item slider__item--three">
                                <div class="container container__slider">
                                    <div class="slider__left">
                                        <div class="slider__title">С друзьями выгоднее!</div>
                                        <div class="slider__description">Пригласи друга и получи 500 бонусов на счет</div>
                                        <div class="slider__btn">
                                            <a href="{{ route('user.referral') }}">Пригласить</a>
                                        </div>
                                        <div class="slider__additionEnd">
                                            *Бонусы начисляются после первого оплаченного заказа приглашенным другом
                                        </div>
                                    </div>
                                    <div class="slider__right">
                                        <div class="slider__img">
                                            <img src="{{ asset('images/rich.png') }}" alt="rich">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slider__item slider__item--one">
                                <div class="container container__slider">
                                    <div class="slider__left">
                                        <div class="slider__title">Получай <span>бонусы</span> за каждый заказ<br class="title__break"></div>
                                        <div class="slider__description">и оплачивай ими до <span>50%</span> стоимости следующего заказа</div>
                                    </div>
                                    <div class="slider__right">
                                        <div class="slider__img">
                                            <img src="{{ asset('images/pigMan.png') }}" alt="pigMan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div class="slider__item slider__item--five">
                                <div class="container container__slider">
                                    <div class="slider__left">
                                        <div class="slider__title">Мы запустили категорию <div class="slider__title--red">«Доставка цветов»</div></div>
                                        <div class="slider__description slider__description--title">Скоро на нашем сайте:</div>
                                        <div class="slider__description">Доставка продуктов питания, Аренда авто, Клининг, Доставка готовой еды, Кальянные, Салоны красоты, Зотовары и многое другое </div>
                                    </div>
                                    <div class="slider__right">
                                        <div class="slider__img">
                                            <img src="images/slider-5.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- If we need pagination -->
                    <div class="main-swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="main-slider-prev  js-main-btn-prev"></div>
                    <div class="main-slider-next  js-main-btn-next"></div>
                    {{--swiper-button-prev--}}
                    {{--swiper-button-next--}}
                </div>
            </div>
        </div>
    </div>
</section>
@push('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/7.0.0/swiper-bundle.min.js"></script>
<script>
    const mainSwiperContainer = document.querySelector('.js-main-slider');

    const swiper3 = new Swiper(mainSwiperContainer.querySelector('.swiper-container-3'), {
        loop: true,
        slidesPerView: 1,
        pagination: {
            el: mainSwiperContainer.querySelector('.main-swiper-pagination'),
        },
        navigation: {
            nextEl:  mainSwiperContainer.querySelector('.js-main-btn-next'),
            prevEl: mainSwiperContainer.querySelector('.js-main-btn-prev'),
        },
        autoplay: {
            delay: 4000,
        },
    });
</script>
@endpush
