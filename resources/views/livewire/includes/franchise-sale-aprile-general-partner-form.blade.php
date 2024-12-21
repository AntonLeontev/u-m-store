<form action="#" method="POST" wire:submit.prevent="generalPartner">
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ФИО</span>
        <input class="franchise-um-popup__input" wire:model="general_partner.name" type="text">
        @error('general_partner.name') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ИНН</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="general_partner.inn" type="text">
        @error('general_partner.inn') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">ОГРН</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="general_partner.ogrn" type="text">
        @error('general_partner.ogrn') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">КПП</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="general_partner.kpp" type="text">
        @error('general_partner.kpp') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">БИК</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="general_partner.bik" type="text">
        @error('general_partner.bik') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">кор. счет №</span>
        <input class="franchise-um-popup__input" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="general_partner.corr_account" type="text">
        @error('general_partner.corr_account') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">счет №</span>
        <input class="franchise-um-popup__input"  onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" wire:model="general_partner.account" type="text">
        @error('general_partner.account') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Юридический адрес</span>
        <input class="franchise-um-popup__input" wire:model="general_partner.legal_address" type="text">
        @error('general_partner.legal_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Фактический адрес</span>
        <input class="franchise-um-popup__input" wire:model="general_partner.actual_address" type="text">
        @error('general_partner.actual_address') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Телефон</span>
        <input class="franchise-um-popup__input" maxlength="20" placeholder="7(900)800 55 55" onkeyup="this.value=this.value.replace(/[^\d]/,'')" wire:model="general_partner.phone_number" type="text">
        @error('general_partner.phone_number') <span class="error">{{ $message }}</span> @enderror
    </label>
    <label class="franchise-um-popup__label">
        <span class="franchise-um-popup__label-text">Email</span>
        <input class="franchise-um-popup__input" wire:model="general_partner.email" type="text">
        @error('general_partner.email') <span class="error">{{ $message }}</span> @enderror
    </label>
    <button class="franchise-um-popup__btn-send" type="submit">Отправить</button>
</form>
