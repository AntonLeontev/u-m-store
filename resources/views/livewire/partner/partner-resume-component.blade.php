@push('head')
    <link rel="stylesheet" href="{{asset('css/um-style/um-main.css?1')}}">
    <link rel="stylesheet" href="{{asset('css/um-style/um-icon-style.css?1')}}">
    <link rel="stylesheet" href="{{asset('css/um-style/um-investor-profile.css?1')}}">
@endpush
@push('footer')
    <script src="{{ asset('js/um-js/um-investor-profile.js?1') }}"></script>
@endpush
<div class="um-investor-profile">

    <div class="um-investor-profile__um-breadcrumbs um-breadcrumbs">
        <a href="https://umclone.pp.ua/" class="um-breadcrumbs__back-button">
            <span class="visually-hidden">Закрыть</span>
            <i class="icon-um-back"></i>
        </a>
        <ul class="um-breadcrumbs__list">
            <li class="um-breadcrumbs__item"><a class="um-breadcrumbs__link" href="https://umclone.pp.ua/">Главная</a></li>
            <li class="um-breadcrumbs__item">Анкетирование</li>
        </ul>
    </div>

    <h1 class="um-investor-profile__title">Анкета <span class="nowrap">"Партнер Onion Market"</span></h1>

    <p class="um-investor-profile__text">Уважаемый партнер United United, для рекламной компании Вашего интернет-магазина на нашем сервисе и получения взаимной выгоды мы привлекаем инвесторов для увеличения рекламного бюджета в Вашем городе. Для участия в маркетинговой программе ответьте, пожалуйста на вопросы в анкете для аналитики и повышения конкурентной и покупательской способности Вашего магазина.</p>

    <form class="um-investor-profile__form" action="#" wire:submit="submitForm">
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Город<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="Москва" required  wire:model="city">
            @error('city') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Население города<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="Население города" required wire:model="population">
            @error('population') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Юридическое лицо<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="ИП Ромашкин А.В." required wire:model="entity">
            @error('entity') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Название магазина<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="Bloom" required wire:model="store_name">
            @error('store_name') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Адрес магазина<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="Коломенская, 20" required wire:model="store_address">
            @error('store_address') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Краткое описание магазина<span class="um-investor-profile__asterisk">&#42;</span></span>
            <span class="um-investor-profile__label-text-min">Количество флористов, их опыт, ассортимент магазина и т.д.</span>
            <textarea class="um-investor-profile__textarea" placeholder="5 человек" required wire:model="store_description"></textarea>
            @error('store_description') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Телефон магазина<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="+79005555555" required wire:model="phone" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
            @error('phone') <span class="error">{{ $message }}</span> @enderror

        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">С какого года (сколько лет) работает Ваш магазин<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="2007" wire:model="start_working" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
            @error('start_working') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Сайт магазина (при наличии)</span>
            <input class="um-investor-profile__input" type="text" placeholder="https://gren-lavka.ru" wire:model="store_site">
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Товарооборот в месяц с сайта(при наличии)</span>
            <input class="um-investor-profile__input" type="text" placeholder="100000" wire:model="store_turnover" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
        </label>

        <div class="um-investor-profile__label-text">Социальные сети (при наличии)</div>
        <div class="um-investor-profile__social-wrap">
            <label class="um-investor-profile__label-social">
                <span class="um-investor-profile__social-icon um-investor-profile__social-icon--fb"><i class="icon-um-fb"></i></span>
                <input class="um-investor-profile__input" type="text" placeholder="https://facebook.com/" wire:model="facebook_link">
            </label>
            <label class="um-investor-profile__label-social">
                <span class="um-investor-profile__social-icon um-investor-profile__social-icon--telegram"><i class="icon-um-telegram"></i></span>
                <input class="um-investor-profile__input" type="text" placeholder="@nickname" wire:model="telegram_link">
            </label>
            <label class="um-investor-profile__label-social">
                <span class="um-investor-profile__social-icon um-investor-profile__social-icon--inst"><i class="icon-um-inst"></i></span>
                <input class="um-investor-profile__input" type="text" placeholder="https://www.instagram.com" wire:model="instagram_link">
            </label>
            <label class="um-investor-profile__label-social">
                <span class="um-investor-profile__social-icon um-investor-profile__social-icon--vk"><i class="icon-um-vk"></i></span>
                <input class="um-investor-profile__input" type="text" placeholder="https://vk.com/" wire:model="vk_link">
            </label>
            <label class="um-investor-profile__label-social">
                <span class="um-investor-profile__social-icon um-investor-profile__social-icon--classmates"><i class="icon-um-classmates"></i></span>
                <input class="um-investor-profile__input" type="text" placeholder="https://ok.ru/" wire:model="odnoklassniki_link">
            </label>
        </div>

        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Товарооборот в месяц с социальных сетей (при наличии)</span>
            <input class="um-investor-profile__input" type="text" placeholder="100000" wire:model="month_turnover_in_socials" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Товарооборот в месяц магазина</span>
            <input class="um-investor-profile__input" type="text" placeholder="100000" wire:model="month_turnover" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Расходы магазина в месяц</span>
            <input class="um-investor-profile__input" type="text" placeholder="20000" wire:model="store_expenses" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Сколько флористов работает, персонал<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="2" required wire:model="staff_count" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
            @error('staff_count') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Арендуемая площадь, м2<span class="um-investor-profile__asterisk">&#42;</span></span>
            <input class="um-investor-profile__input" type="text" placeholder="10" required wire:model="leased_area" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
            @error('leased_area') <span class="error">{{ $message }}</span> @enderror
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Стоимость аренды в месяц</span>
            <input class="um-investor-profile__input" type="text" placeholder="20000" wire:model="rental_price_per_month" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Система налогооблажения</span>
            <input class="um-investor-profile__input" type="text" placeholder="ООО" wire:model="taxation_system">
        </label>
        <label class="um-investor-profile__label">
            <span class="um-investor-profile__label-text">Фотографии магазина (5 фото)</span>
            <input class="um-investor-profile__input-file" type="file" placeholder="Выбрать файл" wire:model="store_image" multiple type="file" accept=".jpg, .jpeg, .png">

            <span class="um-investor-profile__icon-download">
                @if($store_image)
                    <span>Выбрано {{ count($store_image)}} фото</span>
                @else
                    <span>Выбрать файл</span>
                @endif
                <i class="icon-um-download"></i>
            </span>
        </label>
        <button class="um-investor-profile__btn" type="submit">Отправить</button>
    </form>

    <div class="um-investor-profile-popap-sg">
        <button class="um-investor-profile-popap-sg__close btn-close-js">
            <span class="visually-hidden">Закрыть</span>
            <i class="icon-um-city-close"></i>
        </button>
        <p class="um-investor-profile-popap-sg__text">Спасибо! Скоро наши менеджеры свяжутся с вами</p>
    </div>

</div>
