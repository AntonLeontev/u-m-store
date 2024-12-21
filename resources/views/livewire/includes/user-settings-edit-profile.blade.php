<form class="umsp-block__umsp-popap-editor umsp-popap-editor" id="umspPopapEditor" wire:ignore.self wire:submit.prevent="setSettings"  enctype="multipart/form-data">
    <h2 class="visually-hidden">попап редактирование</h2>
    <button class="umsp-btn-edit umsp-block__umsp-btn-edit umsp-btn-edit--active" onclick="document.querySelector('#umspPopapEditor').style.display = 'none'">
        <span class="visually-hidden">Редактировать профиль</span>
        <i class="icon-um-edit"></i>
    </button>

    <div class="umsp-user-photo umsp-user-info__umsp-user-photo">

        <picture>
            @if($tmp_avatar)
                <img class="umsp-user-photo__img" src="{{ $tmp_avatar->temporaryUrl() }}" alt="фото"/>
            @else
                @if($avatar)
                    <img class="umsp-user-photo__img" src="{{ asset('storage/'. $avatar) }}" alt="фото"/>
                @else
                    <img class="umsp-user-photo__img" src="{{ asset('images/png/photo-profil-plug.png') }}" alt="фото"/>
                @endif
            @endif
        </picture>

        <label class="umsp-user-photo__btn">
            <input type="file" class="umsp-user-photo__input" wire:model="tmp_avatar">
            <span class="visually-hidden">Загрузить фото</span>
            <i class="icon-um-photo"></i>
        </label>

    </div>

    <div class="umsp-user-info__wrap">
        <div class="umsp-user-info__user-name">{{ $fullname }}</div>
        <div class="umsp-popap-editor__form">
            <div class="umsp-popap-editor__wrap">
                <label class="umsp-popap-editor__item">
                    <span class="umsp-popap-editor__title">Телефон</span>
                    <input class="umsp-popap-editor__input" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" wire:model.defer="phone" type="tel">
                </label>
                <label class="umsp-popap-editor__item">
                    <span class="umsp-popap-editor__title">Email</span>
                    <input class="umsp-popap-editor__input" wire:model.defer="email"
                           type="email">
                </label>
            </div>
            <label class="umsp-popap-editor__item">
                <span class="umsp-popap-editor__title">Дата рождения</span>
                <span class="umsp-popap-editor__wrpa-calendar">
                        <input class="umsp-popap-editor__input-calendar" wire:model.defer="birthdate" type="text" id="airdatepicker">
                        <span class="umsp-popap-editor__btn-calendar">
                            <i class="icon-um-calendar"></i>
                        </span>
                    </span>
                <span class="umsp-popap-editor__title">Введите дату рождения, чтобы мы могли Вас поздравить</span>
            </label>

            <button class="umsp-popap-editor__btn-save" type="submit" onclick="document.querySelector('#umspPopapEditor').style.display = 'none'">сохранить</button>
        </div>
    </div>
</form>
