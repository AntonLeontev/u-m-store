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
								<h1>Откройте счёт в банке Blanc и упрощайте управление бизнесом!</h1>

								<p><strong>Бланк</strong> — это цифровой банк нового поколения, созданный для предпринимателей, которым важны удобство, скорость и экономия. Забудьте о сложных тарифах, лишних тратах и долгих согласованиях — с Бланком вы получаете максимум удобств и выгоды в одном приложении.</p>

								<hr>

								<p><strong>Почему вам это нужно, если у вас интернет-магазин?</strong></p>
								<p><strong>Бланк идеально подходит для предпринимателей, которые ведут продажи в интернете.</strong></p>

								<ul class="ul">
									<li>Деньги от продаж в интернет-магазине моментально поступают на расчётный счёт в банке.</li>
									<li>Полностью бесплатная бухгалтерия для ИП на УСН автоматизирует расчёты налогов и ведение учёта.</li>
									<li>Вывод денег на личный счёт физлица до 1 500 000 ₽ в месяц — <strong>без комиссии</strong>.</li>
								</ul>

								<p>Вы получаете полный контроль над финансами своего бизнеса в одном удобном приложении. Вся бухгалтерия уже встроена, а значит, вы экономите время и деньги на услугах бухгалтера.</p>

								<hr>

								<p><strong>Основные преимущества:</strong></p>
								
								<p><strong>✅ Бесплатное обслуживание счёта для бизнеса — 0 ₽.</strong></p>

								<ul class="ul">
									<li>Выводите деньги с расчётного счёта на физический счёт без комиссии.</li>
									<li>Снимайте до 300 000 ₽ в банкоматах без переплат.</li>
									<li>Получайте 7% годовых на остаток средств по счёту.</li>
								</ul>

								<p><strong>✅ Бухгалтерия бесплатно.</strong></p>

								<ul class="ul">
									<li>Для ИП на УСН — это огромная экономия: больше не нужно тратить деньги на бухгалтера или программное обеспечение. Всё доступно в приложении.</li>
								</ul>
								
								<p><strong>✅ Гибкость тарифов.</strong></p>

								<ul class="ul">
									<li>Оплачивайте только те функции, которые вам действительно нужны. Стартовая подписка — всего <strong>0 рублей.</strong> </li>
								</ul>
								
								<p><strong>✅ Интеграция с интернет-магазином.</strong></p>

								<ul class="ul">
									<li>Вся ваша выручка мгновенно попадает на расчётный счёт в банке. Это удобно, прозрачно и экономично.</li>
								</ul>
								
								<p><strong>✅ Эквайринг с низкими ставками от 0,58%.</strong></p>

								<ul class="ul">
									<li>Никаких скрытых комиссий, ставка фиксирована и не зависит от оборота.</li>
								</ul>
								
								<p><strong>✅ Открытие счёта бесплатно и полностью онлайн.</strong></p>

								<ul class="ul">
									<li>Сэкономьте время — подайте заявку за пару минут и начните пользоваться счётом без визита в банк.</li>
								</ul>
								
								<p><strong>✅ Живая поддержка 24/7.</strong></p>

								<ul class="ul">
									<li>Настоящие специалисты всегда помогут вам, без чат-ботов и автоматизированных ответов.</li>
								</ul>

								<hr>

								<p><strong>Почему Бланк — лучший выбор для интернет-магазина?</strong></p>

								<ol>
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
								</ol>

								<hr>

								<p><strong>Откройте расчётный счёт в банке Бланк уже сегодня и оцените, как удобно вести бизнес с минимальными затратами!</strong></p>

								<a href="{{ setting('site.accounting_link') }}" class="button">Открыть счет</a>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



