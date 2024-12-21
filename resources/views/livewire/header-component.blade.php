<div>
    <header class="header">
        <nav>
            <div class="container">
                <div class="header__inner">
                    {{--                    <div class="header__info">--}}
                    {{--                        <div class="header__info-wrapper">--}}
                    {{--                            <button class="header__info-btn js-close-header-info">--}}
                    {{--                                <img class="header__info-img" src="https://umclone.pp.ua/images/katclose.svg" alt="close">--}}
                    {{--                            </button>--}}
                    {{--                            <p class="header__info-text">--}}
                    {{--                                В период праздничных дней в связи с большим количеством заказов букеты и цены на них могут незначительно отличаться. Заранее приносим свои извинения.--}}
                    {{--                            </p>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="header__top">
                        <div class="header__city" id="headerCity" wire:ignore>
                            @if(session()->has('city'))
                                {{ session('city')['name'] }}
                            @endif
                        </div>
                        <div class="header__moblogo">
                            <a href="/">
                                <img src="{{asset('images/logo.svg')}}" alt="logo">
                            </a>
                        </div>
                        <div class="header__phone">
                            <a href="tel:{{ setting('site.phone') }}">{{ setting('site.phone') }}</a>
                        </div>
                    </div>
                    <div class="header__middle">
                        <div class="header__mobmenu" id="headerMobMenu">
                            <img src="{{asset('images/btn.svg')}}" alt="menu">
                        </div>
                        <form action="{{route('product.search')}}" id="form-search-top" name="form-search-top"
                              class="header__search" wire:ignore>
                            @csrf
                            @livewire('header-search-component')
                        </form>
                        <div class="header__logo">
                            <a href="/"><img src="{{asset('images/logo.svg')}}" alt="logo"></a>
                        </div>
                    </div>
                    @include('livewire.includes.login-component')

                    <div class="header__bottom">
                        <div class="header__catalog">
                            <ul style="justify-content: flex-start">
                                <li class="header__click" style="margin-right: 10px;">
                                    <a href="#" class="header__a" id="headerA">каталог</a>
                                    <div class="header__window" id="headerWindow" wire:ignore.self>
                                        <div class="window__close" id="windowClose" style="display: block">
                                            <img src="{{asset('images/katclose.svg')}}" alt="">
                                        </div>
                                        <div class="window__left" wire:ignore>
                                            <ul class="left__list">
                                                {{--                                            <li><a href="#" class="first__act">Акции</a></li>s--}}
                                                @foreach($directions as $key=>$direction)
                                                    <li>
                                                        @if($key == 0)
                                                            <a href="#"
                                                               class="click__kat clickKat header__blackMob active"
                                                               wire:click="getCategories({{ $direction->id }}, '{{ $direction->slug }}')">{{ $direction->name }}</a>
                                                        @else
                                                            <a href="#" class="click__kat clickKat header__blackMob"
                                                               wire:click="getCategories({{ $direction->id }}, '{{ $direction->slug }}')">{{ $direction->name }}</a>
                                                        @endif
                                                        <ul class="window__posmob windowPosMob">
                                                            @foreach($direction->categories as $category)
                                                                <li>
                                                                    <a href="{{ route('product.shop', [session('city')['slug'], $direction->slug, $category->id ])}}"
                                                                       class="window__small">{{ $category->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                        <div class="window__right">
                                            <div class="window__item windowItem">
                                                <ul class="window__position">
                                                    @if($categories)
                                                        @foreach($categories as $category)
                                                            <li>
                                                                <a href="{{ route('product.shop', [session('city')['slug'],$category->direction_slug, $category->id ])}}">{{$category->name}}</a>
                                                            </li>
                                                            @if($category->childrens)
                                                                @foreach($category->childrens as $children)
                                                                    <li class="window__small"><a
                                                                            href="{{ route('product.shop', [session('city')['slug'],$category->direction_slug, $children->id ])}}"
                                                                            class="window__small">{{ $children->name }}</a>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                @foreach($main_directions as $direction)
                                    <li style="margin-right: 10px;"><a
                                            href="{{ route('shop', [session('city')['slug'], $direction->slug])}}"
                                            class="click__flower">{{ $direction->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="signin" id="signInBlock">
        <div class="signin__title">Войти</div>
        <div class="signin__description">
            Войдите или зарегистрируйтесь, чтобы совершать покупки, <br> отслеживать заказы и пользоваться персональными
            <br> скидками и бонусами
        </div>
        <div class="signin__buttons">
            <div class="signin__btn" id="signInBtn">
                <a href="#">Войти</a>
            </div>
            <div class="signin__btn">
                <a href="#">Создать аккаунт партнера</a>
            </div>
            <div class="signin__reg" id="signInReg">
                <a href="#">Зарегистрироваться</a>
            </div>
        </div>
        <div class="signin__close" id="signinClose">
            <img src="{{asset('images/close.svg')}}" alt="">
        </div>
    </div>
</div>
