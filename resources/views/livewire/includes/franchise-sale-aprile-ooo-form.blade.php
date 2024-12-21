<form action="#" method="POST" wire:submit.prevent="organization">
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Сфера услуг/товаров: </span>
        <input class="franchise-um-popup__input" list="direction" wire:model="organization.direction" type="text">
        <datalist id="direction">
            @foreach($directions as $direction_partner)
                <option>{{$direction_partner->name}}</option>
            @endforeach
        </datalist>
        @error('organization.direction') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Город</span>
        <input class="franchise-um-popup__input" list="city" wire:model="organization.city_name" type="text">
        <datalist id="city">
            @foreach($cities as $city_partner)
                <option>{{$city_partner->real_name}}</option>
            @endforeach
        </datalist>
        @error('organization.city_name') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Полное наименование организации: </span>
        <input class="franchise-um-popup__input" wire:model="organization.org_name" type="text">
        @error('organization.org_name') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Сокращенное наименование: </span>
        <input class="franchise-um-popup__input"  wire:model="organization.short_name_org" type="text">
        @error('organization.short_name_org') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Юридический адрес: </span>
        <input class="franchise-um-popup__input" wire:model="organization.legal_address" type="text">
        @error('organization.legal_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Фактический адрес: </span>
        <input class="franchise-um-popup__input" wire:model="organization.actual_address" type="text">
        @error('organization.actual_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Почтовый адрес (а/я): </span>
        <input class="franchise-um-popup__input" wire:model="organization.mailing_address" type="text">
        @error('organization.mailing_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Генеральный Директор: </span>
        <input class="franchise-um-popup__input" wire:model="organization.gen_director" type="text">
        @error('organization.gen_director') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Главный бухгалтер: </span>
        <input class="franchise-um-popup__input" wire:model="organization.glav_bug" type="text">
        @error('organization.glav_bug') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ИНН</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="organization.inn" type="text">
        @error('organization.inn') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">КПП</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="organization.kpp" type="text">
        @error('organization.kpp') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ОГРН</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="organization.ogrn" type="text">
        @error('organization.ogrn') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Наименование Банка: </span>
        <input class="franchise-um-popup__input" wire:model="organization.bank_name" type="text">
        @error('organization.bank_name') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Расчётный счет (р/с) : </span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="organization.check_account" type="text">
        @error('organization.check_account') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Корреспондентский счёт: (к/c) </span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="organization.correspondent_account" type="text">
        @error('organization.correspondent_account') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">БИК</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="organization.bik" type="text">
        @error('organization.bik') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Электронный почтовый адрес (E-mail):</span>
        <input class="franchise-um-popup__input" wire:model="organization.email" type="text">
        @error('organization.email') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Мобильный номер телефона:</span>
        <input class="franchise-um-popup__input" wire:model="organization.phone_number" maxlength="20" placeholder="7(900)800 55 55" onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text">
        @error('organization.phone_number') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Сайт/соц.сети:</span>
        <input class="franchise-um-popup__input" wire:model="organization.socials" type="text">
        @error('organization.socials') <span class="error">{{ $message }}</span> @enderror
    </label>
    <button class="franchise-um-popup__btn-send" type="submit" >Отправить</button>
</form>
