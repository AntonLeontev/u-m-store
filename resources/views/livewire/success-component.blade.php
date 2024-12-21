@push('head')
    <link rel="stylesheet" href="{{asset('css/file.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="thanksZakaz">
            <div class="thanksZakaz__title">Спасибо за Ваш заказ! </div>
            @if(!session()->has('certificate'))
            <div class="thanksZakaz__text">Заказ принят в обработку. Мы зарезервировали средства на вашей карте в размере, соответствующем сумме Вашего заказа. После обработки заказа, Вы получите сообщение с подтверждением или с предложением изменить данные заказа.</div>
            @else
                <div class="thanksZakaz__text">Заказ принят в обработку. Ваш сертификат использован. После обработки заказа, Вы получите сообщение с подтверждением или с предложением изменить данные заказа.</div>
            @endif
        </section>
    </div>
</div>
