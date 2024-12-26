@push('head')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css"
          integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('css/clone_styles/clone.css') }}"> --}}
@endpush
<div>
    <section class="slider slider--clone">
        <div class="container">
            <div class="slider__inner">
                <div class="swiper">
                    <div class="swiper-container swiper-container-bottom">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @if($banners)
                                @foreach($banners as $banner)
                                    <div class="swiper-slide swiper-slide-small">
                                        <div class="slider__item slider__item--clone"
                                             style="background: url({{ asset('storage/'.$banner->image)}} ) center / cover no-repeat;"
                                        >
                                            <div class="container container__slider" style="position:absolute; bottom: 64px;left: 74px;">
                                                <div class="slider__left">
                                                    <div class="slider__title" style="color: {{$banner->color_text_slider}}; text-align: left">{{$banner->text_slider}}</div>
                                                    @if($banner->text_button)
                                                    <div class="slider__btn">
                                                        <a href="{{$banner->url}}" style="color: {{$banner->color_text_button}}; background: {{$banner->color_button}}; padding: 20px 25px">{{$banner->text_button}}</a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
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
</div>
@push('footer')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/7.0.0/swiper-bundle.min.js"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                const slideSwiper3 = document.querySelector('.swiper-container-bottom');

                const swiper3 = new Swiper(slideSwiper3, {
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
            }, 5000)
        })
    </script>
@endpush
