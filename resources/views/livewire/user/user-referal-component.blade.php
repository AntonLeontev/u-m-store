@push('head')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">Профиль</a></li>
                            <li><span>Реферальная программа</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title">Профиль</div>
                    <div class="profile__wrapper">
                        @include('livewire.user.user-menu')
                        <div class="ref__inner">
                            <div class="promotions__choose"id="promotionsChoose">Фильтры</div>
                            <div class="promotions__hide" id="promotionsHide">
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox1" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox1">Профиль</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox2" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox2">Настройки профиля</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox3" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox3">Уведомления</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox4" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox4">Заказы</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox5" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox5">Бонусы и промокоды</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox6" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox6">Доставки</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox7" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox7">Электронные чеки</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox8" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox8">Реферальная программа</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox9" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox9">Выйти</label>
                                </div>
                            </div>
                            <div class="ref__title">Пригласи друга по реферальной ссылке и получи 500 бонусов на счет!</div>
                            <div class="ref__description">Бонусы начисляются после первого оплаченного заказа приглашенным другом</div>
                            <div class="ref__form">
                                <input id="refFormInput" type="text" value="https://app.asana.com/0/12002131369413694309/12003" readonly>
                                <button class="ref__btn" id="refBtn">Скопировать ссылку</button>
                                <a href="#" class="ref__share">
                                    <img src="images/share.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
