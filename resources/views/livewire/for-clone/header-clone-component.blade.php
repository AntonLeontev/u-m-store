
<link rel="stylesheet" href="{{ asset('css/clone_styles/clone_header.css?3') }}">
<div>
    @if(session()->has('clone_info'))
    <header class="header">

        <nav>
            <div class="container">
                <div class="header__inner">
                    <div class="header__top header__top_partners">
{{--                        {{session()->get('clone_info')['city_name']}}--}}
                        <div class="header__city header__city_partners" id="headerCity">

                        </div>
                        <div class="header__logo header__logo_partners">
                            <a href="https://{{session()->get('domain')}}"><img src="{{asset('storage/SiteClone/Logo').'/'. session()->get('clone_info')['logo']}}" alt="#"></a>
                        </div>

                        <div class="header__phone header__phone_partners">
                            <a href="tel:{{session()->get('clone_info')['phone']}}">{{session()->get('clone_info')['phone']}}</a>
                        </div>
                    </div>

                    <div class="header__middle header__middle_partners">
                        <div class="header__mobmenu" id="headerMobMenu" style="display: none">
                            <img src="{{asset('images/btn.svg')}}" alt="menu">
                        </div>
                        <form action="{{route('product.search')}}" id="form-search-top" name="form-search-top" class="header__search" wire:ignore>
                            {{-- @csrf
                            @livewire('header-search-component') --}}
                        </form>

                        <div class="header__logo">
                            <a href="https://{{session()->get('domain')}}"><img src="{{asset('storage/SiteClone/Logo').'/'. session()->get('clone_info')['logo']}}" alt="#" > </a>
                        </div>
                        @include('livewire.includes.login-component')
                    </div>
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
								{{-- @foreach($main_directions as $direction)
									<li style="margin-right: 10px;"><a
											href="{{ route('shop', [session('city')['slug'], $direction->slug])}}"
											class="click__flower">{{ $direction->name }}</a>
									</li>
								@endforeach --}}

                                @foreach($main_categories as $category)
                                    <li style="margin-right: 10px;"><a
                                            href="{{ route('shop', [session('city')['slug'], $category->direction_slug ,$category->slug])}}"
                                            class="click__flower">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    @endif
</div>
