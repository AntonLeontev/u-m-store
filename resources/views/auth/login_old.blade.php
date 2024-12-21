{{--<x-guest-layout>--}}
{{--    <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <x-jet-validation-errors class="mb-4" />--}}

{{--        @if (session('status'))--}}
{{--            <div class="mb-4 font-medium text-sm text-green-600">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}

{{--            <div>--}}
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />--}}
{{--            </div>--}}

{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="flex items-center">--}}
{{--                    <x-jet-checkbox id="remember_me" name="remember" />--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
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
             style="display: block !important; position: relative; transform: translateY(0%);top: 25px;">
            <div class="signReg__title">Войти по E-mail</div>
            <div class="signReg__form">
                <div class="container">
                    <div class="login-form form-item form-stl">
                        <x-jet-validation-errors class="mb-4" style="color: red"/>
                        <form name="frm-login" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="signReg__description">Ваш E-Mail адрес</div>
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
            </div><!--end container-->
        </div>
    </div>

</x-guest-layout>
