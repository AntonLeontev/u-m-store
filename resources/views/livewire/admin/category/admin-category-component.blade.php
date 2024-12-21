
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
{{--                            <p style="margin-bottom: 8px">--}}
{{--                                <strong>--}}
{{--                                    1. Изменения в  условиях ценообразования:--}}
{{--                                </strong>--}}
{{--                            </p>--}}
{{--                            <p style="margin-bottom: 8px">--}}
{{--                                <strong>--}}
{{--                                    1.1 Партнёр устанавливает цену на товар на сайте Onion Market, равную цене указанной на витрине магазина.--}}
{{--                                </strong>--}}
{{--                            </p>--}}
{{--                            <p style="margin-bottom: 8px">--}}
{{--                                <strong>--}}
{{--                                    1.2 Сервисный сбор установленный по условиям сотрудничества взимается от стоимости товара.--}}
{{--                                </strong>--}}
{{--                            </p>--}}

                            @include('livewire.admin.includes.mobile-main-menu')
                            <div class="tovar__add" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                <a href="{{ route('admin.addcategory') }}" style="white-space: nowrap;margin-bottom: 0;">Новая категория</a>
                                <div class="tovar__one" style="min-width:200px;display: flex; justify-content: space-between; align-items: center">
                                    <form id="form-search-top"  class="header__search" wire:ignore>
                                        @csrf
                                        <input type="text" name="search" placeholder="Поиск" wire:model="search">
                                        <button type="submit" class="header__btn" ></button>
                                    </form>
                                </div>
                            </div>
                            @if(session()->has('message'))
                                <div class="alert alert-success" style="margin-bottom: 14px">
                                    <span> {{ session('message') }} </span>
                                </div>
                            @endif
                            <div class="tovar__wrapper">
                                <div class="tovar__item tovar__top">
                                    {{--                                    <div class="tovar__one">Дата</div>--}}
                                    <div class="tovar__one">Название</div>
                                    <div class="tovar__one">Статус</div>
                                    <div class="tovar__one">Действие</div>

                                </div>

                                @if($categories)
                                    @foreach($categories as $category)
                                        <div class="tovar__unit">
                                            <div class="tovar__item">
                                                {{--                                        <div class="tovar__data">{{ $product->created_at }}</div>--}}
                                                <div class="tovar__name">{{ $category->name }}</div>
                                                <div class="tovar__status">
                                                    <select class="form-control" style="{{$category->status ? 'color: green' : 'color: red'}};background: #fff;" wire:change="updateStatus({{$category->id}},$event.target.value)">
                                                        @if ($category->status)
                                                            <option selected value="1" style="color: green">Включен</option>
                                                            <option value="0" style="color: red">Выключен</option>
                                                        @else
                                                            <option  value="1" style="color: green">Включен</option>
                                                            <option  value="0" selected value="0" style="color: red">Выключен</option>

                                                        @endif

                                                    </select>

                                                </div>
                                                <div class="action">
                                                    <a href="{{route('admin.editcategory', ['category_id'=>$category->id])}}" title="Редактировать"><img src="{{ asset('images/edit.svg') }}" alt="edit"></a>
                                                    @if($category->partner_id === Auth::user()->partner_id || Auth::user()->role_id === 1 || Auth::user()->role_id === 3 )
                                                        <div class="tovar__delete" onclick="confirm('Вы уверены что хотите удалить?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCategory({{$category->id}})">
                                                            <img src="{{ asset('images/basket(2).svg') }}" alt="del">
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>



                                            <div class="tovar__mob">
                                                <div class="tovar__one">
                                                    <div class="tovar__info">
                                                        <div class="tovar__row">
                                                            <div class="tovar__naz">Название</div>
                                                            <div class="tovar__name">{{ $category->name }}</div>
                                                        </div>
                                                        <div class="tovar__row">
                                                            <div class="tovar__sum">Сумма</div>
                                                        </div>
                                                        <div class="tovar__row">
                                                            <div class="tovar__pos">Статус</div>
                                                            <div class="tovar__description">
                                                                <select class="form-control" style="{{$category->status ? 'color: green' : 'color: red'}};background: #fff;"  wire:change="updateStatus({{$category->id}},$event.target.value)">
                                                                    @if ($category->status)
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
                                                        <a href="{{route('admin.editcategory', ['category_id'=>$category->id])}}" title="Редактировать"><img src="{{ asset('images/edit.svg') }}" alt="edit"></a>
                                                        @if($category->partner_id === Auth::user()->partner_id)
                                                            <div class="tovar__delete" onclick="confirm('Вы уверены что хотите удалить?') || event.stopImmediatePropagation()" wire:click.prevent="deleteCategory({{$category->id}})">
                                                                <img src="{{ asset('images/basket(2).svg') }}" alt="del">
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="flowers__pagination">
                                        {{ $categories->links('vendor.livewire.custom-pagination') }}
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
