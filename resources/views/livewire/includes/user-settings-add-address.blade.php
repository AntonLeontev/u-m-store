<div class="umsp-popup-add-address" id="umspPopupAddAddress" wire:ignore.self>
    <h2 class="visually-hidden">Добавить адрес</h2>
    <button class="umsp-popup-delet__btn-close" onclick="document.querySelector('#umspPopupAddAddress').style.display = 'none'">
        <i class="icon-um-city-close"></i>
        <span class="visually-hidden">Закрыть</span>
    </button>
    <form class="umsp-popup-add-address__form"  wire:submit.prevent="addAddress">
        <label class="umsp-popup-add-address__item">
            <span class="umsp-popup-add-address__title">Город</span>
            <input class="umsp-popup-add-address__input" id="city" wire:model="city" type="text">
        </label>
        <label class="umsp-popup-add-address__item">
            <span class="umsp-popup-add-address__title">Адрес </span>
            <input class="umsp-popup-add-address__input" id="address" type="text" wire:model="address">
        </label>
        <label class="umsp-popup-add-address__item">
            <input class="umsp-popup-add-address__checkbox" @if($is_main_adr) checked @endif type="checkbox" wire:model="is_main_adr">

            <span class="umsp-popup-add-address__icon-checkbox"></span>
            <span class="umsp-popup-add-address__title">Основной адрес</span>
        </label>
        <button type="submit" class="umsp-popup-add-address__btn-save">Сохранить</button>
    </form>
</div>
