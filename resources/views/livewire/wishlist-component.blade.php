
@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
<div class="wrapper">
    <div class="content">
        @include('livewire.includes.main-slider')
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>Понравилось</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="flowers">
            <div class="container">
                @if(Cart::instance('wishlist')->content()->count() > 0)
                <div class="flowers__inner">
                    <div class="row">
{{--                            <div class="flowers__list">--}}
{{--                                <ul>--}}
{{--                                    @foreach($categories as $category)--}}

{{--                                        @if($category->childrens)--}}
{{--                                            <li>--}}
{{--                                                <div--}}
{{--                                                    class="flowers__hideClick flowersHideClick has_children"--}}
{{--                                                    id="">{{ $category->name }}</div>--}}
{{--                                                <div class="hide__li">--}}
{{--                                                    <ul>--}}
{{--                                                        @foreach($category->childrens as $category_children)--}}
{{--                                                            <li>--}}
{{--                                                                <a class="{{ $category_children->id == $category_slug ? 'active' : '' }}"--}}
{{--                                                                   href="{{route('product.shop', [session('city')['slug'], $direction_slug, $category_children->id])}}">{{$category_children->name}}</a>--}}
{{--                                                            </li>--}}
{{--                                                        @endforeach--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </li>--}}
{{--                                        @else--}}
{{--                                            <li>--}}
{{--                                                <a href="{{route('product.shop', [session('city')['slug'], $direction_slug, $category->id])}}"--}}
{{--                                                   id="flowersHideClick">{{ $category->name }}</a></li>--}}
{{--                                        @endif--}}

{{--                                    @endforeach--}}


{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="row">
                                @php
                                    $wish_items = Cart::instance('wishlist')->content()->pluck('id');
                                @endphp
                                @foreach(Cart::instance('wishlist')->content() as $product)
                                    <div class="col-md-12 col-lg-4 col-xl-3">
                                        <div class="popular__item">
                                            <div class="popular__img popularImg">
                                                <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$product->model->id]) }}" title="{{ $product->model->name }}">
                                                    <img src="{{asset('storage') }}/{{$product->model->image}}" alt="{{ $product->name }}">
                                                </a>
{{--                                                <div class="popular__delivery popular__delivery--mob">{{ $product->model->price }} ₽</div>--}}
                                            </div>
                                            <div class="popular__right">
{{--                                                <div class="popular__delivery">300 ₽</div>--}}
{{--                                                <div class="popular__review">--}}
{{--                                                    4,8 <span>(131 отзыв)</span>--}}
{{--                                                </div>--}}
                                                <div class="popular__name">
                                                    <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$product->model->id]) }}">
                                                        {{ $product->model->name }}
                                                    </a>
                                                </div>
                                                <div class="popular__description">{!! html_entity_decode($product->shot_description) !!}</div>
                                                <div class="popular__bottom">
                                                    <div class="popular__price popularPrice">{{ $product->price }} ₽</div>
                                                    @if($product->model->old_price)
                                                        <div class="popular__oldprice popularOldPrice">{{ $product->old_price }} ₽</div>
                                                    @endif
                                                    <div class="popular__buy">
                                                        <a href="" wire:click.prevent="store({{$product->model->id}},'{{$product->model->name}}','{{ $product->price }}','{{ $product->model->image }}')">
                                                            <img src="{{asset('images/basket(1).svg')}}" alt="basket">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="popular__buy popular__buy--second">
                                                    <a href="#" wire:click.prevent="store({{ $product->model->id }},'{{ $product->model->name }}','{{ $product->price }}','{{ $product->model->image }}')">
                                                        <img src="{{asset('images/basket(1).svg')}}" alt="basket">
                                                    </a>
                                                </div>

                                                    <div class="popular__like popularLike active" wire:click.prevent="removeFromWishList({{ $product->model->id }})">
                                                        <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z" stroke-width="2"/>
                                                        </svg>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-12">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <h4>Пока нет понравившихся товаров</h4>
                @endif
            </div>
        </section>

    </div>
</div>
<script>        document.querySelector(".major").scrollIntoView({block: "start",behavior: "smooth"});</script>
@push('footer')
    <style>

        .noUi-connect {
            height: 3px;
            background-color: #3657C8;
        }

        .noUi-handle::before  {
            width: 20px;
            height: 20px;
            border: 2px solid #BFC6E0;
            border-radius: 50%;
            background: #fff;
            top: -4px;
        }
        .noUi-handle {
            border: none;
            border-radius: 0;
            background: none;
            cursor: default;
            box-shadow: none;
        }
        .noUi-target{
            background: none;
            border-radius: 0;
            border: none;
            box-shadow: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{asset('js/main.js')}}"></script>


@endpush


