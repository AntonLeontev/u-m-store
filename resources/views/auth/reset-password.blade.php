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
        <div style="width: 80%; margin: auto; line-height: 2">
            <div class="privacy__text" style="text-align: center">

                <x-jet-validation-errors class="mb-4" style="color: red"/>

                <div class="signReg__form">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="block">
                            <x-jet-label for="email" value="{{ __('Email') }}"/>
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                                         :value="old('email', $request->email)" required autofocus/>
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}"/>
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password"
                                         required autocomplete="new-password"/>
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                         name="password_confirmation" required autocomplete="new-password"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button>
                                {{ __('Reset Password') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
