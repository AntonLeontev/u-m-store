@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <a href="#" class="major__btn-prev"></a>
                <div class="major__inner">
                    <a href="#" class="major__btn-prev"></a>
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{route('admin.dashboard')}}">Профиль</a></li>
                            <li><span>Настройки сайта</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Профиль партнера</div>
                    <div class="profile__wrapper">
                        @include('livewire.admin.includes.main-menu')
                        <div class="set__inner">
                            @include('livewire.admin.includes.mobile-main-menu')

                            <div class="set__one">
                                <div class="set__step">Информация о вашем сайте:</div>
                                <div class="set__form" style="max-width: 550px; width: 100%">
                                    <form enctype="multipart/form-data" wire:submit.prevent="saveSiteSettings">
                                        @csrf
                                        <div class="set__pos">
                                            Домен вашего сайта:<span class="label__partner"></span></div>
                                        <input type="text" wire:model="domain" placeholder="onionmarket.ru">
                                        <div>
                                            @error('domain') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="set__pos">
                                            Название вашего города:<span class="label__partner"></span>
                                        </div>
                                        <input type="text" wire:model="city_name" readonly>
                                        <div>
                                            @error('city_name') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="set__pos">
                                            Название компании отображаемое на сайте:<span class="label__partner"></span>
                                        </div>
                                        <input type="text" wire:model="company_name" placeholder="Флора">
                                        <div>
                                            @error('company_name') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="set__pos">
                                            Номер телефона отображаемый на сайте:<span class="label__partner"></span>
                                        </div>
                                        <input type="text" wire:model="phone_number" placeholder="7(999) 000 11 22">
                                        <div>
                                            @error('phone_number') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="set__pos">
                                            Email на сайте:<span class="label__partner"></span>
                                        </div>
                                        <input type="text" wire:model="email" placeholder="unitedmarket@market.ru">
                                        <div>
                                            @error('email') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="set__pos">
                                            Адрес отображаемый на сайте:<span class="label__partner"></span></div>
                                        <input type="text" wire:model="address"
                                               placeholder="Москва, г. Зеленоград, Улица Юности 8, офис 802">
                                        <div>
                                            @error('address') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="set__pos">
                                            Ссылка на ВКонтакте:
                                        </div>
                                        <input type="text" wire:model="vk_link"
                                               placeholder="https://vk.com/unitedmarketorg">
                                        <div>
                                            @error('vk_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>

{{--                                        <div class="set__pos">--}}
{{--                                            Ссылка на Инстаграм:--}}
{{--                                        </div>--}}
{{--                                        <input type="text" wire:model="inst_link"--}}
{{--                                               placeholder="https://www.instagram.com/unitedmarketorg/">--}}
{{--                                        <div>--}}
{{--                                            @error('inst_link') <span class="error">{{ $message }}</span> @enderror--}}
{{--                                        </div>--}}

{{--                                        <div class="set__pos">--}}
{{--                                            Ссылка на Facebook:--}}
{{--                                        </div>--}}
{{--                                        <input type="text" wire:model="fb_link"--}}
{{--                                               placeholder="https://www.facebook.com/United-Market-160182772502217">--}}
{{--                                        <div>--}}
{{--                                            @error('fb_link') <span class="error">{{ $message }}</span> @enderror--}}
{{--                                        </div>--}}
                                        <div class="set__pos">
                                            Ссылка на Yotube:
                                        </div>

                                        <input type="text" wire:model="youtube_link"
                                               placeholder="https://www.youtube.com/channel/UCns7aIJwqWZFPPwWXd6iq6g">
                                        <div>
                                            @error('youtube_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>


                                        <div class="set__pos">
                                            Логотип на сайте:<span class="label__partner"></span></div>
                                        <div>
                                            @if(is_string($logo))
                                                <img class="logo" src="{{ asset('storage/SiteClone/Logo').'/'.$logo }}" alt="logo"
                                                     width="100"
                                                     style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 8px"; >
                                            @elseif(is_object($logo))

                                                <img class="logo" src="{{ $logo->temporaryUrl() }}" alt="logo"
                                                     width="100"
                                                     style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 8px;">
                                            @endif
                                        </div>
                                        <input type="file" wire:model.debounce.300ms="logo">
                                        <div>
                                            @error('logo') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="reg__flex">
                                            <button style="display: block; margin-left: auto; margin-right: auto;" type="submit">Сохранить</button>

                                        </div>
                                    </form>
                                    @if(session()->has('success'))
                                        <div class="alert-success" style="max-width: 550px; margin-top: 15px;"><span>Данные успешно сохранены.</span>
                                        </div>
                                    @elseif(session()->has('error'))
                                        <div class="alert-danger" style="max-width: 550px; margin-top: 15px;"><span>Ошибка такой домен уже зарегистрирован.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('footer')


    <script src="{{ asset('js/jquery-3.6.0.min.js') }}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endpush
