@push('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major major--nopartner">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>Доставка цветов</span></li>
                        </ul>
                    </div>
                    <div class="major__text major__text--nopartner">
                        Приносим свои извинения, на данный момент нет партнеров в выбранной категории в вашем городе.
                    </div>
                    <div class="major__image">
                        <img src="{{ asset('images/nopartner.jpg') }}" alt="nopartner">
                    </div>
                </div>
            </div>
        </section>

        <section class="popular popular__nopartner">
            <div class="container">
                <div class="popular__inner" wire:ignore>
                    <h2 class="popular__title">Рекомендуем для Вас</h2>

                    @livewire('includes.popular-slider')

                </div>
            </div>
        </section>
        <section class="stock stock--nopartner" wire:ignore>
            <div class="container">
                <div class="stock__inner">
                    <h2 class="stock__title">акции</h2>
                    <div class="stock__slider">
                        <div class="swiper-container swiper-container-2">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide">
                                    <div class="stock__item">
                                        <img src="{{ asset('images/stock1.jpg') }}" alt="1">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="stock__item">
                                        <img src="{{ asset('images/stock3.jpg') }}" alt="3">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="stock__item">
                                        <img src="{{ asset('images/stock4.jpg') }}" alt="4">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="stock__item">
                                        <img src="{{ asset('images/stock2.jpg') }}" alt="2">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="stock__item">
                                        <img src="{{ asset('images/stock5.jpg') }}" alt="5">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="follow">
            <div class="container">
                <div class="follow__inner">
                    <h2 class="follow__title">Подпишись на наш инстаграм</h2>
                    <div class="follow__wrapper">
                        <div class="follow__item">
                            <img src="{{ asset('images/follow1.jpg') }}" alt="1">
                        </div>
                        <div class="follow__item">
                            <img src="{{ asset('images/follow2.jpg') }}" alt="2">
                        </div>
                        <div class="follow__item">
                            <img src="{{ asset('images/follow3.jpg') }}" alt="3">
                        </div>
                        <div class="follow__item">
                            <img src="{{ asset('images/follow4.jpg') }}" alt="4">
                        </div>
                    </div>
                    <div class="follow__btn">
                        <a href="#">подписаться</a>
                    </div>
                    <div class="follow__blog">
                        <div class="follow__text">
                            <div class="follow__name">Lorem ipsum</div>
                            <div class="follow__info">dolor sit amet, consectetur adipiscing elit. Cras lacus neque, varius sit amet sapien eu, feugiat luctus leo. Curabitur ut semper mi. In augue metus, ultricies id diam aliquet, porttitor facilisis justo. Sed elementum justo non erat posuere, at scelerisque sem varius. Duis suscipit, enim ut luctus elementum, arcu lectus cursus diam, eget facilisis lacus mauris et mauris. Curabitur aliquet diam in ligula accumsan condimentum. Etiam tristique blandit varius. Sed tincidunt massa arcu, sit amet condimentum metus sagittis id.</div>
                        </div>
                        <div class="follow__text">
                            <div class="follow__name">Lorem ipsum</div>
                            <div class="follow__info">dolor sit amet, consectetur adipiscing elit. Cras lacus neque, varius sit amet sapien eu, feugiat luctus leo. Curabitur ut semper mi. In augue metus, ultricies id diam aliquet, porttitor facilisis justo. Sed elementum justo non erat posuere, at scelerisque sem varius. Duis suscipit, enim ut luctus elementum, arcu lectus cursus diam, eget facilisis lacus mauris et mauris. Curabitur aliquet diam in ligula accumsan condimentum. Etiam tristique blandit varius. Sed tincidunt massa arcu, sit amet condimentum metus sagittis id.</div>
                        </div>
                        <div class="follow__text">
                            <div class="follow__name">Lorem ipsum</div>
                            <div class="follow__info">dolor sit amet, consectetur adipiscing elit. Cras lacus neque, varius sit amet sapien eu, feugiat luctus leo. Curabitur ut semper mi. In augue metus, ultricies id diam aliquet, porttitor facilisis justo. Sed elementum justo non erat posuere, at scelerisque sem varius. Duis suscipit, enim ut luctus elementum, arcu lectus cursus diam, eget facilisis lacus mauris et mauris. Curabitur aliquet diam in ligula accumsan condimentum. Etiam tristique blandit varius. Sed tincidunt massa arcu, sit amet condimentum metus sagittis id.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="{{ asset('js/main.js') }}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // const swiper1 = new Swiper('.swiper-container-1', {
    //   loop: true,
    //   slidesPerView: 5,
    //   navigation: {
    //     nextEl: '.swiper-button-next',
    //     prevEl: '.swiper-button-prev',
    //   },
    //   breakpoints: {
    //       0: {
    //         slidesPerView: 1,
    //         spaceBetween: 20,
    //       },
    //       1000: {
    //         slidesPerView: 3,
    //       },
    //       1300: {
    //         slidesPerView: 5,
    //       },
    //     }
    // });
    const swiper2 = new Swiper('.swiper-container-2', {
      loop: true,
      slidesPerView: 4,
      breakpoints: {
          0: {
            slidesPerView: 1,
            spaceBetween: 20,
            slidesPerView: 'auto'
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          1000: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
          1050: {
            slidesPerView: 4,
            spaceBetween: 20,
          },
        }
    });
</script>
