@push('head')
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{ route('user.dashboard') }}">Профиль</a></li>
                            <li><a href="#">Заказы</a></li>
                            <li><span>История заказов</span></li>
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
                        @include('livewire.user.includes.user-menu')
                        <div class="story__inner">
                        @if($months)
                        @foreach($months as $date =>$orders)
                            <div class="story__wrapper">
                                <div class="story__month">{{ $date }}</div>
                                @foreach($orders as $order)
                                <div class="story__block">
                                    <div class="story__item">
                                        <div class="story__data">{{ $order->date }}</div>
                                        <div class="story__description">
                                            @foreach($order->details as $item)
                                            <div class="story__pos">{{ $item->name }}</div>
                                            @endforeach
                                        </div>
                                        <div class="story__price">{{ $order->total }} ₽</div>
                                        <div class="story__again">
{{--                                            <a href="#">Повторить заказ</a>--}}
                                        </div>
                                    </div>
                                    <div class="story__mob">
                                        <div class="story__one">
                                            <div class="story__row">
                                                <div class="story__name">Дата</div>
                                                <div class="story__data">{{ $order->date }}</div>
                                            </div>
                                            <div class="story__row">
                                                <div class="story__name">Перечень товаров (услуг)</div>
                                                <div class="story__description">
                                                    @foreach($order->details as $item)
                                                        <div class="story__pos">{{ $item->name }}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="story__row">
                                                <div class="story__name">Сумма: </div>
                                                <div class="story__price">{{ $order->total }} P</div>
                                            </div>
                                        </div>
                                        <div class="story__again">
                                            <a href="#">
{{--                                                <img src="{{ asset('images/againMob.svg') }}" alt="again">--}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
