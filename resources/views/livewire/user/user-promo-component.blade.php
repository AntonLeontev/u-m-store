@push('head')
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
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
                            <li><a href="#">Бонусы и промокоды</a></li>
                            <li><span>Промокоды</span></li>
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
                        <div class="promo__inner">
                            @if($active_promo)
                            <div class="promo__active">
                                <div class="promo__title">Активные промокоды</div>
                                @foreach($active_promo as $promo)
                                <div class="promo__item">
                                    <div class="promo__top">
                                        <div class="promo__name"><input type="text" class="promoNameBtn" value="{{ $promo->code }}" readonly></div>
                                        <div class="promo__btn promoBtn">Скопировать</div>
                                    </div>
                                    <div class="promo__description">
{{--                                        <span>Условия использования:</span> Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности влечет за собой процесс внедрения и модернизации системы обучения кадров, соответствует насущным потребностям. Не следует, однако забывать, что консультация с широким активом представляет собой интересный эксперимент проверки модели развития.--}}
                                    </div>
                                    <div class="promo__description">
                                        <span>Доступен до:</span> {{ Date::parse($promo->date_end)->format('d.m.Y') }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @if($old_promo)
                             @foreach($old_promo as $promo)
                                        <div class="promo__last">
                                <div class="promo__title">Истекшие промокоды</div>
                                <div class="promo__item">
                                    <div class="promo__top">
                                        <div class="promo__name"><input type="text" class="promoNameBtn" value="{{ $promo->code }}" readonly></div>
                                        <div class="promo__btn promoBtn">Скопировать</div>
                                    </div>
                                    <div class="promo__description">
{{--                                        <span>Условия использования:</span> Идейные соображения высшего порядка, а также постоянный количественный рост и сфера нашей активности влечет за собой процесс внедрения и модернизации системы обучения кадров, соответствует насущным потребностям. Не следует, однако забывать, что консультация с широким активом представляет собой интересный эксперимент проверки модели развития.--}}
                                    </div>
                                    <div class="promo__description">
                                        <span>Истек срок действия:</span> {{ Date::parse($promo->date_end)->format('d.m.Y') }}
                                    </div>
                                </div>
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
