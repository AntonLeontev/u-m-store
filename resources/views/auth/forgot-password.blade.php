<x-guest-layout>
    @push('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css"
              integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @endpush
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <div style="width: 80%; margin: auto; line-height: 2; margin-bottom: 10px">
            <div class="privacy__text" style="text-align: left">
                <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                <p>{{ __('If you didn\'t receive the email, please check your spam folder.') }}</p>
                <p>{{ __('Perhaps the letter is there.') }}</p>


                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600" style="color: #00bf3f">
                        {{ session('status') }}
                    </div>
                @endif

                <x-jet-validation-errors class="mb-4" style="color: red"/>


                <div class="signReg__form" style="margin-top: 15px">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="block">
                            {{--                        <x-jet-label for="email" value="{{ __('Email') }}"/>--}}
                            <div class="signReg__description">{{__('Your E-Mail address')}}</div>
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                         :value="old('email')" required autofocus/>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button>
                                {{ __('Email Password Reset Link') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
    </x-jet-authentication-card>
</x-guest-layout>
