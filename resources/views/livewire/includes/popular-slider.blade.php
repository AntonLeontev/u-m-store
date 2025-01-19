@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css"
          integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
@endpush
@php
    $wish_items = Cart::instance('wishlist')->content()->pluck('id');
    $product_items = Cart::instance('cart')->content()->pluck('id');
@endphp
<div>
    <div>
        <div class="popular__mobile" wire:ignore>
            @foreach($popular_products as $product)
                <div class="popular__item">
                    <div class="popular__img">
                        <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$product->id]) }}">
                            <img src="{{ asset('storage') }}/{{ $product->image }}" alt="{{ $product->name }}">
                        </a>
                        @if($product->delivery_price)
                            <div
                                class="popular__delivery popular__delivery--mob">{{ $product->delivery_price }}
                                <span class="ruble-icon">₽</span>
                            </div>
                        @endif
                    </div>
                    <div class="popular__right">
                        @if($product->delivery_price)
                            <div class="popular__delivery"> {{ $product->delivery_price }} <span
                                    class="ruble-icon">₽</span>
                            </div>
                        @endif
                        @if($product->reviews_count)
                            <div class="popular__review">
                                {{ $product->rating }} <span>({{$product->reviews_count}})</span>
                            </div>
                        @endif
                        <div class="popular__name">
                            <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$product->id]) }}">
                                {{ $product->name }}
                            </a>
                        </div>
                        <div class="popular__description">{!! html_entity_decode($product->shot_description) !!}</div>
                        <div class="popular__bottom">
                            <div class="popular__price">{{ $product->store_price }} <span class="ruble-icon">₽</span>
                            </div>
                            @if($product->store_old_price)
                                <div class="popular__oldprice">{{ $product->store_old_price }} <span
                                        class="ruble-icon">₽</span></div>
                            @endif
                            @if($product_items->contains($product->product_id))
                                <div class="popular__buy">
                                    <a href="#"
                                       wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')"
                                       style="background-color: rgb(106, 205, 248);">
                                        <img src="{{ asset('images/doneBuy.svg') }}" alt="basket">
                                    </a>
                                </div>
                        </div>
                        <div class="popular__buy popular__buy--second"
                             wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')">
                            <a href="#" style="background-color: rgb(106, 205, 248);">
                                <img src="{{ asset('images/doneBuy.svg') }}" alt="basket">
                            </a>
                        </div>
                        @else
                            <div class="popular__buy">
                                <a href="#"
                                   wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')">
                                    <img src="{{ asset('images/basket(1).svg') }}" alt="basket">
                                </a>
                            </div>
                    </div>
                    <div class="popular__buy popular__buy--second"
                         wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')">
                        <a href="#">
                            <img src="{{ asset('images/basket(1).svg') }}" alt="basket">
                        </a>
                    </div>
                    @endif


                    @if($wish_items->contains($product->product_id))
                        <div class="popular__like popularLike active"
                             wire:click.prevent="removeFromWishList({{ $product->product_id }})">
                            <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z"
                                    stroke-width="2"/>
                            </svg>
                        </div>
                    @else
                        <div class="popular__like popularLike"
                             wire:click.prevent="addToWishList({{ $product->product_id }},'{{ $product->name }}','{{ $product->store_price }}')">
                            <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z"
                                    stroke-width="2"/>
                            </svg>
                        </div>
                    @endif
                </div>
        </div>

        @endforeach
    </div>
    <div class="popular__slider" wire:ignore>
        <div class="swiper-container swiper-popular">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach($popular_products as $product)
                    <div class="swiper-slide">
                        {{--                    @livewire('includes.product-item-component', ['products' => $popular_products))--}}
                        <div class="popular__item">
                            <div class="popular__img popularImg">
                                <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$product->id]) }}">
                                    <img src="{{ asset('storage') }}/{{ $product->image }}" alt="{{ $product->name }}">
                                </a>
                                @if($product->delivery_price)
                                    <div
                                        class="popular__delivery popular__delivery--mob">{{ $product->delivery_price }}
                                        <span class="ruble-icon">₽</span>
                                    </div>
                                @endif
                            </div>
                            <div class="popular__right">
                                @if($product->delivery_price)
                                    <div class="popular__delivery"> {{ $product->delivery_price }} <span
                                            class="ruble-icon">₽</span>
                                    </div>
                                @endif
                                @if($product->reviews_count)
                                    <div class="popular__review">
                                        {{ $product->rating }} <span>({{$product->reviews_count}})</span>
                                    </div>
                                @endif
                                <div class="popular__name">
                                    <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$product->id]) }}">
                                        {{ $product->name }}
                                    </a>
                                </div>
                                <div class="popular__bottom">
                                    <div class="popular__price">{{ $product->store_price }} <span
                                            class="ruble-icon">₽</span></div>
                                    @if($product->store_old_price)
                                        <div class="popular__oldprice">{{ $product->store_old_price }} <span
                                                class="ruble-icon">₽</span></div>
                                    @endif
                                    <div class="popular__buy">
                                        <a href="#"
                                           wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')">
                                            <img src="{{ asset('images/basket(1).svg') }}" alt="store">
                                        </a>
                                    </div>
                                </div>
                                <div class="popular__buy popular__buy--second">
                                    <a href="#"
                                       wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')">
                                        <img src="{{ asset('images/basket(1).svg') }}" alt="store">
                                    </a>
                                </div>
                                @if($wish_items->contains($product->product_id))
                                    <div class="popular__like popularLike active"
                                        wire:click.prevent="removeFromWishList({{ $product->product_id }})">
                                        <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z"
                                                stroke-width="2"/>
                                        </svg>
                                    </div>
                                @else
                                    <div class="popular__like popularLike"
                                         wire:click.prevent="addToWishList({{ $product->product_id }},'{{ $product->name }}','{{ $product->store_price }}')">
                                        <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z"
                                                stroke-width="2"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>


        </div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div class="popular__btn index__btn">
        <a href="{{ route('product.shop',['city_slug' => session('city')['slug']]) }}">Показать все</a>
    </div>
</div>
@push('footer')
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script>
        const swiper1 = new Swiper('.swiper-popular', {
            loop: true,
            slidesPerView: 5,
            spaceBetween: 25,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                800: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1000: {
                    slidesPerView: 3,
                },
                1300: {
                    slidesPerView: 5,
                },
            }
        });
    </script>

@endpush
