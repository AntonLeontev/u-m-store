<div class="umsp-popup-delet" id="umspPopupDelet">
    <h2 class="visually-hidden">Удалить профиль</h2>
    <p class="umsp-popup-delet__text">Как только Ваш профиль будет удален, Вы автоматически выйдете из системы и больше не сможете войти в этот аккаунт.</p>
    <button class="umsp-popup-delet__btn-delet" wire:click="deleteAccount">Удалить профиль</button>
    <button class="umsp-popup-delet__btn-close" onclick="document.querySelector('#umspPopupDelet').style.display = 'none'">
        <i class="icon-um-city-close"></i>
        <span class="visually-hidden">Закрыть</span>
    </button>
</div>
