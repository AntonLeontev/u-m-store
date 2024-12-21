<form action="#" method="POST" wire:submit.prevent="selfEmpoyed">
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Сфера услуг/товаров: </span>
        <input class="franchise-um-popup__input" list="direction" wire:model="self_employed.direction" type="text">
        <datalist id="direction">
            @foreach($directions as $direction_partner)
                <option>{{$direction_partner->name}}</option>
            @endforeach
        </datalist>
        @error('self_employed.direction') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Город</span>
        <input class="franchise-um-popup__input" list="city" wire:model="self_employed.city_name" type="text">
        <datalist id="city">
            @foreach($cities as $city_partner)
                <option>{{$city_partner->real_name}}</option>
            @endforeach
        </datalist>
        @error('self_employed.city_name') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ФИО:</span>
        <input class="franchise-um-popup__input" wire:model="self_employed.fullName" type="text">
        @error('self_employed.fullName') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Серия и номер паспорта:</span>
        <input class="franchise-um-popup__input" wire:model="self_employed.pasport_seria_number" type="text">
        @error('self_employed.pasport_seria_number') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Когда и кем выдан:</span>
        <input class="franchise-um-popup__input" wire:model="self_employed.when_issued_whom" type="text">
        @error('self_employed.when_issued_whom') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Адрес регистрации:</span>
        <input class="franchise-um-popup__input" wire:model="self_employed.registration_address" type="text">
        @error('self_employed.registration_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Фактический адрес ведения деятельности: </span>
        <input class="franchise-um-popup__input" wire:model="self_employed.actual_address" type="text">
        @error('self_employed.actual_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ИНН</span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="self_employed.inn" type="text">
        @error('self_employed.inn') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Почтовый адрес (а/я):</span>
        <input class="franchise-um-popup__input" wire:model="self_employed.mailing_address" type="text">
        @error('self_employed.mailing_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Наименование Банка: </span>
        <input class="franchise-um-popup__input" wire:model="self_employed.bank_name" type="text">
        @error('self_employed.bank_name') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Расчётный счет (р/с) : </span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="self_employed.check_account" type="text">
        @error('self_employed.check_account') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Корреспондентский счёт: (к/c) </span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="self_employed.correspondent_account" type="text">
        @error('self_employed.correspondent_account') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">БИК</span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="self_employed.bik" type="text">
        @error('self_employed.bik') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Электронный почтовый адрес (E-mail):</span>
        <input class="franchise-um-popup__input" wire:model="self_employed.email" type="text">
        @error('self_employed.email') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Мобильный номер телефона:</span>
        <input class="franchise-um-popup__input" wire:model="self_employed.phone_number" maxlength="20" placeholder="7(900)800 55 55" onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text">
        @error('self_employed.phone_number') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Сайт/соц.сети:</span>
        <input class="franchise-um-popup__input" wire:model="self_employed.socials" type="text">
        @error('self_employed.socials') <span class="error">{{ $message }}</span> @enderror
    </label>
    <button class="franchise-um-popup__btn-send" type="submit">Отправить</button>
</form>
