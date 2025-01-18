@push('head')
    <link rel="stylesheet" href="{{asset('css/um-style/um-main.css')}}">
    <link rel="stylesheet" href="{{asset('css/um-style/um-icon-style.css')}}">
@endpush
<!-- <div class="promotions__choose" id="promotionsChoose">Меню</div> -->
<button class="promotions__btn-menu">
    <i class="icon-um-menu"></i>
    <span class="visually-hidden">кнопка меню</span>
</button>
<div class="promotions__hide" id="promotionsHide">
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox4" name="menu" onclick="location.href = '{{ route('admin.dashboard') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox4">Профиль</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox3" name="menu" onclick="location.href = '{{ route('admin.products') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox3">Загрузка товара (услуг)</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox1" name="menu" onclick="location.href = '{{ route('admin.settings') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox1">Настройки профиля</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox2" name="menu" onclick="location.href = '{{ route('admin.orders') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox2">Заказы</label>
    </div>
    <div class="promotion__br">
        <input class="custom-checkbox" id="checkbox2" name="menu" onclick="location.href = '{{ route('admin.categories') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox2">Категории</label>
    </div>

	@if (!is_numeric($hash = Auth::user()->telegram_id))
		<div class="promotion__br">
			<input class="custom-checkbox" id="checkbox5" name="menu" onclick="location.href = 'https://t.me/umhelp_bot?start={{$hash}}'" class="promotions__mobClick" type="checkbox"><label for="checkbox5">Телеграм уведомления</label>
		</div>
	@else
		<div class="promotion__br">
			<input class="custom-checkbox" id="checkbox5" name="menu" class="promotions__mobClick" type="checkbox" disabled><label for="checkbox5" style="color: #2bbf69">Телеграм уведомления Активны</label>
		</div>
	@endif

	<div class="promotion__br">
		<input class="custom-checkbox" id="checkbox6" name="menu" class="promotions__mobClick" type="checkbox" disabled><label for="checkbox6">Реклама</label>
	</div>
	<div class="promotion__br">
		<input class="custom-checkbox" id="checkbox7" name="menu" class="promotions__mobClick" type="checkbox" disabled><label for="checkbox7">Маркетплейсы</label>
	</div>
	<div class="promotion__br">
        <input class="custom-checkbox" id="checkbox9" name="menu" onclick="location.href = '{{ route('admin.accounting') }}'" class="promotions__mobClick" type="checkbox"><label for="checkbox9">Активировать магазин</label>
    </div>
	<div class="promotion__br">
		<input class="custom-checkbox" id="checkbox8" name="menu" onclick="location.href = '{{ route('admin.partners') }}'" class="promotions__mobClick" type="checkbox" disabled><label for="checkbox8">Партнеры</label>
	</div>
</div>




@push('footer')
    <script src="{{asset('js/main.js')}}"></script>
@endpush
