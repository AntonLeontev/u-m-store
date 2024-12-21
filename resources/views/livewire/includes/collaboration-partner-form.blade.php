<div id="iamPartner" class="iamPartner" style="display: none" >
    <div class="application__title">Давайте сотрудничать! Заполните заявку и мы вам перезвоним</div>
    <div id="hood" class="hood" onclick="document.querySelector('#iamPartner').style.display = 'none'"><img src="{{ asset('images/close.svg') }}" alt="close" /></div>
    <form onsubmit="makeSubmit()" action="{{ route('send.mail') }}" method="POST">
    @csrf
    <!-- Hidden Required Fields -->
        <input name="Источник" value="{{ url()->current() }}" type="hidden" />
        <input name="Тема" value="Заявка на сотрудничество" type="hidden" />
        <input  id="type_cooperation" name="Тип сотрудничества" type="hidden" value="Стать Контрагентом">
        <!-- END Hidden Required Fields -->
        <label>
            <span class="label__partner">Имя</span>
            <input type="text" name="Имя" required maxlength="30">
        </label>
        <label>
            <span class="label__partner">Город</span>
            <input type="text" name="Город" required maxlength="30">
        </label>
        <div class="kategory__class">
            <div class="kategory__input">
                <span class="label__partner">Сфера услуг</span>
                <input type="text" class="kategory__choose" name="Выберите категорию" placeholder="" required autocomplete="false" maxlength="30">
            </div>
        </div>
        <label>
            <span class="label__partner">Телефон</span>
            <input type="tel" name="Телефон" onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" required maxlength="15">
        </label>
        <label>
            <span class="label__partner">Email</span>
            <input type="email" name="E-mail" required maxlength="40">
        </label>
        <button class="common__close js-submit">Отправить</button>

        <script>
            const submitBtn = document.querySelector('.js-submit');
            function makeSubmit() {
                submitBtn.setAttribute('disabled', 'disabled');
                submitBtn.style.cursor = 'not-allowed';
                submitBtn.style.opacity = '0.6';
            }
        </script>
    </form>
</div>


@if(session()->has('message'))
    <div id="thanks" class="thanks" style="display: block !important">
        <h3 class="thanks__title">{{ session('message') }}</h3>
        <div id="thanksClose" class="thanks__close" onclick="document.querySelector('#thanks').style.display = 'none'"><img src="https://onionmarket.ru/images/closePartner.svg" alt="close" /></div>
        <div id="thanksBtn" class="main__btn thanks__btn" onclick="document.querySelector('#thanks').style.display = 'none'">Закрыть</div>
    </div>
@endif
