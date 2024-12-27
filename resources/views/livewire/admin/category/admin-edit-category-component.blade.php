@push('head')
    <link rel="stylesheet" href="/css/download-product.css">
@endpush

<div class="container" style="padding: 30px 0;">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">

                    <a href="{{route('admin.categories')}}" class="profile__title pull-right" style="display: flex;align-items: center;color: #3657C8;">
                        <div class="download-product__prev" style="margin-right: 14px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 12L3 12" stroke="#3657C8" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M9 6L3 12L9 18" stroke="#3657C8" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                        </div>
                        Все категории
                    </a>


                </div>
            </div>
            <div class="panel-body">
                @if(Session::has('message'))
                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                @endif
                <form class="form-horizontal" wire:submit.prevent="storeCategory">
                    @csrf
                    <div class="download-product__form-group">
                        <label for="parent-category" >Название</label>
                        <input type="text" placeholder="Имя категории" class="download-product__form-input form-control input-md" wire:model="name" required>
                    </div>
                    <div class="download-product__form-group">
                        <label for="description" >SEO описание</label>
                        <textarea id="seo-description" type="text" placeholder="SEO description"  class="download-product__form-input form-control input-md" wire:model="seo_text"> </textarea>
                    </div>
{{--                    <div class="download-product__form-group">--}}
{{--                        <input type="text" placeholder="Мета-тег Title" class="download-product__form-input form-control input-md" wire:model="slug">--}}
{{--                    </div>--}}
                    <div class="download-product__form-group">
                        <label for="parent-category" >Родительская категория</label>

                        <select id="parent-category" placeholder="Родительская категория" style="color: #0a0302" class="download-product__form-input download-product__text-grey" wire:change="updateParentCategory($event.target.value)" >
                            <option value="0" @if($parent_id == 0)selected @endif>Отсутствует</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"  @if($parent_id == $category->id) selected @endif >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(Session::has('domain'))
                        <div class="download-product__form-group">
                            <label for="parent-category" >Показать в главном меню</label>
                            <span class="download-product__select js-download-product-select">
                                    <select placeholder="Статус" class="download-product__form-input download-product__text-grey" wire:change="updateMenuStatus($event.target.value)" style="color: #000000" >
                                         @if($in_menu)
                                            <option value="1" selected="true">Да</option>
                                            <option value="0" >Нет</option>
                                        @else
                                            <option value="1" >Да</option>
                                            <option value="0" selected="true">Нет</option>
                                        @endif
                                    </select>
                                </span>
                        </div>
                    @endif
                    <div class="download-product__form-group">
                                <span class="download-product__select js-download-product-select">

                                    <select placeholder="Статус" class="download-product__form-input download-product__text-grey" wire:change="updateStatus($event.target.value)" style="{{$status ? 'color: green' : 'color: red'}}" >
                                    @if ($status)
                                        <option selected value="1" style="color: green">Активна</option>
                                         <option value="0" style="color: red">Выключена</option>
                                        @else
                                            <option value="1" style="color: green">Активна</option>
                                            <option value="0" selected style="color: red">Выключена</option>
                                        @endif
                                    </select>

{{--                            <select class="form-control" style="{{$product->product_status ? 'color: green' : 'color: red'}};background: #fff;" wire:change="updateStatus({{$product->id}},$event.target.value)">--}}
{{--                        @if ($product->product_status)--}}
{{--                                    <option selected value="1" style="color: green">Включен</option>--}}
{{--                                    <option value="0" style="color: red">Выключен</option>--}}
{{--                                @else--}}
{{--                                    <option  value="1" style="color: green">Включен</option>--}}
{{--                                    <option  value="0" selected value="0" style="color: red">Выключен</option>--}}

{{--                                @endif--}}

{{--                        </select>--}}

{{--                                    <span class="download-product__arrow" style="top: 16px">--}}
{{--                                        <img src="https://umclone.pp.ua/images/timeArrow.svg"--}}
{{--                                             alt="time">--}}
{{--                                    </span>--}}
{{--                                </span>--}}
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <button type="submit" class="download-product__btn">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


