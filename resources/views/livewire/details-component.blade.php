@if(!$domain && $seo)
@section('title')
    <title>{{$seo['title']}}</title>
@endsection
@section('meta.description.keywords')
    <meta name="description" content="{{$seo['meta_description']}}"/>
    <meta name="keywords" content="{{$seo['meta_keywords']}}"/>
@endsection
@endunless
@push('head')
@if($domain)
    @if ($domain && $seo)
        {!! $seo  !!}
    @endif
@endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css"
          integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    {{--    <link rel="stylesheet" href="{{ asset('css/common.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/doc.css') }}">
    <link rel="stylesheet" href="{{ asset('css/um-style/um-product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/um-style/um-icon-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/um-style/um-main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/um-style/umdp-style.css') }}">

    <style>
        span.ruble-icon {
            font-family: "Helvetica Neue", sans-serif;
            margin-top: 2px;
        }
    </style>
@endpush
<div class="wrapper">
    <div class="content">
<nav class="major">
    <div class="container">
        <div class="major__inner">
            <div class="major__breadcrumbs">
                <ul>
                    <li><a href="/">Главная</a></li>
                    {{--                                <li><a href="{{route('shop', [session('city')['slug'], $direction_slug ])}}">{{session('direction_name')}}</a></li>--}}
                    {{-- @if(Session::has('parent_category_name'))
                        <li>
                            <a href="{{session()->get('parent_category_url')}}">{{session()->get('parent_category_name')}}</a>
                        </li>
                    @endif --}}
                    @if(session()->get('category_name'))
                        <li>
                            <a href="{{session()->get('category_url')}}">{{session()->get('category_name')}}</a>
                        </li>
                    @endif
                    <li><span>{{ $product->name }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="um-product">
    <div class="swiper um-product-slider">
        <div class="swiper-wrapper">
            @foreach($media as $image)
                <div class="swiper-slide">
                    <picture>
                        <source type="image/webp" srcset="{{$image->image_path}}">
                        <img src="{{$image->image_path}}" alt="фото"/>
                    </picture>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="um-product__wrap">

        <ul class="um-product-preview">
            @foreach($media as $key => $image)
                <li class="um-product-preview__item" >
                    <picture>
                        <source type="image/webp" srcset="{{$image->resize_image_path}}">
                        <img  class="um-product-preview__img @if($key == 0) um-product-preview__img--active @endif" data-tabs-path="Productcard{{$key}}" src="{{$image->resize_image_path}}" alt="{{ $product->name }}" />
                    </picture>
                </li>
            @endforeach
        </ul>

        <div class="um-product-images">
            @foreach($media as $key => $image)
            <picture>
                <source type="image/webp" srcset="{{$image->image_path}}">
                <img class="um-product-images__img @if($key == 0) um-product-images__img--active @endif" data-tabs-target="Productcard{{$key}}" src="{{$image->image_path}}" alt="фото"/>
            </picture>

            @endforeach
        </div>

    </div>
    <div class="um-product-info">
        <h2 class="um-product-info__title">{{ $product->name }}</h2>
        <p class="um-product-info__text">Артикул: {{ $product->id }}</p>

        <div class="um-rating-product um-product-info__um-rating-product">
                @if(count($reviews) > 0 && $rating)
                <ul class="um-rating-product__list">
                    @php
                        $stars = 0;
                    @endphp
                    @while($stars < 5)
                        @if($rating > $stars)
                            <li class="um-rating-product__item"><i class="icon-um-star-full"></i></li>
                        @else
                            <li class="um-rating-product__item"><i class="icon-um-star-none"></i></li>
                        @endif
                        @php $stars +=1; @endphp
                    @endwhile
                </ul>
                <span class="um-rating-product__rating">4.8</span>
                <a href="#" class="um-rating-product__reviews">({{ count($reviews) }}
                    {{ App\Models\Product::incline(count($reviews)) }})</a>
                @endif
        </div>

        <div class="um-price-product um-product-info__um-price-product">
            @if($old_price)
                <span class="um-price-product__price-new">{{ $price }} &#8381;</span>
                <span class="um-price-product__price-old">{{ $old_price }} &#8381;</span>
            @else
                <span class="um-price-product__price-new">{{ $price }} &#8381;</span>
            @endif
        </div>

        <form class="um-feature-product um-product-info__um-feature-product" action="#">

            <div class="um-quantity-product">
                <h3 class="um-quantity-product__title">Количество:</h3>
                <div class="um-quantity-product__wrap">
                    <button class="um-quantity-product__btn" wire:click.prevent="decreaseQuantity()">
                        <i class="icon-um-minus"></i>
                        <span class="visually-hidden">убрать</span>
                    </button>
                    <span class="um-quantity-product__number">{{ $qty }}</span>
                    <button class="um-quantity-product__btn" wire:click.prevent="increaseQuantity()">
                        <i class="icon-um-pluse3"></i>
                        <span class="visually-hidden">Добавить</span>
                    </button>
                </div>
            </div>

            <div class="um-basket-product">

                @if($product_added)
                    <div class="product__btn common__buy added" id="productBuy">
                        <a href="{{ route('product.cart') }}"
                           onclick="location.href='{{ route('product.cart') }}'"><img
                                src=" {{ asset('images/doneBuy.svg') }}"
                                style="margin-top: -9px;">
                            <span>В корзине</span>
                        </a>
                    </div>
                @else
                    <div class="product__btn common__buy" id="productBuy">
                        <a href="#"
                           wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')">
                            <svg width="17" height="23" viewBox="0 0 17 23" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 9L5 4.5C5 2.567 6.567 1 8.5 1V1C10.433 1 12 2.567 12 4.5L12 9"
                                    stroke="white" stroke-width="2" stroke-linecap="round"/>
                                <path
                                    d="M1 10.832C1 8.94641 1 8.0036 1.58579 7.41782C2.17157 6.83203 3.11438 6.83203 5 6.83203H12C13.8856 6.83203 14.8284 6.83203 15.4142 7.41782C16 8.0036 16 8.94641 16 10.832V17.832C16 19.7176 16 20.6605 15.4142 21.2462C14.8284 21.832 13.8856 21.832 12 21.832H5C3.11438 21.832 2.17157 21.832 1.58579 21.2462C1 20.6605 1 19.7176 1 17.832V10.832Z"
                                    stroke="white" stroke-width="2"/>
                            </svg>
                            <span>Добавить в корзину</span>
                        </a>
                    </div>
                @endif
                @php
                    $wish_items = Cart::instance('wishlist')->content()->pluck('id');
                @endphp
                @if($wish_items->contains($product->product_id))
                    <button class="um-basket-product__like product__like added" type="button" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%;"
                        wire:click.prevent="removeFromWishList({{ $product->product_id }})">
                        <svg width="28" height="26" viewBox="0 0 28 26" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M25.4473 2.75435C23.9628 1.19651 21.9951 0.245686 19.8995 0.0736445C17.8039 -0.0983972 15.7187 0.519683 14.0204 1.81624C12.2386 0.429055 10.0209 -0.199961 7.81387 0.0558604C5.60681 0.311682 3.57432 1.43334 2.1257 3.19495C0.677073 4.95657 -0.0800771 7.22729 0.00671527 9.54985C0.0935077 11.8724 1.0178 14.0743 2.59345 15.7121L11.2897 24.8294C12.0179 25.5796 12.9986 26 14.0204 26C15.0421 26 16.0228 25.5796 16.7511 24.8294L25.4473 15.7121C27.0823 13.9901 28 11.661 28 9.23322C28 6.80544 27.0823 4.47628 25.4473 2.75435ZM23.4728 13.6893L14.7765 22.7919C14.6776 22.8965 14.5598 22.9795 14.43 23.0362C14.3002 23.0929 14.161 23.122 14.0204 23.122C13.8797 23.122 13.7405 23.0929 13.6107 23.0362C13.4809 22.9795 13.3631 22.8965 13.2642 22.7919L4.56795 13.6453C3.46974 12.4702 2.85477 10.8917 2.85477 9.24787C2.85477 7.60402 3.46974 6.02553 4.56795 4.85046C5.68706 3.69392 7.19638 3.04542 8.76902 3.04542C10.3417 3.04542 11.851 3.69392 12.9701 4.85046C13.1003 4.98784 13.2552 5.09689 13.4258 5.17131C13.5964 5.24573 13.7795 5.28404 13.9643 5.28404C14.1492 5.28404 14.3322 5.24573 14.5029 5.17131C14.6735 5.09689 14.8284 4.98784 14.9586 4.85046C16.0777 3.69392 17.587 3.04542 19.1597 3.04542C20.7323 3.04542 22.2416 3.69392 23.3607 4.85046C24.474 6.01013 25.1092 7.58007 25.1301 9.22396C25.1511 10.8679 24.5561 12.455 23.4728 13.6453V13.6893Z"
                                style="fill: rgb(210, 75, 108);"></path>
                        </svg>
                        <span class="visually-hidden">Поставить лайк</span>
                    </button>
                @else
                    <button class="um-basket-product__like" type="button"
                        wire:click.prevent="addToWishList({{ $product->product_id }},'{{ $product->name }}','{{ $product->store_price }}')">
                        <i class="icon-um-like"></i>
                        <span class="visually-hidden">Поставить лайк</span>
                    </button>
                @endif
            </div>
        </form>

        <ul class="um-terms-product um-product-info__um-terms-product">

            @if($partner && $partner->delivery_price && $product->store_price<2000)
                <li class="um-terms-product__item">
                    <span class="um-terms-product__text">стоимость доставки</span>
                    <span class="um-terms-product__icon"><i class="icon-um-car"></i>{{ $partner->delivery_price }}&#8381;</span>
                </li>
            @elseif($partner && $partner->delivery_price && $product->store_price>2000)
                <li class="um-terms-product__item">
                    <span class="um-terms-product__text">стоимость доставки</span>
                    <span class="um-terms-product__icon"><i class="icon-um-car"></i>0&#8381;</span>
                </li>
            @endif
            {{-- @if($bonuses)
                <li class="um-terms-product__item">
                    <span class="um-terms-product__text">бонусы за покупку</span>
                    <span class="um-terms-product__icon">{{ $bonuses->qty }}&#8381;</span>
                </li>
            @endif --}}




        </ul>

{{--        <p class="um-product-info__text">Продавец: ООО Кимчи</p>--}}

        <ul class="um-desc-btn-product">
            <li class="um-desc-btn-product__item"><button class="um-desc-btn-product__btn um-desc-btn-product__btn--active" data-tabs-path="description-product">Описание</button></li>
            @if($compounds && count($compounds) > 0 || $parameters )
            <li class="um-desc-btn-product__item"><button class="um-desc-btn-product__btn" data-tabs-path="features-product">Характеристики</button></li>
            @endif
        </ul>

        <div class="um-description-product um-features-desc-feat um-features-desc-feat--active " data-tabs-target="description-product">
			@if(!empty($product->description))
				<h3 class="um-description-product__title-h3">Описание</h3>
				<h4 class="um-description-product__title-h4">О товаре</h4>

				<p class="um-description-product__text">{!! htmlspecialchars_decode($product->description) !!}</p>
				<br>
			@endif
            @if(isset($seo['seo_description']))
                <p class="um-description-product__text">{{$seo['seo_description']}}</p>
            @endif
        </div>
		
        @if($compounds && count($compounds) > 0 || $parameters )
			<div class="um-features-product um-features-desc-feat" data-tabs-target="features-product">
				{{-- <h3 class="um-features-product__title-h3">Характеристики</h3> --}}
				@if($compounds && count($compounds) > 0)
					<h4 class="um-features-product__title-h4">Состав</h4>
					<ul class="um-features-product__list">
						@foreach($compounds as $item)
						<li class="um-features-product__item">
							<span class="um-features-product__elem">{{ $item->compound }}</span>
							<span class="um-features-product__elem">{{ $item->number }}шт</span>
						</li>
						@endforeach
					</ul>
				@endif
				@if($parameters)
					<h4 class="um-features-product__title-h4">Параметры</h4>
					<ul class="um-features-product__list">
						@if($parameters->height)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Высота</span>
								<span class="um-features-product__elem">{{$parameters->height}}см</span>
							</li>
						@endif
						@if($parameters->width)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Ширина</span>
								<span class="um-features-product__elem">{{$parameters->width}}см</span>
							</li>
						@endif
						@if($parameters->depth)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Глубина</span>
								<span class="um-features-product__elem">{{$parameters->depth}}см</span>
							</li>
						@endif
						@if($parameters->weight)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Вес</span>
								<span class="um-features-product__elem">{{$parameters->weight}}кг</span>
							</li>
						@endif
						@if($parameters->volume)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Объем</span>
								<span class="um-features-product__elem">{{$parameters->volume}}л</span>
							</li>
						@endif
						@if($parameters->warranty)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Гарантия</span>
								<span class="um-features-product__elem">{{$parameters->warranty}}месяцев</span>
							</li>
						@endif
						@if($parameters->model)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Модель</span>
								<span class="um-features-product__elem">{{$parameters->model}}</span>
							</li>
						@endif
					</ul>
				@endif

				@if($specifications->isNotEmpty())
					<h4 class="um-features-product__title-h4">Характеристики</h4>
					
					<ul class="um-features-product__list">
						@foreach($specifications as $item)
						<li class="um-features-product__item">
							<span class="um-features-product__elem">{{ $item->specification }}</span>
						</li>
						@endforeach
					</ul>
				@endif

				@if($info)
					<h4 class="um-features-product__title-h4">Информация</h4>
					
					<ul class="um-features-product__list">
						@if($info->peculiarities)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Особенности</span>
								<span class="um-features-product__elem">{{$info->peculiarities}}</span>
							</li>
						@endif
						@if($info->age_limit)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Ограничение по возрасту</span>
								<span class="um-features-product__elem">{{$info->age_limit}}</span>
							</li>
						@endif
						@if($info->number_elements)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Количество элементов</span>
								<span class="um-features-product__elem">{{$info->number_elements}}</span>
							</li>
						@endif
						@if($info->appointment)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Назначение</span>
								<span class="um-features-product__elem">{{$info->appointment}}</span>
							</li>
						@endif
						@if($info->taste)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Вкус</span>
								<span class="um-features-product__elem">{{$info->taste}}</span>
							</li>
						@endif
						@if($info->shelf_life)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Срок годности</span>
								<span class="um-features-product__elem">{{$info->shelf_life}}</span>
							</li>
						@endif
						@if($info->package)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Упаковка</span>
								<span class="um-features-product__elem">{{$info->package}}</span>
							</li>
						@endif
						@if($info->producing_country)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Страна производитель</span>
								<span class="um-features-product__elem">{{$info->producing_country}}</span>
							</li>
						@endif
						@if($info->equipment)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Комплектация</span>
								<span class="um-features-product__elem">{{$info->equipment}}</span>
							</li>
						@endif
						@if($info->brand)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Бренд</span>
								<span class="um-features-product__elem">{{$info->brand}}</span>
							</li>
						@endif
						@if($info->vendor_code)
							<li class="um-features-product__item">
								<span class="um-features-product__elem">Артикул</span>
								<span class="um-features-product__elem">{{$info->vendor_code}}</span>
							</li>
						@endif
					</ul>
				@endif
			</div>
        @endif
    </div>
</div>





        <div class="productImage__popup" id="productImagePopup">
            <div class="productImage__inner">
                <div class="productImage__img">
                    <img src="{{ asset('storage') }}/{{$product->image}}" alt="{{ $product->name }}">
                </div>
                <div class="productImage__close" id="productImageClose"
                     onclick="document.querySelector('#productImagePopup').style.display = 'none'">
                    <img src="{{ asset('images/closeBlack.svg') }}" alt="close">
                </div>
            </div>
        </div>
        @if($buy_products && count($buy_products) > 0)
        <section class="different" style="padding: 43px 0 50px">
            <div class="container">
                <div class="different__inner" wire:ignore>
                    <h2 class="different__title">C этим товаром покупают</h2>
                    <div class="different__wrapper">
                        @php
                            $wish_items = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp

                        @foreach($buy_products as $product)
                            <div class="popular__item">
                                <div class="popular__img popularImg">

                                    <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'city_slug'=>session('city')['slug'], 'slug'=>$product->product_id]) }}">
                                        <img src="{{ asset('storage') }}/{{ $product->image }}"
                                             alt="{{ $product->name }}">
                                        @if($product->store_price>2000)
                                            <div class="popular__delivery-free"></div>
                                        @endif
                                    </a>
                                    @if($partner && $partner->delivery_price)
                                        <div
                                            class="popular__delivery popular__delivery--mob">{{ $partner->delivery_price }}
                                            <span class="ruble-icon">₽</span></div>
                                    @endif

                                </div>
                                <div class="popular__right">
                                    @if($partner && $partner->delivery_price)
                                        <div class="popular__delivery">{{ $partner->delivery_price }} <span
                                                class="ruble-icon">₽</span></div>
                                    @endif
                                    @if($product->reviews_count)
                                        <div class="popular__review">
                                            {{ $product->rating }} <span>({{$product->reviews_count}})</span>
                                        </div>
                                    @endif

                                    <div class="popular__name">
                                        <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'city_slug'=>session('city')['slug'], 'slug'=>$product->product_id]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </div>
                                    <div class="popular__description">Авторская композиция в роскошной упаковке</div>
                                    <div class="popular__bottom">

                                        <div class="popular__price">{{ $product->store_price }} ₽</div>
                                        @if($product->store_old_price)
                                            <div
                                                class="popular__oldprice popularOldPrice">{{ $product->store_old_price }}
                                                ₽
                                            </div>
                                        @endif
                                        @php
                                            $product_items = Cart::instance('cart')->content()->pluck('id');
                                        @endphp
                                        @if($product_items->contains($product->product_id))
                                            <div class="popular__buy">
                                                <a href="{{ route('product.cart') }}"
                                                   style="background-color: rgb(106, 205, 248);">
                                                    <img src="{{ asset('images/doneBuy.svg') }}" alt="basket">
                                                </a>
                                            </div>
                                    </div>
                                    <div class="popular__buy popular__buy--second">
                                        <a href="{{ route('product.cart') }}"
                                           style="background-color: rgb(106, 205, 248);">
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
            </div>
        </section>
        @endif
        <section class="different" style="padding: 43px 0 50px">
            <div class="container">
                <div class="different__inner" wire:ignore>
                    <h2 class="different__title">Вам может понравиться</h2>
                    <div class="different__wrapper">
                        @php
                            $wish_items = Cart::instance('wishlist')->content()->pluck('id');
                        @endphp
                        @foreach($popular_products as $product)
                            <div class="popular__item">
                                <div class="popular__img popularImg">

                                    <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'city_slug'=>session('city')['slug'], 'slug'=>$product->id]) }}">
                                        <img src="{{ asset('storage') }}/{{ $product->image }}"
                                             alt="{{ $product->name }}">
                                        @if($product->store_price>2000)
                                            <div class="popular__delivery-free"></div>
                                        @endif
                                    </a>
                                    @if($partner && $partner->delivery_price)
                                        <div
                                            class="popular__delivery popular__delivery--mob">{{ $partner->delivery_price }}
                                            <span class="ruble-icon">₽</span></div>
                                    @endif

                                </div>
                                <div class="popular__right">
                                    @if($partner && $partner->delivery_price)
                                        <div class="popular__delivery">{{ $partner->delivery_price }} <span
                                                class="ruble-icon">₽</span></div>
                                    @endif
                                    @if($product->reviews_count)
                                        <div class="popular__review">
                                            {{ $product->rating }} <span>({{$product->reviews_count}})</span>
                                        </div>
                                    @endif

                                    <div class="popular__name">
                                        <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'city_slug'=>session('city')['slug'], 'slug'=>$product->id]) }}">
                                            {{ $product->name }}
                                        </a>
                                    </div>
                                    {{-- <div class="popular__description">Авторская композиция в роскошной упаковке</div> --}}
                                    <div class="popular__bottom">

                                        <div class="popular__price">{{ $product->store_price }} ₽</div>
                                        @if($product->store_old_price)
                                            <div
                                                class="popular__oldprice popularOldPrice">{{ $product->store_old_price }}
                                                ₽
                                            </div>
                                        @endif
                                        @php
                                            $product_items = Cart::instance('cart')->content()->pluck('id');
                                        @endphp
                                        @if($product_items->contains($product->product_id))
                                            <div class="popular__buy">
                                                <a href="{{ route('product.cart') }}"
                                                   style="background-color: rgb(106, 205, 248);">
                                                    <img src="{{ asset('images/doneBuy.svg') }}" alt="basket">
                                                </a>
                                            </div>
                                    </div>
                                    <div class="popular__buy popular__buy--second">
                                        <a href="{{ route('product.cart') }}"
                                           style="background-color: rgb(106, 205, 248);">
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
            </div>
        </section>

    </nav>
        <article class="product" style="margin-bottom: 150px ">
            <div class="container">
                <div class="product__inner">
                    <div class="row">
                        <div class="col-12">
                            <div class="product__wrapper">
                                <div class="product__top product__top--choose" wire:ignore>
                                    <div class="product__name common__choose active">Отзывы о товаре
                                        ({{ count($reviews) }})
                                    </div>
                                    <div class="product__name common__choose">О магазине</div>
                                </div>
                                <div class="product__review" wire:ignore.self>
                                    @if($reviews)
                                        @foreach($reviews as $review)
                                            <div class="product__unit">
                                                <div class="product__up">
                                                    <div class="product__image product__person">
                                                        <img src="{{ asset('images/person.svg') }}" alt="person">
                                                    </div>
                                                    <div class="product__info">
                                                        <div class="product__information">
                                                            <div
                                                                class="product__who">{{ $review->name ? $review->name : 'Покупатель' }}</div>
                                                            <div class="product__when">{{ $review->created_at }}</div>
                                                        </div>
                                                        <div class="product__stars">
                                                            @php
                                                                $counter = $review->rating;
                                                                $stars = 0;
                                                            @endphp
                                                            @while($stars < 5)
                                                                @if($review->rating > $stars)
                                                                    <div class="product__star">
                                                                        <img
                                                                            src="{{ asset('images/fullStarSmall.svg') }}"
                                                                            alt="оценка пользователя">
                                                                    </div>
                                                                @else
                                                                    <div class="product__star">
                                                                        <img
                                                                            src="{{ asset('images/emptyStarSmall.svg') }}"
                                                                            alt="оценка пользователя">
                                                                    </div>
                                                                @endif
                                                                @php $stars +=1; @endphp
                                                            @endwhile
                                                        </div>
                                                        <div class="product__texting"> {!! $review->review !!}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if(Auth::check())
                                        <div class="product__button common__btn" id="productButton">

                                            <a href="#">Оставить отзыв</a>
                                        </div>
                                    @else
                                        <div class="product__button">
                                            <a href="{{ route('auth') }}" style="text-decoration: underline"> Войдите
                                                или зарегистрируйтесь </a> чтобы оставить свой отзыв
                                        </div>
                                    @endif


                                    <div class="product__review__hide" id="reviewProduct" wire:ignore.self>

                                        <div class="review__choose">
                                            <div class="review__item">Добавить отзыв</div>
                                            <!-- <div class="review__item">Мои отзывы (2)</div> -->
                                        </div>
                                        <div class="review__block common__form">
                                            <form class="review__form" wire:submit.prevent="setReview">
                                                @csrf
                                                <div class="review__top">
                                                    Добавить оценку <span>(необязательное поле)</span>
                                                    <div class="rating-area">
                                                        <input type="radio" id="star-5" name="rating"
                                                               wire:model.defer="review_rating" value="5">
                                                        <label for="star-5" title="Оценка «5»"></label>
                                                        <input type="radio" id="star-4" name="rating"
                                                               wire:model.defer="review_rating" value="4">
                                                        <label for="star-4" title="Оценка «4»"></label>
                                                        <input type="radio" id="star-3" name="rating"
                                                               wire:model.defer="review_rating" value="3">
                                                        <label for="star-3" title="Оценка «3»"></label>
                                                        <input type="radio" id="star-2" name="rating"
                                                               wire:model.defer="review_rating" value="2">
                                                        <label for="star-2" title="Оценка «2»"></label>
                                                        <input type="radio" id="star-1" name="rating"
                                                               wire:model.defer="review_rating" value="1">
                                                        <label for="star-1" title="Оценка «1»"></label>
                                                    </div>
                                                </div>
                                                <div class="review__top">Тема</div>
                                                <div class="review__unit">
                                                    <div class="review__field">
                                                        <input type="text" placeholder="Пожелания / Замечания"
                                                               wire:model="review_theme" value="Пожелания / Замечания"
                                                               id="reviewTheme" readonly>
                                                        <div class="review__arrow" id="reviewArrow1">
                                                            <img src="{{ asset('images/arrowMenu.svg') }}"
                                                                 alt="arrowMenu">
                                                        </div>
                                                        <div class="review__items" id="reviewItems">
                                                            <div class="review__point added" id="reviewPoint">Пожелания/
                                                                Замечания
                                                            </div>
                                                            <div class="review__point" id="reviewPoint">Оформление
                                                                заказ
                                                            </div>
                                                            <div class="review__point" id="reviewPoint">Оплата заказа
                                                            </div>
                                                            <div class="review__point" id="reviewPoint">Доставка</div>
                                                            <div class="review__point" id="reviewPoint">Возврат</div>
                                                            <div class="review__point" id="reviewPoint">Благодарность
                                                            </div>
                                                            <div class="review__point" id="reviewPoint">Вопросы по
                                                                акциям и скидкам
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="review__top">Категория</div>
                                                <div class="review__unit">
                                                    <div class="review__field">
                                                        <input type="text" value="Доставка букетов"
                                                               placeholder="Категория" wire:model.defer="review_branch"
                                                               id="reviewKategoryItem" readonly>
                                                        <!-- <div class="review__arrow" id="reviewKategoryItem">
                                                            <img src="images/arrowMenu.svg" alt="">
                                                        </div>
                                                        <div class="review__items" id="reviewCategory">
                                                            <div class="review__point" id="reviewUnit">Авто</div>
                                                            <div class="review__point" id="reviewUnit">Доставка букетов</div>
                                                            <div class="review__point" id="reviewUnit">Детские игрушки</div>
                                                            <div class="review__point" id="reviewUnit">Дизайн Интерьеров</div>
                                                            <div class="review__point" id="reviewUnit">Доставка еды</div>
                                                            <div class="review__point" id="reviewUnit">Зоотовары</div>
                                                            <div class="review__point" id="reviewUnit">Кальянные</div>
                                                            <div class="review__point" id="reviewUnit">Клининг</div>
                                                            <div class="review__point" id="reviewUnit">Кузнечные мастерские</div>
                                                            <div class="review__point" id="reviewUnit">Кузнечные мастерские</div>
                                                            <div class="review__point" id="reviewUnit">Организация праздников</div>
                                                            <div class="review__point" id="reviewUnit">Подарки ручной работы</div>
                                                            <div class="review__point" id="reviewUnit">Пошив и ремонт одежды</div>
                                                            <div class="review__point" id="reviewUnit">Салон красоты</div>
                                                            <div class="review__point" id="reviewUnit">Сервисный центр – ремонт техники</div>
                                                            <div class="review__point" id="reviewUnit">Столярные мастерские</div>
                                                            <div class="review__point" id="reviewUnit">Строительство</div>
                                                            <div class="review__point" id="reviewUnit">Товары 18+</div>
                                                            <div class="review__point" id="reviewUnit">Туры и Отели</div>
                                                            <div class="review__point" id="reviewUnit">Фитнес и спорт</div>
                                                            <div class="review__point" id="reviewUnit">Фотоуслуги и видео услуги</div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="review__top">Текст</div>
                                                @error('review_text')
                                                <div class="error">Отзыв должен составлять не менее 15 символов*
                                                </div>@enderror
                                                <textarea type="text" placeholder="Введите текст отзыва ..."
                                                          wire:model.defer="review_text"></textarea>
                                                <button class="common__close">Отправить</button>
                                            </form>
                                        </div>
                                        <div class="product__closeBtn" id="productCloseBtn"
                                             onclick="document.querySelector('#reviewProduct').style.display = 'none'">
                                            <img src=" {{ asset('images/closeBlack.svg') }}" alt="close">
                                        </div>
                                    </div>

                                </div>
                                <div class="product__review" wire:ignore.self>
                                    <div class="product__review--man">
                                        @if(isset($partner->description) && $partner->description)
                                            @if($partner->image)
                                                <div class="product__man">
                                                    <img src=" {{ asset('storage') }}/{{ $partner->image }}"
                                                         alt="partner">
                                                </div>
                                            @endif
                                            <div class="product__review__text">
                                                {!! htmlspecialchars_decode($partner->description) !!}
                                            </div>
                                        @else
                                            <div class="product__review__text">
                                                <p>Почти всегда в наших магазинах вы найдёте широкий выбор и высокое
                                                    качество цветов. Конечно, есть дни перед поставкой, когда выбор уже
                                                    не так велик, ведь мы берём столько цветов, сколько можем продать.
                                                    Именно благодаря такому подходу, вы приобретаете у нас только свежие
                                                    цветы.</p>
                                                <p>Мы постоянно работаем над улучшением нашего сервиса, думаем над тем,
                                                    как стать лучше. Конечно, не может всё получатся идеальным, ведь все
                                                    в нашем коллективе живые люди, но та обратная связь, которую мы
                                                    получаем, говорит нам, что мы движемся в правильном направлении и
                                                    подсказывает, как стать ещё лучше.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
</div>

@if(session()->has('message'))
    <div id="thanks" class="thanks" style="display: block !important;box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1);">
        <h3 class="thanks__title">{{ session('message') }}</h3>
        <div id="thanksClose" class="thanks__close" onclick="document.querySelector('#thanks').style.display = 'none'">
            <img src="{{ asset('images/closePartner.svg') }}" alt="close"/></div>
        <div id="thanksBtn" class="main__btn thanks__btn"
             onclick="document.querySelector('#thanks').style.display = 'none'">Закрыть
        </div>
    </div>
    <script>
        document.querySelector('#reviewProduct').style.display = 'none';
    </script>
@endif



@push('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{asset('js/um-js/um-product-info.js')}}"></script>
    <script>
        document.querySelectorAll('#productFlower #productChoose input').forEach(item => item.checked = false);

        function checkedOption(input) {
            if (input.checked) {
            @this.set('option_checked', true);
            } else {
            @this.set('option_checked', false);
            }
        }

    </script>
@endpush
