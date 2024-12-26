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
									<form enctype="multipart/form-data" wire:submit.prevent="orderDomain"
										x-data="{
											domain: '{{ $domain }}',
											newDomain: '{{ $domain }}',
										}"
									>
										@csrf
                                        <div class="set__pos">
                                            Домен вашего сайта:<span class="label__partner"></span>
										</div>
                                        <input type="text" wire:model="domain" placeholder="yoursite.ru" required @input="newDomain = $event.target.value">
                                        <div>
                                            @error('domain') <span class="error">{{ $message }}</span> @enderror
                                        </div>

										@if ($domainOrdered)
											<button style="max-width: 100%; padding: 10px">Заявка отправлена</button>
										@else
											<button 
												style="max-width: 100%; padding: 10px" 
												type="submit"
												x-show="domain !== newDomain"
											>
												Запросить изменение домена
											</button>
										@endif
									</form>
								</div>

                                <div class="set__form" style="max-width: 550px; width: 100%; margin-top: 50px">
                                    <form enctype="multipart/form-data" wire:submit.prevent="saveSiteSettings">
                                        @csrf

                                        {{-- <div class="set__pos">
                                            Название вашего города:<span class="label__partner"></span>
                                        </div>
                                        <input type="text" wire:model="city_name" readonly>
                                        <div>
                                            @error('city_name') <span class="error">{{ $message }}</span> @enderror
                                        </div> --}}

                                        <div class="set__pos">
                                            Название компании и ИНН:<span class="label__partner"></span>
                                        </div>
                                        <input type="text" wire:model="company_name" placeholder="ИП Иванов ИИ ИНН 1231244124">
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

                                        <div class="set__pos">
                                            Ссылка на Rutube:
                                        </div>

                                        <input type="text" wire:model="youtube_link"
                                               placeholder="https://www.rutube.ru/channel/UCns7aIJwqWZFPPwWXd6iq6g">
                                        <div>
                                            @error('youtube_link') <span class="error">{{ $message }}</span> @enderror
                                        </div>

										<style>
											.btn_order {
												margin: 0!important;
												font-size: 0.875rem!important;
												padding: 0 10px!important;
												width: auto!important;
											}
										</style>

                                        <div class="set__pos" style="display: flex; justify-content: space-between">
											<div>
												Логотип на сайте:<span class="label__partner"></span>
											</div>
											@if ($logoOrdered)
												<button class="btn_order" disabled>Заявка отправлена</button>
											@else
												<button class="btn_order" wire:click="orderLogo" type="button">Заказать логотип</button>
											@endif
										</div>
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
										<div>Логотип должен быть изображением с соотношением сторон 1:1, не более 8мб</div>
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

	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
