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
                            <li><a href="#">Заказы</a></li>
                            <li><span>Доставки</span></li>
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
                        <div class="delivery__inner">
                            <div class="promotions__choose" id="promotionsChoose">Фильтры</div>
                            @include('livewire.user.includes.user-mobile-menu')
                            <div class="delivery__top">
                                <div class="delivery__data">Дата</div>
                                <div class="delivery__num">№ заказа</div>
                                <div class="delivery__address">Адрес</div>
                                <div class="delivery__sum">Сумма</div>
                                <div class="delivery__pos">Статус заказа</div>
                            </div>
                            @foreach($deliveries as $delivery)
                            <div class="delivery__block">
                                <div class="delivery__item">
                                    <div class="delivery__when">{{ $delivery['date'] }}</div>
                                    <div class="delivery__trek">{{ $delivery['id'] }}</div>
                                    <div class="delivery__image">
                                        <img src=" {{ asset('images/empty.svg') }}" alt="empty">
                                    </div>
                                    <div class="delivery__where">{{ $delivery['address'] }}</div>
                                    <div class="delivery__money">{{ $delivery['total'] }} ₽</div>
                                    <div class="delivery__description">{{ $delivery['status'] }}</div>
                                </div>
                                <div class="delivery__mob">
                                    <div class="delivery__one">
                                        <div class="delivery__image">
                                            <img src="{{ asset('images/empty.svg') }}" alt="empty">
                                        </div>
                                        <div class="delivery__info">
                                            <div class="delivery__row">
                                                <div class="delivery__data">Дата</div>
                                                <div class="delivery__when">{{ $delivery['date'] }}</div>
                                            </div>
                                            <div class="delivery__row">
                                                <div class="delivery__num">№ заказа</div>
                                                <div class="delivery__trek">{{ $delivery['id'] }}</div>
                                            </div>
                                            <div class="delivery__row">
                                                <div class="delivery__sum">Сумма</div>
                                                <div class="delivery__money">{{ $delivery['total'] }} Р</div>
                                            </div>
                                            <div class="delivery__row">
                                                <div class="delivery__pos">Статус заказа</div>
                                                <div class="delivery__description">{{ $delivery['status'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="delivery__where">{{ $delivery['address'] }}</div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


