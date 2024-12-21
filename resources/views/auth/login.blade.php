{{--<x-guest-layout>--}}
{{--    <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <x-jet-validation-errors class="mb-4" />--}}

{{--        @if (session('status'))--}}
{{--            <div class="mb-4 text-sm font-medium text-green-600">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}

{{--            <div>--}}
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />--}}
{{--            </div>--}}

{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="flex items-center">--}}
{{--                    <x-jet-checkbox id="remember_me" name="remember" />--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-jet-button class="ml-4">--}}
{{--                    {{ __('Log in') }}--}}
{{--                </x-jet-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}
<x-guest-layout>
    @push('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css"
              integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @endpush
    <div class="wrapper">
        <div class="signReg" id="regSign"
             style="display: block !important; position: relative; transform: translateY(0%); margin: 24px auto;">
            <div class="signReg__title">Войти по E-mail</div>
            <div class="signReg__form">
                <div class="container">
                    <div class="login-form form-item form-stl">
                        <x-jet-validation-errors class="mb-4" style="color: red"/>
                        <form name="frm-login" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="signReg__description">Ваш E-Mail адрес</div>
                            @if (\Illuminate\Support\Facades\Session::has('message'))
                                <p style="color:red">{{ \Illuminate\Support\Facades\Session::get('message') }}</p>
                            @endif
                            <div class="sign-input__block">
                                <input type="email" id="frm-login-uname" name="email"
                                       placeholder="Введите ваш E-mail" :value="old('email')"
                                       required autofocus>
                            </div>
                            <div class="signReg__description">Пароль</div>
                            <input type="password" id="frm-login-pass" name="password"
                                   placeholder="************" required
                                   autocomplete="current-password">
                            <div class="sign-input__block">
                                <input type="submit" class="btn btn-submit" value="Войти" name="submit">
                            </div>

                        </form>
                        <div class="sign-input__block" >
                            Новый пользователь?
                            <a class="link-function left-position"
                               href="{{ route('register') }}" title="{{__('Register')}}">Зарегистрироваться</a>
                        </div>
                        <div class="sign-input__block" style="margin-top: 10px">
                            <a class="link-function left-position"
                               href="{{ route('password.request') }}" title="{{__('Forgotten password?')}}">{{__('Forgotten password?')}}</a>
                        </div>
                    </div>
                </div>

                <div class="oath">
                    <h3 class="oath__title">
                        <span>или вход с помощью</span>
                    </h3>

                    <div class="oath__list">
                        <!-- телеграм позволяет использовать только свою кнопку -->
{{--                        {!! Socialite::driver('telegram')->getButton() !!}--}}

                        {{--telegram--}}
{{--                        <a href="oath__link" href="#">--}}
{{--                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path d="M30.0125 60.025C46.588 60.025 60.025 46.588 60.025 30.0125C60.025 13.4371 46.588 0 30.0125 0C13.4371 0 0 13.4371 0 30.0125C0 46.588 13.4371 60.025 30.0125 60.025Z" fill="url(#paint0_linear_3189_46808)"/>--}}
{{--                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5694 29.6876C22.3157 25.8892 28.1383 23.3653 31.0621 22.1408C39.3836 18.6672 41.1329 18.0675 42.2574 18.0425C42.5073 18.0425 43.0571 18.0925 43.4319 18.3923C43.7318 18.6422 43.8068 18.9671 43.8568 19.217C43.9067 19.4669 43.9567 19.9917 43.9067 20.3915C43.4569 25.1395 41.5077 36.6597 40.5081 41.9575C40.0833 44.2066 39.2587 44.9563 38.459 45.0312C36.7097 45.1812 35.3853 43.8817 33.711 42.7822C31.0621 41.0579 29.5877 39.9833 27.0138 38.284C24.04 36.3349 25.9642 35.2603 27.6635 33.511C28.1133 33.0612 35.7851 26.0641 35.9351 25.4394C35.96 25.3644 35.96 25.0646 35.7851 24.9146C35.6102 24.7647 35.3603 24.8147 35.1604 24.8646C34.8855 24.9146 30.6872 27.7134 22.5156 33.2361C21.3161 34.0608 20.2416 34.4606 19.267 34.4356C18.1924 34.4107 16.1433 33.8359 14.5939 33.3361C12.7197 32.7364 11.2203 32.4115 11.3453 31.3619C11.4203 30.8122 12.17 30.2624 13.5694 29.6876Z" fill="white"/>--}}
{{--                                <defs>--}}
{{--                                    <linearGradient id="paint0_linear_3189_46808" x1="29.9875" y1="0" x2="29.9875" y2="59.5502" gradientUnits="userSpaceOnUse">--}}
{{--                                        <stop stop-color="#2AABEE"/>--}}
{{--                                        <stop offset="1" stop-color="#229ED9"/>--}}
{{--                                    </linearGradient>--}}
{{--                                </defs>--}}
{{--                            </svg>--}}
{{--                        </a>--}}

                        {{--vk--}}
                        <a href="{{ route('soc.auth', ['service' => 'vk']) }}">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8 0H39.2C56 0 60 4 60 20.8V39.2C60 56 56 60 39.2 60H20.8C4 60 0 56 0 39.2V20.8C0 4 4 0 20.8 0Z" fill="#2787F5"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M49.1357 20.6707C49.4137 19.7437 49.1357 19.0625 47.8126 19.0625H43.4376C42.3252 19.0625 41.8124 19.6509 41.5342 20.2998C41.5342 20.2998 39.3094 25.7228 36.1576 29.2454C35.1379 30.2651 34.6744 30.5895 34.1182 30.5895C33.8401 30.5895 33.4376 30.265 33.4376 29.3381V20.6707C33.4376 19.5583 33.1147 19.0625 32.1876 19.0625H25.3126C24.6175 19.0625 24.1994 19.5788 24.1994 20.0681C24.1994 21.1227 25.7752 21.3659 25.9376 24.3323V30.775C25.9376 32.1875 25.6825 32.4436 25.1263 32.4436C23.6432 32.4436 20.0354 26.9964 17.8957 20.7634C17.4764 19.5519 17.0558 19.0625 15.9376 19.0625H11.5626C10.3126 19.0625 10.0626 19.6509 10.0626 20.2998C10.0626 21.4586 11.5458 27.206 16.9688 34.8074C20.584 39.9985 25.6776 42.8125 30.3126 42.8125C33.0936 42.8125 33.4376 42.1875 33.4376 41.1109V37.1875C33.4376 35.9375 33.7011 35.688 34.5817 35.688C35.2306 35.688 36.343 36.0125 38.9387 38.5154C41.905 41.4817 42.3941 42.8125 44.0626 42.8125H48.4376C49.6876 42.8125 50.3126 42.1875 49.9521 40.9541C49.5575 39.7248 48.1413 37.9413 46.262 35.8271C45.2422 34.622 43.7127 33.3242 43.2492 32.6752C42.6003 31.841 42.7857 31.4701 43.2492 30.7286C43.2492 30.7286 48.5795 23.2199 49.1357 20.6707Z" fill="white"/>
                            </svg>
                        </a>
                        {{--od--}}
                        <a href="{{ route('soc.auth', ['service' => 'ok']) }}">
                            <svg width="61" height="60" viewBox="0 0 61 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_3189_46818)">
                                    <path d="M60.3077 51.2198C60.3077 56.0692 56.3766 60 51.5276 60H8.78015C3.93096 60 0 56.0692 0 51.2198V8.78015C0 3.93096 3.93096 0 8.78015 0H51.5276C56.3768 0 60.3077 3.93096 60.3077 8.78015V51.2198Z" fill="#FAAB62"/>
                                    <path d="M59.9979 51.002C59.9979 55.8013 56.1072 59.6918 51.3079 59.6918H8.99955C4.20023 59.6918 0.309692 55.8013 0.309692 51.002V8.99806C0.309692 4.19873 4.20038 0.308197 8.99955 0.308197H51.3079C56.1072 0.308197 59.9979 4.19889 59.9979 8.99806V51.002Z" fill="#F7931E"/>
                                    <path d="M30.1202 8.96722C24.1433 8.96722 19.2981 13.8125 19.2981 19.7894C19.2981 25.7663 24.1433 30.612 30.1202 30.612C36.0972 30.612 40.9424 25.7663 40.9424 19.7894C40.9424 13.8125 36.0972 8.96722 30.1202 8.96722ZM30.1202 24.2633C27.6496 24.2633 25.6466 22.2602 25.6466 19.7895C25.6466 17.3188 27.6496 15.3159 30.1202 15.3159C32.5909 15.3159 34.5939 17.3188 34.5939 19.7895C34.5939 22.2602 32.5909 24.2633 30.1202 24.2633Z" fill="white"/>
                                    <path d="M33.941 39.2232C38.2735 38.3405 40.8698 36.2888 41.0072 36.1787C42.2749 35.162 42.4786 33.31 41.4619 32.0421C40.4453 30.7743 38.5935 30.5706 37.3254 31.5872C37.2986 31.6089 34.5295 33.7331 29.9733 33.7362C25.4173 33.7331 22.5896 31.6089 22.5628 31.5872C21.2947 30.5706 19.4429 30.7743 18.4264 32.0421C17.4096 33.31 17.6133 35.162 18.8811 36.1787C19.0203 36.2904 21.7237 38.3955 26.1777 39.2574L19.9703 45.7447C18.8422 46.9146 18.8761 48.7774 20.046 49.9055C20.617 50.456 21.353 50.7297 22.0883 50.7297C22.8593 50.7297 23.6294 50.4285 24.2068 49.8296L29.9735 43.6866L36.3226 49.8694C37.473 51.0179 39.3358 51.016 40.484 49.8661C41.6322 48.716 41.6308 46.8529 40.4807 45.7047L33.941 39.2232Z" fill="white"/>
                                    <path d="M29.9733 33.7361C29.966 33.7361 29.9804 33.7362 29.9733 33.7363C29.9662 33.7362 29.9806 33.7361 29.9733 33.7361Z" fill="white"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_3189_46818">
                                        <rect width="60.3077" height="60" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>
            </div><!--end container-->
        </div>
    </div>

</x-guest-layout>
