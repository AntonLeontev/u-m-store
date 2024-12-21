<form class="franchise__form" action="#" method="POST" wire:submit.prevent="questionsRemain">
    <div class="franchise__form-content franchise__form-content_section">
        <input type="hidden" name='ИСТОЧНИК' value="ОСТАЛИСЬ ВОПРОСЫ ФРАНШИЗА!">
        <div class="franchise__form-input franchise__form-input_necessarily">Имя</div>
        <input type="text" name="Фамилия и Имя" wire:model="questions_name" maxlength="60" required>

        <div class="franchise__form-input franchise__form-input_necessarily">Номер телефона</div>
        <input name="Номер телефона" type="tel" wire:model="questions_phone" required maxlength="20" placeholder="7(900)800 55 55" onkeyup="this.value=this.value.replace(/[^\d]/,'')">

        <div class="franchise__form-input franchise__form-input_necessarily">Email</div>
        <input type="email" name="Email" wire:model="questions_email" maxlength="60" required>

        <div class="franchise__form-input franchise__form-input_necessarily">Сообщение</div>
        <textarea wire:model="questions_message" maxlength="250" required></textarea>

        <button type="submit" class="franchise__button franchise__button_blue">Отправить</button>
        {{--                        @if(count($errors)>0)--}}
        {{--                            <div style="margin-top:10px ">--}}
        {{--                                @foreach($errors->all() as $error)--}}
        {{--                                    <div><span class="error">{{ $error }}</span></div>--}}
        {{--                                @endforeach--}}
        {{--                            </div>--}}
        {{--                        @endif--}}
        @if(session()->has('success_question'))
            <div class="alert-success" style="max-width: 450px; margin-top: 15px; text-align: center"><span>Данные успешно отправлены</span>
            </div>
        @elseif(session()->has('error_question'))
            <div class="error" style="max-width: 550px; margin-top: 15px; text-align: center"><span>Ошибка отправки данных</span>
            </div>
        @endif
    </div>
</form>
