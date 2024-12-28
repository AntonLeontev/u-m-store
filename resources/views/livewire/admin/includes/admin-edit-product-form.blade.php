
<div class="download-product">

    <form class="download-product__form is-visible js-tab-item" id="tab-files" wire:ignore.self wire:submit.prevent="updateImages">

        @if(Session::has('update_image'))
            <p class="alert" style="color:green">{{ Session::get('update_image') }}</p>
        @endif

        <input class="download-product__file" wire:model="additional_images" multiple type="file"
               accept=".jpg, .jpeg, .png" id="file-add-image-uploader">

        <div class="download-product__file-grid">

            <!-- скрываем, если есть добавленные изображения -->
            @if($need_uploader)
            <label for="file-add-image-uploader" class="download-product__label">
                <span class="plug">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.66664 1.66664H18.3333V9.16664C18.3333 9.625 18.7083 10 19.1666 10H26.6666V15.8334H28.3333V9.16672C28.3333 9.08336 28.3083 9.00008 28.2833 8.91672C28.2749 8.89172 28.2749 8.87508 28.2666 8.85008C28.225 8.74172 28.1583 8.65008 28.075 8.56672L19.7584 0.241641C19.6 0.0916406 19.3916 0 19.1666 0H0.833359C0.375 0 0 0.375 0 0.833359V35.8334C0 36.2917 0.375 36.6667 0.833359 36.6667H17.5V35H1.66664V1.66664ZM20 2.85L25.4834 8.33336H20V2.85Z"
                            fill="#828282" />
                        <path
                            d="M29.1673 18.332C23.184 18.332 18.334 23.182 18.334 29.1654C18.334 35.1487 23.1841 39.9987 29.1673 39.9987C35.1506 39.9987 40.0007 35.1487 40.0007 29.1653C39.9923 23.182 35.1507 18.3403 29.1673 18.332ZM29.1673 38.332C24.1007 38.332 20.0007 34.232 20.0007 29.1653C20.0007 24.0986 24.1007 19.9987 29.1673 19.9987C34.234 19.9987 38.334 24.0987 38.334 29.1653C38.3257 34.2237 34.2257 38.3237 29.1673 38.332Z"
                            fill="#828282" />
                        <path
                            d="M32.2495 29.4653L29.9995 31.7153V24.6403C29.9995 24.2237 29.6995 23.8487 29.2912 23.7903C28.7745 23.7153 28.3328 24.1153 28.3328 24.6153V31.6987L26.0995 29.4653C25.7745 29.1403 25.2411 29.1403 24.9078 29.4653C24.5828 29.7903 24.5828 30.3237 24.9078 30.657L28.5745 34.3236C28.8995 34.6486 29.4328 34.6486 29.7661 34.3236L33.4327 30.657C33.7577 30.3236 33.7494 29.7903 33.4161 29.4653C33.0912 29.1487 32.5745 29.1487 32.2495 29.4653Z"
                            fill="#828282" />
                    </svg>
                    Загрузить фото
                </span>
            </label>
            @endif

            <!-- вывод новодобавленных изображений -->
            @if ($images)
                @foreach($images as $key => $image)
                        <!-- не выводим удаленные изображения -->
                        @if($image['url'] != '')
                            <div class="download-product__file-item">

                                    @if(!is_string($image['url']))
                                        <!-- новые временно загруженные фото -->
                                        <img class="download-product__file-img" src="{{ $image['url']->temporaryUrl() }}" alt="img_2.jpg">
                                    @else
                                        <!-- фотографии из базы -->
                                        <img class="download-product__file-img" src="{{ $image['url'] }}" alt="img_2.jpg">
                                    @endif

                                    <!-- изменить фото -->
                                    <input class="download-product__file" wire:model="images.{{ $key }}.url"  type="file" accept=".jpg, .jpeg, .png" id="file-edit-image-uploader-{{$key}}">
                                    <label for="file-edit-image-uploader-{{$key}}"><span class="download-product__file-setting"></span></label>
                                     <!-- удалить фото -->
                                    <div class="download-product__file-del" wire:click="deleteImage('{{$key}}')">
                                </div>

                            </div>
                        @endif
                @endforeach
            @endif

            <!-- добавить еще фотографий -->
            @if($images && count($images) < 10)
                <label for="file-add-image-uploader">
                    <span class="download-product__label-btn">+ Добавить еще фотографий</span>
                </label>
            @endif

            <!-- вывод ошибок валидации -->
            @error('images') <span class="error">{{ $message }}</span> @enderror
            @error('images.*') <span class="error">{{ $message }}</span> @enderror

        </div>
        <div>
            <button class="download-product__btn js-tab-item btn-mr" type="submit">Сохранить</button>
            <button class="download-product__btn download-product__btn--color js-next-btn">Продолжить</button>
        </div>
    </form>

    <form class="download-product__form js-tab-item" id="tab-info" wire:ignore.self wire:submit.prevent="updateDescription">

        @if(Session::has('update_description'))
            <p class="alert" style="color:green">{{ Session::get('update_description') }}</p>
        @endif

        <!-- фильры товара -->
        @if(!empty($filters))
            <div class="download-product__form-group">
                <!-- вывод ошибок валидации -->
                @error('max_checked_filters') <span class="error">{{ $message }}</span> @enderror
                <div class="selectBox js-download-product-select">
                    <select class="download-product__form-input">
                        @if(count($filters) > 0)
                            <option>Выберите фильтры</option>
                        @else
                            <option>Для вашего партнера нет фильтров</option>
                        @endif
                    </select>
                    <span class="download-product__arrow">
                         <img src="/images/timeArrow.svg" alt="time">
                    </span>
                    <div class="overSelect"></div>
                </div>
                @if(count($filters) > 0)
                    <div class="download-product__um-checkboxes" wire:ignore.self id="checkboxes">
                            @foreach($filters as $key => $filter)
                                <label class="download-product__label-check"><input wire:model.defer="filters.{{$key}}.checked" type="checkbox">{{$filter['value']}}</label>
                            @endforeach
                    </div>
                @endif

            </div>
        @endif

        <!-- категории товара -->
        @if(!empty($categories))
            <div class="download-product__form-group">
                <!-- вывод ошибок валидации -->
                @error('max_checked_categories') <span class="error">{{ $message }}</span> @enderror
                <div class="selectBox js-download-product-select">
                    <select class="download-product__form-input">
                        @if(count($categories) > 0)
                            <option>Выберите категорию</option>
                        @else
                            <option>Для вашего партнера нет категорий</option>
                        @endif
                    </select>
                    <div class="overSelect"></div>
                    <span class="download-product__arrow">
                         <img src="/images/timeArrow.svg" alt="time">
                    </span>
                </div>
                @if(count($categories) > 0)
                    <div class="download-product__um-checkboxes" wire:ignore.self id="checkboxes">
                        @foreach($categories as $key => $category)
                            <label> <input wire:model.defer="categories.{{$key}}.checked" type="checkbox">{{$category['value']}}</label>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        @if(!empty($add_categories))
            @for ($key = 0; $key < count($add_categories); $key++)
                <div class="download-product__form-group">
                    <input type="text" wire:model="add_categories.{{$key}}.value" placeholder="Название новой категории" class="download-product__form-input">
                </div>
            @endfor
        @endif

