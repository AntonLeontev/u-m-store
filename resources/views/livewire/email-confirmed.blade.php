@push('head')
    <link rel="stylesheet" href="{{asset('css/file.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="thanksZakaz">
            <div class="thanksZakaz__title">Ваш email успешно подтвержден!</div>
            Теперь Вы можете <a href="{{ url('/login') }}">войти в свой аккаунт</a>
        </section>
    </div>
</div>
