@push('head')
    <link rel="stylesheet" href="{{asset('css/file.css')}}">
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
                            <li><a href="#">Бонусы и промокды</a></li>
                            <li><span>Бонусы</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Профиль</div>
                    <div class="profile__wrapper">
                        @include('livewire.user.includes.user-menu')
                        <div class="plus__inner">
                            <div class="plus__title">У Вас {{ $user_bonuses_count }} бонусов</div>
                            <div class="plus__reminder">Вы можете оплатить ими до 50% заказа</div>
                            <div class="plus__description">
                                <p><span>Правила начисления бонусов:</span> При оформлении заказа и последующей оплаты его на сайте пользователю на счет в личном кабинете начисляется бонус в размере от 3% до 5%. Бонусы имеют ограниченный срок действия – 1 месяц, после чего они сгорают.
                                </p>
                                <p>
                                    <span>Правила оплаты бонусами:</span> Бонусы можно использовать, оплачивая ими последующие заказы в размере до 50% от общей суммы заказа. Чтобы оплатить часть заказа бонусами при оформлении заказа в корзине выберите вариант «Использовать бонусы».
                                </p>
                            </div>
                            @if($bonuses_history)
                            <div class="plus__wrapper">
                                <div class="plus__top">
                                    <div class="plus__data">Дата и время</div>
                                    <div class="plus___process">Операция</div>
                                    <div class="plus__sum">Сумма</div>
                                    <div class="plus__data">Срок действия <span>(дней)</span></div>
                                </div>
                                @foreach($bonuses_history as $bonuses)
                                <div class="plus__item">
                                    <div class="plus__wrap">
                                        <div class="plus__when">
                                            <div class="plus__day">{{ $bonuses['date'] }}</div>
                                            <div class="plus__time">{{ $bonuses['time'] }}</div>
                                        </div>
                                        <div class="plus__done">{{ $bonuses['status'] }}</div>
                                        <div class="plus__money plusMoney">{{ $bonuses['total'] }} ₽</div>
                                        <div class="plus__day">{{ $bonuses['dead_line'] }}</div>
                                    </div>
                                </div>
                                    @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
