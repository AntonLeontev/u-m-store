@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>Профиль</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Профиль партнера</div>
                    <div class="profile__wrapper">
                      @include('livewire.admin.includes.main-menu')

                        <div class="tovar__inner">
                            <p style="margin-bottom: 8px">
                                <strong>
                                    1. Изменения в  условиях ценообразования:
                                 </strong>
                            </p>
                            <p style="margin-bottom: 8px">
                                <strong>
                                    1.1 Партнёр устанавливает цену на товар на сайте Onion Market, равную цене указанной на витрине магазина.
                                </strong>
                            </p>
                            <p style="margin-bottom: 8px">
                                <strong>
                                    1.2 Сервисный сбор установленный по условиям сотрудничества взимается от стоимости товара.
                                </strong>
                            </p>
                            <p style="margin-bottom: 16px">
                                <strong>
                                    1.3 Партнёр сам несёт ответственность за сопоставление цен сервиса Onion Market и магазина.
                                </strong>
                            </p>

                            @include('livewire.admin.includes.mobile-main-menu')

                                <div class="tovar__add" style="display: flex; justify-content: space-between; align-items: center; width: 100%; margin-bottom: 36px;">
                                    <a href="{{ route('admin.addproduct') }}">Загрузить товар</a>
                                    <form id="form-search-top"  class="header__search" wire:ignore>
                                        @csrf
                                        <input type="text" name="search" placeholder="Поиск" wire:model="search">
                                        <button type="submit" class="header__btn" ></button>
                                    </form>
                                </div>

                            @if(session()->has('message'))
                                <div class="alert alert-success" style="margin-bottom: 14px">
                                    <span> {{ session('message') }} </span>
                                </div>
                            @endif
                            <div class="tovar__wrapper">
                                <div class="tovar__item tovar__top">
                                    <div class="tovar__one"></div>
{{--                                    <div class="tovar__one">Дата</div>--}}
                                    <div class="tovar__one">Название</div>
{{--                                    <div class="tovar__one">Категория</div>--}}
                                    <div class="tovar__one">Цена на сайте, ₽</div>
                                    <div class="tovar__one">Состояние</div>
                                    <div class="tovar__one">Статус</div>
                                    <div class="tovar__one">Действие</div>
                                </div>
                                @if($products)
                                @foreach($products as $product)
                                <div class="tovar__unit">
                                    <div class="tovar__item">
                                        <div class="tovar__image" style="height: 96px;">
                                            <img src="{{asset('storage/'.$product->image)}}" width="80" alt="img">
                                        </div>
{{--                                        <div class="tovar__data">{{ $product->created_at }}</div>--}}
                                        <div class="tovar__name">{{ $product->name }}</div>
{{--                                        <div class="tovar__kategory">{{ $product->direction_id }}</div>--}}
                                        <div class="tovar__price">
                                       <input class="form-control input-md" type="text" value="{{$product->store_price}}" onchange="this.value=this.value.replace(/[^0-9]/g,'')" wire:change.prevent="updatePrice('{{$product->id}}',$event.target.value)" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')"  style="max-width: 75px;">

                                            </div>
                                        <div class="tovar__status"> @if($product->moderated) Опубликован @else На рассмотрении  @endif </div>
                                        <div class="tovar__status">
                                                                                    <select class="form-control" style="{{$product->product_status ? 'color: green' : 'color: red'}};background: #fff;" wire:change="updateStatus({{$product->id}},$event.target.value)">
                                                                                        @if ($product->product_status)
                                                                                                <option selected value="1" style="color: green">Включен</option>
                                                                                                <option value="0" style="color: red">Выключен</option>
                                                                                        @else
                                                                                                <option  value="1" style="color: green">Включен</option>
                                                                                                <option  value="0" selected value="0" style="color: red">Выключен</option>

                                                                                        @endif

                                                                                    </select>

                                        </div>
                                            <div class="action">
                                            <a href="{{route('admin.editproduct', ['product_id'=>$product->product_id])}}" title="Редактировать"><img src="{{ asset('images/edit.svg') }}" alt="edit"></a>
                                                @if($product->partner_id === Auth::user()->partner_id || Auth::user()->role_id === 1 || Auth::user()->role_id === 3 )
                                                 <div class="tovar__delete" onclick="confirm('Вы уверены что хотите удалить?') || event.stopImmediatePropagation()" wire:click.prevent="deleteProduct({{$product->product_id}})">
                                                    <img src="{{ asset('images/basket(2).svg') }}" alt="del">
                                                </div>
                                                @endif
                                            </div>

                                    </div>



                                    <div class="tovar__mob">
                                        <div class="tovar__one">
                                            <div class="tovar__image" style="height: 96px;">
                                                <img src="{{asset('storage/'.$product->image)}}" width="80" alt="img">
                                            </div>
                                            <div class="tovar__info">
{{--                                                <div class="tovar__row">--}}
{{--                                                    <div class="tovar__data">Дата</div>--}}
{{--                                                    <div class="tovar__when">10.06.2021</div>--}}
{{--                                                </div>--}}
{{--                                                <div class="tovar__row">--}}
{{--                                                    <div class="tovar__data">Категория</div>--}}
{{--                                                    <div class="tovar__kategory">Доставка букетов</div>--}}
{{--                                                </div>--}}
                                                <div class="tovar__row">
                                                    <div class="tovar__naz">Название</div>
                                                    <div class="tovar__name">{{ $product->name }}</div>
                                                </div>
                                                <div class="tovar__row">
                                                    <div class="tovar__sum">Сумма</div>
                                                    <div class="tovar__money">
                                                        <input class="form-control input-md" type="text" value="{{$product->store_price}}"  wire:change.prevent="updatePrice({{$product->id}},$event.target.value)" style="max-width: 75px;">
                                                        ₽</div>
                                                </div>
                                                <div class="tovar__row">
                                                    <div class="tovar__pos">Состояние</div>
                                                    <div class="tovar__description">@if($product->moderated) Опубликован @else На рассмотрении  @endif </div>
                                                </div>
                                                <div class="tovar__row">
                                                    <div class="tovar__pos">Статус</div>
                                                    <div class="tovar__description">
                                                        <select class="form-control" style="{{$product->product_status ? 'color: green' : 'color: red'}};background: #fff;"  wire:change="updateStatus({{$product->product_id}},$event.target.value)">
                                                            @if ($product->product_status)
                                                                <option  selected value="1" style="color: green;">Включен</option>
                                                                <option  value="0" style="color: red;">Выключен</option>
                                                            @else
                                                                <option  value="1" style="color: green;">Включен</option>
                                                                <option  value="0" selected style="color: red;">Выключен</option>
                                                            @endif

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="action">
                                                    <a href="{{route('admin.editproduct', ['product_id'=>$product->product_id])}}" title="Редактировать"><img src="{{ asset('images/edit.svg') }}" alt="edit"></a>
                                                    @if($product->partner_id === Auth::user()->partner_id)
                                                    <div class="tovar__delete" onclick="confirm('Вы уверены что хотите удалить?') || event.stopImmediatePropagation()" wire:click.prevent="deleteProduct({{$product->product_id}})">
                                                        <img src="{{ asset('images/basket(2).svg') }}" alt="del">
                                                    </div>
                                                    @endif
                                                </div>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="flowers__pagination">
                                    {{ $products->links('vendor.livewire.custom-pagination') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>



<div class="exiting" id="cardExit">
    <div class="exiting__text">Вы уверены,что хотите выйти?</div>
    <div class="exiting__buttons">
        <div class="exiting__btn" id="exitNo">
            <a href="#">Отмена</a>
        </div>
        <div class="exiting__btn" id="exitYes">
            <a href="#">Да</a>
        </div>
    </div>
    <div class="exiting__close" id="exitClose">
        <img src="images/closeImage.svg" alt="">
    </div>
</div>
