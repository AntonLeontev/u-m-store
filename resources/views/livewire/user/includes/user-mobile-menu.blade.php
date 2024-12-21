<div class="promotions__hide" id="promotionsHide">
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox1" onclick="location.href = '{{ route('user.dashboard') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox1">Профиль</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox2" onclick="location.href = '{{ route('user.settings') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox2">Настройки профиля</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox3" onclick="location.href = '{{ route('user.notifications') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox3">Уведомления</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox4" onclick="location.href = '{{ route('user.orders-history') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox4">Заказы</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox5" onclick="location.href = '{{ route('user.bonus') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox5">Бонусы</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox6" onclick="location.href = '{{ route('user.promo') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox6">Промокоды</label>
    </div>
{{--    <div class="promotion__br">--}}
{{--        <input class="custom-checkbox" id="checkbox7" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox7">Электронные чеки</label>--}}
{{--    </div>--}}
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox8" onclick="location.href = '{{ route('user.referral') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox8">Реферальная программа</label>
    </div>
    <div class="promotion__br">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input type="submit" class="custom-checkbox" id="checkbox9" class="promotions__mobClick" type="checkbox"><label for="checkbox9">Выйти</label>
        </form>
    </div>
</div>
