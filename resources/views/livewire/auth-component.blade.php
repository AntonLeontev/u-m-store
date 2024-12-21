@push('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.0/swiper-bundle.css" integrity="sha512-85xVunKWH9+w3fBf0ndSXOkkCuEWPbhAtnKKaFM7032omgb+gpRZXxs3bzs8mICAi8lASiYxHBxMcLYJdeJozA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush
<div class="wrapper">
    <div class="content">
@if(!session()->has('user'))
<div class="signReg" id="regSign" style="display: block !important; position: relative; transform: translateY(0%);top: 25px;">
    <div class="signReg__title">Войти или зарегистрироваться</div>
    <div class="signReg__description">Войдите или зарегистрируйтесь</div>
    <div class="signReg__form">
        <form {{ $submit_method }}>
            @csrf
          <div class="sign-input">
              <div class="sign-input__block">
{{--                  <span>+7</span>--}}
                  <input type="text" wire:model="phone" wire:keyup="phoneMask()" placeholder="7(555)55 55 555"></div>
          </div>
           @if(isset(Session('user')['phone']))
                <button type="submit">Войти</button>
            @else
                <button wire:ignore type="submit" class="sendsms" disabled="true">Получить код <span></span></button>
            @endif
        </form>
        @if(session()->has('phone-error')) <div class="error" style="text-align: center" wire:ignore>{{ session('phone-error') }}</div>@endif
    </div>
    <div class="signReg__email" id="regSignEmail">
        <a href="{{route('login')}}">Вход по e-mail</a>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function () {
    @this.on('phoneReady', ()=> {
        if (document.querySelector('.sendsms span').innerHTML.length === 0) {
            let sendsms = document.querySelector('.sendsms');
        sendsms.style.background = '#3657c8';
        sendsms.disabled = false;
    }
    });
    @this.on('phoneNotReady', ()=> {
        let sendsms = document.querySelector('.sendsms');
        sendsms.style.background ='#a1acd2';
        sendsms.disabled = true;
    });
    })
</script>
@else
<div class="number" id="numberBlock" style="display: block !important; position: relative; transform: translateY(0%); top: 25px; left: 0; margin: 0 auto" >
    <h2 class="number__title">Введите код</h2>
    <div class="back swiper-button-prev" wire:click.prevent="$emit('back')"></div>
    <p class="number__description">Мы отправили код на номер<span class="number__num">{{ Session('user')['phone'] }}</span></p>

    @if(session()->has('callback'))
        <span class="error"> {{ session('callback')['message'] }}</span>
        <div class="callback">  {!! session('callback')['phone'] !!} </div>
    @else
    <div class="number__text">Ввести код</div>
    <form id="accept">
        @csrf
       <input name="code" type="text" class="number__input" wire:model="code" wire:keyup="getCode()" placeholder="0000" >
        @if(session()->has('error_code')) <span class="error"> {{ session('error_code') }}</span> @endif
    </form>
        <div class="number__new">
            Получить новый код можно через 0:<div class="number__time">40</div>
        </div>
    <div class="number__again">
        <a href="" wire:click.prevent="$emit('resendCode')">Отправить код повторно</a>
    </div>
        <script>
            timer();
        </script>
    @endif
    <div class="number__email" id="numberBlockEmail">
        <a href="{{route('login')}}">Вход по e-mail</a>
    </div>
</div>
@endif
    </div>
    </div>
<script wire:ignore>
    function timer(){
        let timer = document.querySelector('.number__time');
        let sendsms = document.querySelector('.sendsms');
        if(timer != null)   {

            timerId = setInterval(function () {
                if(timer.innerHTML > 0) {
                    timer.innerHTML = timer.innerHTML - 1;
                    if(document.querySelector('.sendsms')) {
                        let timeer2 = document.querySelector('.sendsms span');
                        timeer2.innerHTML = 'через ' + timer.innerHTML;
                        let sendsms = document.querySelector('.sendsms');
                        sendsms.style.background ='#a1acd2';
                        sendsms.disabled = true;

                    }
                }
                else {
                    clearInterval(timerId);
                    if(document.querySelector('.number__new')) document.querySelector('.number__new').style.display ='none';
                    if(document.querySelector('.number__again')) document.querySelector('.number__again').style.display ='block';
                    if(document.querySelector('.sendsms')) {
                        console.log(11);
                        let sendsms = document.querySelector('.sendsms');
                        sendsms.style.background = '#3657c8';
                        sendsms.disabled = false;
                        document.querySelector('.sendsms span').innerHTML = '';
                    }
                }
            }, 1000);
        }
    }
    timer();
    document.addEventListener('livewire:load', function () {
    @this.on('resendCode', ()=> {
        timer();
    });
    @this.on('back', ()=> {

    });
    });
</script>

