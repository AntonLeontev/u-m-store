@push('head')
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
@endpush

<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <a href="#" class="major__btn-prev"></a>
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><span>Бухгалтерия бесплатно</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{--
            Профиль инвестора,
            нужно подставить данные,
            изменить путь к картинкам
        --}}
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Бухгалтерия бесплатно</div>
                    <div class="profile__wrapper">
                        @include('livewire.admin.includes.main-menu')

                        <div class="">
                            @include('livewire.admin.includes.mobile-main-menu')

							<style>
								h1 {
									margin-bottom: 30px;
								}
								p+p {
									margin-top: 10px;
								}
								ul.ul {
									margin: 15px 0;
									padding-left: 25px;
								}
								ul.ul>li {
									list-style: disc;
								}
								ol {
									padding-left: 25px;
								}
								ol>li {
									list-style: decimal;
								}
								ol>li+li {
									margin-top: 15px;
								}
								 ol>li .title {
									 font-weight: bold;
									 margin-bottom: 10px;
								 }
								 hr {
									margin: 30px 0;
									border-color: #ccc;
								 }
								 .button {
									width: 270px;
									height: 68px;
									display: flex;
									justify-content: center;
									align-items: center;
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

							<div class="">
								<h1>Откройте расчетный счет в Альфа-Банке и получите магазин бесплатно!</h1>

								<p>Альфа-Банк предлагает самые выгодные условия для малого и среднего бизнеса. Откройте расчетный счет всего за несколько минут и активируйте интернет-магазин без дополнительных затрат. Это идеальное решение для тех, кто хочет сэкономить время, деньги и получить максимум удобства для управления бизнесом.</p>

								<hr>

								{{-- <p><strong>Почему вам это нужно, если у вас интернет-магазин?</strong></p>
								<p><strong>Бланк идеально подходит для предпринимателей, которые ведут продажи в интернете.</strong></p>

								<ul class="ul">
									<li>Деньги от продаж в интернет-магазине моментально поступают на расчётный счёт в банке.</li>
									<li>Полностью бесплатная бухгалтерия для ИП на УСН автоматизирует расчёты налогов и ведение учёта.</li>
									<li>Вывод денег на личный счёт физлица до 1 500 000 ₽ в месяц — <strong>без комиссии</strong>.</li>
								</ul>

								<p>Вы получаете полный контроль над финансами своего бизнеса в одном удобном приложении. Вся бухгалтерия уже встроена, а значит, вы экономите время и деньги на услугах бухгалтера.</p> --}}

								{{-- <hr> --}}

								<p><strong>Преимущества открытия расчетного счета с Onion Market:</strong></p>
								
								<p><strong>✅ Бесплатное открытие и обслуживание счета. </strong></p>

								<ul class="ul">
									<li>Подключите РКО без скрытых платежей и наслаждайтесь выгодными условиями.</li>
								</ul>

								<p><strong>✅ Удобное мобильное приложение.</strong></p>

								<ul class="ul">
									<li>Полный контроль над счетами ИП или ООО с любого устройства.</li>
								</ul>
								
								<p><strong>✅ Бухгалтерия бесплатно.</strong></p>

								<ul class="ul">
									<li>Автоматический расчет налогов и взносов без дополнительных расходов.</li>
								</ul>
								
								<p><strong>✅ Выгодный эквайринг.</strong></p>

								<ul class="ul">
									<li>Увеличивайте продажи, принимая карты с минимальными комиссиями.</li>
								</ul>
								
								<p><strong>✅ Кэшбэк до 10%.</strong></p>

								<ul class="ul">
									<li>Получайте деньги обратно за бизнес-расходы.</li>
								</ul>
								
								<p><strong>✅ 300 000 рублей бонусов на развитие бизнеса.</strong></p>

								<ul class="ul">
									<li>Используйте бонусы на продвижение и развитие своего магазина.</li>
								</ul>
								
								<p><strong>✅ Сервис "Индикатор риска".</strong></p>

								<ul class="ul">
									<li>Блокировка подозрительных операций и защита ваших финансов.</li>
								</ul>

								<hr>

								<p><strong>Как это работает?</strong></p>

								{{-- <ol>
									<li>
										<div>
											<div class="title">Простота и удобство:</div>
											<div class="text">Деньги с продаж сразу поступают на счёт, а встроенная бухгалтерия автоматически помогает управлять налогами.</div>
										</div>
									</li>
									<li>
										<div>
											<div class="title">Экономия:</div>
											<div class="text">Вы ничего не платите за обслуживание, вывод денег на личный счёт — бесплатно, а бухгалтерия входит в стандартный функционал для ИП.</div>
										</div>
									</li>
									<li>
										<div>
											<div class="title">Гибкость:</div>
											<div class="text">Удобные интеграции с интернет-магазинами и сервисами для бизнеса, которые делают управление ещё проще.</div>
										</div>
									</li>
									<li>
										<div>
											<div class="title">Всё в одном месте:</div>
											<div class="text">Полный контроль над продажами, финансами и налогами прямо в вашем смартфоне.</div>
										</div>
									</li>
								</ol> --}}

								{{-- <hr> --}}

								<p>Нажмите кнопку "Активировать РКО".</p>
								<p>Заполните заявку на расчетный счет в Альфа-Банке.</p>
								<p>Подпишите документы на встрече с менеджером.</p>
								<p>После активации счета магазин будет готов к работе.</p>
								<p>Выберите способ активации магазина:</p>

								<a href="{{ setting('site.accounting_link') }}" class="button" style="width: 100%">Оплатить 24 000 ₽ (активация без подключения РКО).</a>
								<a href="{{ route('admin.partners') }}" class="button" style="width: 100%">Активировать РКО (бесплатное подключение через Альфа-Банк).</a>

								<p style="margin-top: 15px">Не упустите возможность открыть магазин с минимальными затратами уже сегодня!</p>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



