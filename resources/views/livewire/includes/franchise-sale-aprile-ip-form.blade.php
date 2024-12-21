<form action="#" method="POST" wire:submit.prevent="individualBusiness">
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Сфера услуг/товаров: </span>
        <input class="franchise-um-popup__input" list="direction" wire:model="individual_business.direction" type="text">
        <datalist id="direction">
            @foreach($directions as $direction_partner)
                <option>{{$direction_partner->name}}</option>
            @endforeach
        </datalist>
        @error('individual_business.direction') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Город</span>
        <input class="franchise-um-popup__input" list="city" wire:model="individual_business.city_name" type="text">
        <datalist id="city">
            @foreach($cities as $city_partner)
                <option>{{$city_partner->real_name}}</option>
            @endforeach
        </datalist>
        @error('individual_business.city_name') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Полное наименование организации: </span>
        <input class="franchise-um-popup__input" wire:model="individual_business.organization" type="text">
        @error('individual_business.organization') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Сокращенное наименование: </span>
        <input class="franchise-um-popup__input" wire:model="individual_business.short_name_organization" type="text">
        @error('individual_business.short_name_organization') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Юридический адрес: </span>
        <input class="franchise-um-popup__input" wire:model="individual_business.legal_address" type="text">
        @error('individual_business.legal_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Фактический адрес: </span>
        <input class="franchise-um-popup__input" wire:model="individual_business.actual_address" type="text">
        @error('individual_business.actual_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Почтовый адрес (а/я): </span>
        <input class="franchise-um-popup__input" wire:model="individual_business.mailing_address" type="text">
        @error('individual_business.mailing_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ИНН</span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="individual_business.inn" type="text">
        @error('individual_business.inn') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">КПП</span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="individual_business.kpp" type="text">
        @error('individual_business.kpp') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ОГРН</span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="individual_business.ogrn" type="text">
        @error('individual_business.ogrn') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Наименование Банка: </span>
        <input class="franchise-um-popup__input" wire:model="individual_business.bank_name" type="text">
        @error('individual_business.bank_name') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Расчётный счет (р/с) : </span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="individual_business.check_account" type="text">
        @error('individual_business.check_account') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Корреспондентский счёт: (к/c) </span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="individual_business.correspondent_account" type="text">
        @error('individual_business.correspondent_account') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">БИК</span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="individual_business.bik" type="text">
        @error('individual_business.bik') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Электронный почтовый адрес (E-mail):</span>
        <input class="franchise-um-popup__input" wire:model="individual_business.email" type="text">
        @error('individual_business.email') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Мобильный номер телефона:</span>
        <input class="franchise-um-popup__input" maxlength="20" placeholder="7(900)800 55 55" onkeyup="this.value=this.value.replace(/[^\d]/,'')" wire:model="individual_business.phone_number" type="text">
        @error('individual_business.phone_number') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Сайт/соц.сети:</span>
        <input class="franchise-um-popup__input" wire:model="individual_business.socials" type="text">
        @error('individual_business.socials') <span class="error">{{ $message }}</span> @enderror
    </label>
    <button class="franchise-um-popup__btn-send" type="submit">Отправить</button>
</form>
