<x-guest-layout>
    @push('head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css"
              integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @endpush
    <div class="container">
        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo/>
            </x-slot>

            <div style="width: 80%; margin: auto; line-height: 2">
                <div class="privacy__text" style="text-align: left">
                    <p >{{ __('Thanks for signing up!')}}</p>
                    <p >{{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you?')}}</p>
                    <p >{{ __('If you didn\'t receive the email, we will gladly send you another.')}}</p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        <p style="color: #00bf3f">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
                    </div>
                @endif

                {{--                <div class="mt-4 flex items-center justify-between">--}}
                <div class="signReg__form">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div style="margin-top: 30px">
                            <input type="submit" class="btn btn-sign" value="{{__('Resend Verification Email')}}"
                                   name="register">

                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-primary">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </x-jet-authentication-card>
        {{--        </div>--}}
    </div>

</x-guest-layout>
