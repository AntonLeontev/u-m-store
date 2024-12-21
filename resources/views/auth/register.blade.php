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
            <div class="signReg__title">{{__('Registration by e-mail')}}</div>
            <div class="signReg__form">
                <div class="container">

                    <div class="login-form form-item form-stl">
                        <x-jet-validation-errors class="mb-4"/>
                        <div class="signReg__title">{{__('Create Account')}}</div>
                        <form class="form-stl" action="{{ route('register') }}" name="frm-login" method="POST">
                            @csrf

                            <div class="signReg__description">{{__('Name')}}</div>
                            <div class="sign-input__block">
                                <input type="text" id="frm-reg-lname" name="name" :value="old('name')"
                                       placeholder="{{__('Your name')}}" required autofocus autocomplete="name">
                            </div>
                            <div class="signReg__description">{{__('Email Address')}}</div>
                            <div class="sign-input__block">
                                <input type="email" id="frm-reg-email" name="email" :value="old('email')" required
                                       placeholder="{{__('Email Address')}}">
                            </div>
                            <div class="signReg__description">{{__('Password')}}</div>
                            <div class="sign-input__block">
                                <input type="password" id="frm-reg-pass" name="password" required
                                       autocomplete="new-password" placeholder="{{__('Password')}}">
                            </div>
                            <div class="signReg__description">{{__('Confirm Password')}}</div>
                            <div class="sign-input__block">
                                <input type="password" id="frm-reg-cfpass" name="password_confirmation"
                                       placeholder="{{__('Confirm Password')}}" required autocomplete="new-password">
                            </div>
                            <input type="submit" class="btn btn-sign" value="{{__('Register')}}" name="register">
                        </form>
                    </div>
                </div>
            </div><!--end main products area-->
        </div>
    </div><!--end row-->

    </div><!--end container-->

    </main>
    <!--main area-->
</x-guest-layout>
{{--<x-guest-layout>--}}
{{--    <!--main area-->--}}
{{--    <main id="main" class="main-site left-sidebar">--}}

{{--        <div class="container">--}}

{{--            <div class="wrap-breadcrumb">--}}
{{--                <ul>--}}
{{--                    <li class="item-link"><a href="/" class="link">home</a></li>--}}
{{--                    <li class="item-link"><span>Register</span></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">--}}
{{--                    <div class=" main-content-area">--}}
{{--                        <div class="wrap-login-item ">--}}
{{--                            <div class="register-form form-item ">--}}
{{--                                <x-jet-validation-errors class="mb-4" />--}}
{{--                                <form class="form-stl" action="{{ route('register') }}" name="frm-login" method="POST" >--}}
{{--                                    @csrf--}}
{{--                                    <fieldset class="wrap-title">--}}
{{--                                        <h3 class="form-title">Create an account</h3>--}}
{{--                                        <h4 class="form-subtitle">Personal infomation</h4>--}}
{{--                                    </fieldset>--}}
{{--                                    <fieldset class="wrap-input">--}}
{{--                                        <label for="frm-reg-lname">Name*</label>--}}
{{--                                        <input type="text" id="frm-reg-lname" name="name" :value="old('name')" placeholder="Your name*" required autofocus autocomplete="name">--}}
{{--                                    </fieldset>--}}
{{--                                    <fieldset class="wrap-input">--}}
{{--                                        <label for="frm-reg-email">Email Address*</label>--}}
{{--                                        <input type="email" id="frm-reg-email" name="email" :value="old('email')" required placeholder="Email address">--}}
{{--                                    </fieldset>--}}
{{--                                    <fieldset class="wrap-title">--}}
{{--                                        <h3 class="form-title">Login Information</h3>--}}
{{--                                    </fieldset>--}}
{{--                                    <fieldset class="wrap-input item-width-in-half left-item ">--}}
{{--                                        <label for="frm-reg-pass">Password *</label>--}}
{{--                                        <input type="password" id="frm-reg-pass"  name="password" required autocomplete="new-password" placeholder="Password">--}}
{{--                                    </fieldset>--}}
{{--                                    <fieldset class="wrap-input item-width-in-half ">--}}
{{--                                        <label for="frm-reg-cfpass">Confirm Password *</label>--}}
{{--                                        <input type="password" id="frm-reg-cfpass" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">--}}
{{--                                    </fieldset>--}}
{{--                                    <input type="submit" class="btn btn-sign" value="Register" name="register">--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!--end main products area-->--}}
{{--                </div>--}}
{{--            </div><!--end row-->--}}

{{--        </div><!--end container-->--}}

{{--    </main>--}}
{{--    <!--main area-->--}}
{{--</x-guest-layout>--}}