{{--        @if(count($add_categories) < 3)--}}
{{--            <div class="download-product__form-group">--}}
{{--                <a href="#" class="download-product__add" wire:click.prevent="addCategory">+ Добавить новую категорию</a>--}}
{{--            </div>--}}
{{--        @endif--}}

        <!-- название товара -->
        <div class="download-product__form-group">
            <input type="text" wire:model.lazy='name' placeholder="Название товара" class="download-product__form-input">
            <!-- вывод ошибок валидации -->
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- описание товара -->

        <div class="download-product__form-group" >
            <textarea class="download-product__textarea"  wire:model.lazy='description'  placeholder="Описание товара"></textarea>
            <!-- вывод ошибок валидации -->
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- состав товара -->
        <div class="download-product__form-group">
            <button wire:ignore.self class="download-product__acc-btn js-acc-action is-active">Состав</button>
            <div wire:ignore.self class="download-product__content is-visible">
                <div class="download-product__form-label">
                    Состав. Впишите в поля составляющие товары и укажите их количество
                </div>
                @if(!empty($compounds))
                    @foreach($compounds as $key => $compound)
                        <div class="download-product__form-group">
                            <div class="download-product__counter-wrapper">
                                <input type="text" placeholder="Составляющее {{$key}}"
                                       class="download-product__form-input" wire:model="compounds.{{$key}}.value">
                                <div class="download-product__counter">
                                    <button class="download-product__counter-btn" wire:click.prevent="changeCmpNum({{$key}}, 'dec')">
                                        <svg width="14" height="2" viewBox="0 0 14 2"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0.75" y1="1.25" x2="13.25" y2="1.25"
                                                  stroke="#BFC6E0" stroke-width="1.5"
                                                  stroke-linecap="round" />
                                        </svg>
                                    </button>
                                    <input type="text" class="download-product__input-number" wire:model="compounds.{{$key}}.number"
                                           value="0">
                                    <button class="download-product__counter-btn" wire:click.prevent="changeCmpNum({{$key}}, 'inc')">
                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="0.75" y1="6.66406" x2="13.25" y2="6.66406"
                                                  stroke="white" stroke-width="1.5"
                                                  stroke-linecap="round" />
                                            <line x1="7.33789" y1="0.75" x2="7.33789" y2="13.25"
                                                  stroke="white" stroke-width="1.5"
                                                  stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @error("compounds.$key.value") <span class="error">{{ $message }}</span><br> @enderror
                            @error("compounds.$key.number") <span class="error">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                @else
                    <div class="download-product__form-group">
                        <p class="download-product__um-label p-mrt">У товара не указан ни один состав</p>
                    </div>
                @endif

                <div class="download-product__form-group">
                    <button class="download-product__add" wire:click.prevent="addCompound">+ Добавить поле</button>
                </div>
            </div>
        </div>

        <!-- параметры товара -->
        <div class="download-product__form-group">
            <button wire:ignore.self class="download-product__acc-btn js-acc-action">Параметры</button>

            <div wire:ignore.self class="download-product__content">
                <div class="download-product__form-label mb">
                    Состав. Впишите в поля составляющие товары и укажите их
                    количество
                </div>

                <div class="download-product__form-group">
                    <label for="um-1" class="download-product__um-label">Высота, см</label>
                    <input type="number" placeholder="Высота, см" id="um-1" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"  wire:model.defer="parameters.height"
                           class="download-product__form-input">
                </div>
                <div class="download-product__form-group">
                    <label for="um-2" class="download-product__um-label">Ширина, см</label>
                    <input type="number" id="um-2" placeholder="Ширина, см"
                           class="download-product__form-input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"  wire:model.defer="parameters.width">
                </div>
                <div class="download-product__form-group">
                    <label for="um-3" class="download-product__um-label">Глубина, см</label>
                    <input type="number" id="um-3" placeholder="Глубина, см"
                           class="download-product__form-input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"  wire:model.defer="parameters.depth">
                </div>
                <div class="download-product__form-group">
                    <label for="um-4" class="download-product__um-label">Вес, кг</label>
                    <input type="number" id="um-4" placeholder="Вес, кг"
                           class="download-product__form-input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"  wire:model.defer="parameters.weight">
                </div>
                <div class="download-product__form-group">
                    <label for="um-5" class="download-product__um-label">объем, л</label>
                    <input type="number" id="um-5" placeholder="объем, л"
                           class="download-product__form-input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"  wire:model.defer="parameters.volume">
                </div>
                <div class="download-product__form-group">
                    <label for="um-6" class="download-product__um-label">гарантия, месяцев</label>
                    <input type="number" id="um-6" placeholder="гарантия, месяцев"
                           class="download-product__form-input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"  wire:model.defer="parameters.warranty">
                </div>
                <div class="download-product__form-group">
                    <label for="um-7" class="download-product__um-label">модель</label>
                    <input type="text" id="um-7" placeholder="модель"
                           class="download-product__form-input" wire:model.defer="parameters.model">
                </div>
            </div>
        </div>

        <!-- технические характеристики -->
        <div class="download-product__form-group">
            <button wire:ignore.self class="download-product__acc-btn js-acc-action ta-l">Технические
                характеристики</button>

            <div wire:ignore.self class="download-product__content">

                @if($this->specifications)
                    @foreach($this->specifications as $key => $specification)
                        <div class="download-product__form-group">
                            <input type="text" class="download-product__form-input" wire:model="specifications.{{$key}}.value">
                            @error("specifications.$key.value") <span class="error">{{ $message }}</span><br> @enderror
                            @error("specifications.$key.max") <span class="error">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                @else
                    <div class="download-product__form-group">
                        <p class="download-product__um-label">У товара не указаны тех.характеристики</p>
                    </div>
                @endif
                    <div class="download-product__form-group">
                        <button class="download-product__add" wire:click.prevent="addSpecification">+ Добавить поле</button>
                    </div>
            </div>
        </div>

        <!-- материалы -->
        <div wire:ignore.self class="download-product__form-group">
            <button class="download-product__acc-btn js-acc-action">Материалы</button>

            <div wire:ignore.self class="download-product__content">
                @if($materials)
                    @foreach($materials as $key => $material)
                        <div class="download-product__form-group">
                            <input type="text" class="download-product__form-input" wire:model="materials.{{$key}}.value">
                            @error("materials.$key.value") <span class="error">{{ $message }}</span><br> @enderror
                            @error("materials.$key.max") <span class="error">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                @else
                    <div class="download-product__form-group">
                        <p class="download-product__um-label">У товара нет материалов</p>
                    </div>
                @endif
                <!-- Добавил блок 30.05.22-->
                    <div class="download-product__form-group">
                        <button class="download-product__add" wire:click.prevent="addMaterial">+ Добавить поле</button>
                    </div>
                <!-- конец блока -->
            </div>
        </div>

        <!-- дополнительная информация -->
        <div wire:ignore.self class="download-product__form-group">
            <button class="download-product__acc-btn js-acc-action ta-l">Дополнительная
                информация</button>

            <div wire:ignore.self class="download-product__content">
                {{-- <div class="download-product__form-group mb2">
                    <label for="um-8" class="download-product__um-label">Вес, кг</label>
                    <input type="number" id="um-8" placeholder="Вес, кг"
                           class="download-product__form-input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model.defer="additional_info.weight">
                </div>
                <div class="download-product__form-group">
                    <label for="um-9" class="download-product__um-label">Вид</label>
                    <input type="text" id="um-9" placeholder="Вид"
                           class="download-product__form-input" wire:model="additional_info.type">
                </div>
                <div class="download-product__form-group">
                    <label for="um-10" class="download-product__um-label">Глубина, см</label>
                    <input type="number" id="um-10" placeholder="Глубина, см"
                           class="download-product__form-input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model.defer="additional_info.depth">
                </div>
                <div class="download-product__form-group">
                    <label for="um-11" class="download-product__um-label">Высота, см</label>
                    <input type="number" id="um-11" placeholder="Высота, см"
                           class="download-product__form-input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model.defer="additional_info.height">
                </div>
                <div class="download-product__form-group">
                    <label for="um-12" class="download-product__um-label">Диаметр, см</label>
                    <input type="number" id="um-12" placeholder="Диаметр, см"
                           class="download-product__form-input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model.defer="additional_info.diameter">
                </div> --}}
                <div class="download-product__form-group">
                    <label for="um-13" class="download-product__um-label">Особенности</label>
                    <input type="text" id="um-13" placeholder="Особенности"
                           class="download-product__form-input" wire:model="additional_info.peculiarities">
                </div>
                <div class="download-product__form-group">
                    <label for="um-14" class="download-product__um-label">Возрастное ограничение</label>
                    <input type="number" id="um-14" placeholder="Возрастное ограничение"
                           class="download-product__form-input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model.defer="additional_info.age_limit">
                </div>
                <div class="download-product__form-group">
                    <label for="um-15" class="download-product__um-label">Количество элементов</label>
                    <input type="number" id="um-15" placeholder="Количество элементов"
                           class="download-product__form-input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model.defer="additional_info.number_elements">
                </div>
                <div class="download-product__form-group">
                    <label for="um-16" class="download-product__um-label">Назначение</label>
                    <input type="text" id="um-16" placeholder="Назначение"
                           class="download-product__form-input" wire:model.defer="additional_info.appointment">
                </div>
                <div class="download-product__form-group">
                    <label for="um-17" class="download-product__um-label">Вкус</label>
                    <input type="text" id="um-17" placeholder="Вкус"
                           class="download-product__form-input" wire:model.defer="additional_info.taste">
                </div>
                <div class="download-product__form-group">
                    <label for="um-18" class="download-product__um-label">Срок годности</label>
                    <input type="text" id="um-18" placeholder="Срок годности"
                           class="download-product__form-input" wire:model.defer="additional_info.shelf_life">
                </div>
                <div class="download-product__form-group">
                    <label for="um-19" class="download-product__um-label">Упаковка</label>
                    <input type="text" id="um-19" placeholder="Упаковка"
                           class="download-product__form-input" wire:model.defer="additional_info.package">
                </div>
                <div class="download-product__form-group">
                    <label for="um-20" class="download-product__um-label">Комплектация</label>
                    <input type="text" id="um-20" placeholder="Комплектация"
                           class="download-product__form-input" wire:model.defer="additional_info.equipment">
                </div>

                @if($more_additional_info)
                    @foreach($more_additional_info as $key => $more_additional)
                        <div class="download-product__form-group">
                            <input type="text" placeholder="Дополнительная информация о товаре"
                                   class="download-product__form-input" wire:model="more_additional_info.{{$key}}.value">
                        </div>
                    @endforeach
                @endif

                {{-- <div class="download-product__form-group">
                    <button class="download-product__add" wire:click.prevent="addMoreInfo">+ Добавить поле</button>
                </div> --}}

                <div class="download-product__form-group">

                    {{-- <h3 class="download-product__um-title">Цвет</h3>

                    <div class="download-product__form-label">
                        Выберете цвет товара
                    </div>

                    <div class="download-product__radio-wrapper">
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" checked value="red"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #FF0000;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="white"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #FFFFFF; border: 1px solid #BFC6E0"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="pink"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #FF92D3;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="green"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #4CD964;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="yellow"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #FFD600;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="burgundy"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #AB0000;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="dark_blue"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #6803B8;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="dark_green"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #228300;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="orange"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #FF6C01;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="something"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #AD7BFF;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="pomade"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #EC126E;"></span>
                        </div>
                        <div class="download-product__radio-item">
                            <input type="radio" name="product_color" value="dark_blue"
                                   class="download-product__form-radio" wire:model.defer="additional_info.color">
                            <span class="download-product__radio-bg"
                                  style="background-color: #3657C8;"></span>
                        </div>

                        <!-- Добавил блок 30.05.22-->
                        <label class="download-product__um-color">
                            <span class="download-product__um-color-text">Добавить цвет</span>
                            <span class="download-product__um-color-pluse">
                                <i class="icon-um-pluse3"></i>
                            </span>
                            <input class="download-product__um-color-input" wire:model.defer="additional_info.color_hex" type="color">
                        </label>
                        <!-- конец блока -->
                    </div> --}}

                    <!-- Добавил блок 30.05.22-->

                    <div class="download-product__form-group">
                        <h3 class="download-product__um-title">Бренд</h3>
                        <!-- добавить поля -->
                        <input type="text" placeholder="Бренд"
                               class="download-product__form-input" wire:model.defer="additional_info.brand">
                    </div>

                    <div class="download-product__form-group">
                        <h3 class="download-product__um-title">Страна производитель</h3>
                        <input type="text" placeholder="Страна производитель"
                               class="download-product__form-input" wire:model.defer="additional_info.producing_country">
                    </div>

                    <div class="download-product__form-group">
                        <h3 class="download-product__um-title">Артикул</h3>
                        <!-- добавить поля -->
                        <input type="text" placeholder="Артикул"
                               class="download-product__form-input"wire:model.defer="additional_info.vendor_code">
                    </div>

                    <!-- конец блока -->

                </div>
                <div class="download-product__form-group">
                    <h3 class="download-product__um-title">Видео</h3>
                </div>
                @if($additional_videos)
                    @foreach($additional_videos as $key => $video_link)
                        <div class="download-product__form-group">
                            <input type="text" placeholder="Ссылка на видео товара" class="download-product__form-input" wire:model="additional_videos.{{$key}}.value">
                            <!-- вывод ошибок валидации -->
                            @error("additional_videos.$key.value") <span class="error">{{ $message }}</span> @enderror
                        </div>
                    @endforeach
                @else
                    <div class="download-product__form-group">
                        <p class="download-product__um-label">Для товара не указаны видео</p>
                    </div>
                @endif
                <!-- вывод ошибок валидации -->
{{--                @error('additional_videos') <span class="error">{{ $message }}</span> @enderror--}}
                @if(count($additional_videos) < 3)
                    <div class="download-product__form-group">
                        <button class="download-product__add" wire:click.prevent="addVideoLink">+ Добавить видео</button>
                    </div>
                @endif
            </div>
        </div>

        <!-- другие функции -->
        <div wire:ignore.self class="download-product__form-group">
            <button class="download-product__acc-btn js-acc-action">Другие функции</button>

            <div wire:ignore.self class="download-product__content">
                <div class="download-product__form-group">
                    <span class="download-product__select js-download-product-select">

                        <select wire:model.defer="another_option.transportation" placeholder="Транспортировка" class="download-product__form-input download-product__text-grey">
                                 <option value="danger">Опасный</option>
                                 <option value="not_danger" selected>не опасный</option>
                        </select>

                        <span class="download-product__arrow">
                            <img src="/images/timeArrow.svg"
                                 alt="time">
                        </span>
                    </span>
                </div>

                <div class="download-product__form-group">
                    <span class="download-product__select js-download-product-select">

                        <select wire:model.defer="another_option.fragile" class="download-product__form-input download-product__text-grey">
                                 <option value="fragile">Хрупкое</option>
                                 <option value="not_fragile">не хрупкое</option>
                        </select>

                        <span class="download-product__arrow">
                            <img src="/images/timeArrow.svg"
                                 alt="time">
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div>
            <button class="download-product__btn js-tab-item btn-mr" type="submit">Сохранить</button>
            <button class="download-product__btn download-product__btn--color js-next-btn">Продолжить</button>
        </div>
    </form>

    <form wire:ignore.self  class="download-product__form js-tab-item" id="tab-price">
        <div class="download-product__form-heading">Укажите цену и можете добавить
            скидку</div>

        <div class="download-product__form-group">
            <div class="download-product__form-label">
                Укажите цену, ₽
            </div>
        </div>

        <div class="download-product__form-group">
            <input type="number" placeholder="Цена" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"
                   class="download-product__form-input" wire:keyup="changePartnerPrice" wire:model="price">
        </div>
        <!-- вывод ошибок валидации -->
        @error('price') <span class="error">{{ $message }}</span> @enderror

        <div class="download-product__form-group">
            <div class="download-product__form-label">
                Установите скидку, %
            </div>
        </div>

        <div class="download-product__form-group">
            <input type="number" placeholder="Скидка" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')"
                   class="download-product__form-input" wire:keyup="changePartnerPrice" wire:model="discount">
        </div>
        <!-- вывод ошибок валидации -->
        @error('discount') <span class="error">{{ $message }}</span> @enderror

        <div class="download-product__form-calc">
            <div class="download-product__form-desc">При продаже товара после вычета
                комиссии вы получите:</div>

            <div class="download-product__form-price">{{ $partner_price }} ₽</div>
        </div>
        <button class="download-product__btn" type="submit" wire:click.prevent='updatePrice'>Сохранить</button>
    </form>
</div>
