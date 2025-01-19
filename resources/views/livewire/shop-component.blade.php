@section('title')
	@if ($seo)
    	<title>{{$seo['title']}}</title>
	@else
		<title>Onion Market</title>
	@endif
@endsection
@section('meta.description.keywords')
	@if ($seo)
    	<meta name="description" content="{{$seo['meta_description']}}"/>
    	<meta name="keywords" content="{{$seo['meta_keywords']}}"/>
	@endif
@endsection
@push('head')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush
<div class="wrapper">
    <div class="content">
        @if ($domain)
            @livewire('for-clone.clone-shop-slider')
        @else
            @include('livewire.includes.shop-slider')
        @endif
        <section class="major">
            <div class="container">
                <a href="#" class="major__btn-prev"></a>
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li>
                                <span>Каталог</span>
                            </li>
                            {{-- <li>
                                <a href="{{route('shop', [session('city')['slug'], $direction_slug])}}">{{ session('direction_name') }}</a>
                            </li> --}}
                            {{-- @if(Session::has('parent_category_name'))
                                <li>
                                    <a href="{{session()->get('parent_category_url')}}">{{session()->get('parent_category_name')}}</a>
                                </li>
                            @endif
                            @if(Session::has('category_name'))
                                <li>
                                    <a href="{{url()->current()}}"><span>{{ session()->get('category_name') }}</span></a>
                                </li>

                            @endif --}}
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="flowers">
            <div class="container">
                <div class="flowers__inner">
                    <div class="row">
                        <div class="col-12">
                            {{-- <h1 class="flowers__delivery">{{ session('direction_name') }}</h1> --}}
                            <h1 class="flowers__delivery">Каталог</h1>
                            <div class="promotions__choose" id="promotionsChoose">Фильтры</div>
                            <div class="flowers__sorting" id="flowersSorting">Сортировать</div>
                            <div class="sorting__hide" id="sortingHide">
                                <ul>
                                    <li>
                                        <a href="#" wire:click.prevent="sort('date')">Новизне</a>
                                    </li>
                                    <li>
                                        <a href="#" wire:click.prevent="sort('price')">По цене (Низкая > Высокая)</a>
                                    </li>
                                    <li>
                                        <a href="#" wire:click.prevent="sort('price-desc')">По цене (Высокая >
                                            Низкая)</a>
                                    </li>
                                    {{--                                    <li>--}}
                                    {{--                                        <a href="#">Рейтингу</a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li>--}}
                                    {{--                                        <a href="#">Скидке</a>--}}
                                    {{--                                    </li>--}}
                                </ul>
                            </div>
                            <div class="promotions__hide" id="promotionsHide">
                                {{--                                @foreach($parentFilter as $parent)--}}
                                {{--                                    <div class="flowers__top">{{$parent->name}}</div>--}}
                                {{--                                    <div class="flowers__hide">--}}
                                {{--                                        @foreach($allFilters->where('parent_id',$parent->id) as $filter)--}}
                                {{--                                            <div class="promotion__br">--}}
                                {{--                                                <input class="custom-checkbox" id="checkbox{{$filter->id}}"--}}
                                {{--                                                       class="promotions__mobClick" type="checkbox">--}}
                                {{--                                                <label --}}
                                {{--                                                    for="checkbox{{$filter->id}}">{{$filter->name}}--}}
                                {{--                                                </label>--}}
                                {{--                                            </div>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </div>--}}
                                {{--                                @endforeach--}}
                                <div class="flowers__list" wire:ignore>
                                    <ul>
                                        @foreach($categories as $category)
                                            @if($category->childrens)
                                                <li>
                                                    <div
                                                        class="flowers__hideClick flowersHideClick {{ $category->id == $current_category_id ? 'active' : '' }} has_children"
                                                        id="">{{ $category->name }}</div>
                                                    <div class="hide__li"
                                                         style="{{ $category->id == $current_category_id ? 'display:block;' : '' }}">
                                                        <ul>
                                                            @foreach($category->childrens as $category_children)
                                                                <li>
                                                                    <div
                                                                        class="{{ $category_children->id == $category_slug ? 'active' : '' }}"
                                                                        style="cursor: pointer"
                                                                        onclick="location.href='{{route('product.shop', [session('city')['slug'], $direction_slug, $category_children->id])}}'">{{ $category_children->name }}
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @else
                                                <li>
                                                    <div
                                                        onclick="location.href='{{route('product.shop', [session('city')['slug'], $direction_slug, $category->id])}}'"
                                                        style="cursor: pointer"
                                                        id="flowersHideClick">{{ $category->name }}
                                                    </div>
                                                </li>
                                            @endif

                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 d-none d-lg-block">
                            <div class="flowers__price">
                                <div class="flowers__p">Цена</div>
                                {{--                                <input type="text" class="js-range-slider" wire:ignore id="demo_0" name="my_range" value="" />--}}
                                <div id="price-slider" class="slider" wire:ignore></div>
                                <div class="wrap" style="display: flex;">
                                    <input type="text" class="flowers__inputFrom"
                                           wire:model="min_price"
                                           placeholder="от  {{ $min_price }}">
                                    <input type="text" class="flowers__inputTo" value="{{ $max_price }}"
                                           wire:model="max_price"
                                           placeholder="до  {{ $max_price }}">
                                </div>
                            </div>

                            <div class="flowers__list" wire:ignore>
                                <ul>
                                    @foreach($categories as $category)

                                        @if($category->childrens)
                                            <li>
                                                <div
                                                    class="flowers__hideClick flowersHideClick {{ $category->id == $current_category_id ? 'active' : '' }} has_children"
                                                    id="">{{ $category->name }}</div>
                                                <div class="hide__li"
                                                     style="{{ $category->id == $current_category_id ? 'display:block;' : '' }}">
                                                    <ul>
                                                        @foreach($category->childrens as $category_children)
                                                            <li>
                                                                <div
                                                                    class="{{ $category_children->id == $category_slug ? 'active' : '' }}"
                                                                    style="cursor: pointer"
                                                                    onclick="location.href='{{route('product.shop', [session('city')['slug'], $direction_slug, $category_children->id])}}'">{{ $category_children->name }}
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @else
                                            <li>
                                                <div
                                                    onclick="location.href='{{route('product.shop', [session('city')['slug'], $direction_slug, $category->id])}}'"
                                                    style="cursor: pointer"
                                                    id="flowersHideClick">{{ $category->name }}
                                                </div>
                                            </li>
                                        @endif

                                    @endforeach


                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="flowers__sort" id="flowersSort">
                                        <ul wire:ignore>
                                            <li>Сортировать по:</li>
                                            <li>
                                                <a href="#" wire:click.prevent="sort('date')"
                                                   style="color: rgb(0, 0, 0);">Новизне</a>
                                            </li>
                                            <li>
                                                <a href="#" wire:click.prevent="sort('price')">По цене (Низкая >
                                                    Высокая)</a>
                                            </li>
                                            <li>
                                                <a href="#" wire:click.prevent="sort('price-desc')">По цене (Высокая >
                                                    Низкая)</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">


                                @php
                                    $wish_items = Cart::instance('wishlist')->content()->pluck('id');
                                @endphp
                                @foreach($products as $product)

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="popular__item">
                                            @if($product->store_old_price)
                                                @php
                                                    $discount = ($product->store_old_price - $product->store_price) * 100 / $product->store_old_price;
                                                @endphp
                                            <div class="popular__new popular__new_discount" style="z-index: 500; padding: 10px !important;">-{{ round($discount) }}%</div>
                                            @endif
                                            <div class="popular__img popularImg">
                                                <a href="{{ route('product.details', [ 'city_slug'=>session('city')['slug'] ,'slug'=>$product->product_id]) }}"
                                                   title="{{ $product->name }}">
                                                    <img src="{{asset('storage') }}/{{$product->image}}"
                                                         alt="{{ $product->name }}">
                                                    @if($product->store_price>2000)
                                                        <div class="popular__delivery-free"></div>
                                                    @endif
                                                </a>
                                                @if($product->delivery_price && $product->store_price<2000)
                                                    <div
                                                        class="popular__delivery popular__delivery--mob">{{ $product->delivery_price }}
                                                        <span class="ruble-icon">₽</span></div>
                                                @endif
                                            </div>
                                            <div class="popular__right">
                                                @if($product->delivery_price && $product->store_price<2000)
                                                    <div class="popular__delivery"> {{ $product->delivery_price }} <span
                                                            class="ruble-icon">₽</span></div>
                                                @elseif($product->store_price>2000)
                                                    <div class="popular__delivery-free--mob"></div>

                                                @endif

                                                <div class="popular__name">
                                                    <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'],'slug'=>$product->product_id]) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </div>

                                                @if($product->reviews_count)
                                                    <div class="popular__review">
                                                        {{ $product->rating }}
                                                        <span>({{$product->reviews_count}})</span>
                                                    </div>
                                                @endif

                                                {{--                                                <div class="popular__description"> {!! html_entity_decode($product->shot_description) !!} </div>--}}
                                                <div class="popular__bottom">
                                                    <div class="popular__price popularPrice">{{ $product->store_price }}
                                                        <span class="ruble-icon">₽</span></div>
                                                    @if($product->store_old_price)
                                                        <div
                                                            class="popular__oldprice popularOldPrice">{{ $product->store_old_price }}
                                                            <span class="ruble-icon">₽</span></div>
                                                    @endif
                                                    @php
                                                        $product_items = Cart::instance('cart')->content()->pluck('id');
                                                    @endphp
                                                    @if($product_items->contains($product->product_id))
                                                        <div class="popular__buy">
                                                            <a class="active" href="{{ route('product.cart') }}"
                                                               style="background-color: rgb(106, 205, 248);">
                                                                <img src="{{ asset('images/doneBuy.svg') }}"
                                                                     alt="basket">
                                                            </a>
                                                        </div>
                                                </div>
                                                <div class="popular__buy popular__buy--second">
                                                    <a class="active" href="{{ route('product.cart') }}"
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
                                                <div class="popular__like active"
                                                     wire:click.prevent="removeFromWishList({{ $product->product_id }})">
                                                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z"
                                                            stroke-width="2"/>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="popular__like "
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
                        <div class="row">
                            <div class="col-12">
                                <div class="flowers__pagination">
                                    {{ $products->links('vendor.livewire.custom-pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
</div>
{{--{{dd($pagesize,$products)}}--}}
@push('footer')
    <script> document.querySelector(".major").scrollIntoView({block: "start", behavior: "smooth"});</script></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{asset('js/main.js')}}">


    </script>


    <script>
        document.addEventListener("DOMContentLoaded", ready);

        function ready() {
            let slider = document.getElementById('price-slider');
            noUiSlider.create(slider, {
                start: [{{ $min_price }}, {{ $max_price }}],
                connect: true,
                range: {
                    'min': {{ $min_price }},
                    'max': {{ $max_price }}
                },
            });
            slider.noUiSlider.on('update', function (value) {
                document.querySelector('.flowers__inputFrom').value = value[0];
                document.querySelector('.flowers__inputTo').value = value[1];
            @this.set('min_price', value[0]);
            @this.set('max_price', value[1]);
            })
        }


    </script>



@endpush
