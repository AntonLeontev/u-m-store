@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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
                            <li><span>Поиск</span></li>
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
                            <div class="flowers__delivery">Поиск</div>
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
                                        <a href="#" wire:click.prevent="sort('price-desc')" >По цене (Высокая > Низкая)</a>
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
                                <div class="flowers__top">Повод</div>
                                <div class="flowers__hide">
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox1" class="promotions__mobClick" type="checkbox"><label for="checkbox1">1 Сентября</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox2" class="promotions__mobClick" type="checkbox"><label for="checkbox2">14 февраля</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox3" class="promotions__mobClick" type="checkbox"><label for="checkbox3">23 Февраля</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox4" class="promotions__mobClick" type="checkbox"><label for="checkbox4">8 Марта</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox5" class="promotions__mobClick" type="checkbox"><label for="checkbox5">9 мая</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox6" class="promotions__mobClick" type="checkbox"><label for="checkbox6">День матери</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox7" class="promotions__mobClick" type="checkbox"><label for="checkbox7">Выписка из роддома</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox8" class="promotions__mobClick" type="checkbox"><label for="checkbox8">День Рождения</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox9" class="promotions__mobClick" type="checkbox"><label for="checkbox9">День Учителя</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox10" class="promotions__mobClick" type="checkbox"><label for="checkbox10">Новоселье</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox11" class="promotions__mobClick" type="checkbox"><label for="checkbox11">Новый Год</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox12" class="promotions__mobClick" type="checkbox"><label for="checkbox12">Повышение</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox13" class="promotions__mobClick" type="checkbox"><label for="checkbox13">Последний звонок</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox14" class="promotions__mobClick" type="checkbox"><label for="checkbox14">Рождение ребенка</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox15" class="promotions__mobClick" type="checkbox"><label for="checkbox15">Свадьба</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox16" class="promotions__mobClick" type="checkbox"><label for="checkbox16">Татьянин день</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox17" class="promotions__mobClick" type="checkbox"><label for="checkbox17">Торжество</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox18" class="promotions__mobClick" type="checkbox"><label for="checkbox18">Юбилей</label>
                                    </div>
                                </div>
                                <div class="flowers__top">Кому</div>
                                <div class="flowers__hide">
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox19" class="promotions__mobClick" type="checkbox"><label for="checkbox19">Бабушке</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox20" class="promotions__mobClick" type="checkbox"><label for="checkbox20">Девушке</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox21" class="promotions__mobClick" type="checkbox"><label for="checkbox21">Женщине</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox22" class="promotions__mobClick" type="checkbox"><label for="checkbox22">Коллеге</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox23" class="promotions__mobClick" type="checkbox"><label for="checkbox23">Руководителю</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox24" class="promotions__mobClick" type="checkbox"><label for="checkbox24">Сестре</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox25" class="promotions__mobClick" type="checkbox"><label for="checkbox25">Учителю</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox26" class="promotions__mobClick" type="checkbox"><label for="checkbox26">для Невесты</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox27" class="promotions__mobClick" type="checkbox"><label for="checkbox27">для Любимой</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox28" class="promotions__mobClick" type="checkbox"><label for="checkbox28">Маме</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox29" class="promotions__mobClick" type="checkbox"><label for="checkbox29">Папе</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox30" class="promotions__mobClick" type="checkbox"><label for="checkbox30">Подруге</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="flowers__sort" id="flowersSort">
                                        <ul wire:ignore>
                                            <li>Сортировать по:</li>
                                            <li>
                                                <a href="#" wire:click.prevent="sort('date')" style="color: rgb(0, 0, 0);">Новизне</a>
                                            </li>
                                            <li>
                                                <a href="#" wire:click.prevent="sort('price')">По цене (Низкая > Высокая)</a>
                                            </li>
                                            <li>
                                                <a href="#" wire:click.prevent="sort('price-desc')" >По цене (Высокая > Низкая)</a>
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
                                    <div class="col-md-12 col-lg-4 col-xl-3">
                                        <div class="popular__item">
                                            <div class="popular__img popularImg">
                                                <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$product->product_id]) }}" title="{{ $product->name }}">
                                                    <img src="{{asset('storage') }}/{{$product->image}}" alt="{{ $product->name }}">
                                                </a>
                                                <div class="popular__delivery popular__delivery--mob">{{ $product->store_price }} ₽</div>
                                            </div>
                                            <div class="popular__right">
                                                @if($product->reviews_count)
                                                    <div class="popular__review">
                                                        {{ $product->rating }} <span>({{$product->reviews_count}})</span>
                                                    </div>
                                                @endif
                                                <div class="popular__name">
                                                    <a href="{{ route('product.details', ['city_slug'=>session('city')['slug'], 'slug'=>$product->product_id]) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </div>
                                                <div class="popular__description">{!! html_entity_decode($product->shot_description) !!}</div>
                                                <div class="popular__bottom">
                                                    <div class="popular__price popularPrice">{{ $product->store_price }} <span class="ruble-icon">₽</span></div>
                                                    @if($product->old_price)
                                                        <div class="popular__oldprice popularOldPrice">{{ $product->old_price }} <span class="ruble-icon">₽</span></div>
                                                    @endif
                                                    @php
                                                        $product_items = Cart::instance('cart')->content()->pluck('id');
                                                    @endphp
                                                    @if($product_items->contains($product->product_id))
                                                        <div class="popular__buy">
                                                            <a class="active" href="#" style="background-color: rgb(106, 205, 248);">
                                                                <img src="{{ asset('images/doneBuy.svg') }}" alt="basket">
                                                            </a>
                                                        </div>
                                                </div>
                                                <div class="popular__buy popular__buy--second">
                                                    <a class="active" href="#" style="background-color: rgb(106, 205, 248);">
                                                        <img src="{{ asset('images/doneBuy.svg') }}" alt="basket" >
                                                    </a>
                                                </div>
                                                @else
                                                    <div class="popular__buy">
                                                        <a href="#" wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')">
                                                            <img src="{{ asset('images/basket(1).svg') }}" alt="basket">
                                                        </a>
                                                    </div>
                                            </div>
                                            <div class="popular__buy popular__buy--second" wire:click.prevent="store({{$product->product_id}},'{{$product->name}}','{{$product->store_price}}','{{$product->image}}')" >
                                                <a href="#">
                                                    <img src="{{ asset('images/basket(1).svg') }}" alt="basket">
                                                </a>
                                            </div>
                                            @endif
                                                @if($wish_items->contains($product->product_id))
                                                    <div class="popular__like popularLike active" wire:click.prevent="removeFromWishList({{ $product->product_id }})">
                                                        <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z" stroke-width="2"/>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="popular__like popularLike" wire:click.prevent="addToWishList({{ $product->product_id }},'{{ $product->name }}','{{ $product->store_price }}')">
                                                        <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.45067 10.9082L10.4033 17.4395C10.6428 17.6644 10.7625 17.7769 10.9037 17.8046C10.9673 17.8171 11.0327 17.8171 11.0963 17.8046C11.2375 17.7769 11.3572 17.6644 11.5967 17.4395L18.5493 10.9082C20.5055 9.07059 20.743 6.0466 19.0978 3.92607L18.7885 3.52734C16.8203 0.99058 12.8696 1.41601 11.4867 4.31365C11.2913 4.72296 10.7087 4.72296 10.5133 4.31365C9.13037 1.41601 5.17972 0.990584 3.21154 3.52735L2.90219 3.92607C1.25695 6.0466 1.4945 9.07059 3.45067 10.9082Z" stroke-width="2"/>
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

                                </div>
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

@push('footer')
    <script>        document.querySelector(".major").scrollIntoView({block: "start",behavior: "smooth"});</script>
    <script src="{{asset('js/main.js')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>



@endpush
