
@push('head')
    <link rel="stylesheet" href="{{ asset("css/um-style/um-icon-style.css") }}">
    <link rel="stylesheet" href="{{ asset("css/normilze.css") }}">
    <link rel="stylesheet" href="{{ asset("css/another.css") }}">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <link rel="stylesheet" href="{{ asset("css/catalog.css") }}">
    <link rel="stylesheet" href="{{ asset("css/common.css") }}">
    <link rel="stylesheet" href="{{ asset("css/custom.css") }}">
    <link rel="stylesheet" href="{{ asset("css/doc.css") }}">
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <link rel="stylesheet" href="{{ asset("css/file.css") }}">
    <link rel="stylesheet" href="{{ asset("css/footer.css") }}">
    <link rel="stylesheet" href="{{ asset("css/download-product.css") }}">
@endpush

<div> <!-- div элемент для livewire -->
    <div class="wrapper">
        <div class="content">
            <div class="major">
                <div class="container">
                    <div class="major__inner">
                        <div class="major__breadcrumbs">
                            <ul>
                                <li><a href="#">Главная</a></li>
                                <li><span>Профиль</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <section class="profile">
                <div class="container">
                    <div class="profile__inner">
                        <div class="profile__title active">Профиль партнера</div>

                        <div class="profile__wrapper">
                            <!-- подключение меню -->
                            @include('livewire.admin.includes.main-menu')

                            <div class="tovar__inner" style="display: flex; flex-direction: column;">
                                <div class="promotions__choose promotions__choose_bg" id="promotionsChoose"></div>

                                <div class="promotions__hide" id="promotionsHide">
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox1" onclick="location.href = '#'"
                                               class="promotions__mobClick" type="checkbox"><label
                                            for="checkbox1">Настройки профиля</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox2" onclick="location.href = '#'"
                                               class="promotions__mobClick" type="checkbox"><label
                                            for="checkbox2">Заказы</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox3" onclick="location.href = '#'"
                                               class="promotions__mobClick" type="checkbox"><label for="checkbox3">Загрузка
                                            товара (услуг)</label>
                                    </div>
                                    <div class="promotion__br">
                                        <input class="custom-checkbox" id="checkbox4" onclick="location.href = '#'"
                                               class="promotions__mobClick" type="checkbox"><label
                                            for="checkbox4">Склад</label>
                                    </div>
                                </div>

                                <!-- заголовок с выбором таба товара -->
                                <div class="download-product__head">
                                    <button class="download-product__prev js-prev-btn">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21 12L3 12" stroke="#3657C8" stroke-width="2"
                                                  stroke-linecap="round" />
                                            <path d="M9 6L3 12L9 18" stroke="#3657C8" stroke-width="2"
                                                  stroke-linecap="round" />
                                        </svg>
                                    </button>
                                    <div class="download-product__pagination-wrapper">
                                        <button wire:ignore.self class="download-product__bullet is-active js-tab-btn"
                                                data-target="#tab-files"><span>1</span>Добавить фото
                                        </button>

                                        <button wire:ignore.self class="download-product__bullet js-tab-btn"
                                                data-target="#tab-info"><span>2</span>
                                            Добавить описание
                                        </button>

                                        <button wire:ignore.self class="download-product__bullet js-tab-btn"
                                                data-target="#tab-price"><span>3</span>
                                            Установить цену
                                        </button>
                                    </div>
                                </div>

                                <!-- форма добавление товара -->
                                @include('livewire.admin.includes.admin-add-product-form')

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@push('footer')
    <script defer src="{{ asset('js/download-product.js') }}"></script>

    <script defer src="{{ asset('js/main.js') }}"></script>
@endpush
