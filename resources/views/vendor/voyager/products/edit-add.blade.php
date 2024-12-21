{{--Edit and Add for Products--}}
@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp
@extends('voyager::master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __(($edit ? 'Редактируем' : 'Добавляем')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')

@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <!-- form start -->
                <form role="form"
                      class="form-edit-add"
                      action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                      method="POST" enctype="multipart/form-data">
                    <div class="panel-footer">
                        @section('submit-buttons')
                            <button type="submit"
                                    class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        @stop
                        @yield('submit-buttons')
                    </div>
                    <!-- PUT Method if we are editing -->
                @if($edit)
                    {{ method_field("PUT") }}
                @endif

                <!-- CSRF TOKEN -->
                    {{ csrf_field() }}

                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    <!-- Adding / Editing -->
                        @php
                            $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                        @endphp

                        @foreach($dataTypeRows as $row)
                        <!-- GET THE DISPLAY OPTIONS -->
                            @php
                                $display_options = $row->details->display ?? NULL;
                                if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                }
                            @endphp
                            @if (isset($row->details->legend) && isset($row->details->legend->text))
                                <legend class="text-{{ $row->details->legend->align ?? 'center' }}"
                                        style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                            @endif

                            <div
                                class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                {{ $row->slugify }}
                                <label class="control-label"
                                       for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                @include('voyager::multilingual.input-hidden-bread-edit-add')
                                @if (isset($row->details->view))
                                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                @elseif ($row->type == 'relationship')
                                    @include('voyager::formfields.relationship', ['options' => $row->details])
                                @else
                                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                @endif

                                @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                    {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                @endforeach
                                @if ($errors->has($row->field))
                                    @foreach ($errors->get($row->field) as $error)
                                        <span class="help-block">{{ $error }}</span>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach

                        <div class="form-group  col-md-12">
                            <label class="control-label" for="name">Количество бонусов</label>
                            <input type="text" class="form-control" name="bonus_qty"
                                   placeholder="Количество бонусов" value="{{$bonus_qty ? $bonus_qty->qty : 0}}">
                        </div>
                        {{--                                Вывод категорий--}}
                        <div class="form-group  col-lg-2 col-md-3">
                            <label class="control-label text-uppercase fw-bold text-success" for="name">Выбор
                                категорий</label>
                            <div>
                                <select class="myselect form-select" size="{{$allCategories->count()}}"
                                        multiple="multiple"
                                        name="categorySelected[]">

                                    @foreach($allCategories as $category)
                                        <option
                                            {{ $categories->contains($category) ? 'selected': ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--                                Вывод фильтров--}}
                        <div class="form-group  col-lg-2 col-md-3">
                            <label class="control-label text-uppercase fw-bold text-success" for="name">Выбор
                                фильтров</label>
                            <div>
                                <select class="myselect form-select" size="{{$allFilters->count()}}"
                                        multiple="multiple"
                                        name="filterSelected[]">

                                    @foreach($allFilters as $filter)
                                        <option
                                            {{ $filters->contains($filter) ? 'selected': ''}} value="{{ $filter->id }}"
                                            @if($filter->parent_id == 0)
                                            class="text-danger text-center text-uppercase"
                                            @endif
                                        >
                                            {{ $filter->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- panel-body -->


                        {{--                                Вывод цен по городам--}}

                                <div class="form-group col-md-12 col-lg-9" id="storesPrice">
                                    @if($product)
                                        @if(isset($products_to_store))
                                    <label class="control-label " for="name">Цены в городах</label>
                                    @php
                                        $last_letter_foreach = '';
                                    @endphp
                                    @foreach($products_to_store as $key => $product_to_store)
                                        @php
                                            $first_latter = mb_substr($product_to_store->real_name, 0,1)
                                        @endphp


                                        @if($first_latter!=$last_letter_foreach)
                                            <div><span class="input-group-text text-danger fs-5 bg-white"
                                                       id="basic-addon1">{{mb_substr($product_to_store->real_name, 0,1)}}</span>
                                            </div>

                                        @endif
                                        <div class="input-group mb-3">
                                            {{--                                            Вывод города--}}
                                            {{--                                            {{dd($product_to_store->partner_id,$product_to_store->store_id)}}--}}
                                            <input type="hidden" class="form-control"
                                                   name="store_id_price[{{$product_to_store->partner_id}}]"
                                                   value="{{$product_to_store->store_id}}" readonly="true">
                                            <input type="text" id="{{$product_to_store->store_id}}" class="form-control"
                                                   name="store_name[{{$product_to_store->store_id}}]"
                                                   id="{{$product_to_store->store_id}}"
                                                   value="{{$product_to_store->real_name}}" readonly="true">
                                            {{--                                            Вывод названия оргинизации--}}

                                            <input type="text" class="form-control"
                                                   name="partner_id_price[{{$product_to_store->partner_id}}]" class=""
                                                   id="{{$product_to_store->partner_id}}" placeholder=""
                                                   {{--                                                   {{dd($allPartners->find($product_to_store->partner_id)->organisation_name)}}--}}
{{--                                                       {{dd($product_to_store->partner_id)}}--}}
{{--                                                       {{dd($product_to_store->partner_id, $product->partner_id)}}--}}

                                                   value="{{$product->partner_id!=0  ? (is_object($allPartners->find($product_to_store->partner_id)) ? $allPartners->find($product_to_store->partner_id)->organisation_name : ''): ''}}"
                                                   readonly="true">
                                            {{--                                            Вывод цены--}}

                                            <input type="text" class="form-control"
                                                   name="partner_price_new[{{$product_to_store->partner_id}}]"
                                                   value="{{$product_to_store->partner_price}} руб."
                                                   onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" size="36">

                                            <input type="text" name="store_price" class="form-control"
                                                   value="{{$product_to_store->store_price}} руб." size="24"
                                                   readonly="true">

                                        </div>
                                        @php
                                            $last_letter_foreach = $first_latter;
                                        @endphp

                                    @endforeach
                                        @endif
                                    @endif
                                </div>

                                <div class="form-group col-md-12 col-lg-9">
                                    {{--                                Вывод городов для для установки цены --}}
                                    <div>
                                        <div class="form-group  col-md-2">
                                            <label class="control-label " for="name">Выберите город</label>
                                            <div>
                                                <select class="form-select" aria-label="Default select example"
                                                        name="selectCity"  id="{{$id}}">
                                                    <option value="-1">Выберите город..</option>
                                                    <option value="0">Все города</option>
                                                    @foreach($allStores as $store)
                                                        <option
                                                           class="stores" value="{{ $store->id }}" {{$store->partner_id == 0 ?'disabled': ''}}>{{ $store->real_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                Вывод названия магазинов партнеров--}}
                                    <div>
                                        <div class="form-group  col-md-2">
                                            <label class="control-label" for="name">Выберите партнера</label>
                                            <div>
                                                <select class="form-select" aria-label="Default select example"
                                                        name="selectPartner">
                                                    <option value="0">Выберите партнера..</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label" for="name"></label>
                                        <a href="#" id="addPrice" class="btn btn-success btn-sm">Добавить</a>
                                    </div>
                                    {{--                                Акордион с инструкцией добавление цен.--}}
                                    <div class="col-lg-12">
                                        <div class="accordion accordion-flush col-lg-6" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapseOne"
                                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Инструкция по внесению цен в города.
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                     aria-labelledby="flush-headingOne"
                                                     data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li><span class="text-success">Добавление цены в город и партнера.</span>
                                                            </li>
                                                            <ul>
                                                                <li>Для начала выберите город.</li>
                                                                <li>После выбора города автоматически подгружаются
                                                                    партнеры в
                                                                    этом городе. Выбираем партнера.
                                                                </li>
                                                                <li>Нажимаем кнопку добавить.</li>
                                                                <li>После добавления появится ввод цены.</li>
                                                                <li>Цена указывается в рублях без наценки.</li>
                                                                <li>Цена с наценкой считается автоматически. Наценка
                                                                    берется из
                                                                    таблицы Партнеры (Partners)
                                                                </li>
                                                            </ul>
                                                            <li><span class="text-danger">Удаление цены в городе.</span>
                                                            </li>
                                                            <ul>
                                                                <li>В поле с ценой удалите значение. Удаление
                                                                    происходит, если
                                                                    поле пустое или равно нулю.
                                                                </li>
                                                                <li>После нажатия кнопки сохранить поля с пустыми
                                                                    значениями
                                                                    будут удалены.
                                                                </li>
                                                            </ul>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        {{--                                Вывод опций в направлении --}}
                        <div class="col-lg-12">
                            @if(Session::get('partner_id')>0)


                                <div>
                                    <div class="form-group col-lg-7 col-md-6" id="optionValueProduct">
                                        <label class="control-label fs-5" for="name">
                                            Опции для города
                                            <span
                                                class="text-info">{{$allStores->where('partner_id',Session::get('partner_id'))->first()->real_name}}</span>
                                            партнер
                                            <span
                                                class="text-info">{{$allPartners->where('id',Session::get('partner_id'))->first()->organisation_name}}</span>
                                        </label>

                                        @foreach($product_option_value as $key => $option)
                                            <div class="input-group input-group-sm mb-3" id="{{$option->id}}">
                                                <input type="text" id="{{$option->option_id}}" class="form-control"
                                                       name="option_id[{{$option->id}}]"
                                                       value="{{$option->option_name}}" readonly="true">

                                                <input type="text" id="{{$option->option_value_id}}"
                                                       class="form-control"
                                                       name="option_value_id[{{$option->id}}]"
                                                       value="{{$option->name}}" readonly="true">

                                                <input type="text" id="" class="form-control"
                                                       name="partner_price[{{$option->id}}]"
                                                       value="{{$option->partner_price}} руб."
                                                       onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')">
                                                <a href="#" id="{{$option->id}}" class="btn btn-danger delOption"
                                                   role="button"
                                                   data-bs-toggle="button">удалить</a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="option col-lg-6 col-md-6 col-sm-9" id="optionOn">
                                        <div class="input-group mb-3 ">
                                            <select class="form-select" id="inputGroupSelect03" name="selectOption"
                                                    aria-label="Example select with button addon">
                                                <option value="0" selected>Выберите опцию...</option>

                                                {{--                                                    Выводим все опции для направления и выделяем те что уже выбраны--}}
                                                @foreach($options as $option)
                                                    <option
                                                        value="{{ $option->id }}">
                                                        {{ $option->option_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <select class="form-select" id="inputGroupSelect" name="selectValue"
                                                    aria-label="Example select with button addon">
                                                <option selected>Выберите значение ...</option>
                                            </select>
                                            <button id="addOption" class="btn btn-outline-secondary btn-success"
                                                    type="button">Добавить
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{--                                Акордион с инструкцией добавление опция--}}
                                <div class="col-lg-12">
                                    <div class="accordion accordion-flush col-lg-4" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Инструкция по добавлению опций
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                 aria-labelledby="flush-headingTwo"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        <li><span class="text-success">Добавление опций к товару.</span>
                                                        </li>
                                                        <ul>
                                                            <li>Для начала выберите опцию.</li>
                                                            <li>После выбора опции автоматически подгружаются возможные
                                                                значения данной опции
                                                            </li>
                                                            <li>Нажимаем кнопку добавить.</li>
                                                            <li>После добавления появится добавление цены для данной
                                                                опции.
                                                            </li>
                                                            <li>Цена указывается в рублях без наценки.</li>
                                                            <li>Цена с наценкой считается автоматически. Наценка берется
                                                                из
                                                                таблицы Партнеры (Partners)
                                                            </li>
                                                        </ul>
                                                        <li><span class="text-danger">Удаление опции.</span></li>
                                                        <ul>
                                                            <li>Нажмите кнопку удалить напротив опции которую нужно
                                                                удалить.
                                                            </li>
                                                            <li>После нажатия кнопки опция будет удалена из базы.</li>
                                                        </ul>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else <p>Партнер не выбран опции не выводятся</p>
                            @endif
                        </div>
                    </div>

                    <!-- panel-body -->
                    <div class="panel-footer col-md-12">
                        @section('submit-buttons')
                            <button type="submit"
                                    class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        @stop
                        @yield('submit-buttons')
                    </div>
                </form>
                <iframe id="form_target" name="form_target" style="display:none"></iframe>
                <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                      enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                    <input name="image" id="upload_file" type="file"
                           onchange="$('#my_form').submit();this.value='';">
                    <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                    {{ csrf_field() }}
                </form>


                <div class="modal fade modal-danger" id="confirm_delete_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;
                                </button>
                                <h4 class="modal-title"><i
                                        class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                                </h4>
                            </div>

                            <div class="modal-body">
                                <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span
                                        class="confirm_delete_name"></span>'
                                </h4>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                                <button type="button" class="btn btn-danger"
                                        id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Delete File Modal -->

                @stop

                @section('javascript')

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                            crossorigin="anonymous"></script>
                    <script src="{{asset('js/voyager_custom.js')}}"></script>
                    <script>
                        var params = {};
                        var $file;

                        function deleteHandler(tag, isMulti) {
                            return function () {
                                $file = $(this).siblings(tag);

                                params = {
                                    slug: '{{ $dataType->slug }}',
                                    filename: $file.data('file-name'),
                                    id: $file.data('id'),
                                    field: $file.parent().data('field-name'),
                                    multi: isMulti,
                                    _token: '{{ csrf_token() }}'
                                }

                                $('.confirm_delete_name').text(params.filename);
                                $('#confirm_delete_modal').modal('show');
                            };
                        }

                        $('document').ready(function () {
                            $('.toggleswitch').bootstrapToggle();

                            //Init datepicker for date fields if data-datepicker attribute defined
                            //or if browser does not handle date inputs
                            $('.form-group input[type=date]').each(function (idx, elt) {
                                if (elt.hasAttribute('data-datepicker')) {
                                    elt.type = 'text';
                                    $(elt).datetimepicker($(elt).data('datepicker'));
                                } else if (elt.type != 'date') {
                                    elt.type = 'text';
                                    $(elt).datetimepicker({
                                        format: 'L',
                                        extraFormats: ['YYYY-MM-DD']
                                    }).datetimepicker($(elt).data('datepicker'));
                                }
                            });

                            @if ($isModelTranslatable)
                            $('.side-body').multilingual({"editing": true});
                            @endif

                            $('.side-body input[data-slug-origin]').each(function (i, el) {
                                $(el).slugify();
                            });

                            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
                            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
                            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
                            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

                            $('#confirm_delete').on('click', function () {
                                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                                    if (response
                                        && response.data
                                        && response.data.status
                                        && response.data.status == 200) {

                                        toastr.success(response.data.message);
                                        $file.parent().fadeOut(300, function () {
                                            $(this).remove();
                                        })
                                    } else {
                                        toastr.error("Error removing file.");
                                    }
                                });

                                $('#confirm_delete_modal').modal('hide');
                            });
                            $('[data-toggle="tooltip"]').tooltip();
                        });

                    </script>

@stop
