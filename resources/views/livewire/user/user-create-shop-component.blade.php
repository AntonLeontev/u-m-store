@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><span>Профиль</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Профиль</div>
                    <div class="profile__wrapper">
                        @include('livewire.user.includes.user-menu')
                        <div class="profile__bigboxing">
                            <div class="promotions__choose" id="promotionsChoose">Меню</div>
                            @include('livewire.user.includes.user-mobile-menu')

							<style>
								.create-text p {
									margin-bottom: 20px;
								}
								.create-text li {
									margin-bottom: 10px;
									list-style: disc;
								}
								.button {
									width: 270px;
									height: 68px;
									font-weight: 700;
									font-size: 20px;
									line-height: 160%;
									text-align: center;
									letter-spacing: 0.05em;
									color: #FFFFFF;
									background: #d24b6c;
									border-radius: 39px;
									-webkit-transition-duration: .5s;
									transition-duration: .5s;
									border: none;
									margin-top: 30px;
								}
							</style>
                            <div class="create-text" style="background: rgba(191, 198, 224, .4); padding: 42px 75px;">
								<p>
									Мы рады, что вы выбрали наш конструктор для создания своего интернет-магазина! Мы стремимся сделать процесс простым, удобным и безопасным как для вас, так и для ваших клиентов.
								</p>
								<p>
									Однако важно помнить, что деятельность интернет-магазинов регулируется законодательством Российской Федерации. Чтобы ваш бизнес был законным и успешным, мы настоятельно рекомендуем придерживаться установленных правил.
								</p>
								<h3 style="margin-bottom: 20px">Запрещенные товары и услуги</h3>
								<p>Обратите внимание, что при использовании конструктора интернет-магазинов <strong>{{ config('app.name') }}</strong> строго запрещено создавать магазины, предлагающие следующие товары и услуги, запрещенные законодательством Российской Федерации:</p>

								<ol>
									<li><strong>Наркотические средства и психотропные вещества</strong>, их аналоги, а также средства для их изготовления и употребления.</li>
									<li><strong>Оружие</strong>, боеприпасы, взрывчатые вещества, а также их основные компоненты.</li>
									<li><strong>Алкогольная продукция</strong> и табачные изделия, включая устройства для употребления табака (вейпы, кальяны и т.д.), если они продаются без соответствующих лицензий.</li>
									<li><strong>Продукция, нарушающая авторские права</strong> (контрафактные товары).</li>
									<li><strong>Порнографические материалы и товары</strong>, нарушающие нормы общественной морали.</li>
									<li><strong>Человеческие органы и ткани</strong>.</li>
									<li><strong>Поддельные документы</strong>, печати, бланки, удостоверения.</li>
									<li>Любые <strong>финансовые пирамиды</strong> или схемы, вводящие покупателей в заблуждение.</li>
									<li><strong>Программы-вредоносное ПО</strong>, а также услуги по их созданию и продаже.</li>
									<li>Любые товары, <strong>ограниченные к продаже или полностью запрещенные законодательством РФ</strong>.</li>
								</ol>

								<p><strong>Ответственность за размещение запрещенных товаров</strong> полностью ложится на пользователя конструктора. В случае нарушения мы оставляем за собой право заблокировать ваш магазин</p>

								@if (!$isSubmited) 
									<form style="margin-top: 30px" wire:submit.prevent="submit">
										@csrf

										<input type="checkbox" id="check" checked required>
										<label for="check">Ознакомлен и согласен</label>
										<br>

										<button type="submit" class="button">Создать магазин</button>
									</form>
								@else
									<div class="alert alert-success" role="alert">Заявка на создание успешно отправлена</div>
								@endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

