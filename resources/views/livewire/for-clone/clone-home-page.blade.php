{{-- @section('title') --}}
{{--    <title>{{$seo['title']}}</title> --}}
{{-- @endsection --}}
{{-- @section('meta.description.keywords') --}}
{{--    <meta name="description" content="{{$seo['meta_description']}}"/> --}}
{{--    <meta name="keywords" content="{{$seo['meta_keywords']}}"/> --}}
{{-- @endsection --}}
@push('head')
    @if ($domain && $seo)
        {!! $seo !!}
    @endif
@endpush
<div class="wrapper">
    <div class="content">
        @livewire('for-clone.clone-shop-slider')
        @php
            $wish_items = Cart::instance('wishlist')->content()->pluck('id');
            $product_items = Cart::instance('cart')->content()->pluck('id');
        @endphp
        <section class="popular" wire:ignore>
            <div class="container">
                <div class="popular__inner">
                    <h2 class="popular__title">Популярное</h2>
                    @livewire('includes.popular-slider')
                </div>
            </div>
        </section>
		@if ($promotions->isNotEmpty())
			<section class="stock" wire:ignore>
				<div class="container">
					<div class="stock__inner">
						<h2 class="stock__title">акции</h2>
						<div class="stock__slider">
							<div class="swiper-container swiper-container-2">
								<!-- Additional required wrapper -->
								<div class="swiper-wrapper">
									<!-- Slides -->
									@foreach ($promotions as $promotion)
										<div class="swiper-slide">
											<div class="stock__item">
												<a href="{{ $promotion->url }}">
													<img src="{{ asset('storage/'.$promotion->image) }}" alt="">
												</a>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		@endif
        <section class="new">
            <div class="container">
                <div class="new__inner">
                    <h2 class="new__title">новинки</h2>
                    <div class="new__wrapper">
                        <div class="new__bouquets">
                            @foreach ($new_products as $product)
                                <div class="popular__item">
                                    <div class="popular__new">New</div>

                                    <div class="popular__img">
                                        <a
                                            href="{{ route('product.details', ['city_slug' => session('city')['slug'], 'slug' => $product->id]) }}">
                                            <img src="{{ asset('storage/') }}/{{ $product->image }}"
                                                alt="{{ $product->name }}">
                                        </a>
                                        @if ($product->delivery_price)
                                            <div class="popular__delivery popular__delivery--mob">
                                                {{ $product->delivery_price }}
                                                <span class="ruble-icon">₽</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="popular__right">
                                        @if ($product->delivery_price)
                                            <div class="popular__delivery"> {{ $product->delivery_price }} <span
                                                    class="ruble-icon">₽</span></div>
                                        @endif
                                        @if ($product->reviews_count)
                                            <div class="popular__review">
                                                {{ $product->rating }} <span>({{ $product->reviews_count }})</span>
                                            </div>
                                        @endif
                                        <div class="popular__name">
                                            <a
                                                href="{{ route('product.details', ['city_slug' => session('city')['slug'], 'slug' => $product->id]) }}">
                                                {{ $product->name }}
                                            </a>
                                        </div>
                                        <div class="popular__description">{!! html_entity_decode($product->shot_description) !!}</div>
                                        <div class="popular__bottom">


                                            <div class="popular__price">{{ $product->store_price }} <span
                                                    class="ruble-icon">₽</span></div>
                                            @if ($product->store_old_price)
                                                <div class="popular__oldprice">{{ $product->store_old_price }} <span
                                                        class="ruble-icon">₽</span></div>
                                            @endif

                                            @if ($product_items->contains($product->product_id))
                                                <div class="popular__buy">
                                                    <a class="active" href="#"
                                                        style="background-color: rgb(106, 205, 248);">
                                                        <img src="{{ asset('images/doneBuy.svg') }}" alt="basket">
                                                    </a>
                                                </div>
                                        </div>
                                        <div class="popular__buy popular__buy--second">
                                            <a class="active" href="#"
                                                style="background-color: rgb(106, 205, 248);">
                                                <img src="{{ asset('images/doneBuy.svg') }}" alt="basket">
                                            </a>
                                        </div>
                                    @else
                                        <div class="popular__buy">
                                            <a href="#"
                                                wire:click.prevent="store({{ $product->product_id }},'{{ $product->name }}','{{ $product->store_price }}','{{ $product->image }}')">
                                                <img src="{{ asset('images/basket(1).svg') }}" alt="basket">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="popular__buy popular__buy--second"
                                        wire:click.prevent="store({{ $product->product_id }},'{{ $product->name }}','{{ $product->store_price }}','{{ $product->image }}')">
                                        <a href="#">
                                            <img src="{{ asset('images/basket(1).svg') }}" alt="basket">
                                        </a>
                                    </div>
                            @endif

                            @if ($wish_items->contains($product->product_id))
                                <div class="popular__like active"
                                    wire:click.prevent="removeFromWishList({{ $product->product_id }})">
                                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z"
                                            stroke-width="2" />
                                    </svg>
                                </div>
                            @else
                                <div class="popular__like"
                                    wire:click.prevent="addToWishList({{ $product->product_id }},'{{ $product->name }}','{{ $product->store_price }}')">
                                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z"
                                            stroke-width="2" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </div>
    </section>
    <section class="tell" wire:ignore>
        <div class="container">

			@livewire('for-clone.clone-shop-bottom-slider')
            {{-- <div class="tell__inner">
                <div class="tell__one">
                    <div class="tell__image">
                        <img src="{{ asset('images/newPromo-1.jpg') }}" alt="promo">
                    </div>
                </div>
                <!-- <div class="tell__two">
                        <img src="images/gerb.svg" alt="">
                    </div> -->
            </div> --}}
        </div>
    </section>

</div>
</div>

@push('footer')
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        const swiper2 = new Swiper('.swiper-container-2', {
            loop: false,
            slidesPerView: 4,
			loopFillGroupWithBlank: true,
			centeredSlides: true,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    // slidesPerView: 'auto'
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
@endpush
