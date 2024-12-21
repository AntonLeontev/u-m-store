@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><span>Уведомления</span></li>
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
                        <div class="uved__inner">
                            <div class="promotions__choose" id="promotionsChoose">Фильтры</div>
                            @include('livewire.user.includes.user-mobile-menu')

                            <div class="uved__title">Уведомления (<div class="uved__num">{{ $notifications ? count($notifications) : 0 }}</div>)</div>
{{--                            <a href="#" class="uved__item uved__before__yes">--}}
{{--                                <div class="uved__name uved__yesName">Ваш заказ подтвержден</div>--}}
{{--                                <div class="uved__data">12.06.2020</div>--}}
{{--                            </a>--}}
                            @if($notifications)
                                @foreach($notifications as $item)
                                    <a href="#" class="uved__item" wire:click.prevent="clickItem('{{$item->id}}')">
                                        <div class="uved__name" style="line-height: 1.2; @if(!$item->read_status) font-weight: 700; @endif">{{ $item->title }}</div>
                                        <div class="uved__data">{{ $item->date }}</div>
                                    </a>
                                @endforeach
                            @endif
                            @if(session()->has('message'))
                                <div id="thanks" class="thanks" style="display: block !important;box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1);">
                                    <h3 class="thanks__title">{{ session('message') }}</h3>
                                    <div id="thanksClose" class="thanks__close" onclick="document.querySelector('#thanks').style.display = 'none'"><img src="{{ asset('images/closePartner.svg') }}" alt="close" /></div>
                                    <div id="thanksBtn" class="main__btn thanks__btn" onclick="document.querySelector('#thanks').style.display = 'none'">Закрыть</div>
                                </div>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>

