@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .alert-update {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            z-index: 9999;
            border-radius: 0px;
            text-align: center;
        }

        .input__color {
            width: 25px;
            height: 25px;
            border-color: black;
            color: black;
            background-color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        input[type="color"]::-webkit-color-swatch {
            border: none;
            border-radius: 30px;
        }
    </style>
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <a href="#" class="major__btn-prev"></a>
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{route('admin.dashboard')}}">Профиль</a></li>
                            <li><span>Настройки сайта</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Настройка верхнего слайдера</div>
                    <div class="profile__wrapper">
                        @include('livewire.admin.includes.main-menu')
                        <div class="set__inner">
                            @include('livewire.admin.includes.mobile-main-menu')
                            @if($uploaded_banners)
                                <div class="set__one">
                                    <div class="set__step">Загруженные изображения слайдеров:</div>
                                    <div class="set__form" style="max-width: 550px; width: 100%" wire:ignore.self>
                                        <form enctype="multipart/form-data" wire:submit.prevent="saveAllBanners">
                                            {{--                                            Вывод загруженных слайдеров--}}
                                            @foreach($uploaded_banners as $key=>$uploaded_banner)
                                                {{-- Загрузка баннеров. --}}
                                                <div wire:key="uploaded_banner-field-{{ $uploaded_banner->id }}">
                                                    <div class="set__pos">
                                                        Изображение для баннера {{$key+1}}:<span
                                                            class="label__partner"></span>
                                                    </div>
                                                    <div>

                                                        <img class="mb-3 logo"
                                                             src="{{asset('storage/'.$uploaded_banners[$key]->image)}}"
                                                             alt="logo"
                                                             width="500"
                                                             style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 8px;">

                                                        @error('uploaded_banners.*.banner_image') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                        <input type="text"
                                                               wire:model.deounce.800ms="uploaded_banners.{{$key}}.text_slider"
                                                               style="color: {{$uploaded_banners[$key]->color_text_slider}}">
                                                        <div>
                                                            {{-- Цвет текста на беннере--}}
                                                            <input class="input__color" type="color" id="head"
                                                                   name="head"
                                                                   wire:model="uploaded_banners.{{$key}}.color_text_slider"
                                                                   style="width: 25px; padding: 1px; border: none; margin-top: 10px;">
                                                            <label for="head">Цвет текста</label>
                                                        </div>
                                                        {{--                                                        <input type="color" value="#ffffff" >--}}
                                                        @error('uploaded_banners.*.text_slider') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                        <div class="mb-2 set__pos">Текст на кнопке:</div>
                                                        <input type="text"
                                                               wire:model.deounce.800ms="uploaded_banners.{{$key}}.text_button"
                                                               placeholder="Купить" maxlength="20"
                                                               style="color: {{$uploaded_banners[$key]->color_text_button}}; background: {{$uploaded_banners[$key]->color_button}}">
                                                        {{--                                                        Цвет текста --}}
                                                        <input class="input__color" type="color" id="head" name="head"
                                                               wire:model="uploaded_banners.{{$key}}.color_text_button"
                                                               style="width: 25px; padding: 1px; border: none; margin-top: 10px;">
                                                        <label for="head">Цвет текста</label>
                                                        <input class="input__color" type="color" id="head" name="head"
                                                               wire:model="uploaded_banners.{{$key}}.color_button"
                                                               style="width: 25px; padding: 1px; border: none; margin-top: 10px;">
                                                        <label for="head">Цвет кнопки</label>
                                                        @error('uploaded_banners.*.text_button') <span
                                                            class="error">{{ $message }}</span> @enderror

                                                        <div class="mb-2 set__pos">Ссылка на кнопке:</div>
                                                        <input type="text"
                                                               wire:model.deounce.800ms="uploaded_banners.{{$key}}.url"
                                                               placeholder="https://ourlink.com/" maxlength="200">
                                                        @error('uploaded_banners.*.url') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                        <div class="mb-2 set__pos">Порядок сортировки</div>
                                                        <input type="number"
                                                               wire:model.deounce.800ms="uploaded_banners.{{$key}}.sort"
                                                               placeholder="Цифра от 1 до 10" maxlength="3">
                                                        @error('uploaded_banners.*.sort') <span
                                                            class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="reg__flex">
                                                        {{--                                                        <button--}}
                                                        {{--                                                            style="display: block; margin-left: auto; margin-right: auto;"--}}
                                                        {{--                                                            type="submit">Сохранить--}}
                                                        {{--                                                        </button>--}}

                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                        wire:click.prevent="deleteBanner({{$key}})">Удалить
                                                </button>
                                            @endforeach
                                            @if(session()->has('success'))

                                                <div class="alert-success alert-update">
                                                    <span>Данные успешно сохранены.</span>
                                                </div>

                                            @endif
                                        </form>
                                    </div>
                                </div>


                            @endif
{{--                            @if(session()->has('site_info_id') and (count($uploaded_banners)<4))--}}
                                <div class="set__one">
                                    <div class="set__step">Загрузите изображения слайдеров (1380Х365):</div>
                                    <div class="set__form" style="max-width: 550px; width: 100%">
                                        <form enctype="multipart/form-data" wire:submit.prevent="saveSliderSettings">
                                            @csrf
                                            {{-- Загрузка баннеров. --}}
                                            <div class="set__pos">
                                                Изображение для баннера:<span class="label__partner"></span></div>
                                            <div>
                                                @if(isset($banner_image) and is_object($banner_image))
                                                    <img class="mb-3 logo" src="{{ $banner_image->temporaryUrl() }}"
                                                         alt="logo"
                                                         width="500"
                                                         style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 8px;">

                                                    <div class="mb-2 set__pos">Текст на слайдере:</div>
                                                    <input type="text" wire:model="text_slider"
                                                           placeholder="До 32 символов." maxlength="32"
                                                           style="color: {{$color_text_slider}}">
                                                    {{-- Цвет текста на беннере--}}
                                                    <input class="input__color" type="color" id="head" name="head"
                                                           wire:model="color_text_slider"
                                                           style="width: 25px; padding: 1px; border: none; margin-top: 10px;">
                                                    <label for="head">Цвет текста</label>

                                                    @error('text_slider') <span
                                                        class="error">{{ $message }}</span> @enderror
                                                    <div class="mb-2 set__pos">Текст на кнопке:</div>
                                                    <input type="text" wire:model="text_button"
                                                           placeholder="Купить" maxlength="20"
                                                           style="color: {{$color_text_button}}; background: {{$color_button}}">
                                                    {{-- Цвет текста на беннере--}}
                                                    <input class="input__color" type="color" id="head" name="head"
                                                           wire:model="color_text_button"
                                                           style="width: 25px; padding: 1px; border: none; margin-top: 10px;">
                                                    <label for="head">Цвет текста</label>
                                                    {{--Цывет кнопки--}}
                                                    <input class="input__color" type="color" id="head" name="head"
                                                           wire:model="color_button"
                                                           style="width: 25px; padding: 1px; border: none; margin-top: 10px;">
                                                    <label for="head">Цвет кнопки</label>

                                                    @error('text_button') <span
                                                        class="error">{{ $message }}</span> @enderror
                                                    <div class="mb-2 set__pos">Ссылка на кнопке:</div>
                                                    <input type="text" wire:model="url"
                                                           placeholder="https://ourlink.com/" maxlength="200">
                                                    @error('url') <span class="error">{{ $message }}</span> @enderror
                                                    <div class="mb-2 set__pos">Порядок сортировки</div>
                                                    <input type="number" wire:model="sort"
                                                           placeholder="Цифра от 1 до 10" maxlength="3">
                                                    @error('sort') <span class="error">{{ $message }}</span> @enderror
                                                @endif
                                            </div>


                                            <input id="banner_image" type="file" wire:model="banner_image"
                                                   name="files">
                                            <div>
                                                @error('banner_image') <span
                                                    class="error">{{ $message }}</span> @enderror
                                            </div>


                                            <div class="reg__flex">
                                                <button style="display: block; margin-left: auto; margin-right: auto;"
                                                        type="submit">Сохранить
                                                </button>
                                            </div>

                                        </form>
                                        @if(session()->has('success_load'))
                                            <div class="alert-success" style="max-width: 550px; margin-top: 15px;">
                                                <span>Данные успешно сохранены.</span>
                                            </div>
                                        @elseif(session()->has('error'))
                                            <div class="alert-danger" style="max-width: 550px; margin-top: 15px;">
                                                <span>Ошибка сохранения данных.</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
{{--                            @else--}}
                                <div class="set__one">
                                    <div class="set__step">Можно загрузить 3 слайдера после добавления информации о
                                        сайте.
                                    </div>

                                </div>
{{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('footer')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}">
    </script>
    <script>
        $(document).ready(function () {
            window.livewire.on('alert_remove', () => {
                setTimeout(function () {
                    $(".alert-success").fadeOut('fast');
                }, 1500); // 3 secs
            });
            window.livewire.on('uploaded_banner_remove', () => {
                setTimeout(function () {
                    $(".alert-success").fadeOut('fast');
                }, 1500); // 3 secs
            });
        });
    </script>
    {{--    <script>--}}
    {{--        // document.addEventListener('livewire-upload-start', function () {--}}
    {{--        //     let inputFile = document.getElementById('banner_image').files;--}}
    {{--        //     fileListArr = Array.from(inputFile)--}}
    {{--        //     if (inputFile.length > 3) {--}}
    {{--        //         inputFile.length = 3;--}}
    {{--        //     }--}}
    {{--        //     console.log(inputFile)--}}
    {{--        //--}}
    {{--        //--}}
    {{--        //     // Run a callback when an event ("foo") is emitted from this component--}}
    {{--        //--}}
    {{--        // })--}}

    {{--    </script>--}}

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

@endpush

