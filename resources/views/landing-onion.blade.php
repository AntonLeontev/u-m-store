<!DOCTYPE html>
<html lang="ru">

<head>
	<title>Главная</title>
	<meta charset="UTF-8">
	<meta name="format-detection" content="telephone=no">
	<!-- <style>body{opacity: 0;}</style> -->
	<link rel="stylesheet" href="/onion/css/style.min.css?_v=20250113092227">
	<link rel="shortcut icon" href="/onion/favicon.ico">
	<link rel="stylesheet" href="{{ asset('css/footer.css?3') }}">
	<!-- <meta name="robots" content="noindex, nofollow"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	@laravelPWA

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
	m[i].l=1*new Date();
	for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
	k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym({{ config('services.yandex_metrica_counter') }}, "init", {
			clickmap:true,
			trackLinks:true,
			accurateTrackBounce:true,
			webvisor:true
	});
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/{{ config('services.yandex_metrica_counter') }}" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</head>

<body>
	<div class="wrapper">
		<header class="header">
			<div class="header__container">
				<a href="/" class="header__logo logo">
					<picture>
						<source media="(min-width: 479.98px)" srcset="/onion/img/logo.webp">
						<img src="/onion/img/logo_m.webp" alt="Logo">
					</picture>
				</a>
				<div class="header__right">
					<div class="header__menu menu">
						<button type="button" class="menu__icon icon-menu"><span></span></button>
						<nav class="menu__body">
							<ul class="menu__list">
								<li class="menu__item"><a href="#" class="menu__link" data-goto=".cases">Примеры использования</a></li>
								<li class="menu__item"><a href="#" class="menu__link" data-goto=".how-work">Как это работает</a></li>
								<li class="menu__item"><a href="#" class="menu__link" data-goto=".tariffs">Тарифы</a></li>
								<li class="menu__item"><a href="{{ route('user.dashboard') }}" class="menu__link"><strong>Войти</strong></a></li>
								<li class="menu__item"><a href="{{ route('user.create-shop') }}" class="button" data-da=".header__menu, 767.98">Начать</a></li>
							</ul>
						</nav>
					</div>

				</div>
			</div>
		</header>

		<main class="page">
			<section class="hero section-bottom">
				<picture>
					<source media="(min-width: 480px)" srcset="/onion/img/hero-dec.svg">
					<img src="/onion/img/hero-dec_m.svg" alt="Image" class="hero__dec">
				</picture>
				<div class="hero__container">
					<h1 class="hero__title">
						<strong></strong>
					</h1>
					<div class="hero__text">Создайте интернет-магазин, синхронизируйте товары и&nbsp;заказы на&nbsp;всех
						маркетплейсах
					</div>
					<div class="hero__img">
						<img src="/onion/img/hero-img.webp" alt="Image" class="ibg">
					</div>
				</div>
			</section>
			<div class="benefits section-bottom">
				<div class="benefits__container">
					<div class="benefits__items">
						<div class="benefit">
							<div class="benefit__header">
								<img src="/onion/img/benefits/01.webp" alt="Image">
								<strong>Собственный интернет-магазин</strong>
							</div>
							<div class="benefit__body">
								Внесите данные, загрузите фото и&nbsp;описание товара и&nbsp;получите <strong>готовый сайт
									за&nbsp;15 минут</strong>
							</div>
						</div>
						<div class="benefit">
							<div class="benefit__header">
								<img src="/onion/img/benefits/02.webp" alt="Image">
								<strong>Мобильное приложение</strong>
							</div>
							<div class="benefit__body">
								<strong>Готовое мобильное приложение сразу</strong> с&nbsp;вашим интернет-магазином
							</div>
						</div>
						<div class="benefit">
							<div class="benefit__header">
								<img src="/onion/img/benefits/03.webp" alt="Image">
								<strong>Увеличение ЦА</strong>
							</div>
							<div class="benefit__body">
								Увеличьте количество как целевых, так и&nbsp;потенциальных клиентов за&nbsp;счет продаж на
								всех маркетплейсах
							</div>
						</div>
					</div>
				</div>
			</div>
			<section class="cases section-bottom">
				<div class="cases__container">
					<h2 class="cases__title title">Примеры использования</h2>
					<div class="cases__items">
						<div class="case d-flex">
							<div class="case__body">
								<div class="case__title">Продукты питания</div>
								<div class="case__text">Создайте интернет-магазин по&nbsp;продаже продуктов питания,
									устанавливайте цены, скидки в&nbsp;один клик
								</div>
							</div>
							<img src="/onion/img/cases/01/01.webp" alt="Image" class="case__img">
						</div>
						<div class="case d-flex">
							<div class="case__title">Косметика</div>
							<img src="/onion/img/cases/02/01.webp" alt="Image" class="case__img">
						</div>
						<div class="case d-flex">
							<div class="case__title">Флористика</div>
							<img src="/onion/img/cases/04/01-01.webp" alt="Image" class="case__img">
						</div>
						<div class="case">
							<div class="case__body">
								<div class="case__title">Одежда и аксессуары</div>
								<div class="case__text">У вас собственное производство одежды или&nbsp;аксессуаров? создайте
									онлайн-магазин и&nbsp;продавайте еще больше! Загрузите карточки товара и&nbsp;интегрируйтесь
									с&nbsp;известными маркетплейсами
								</div>
							</div>
							<img src="/onion/img/cases/03/01.webp" alt="Image" class="case__img">
							<img src="/onion/img/cases/03/02-dec.svg" alt="Image" class="case__img-dec">
						</div>
						<div class="case d-flex">
							<div class="case__body">
								<div class="case__title">Рестораны</div>
								<div class="case__text">Мы предлагаем вам создать уникальный интернет-магазин для&nbsp;вашего
									ресторана, который позволит вашим клиентам заказывать любимые блюда в&nbsp;один клик.
									Удобный и&nbsp;простой интерфейс позволит быстро загружать фотографии и&nbsp;описание
									блюд, проводить систему
									оплаты, а&nbsp;также связываться с&nbsp;клиентами
								</div>
							</div>
							<img src="/onion/img/cases/05/01.webp" alt="Image" class="case__img">
							<img src="/onion/img/cases/05/02-dec.svg" alt="Image" class="case__img-dec">
						</div>
					</div>
					<div class="cases__now now-start">
						<div class="now-start__wrapper">
							<img src="/onion/img/now/01.svg" alt="Image" class="now-start__dec">
							<div class="now-start__img">
								<img class="ibg" src="/onion/img/now/now-img.webp" alt="Image">
							</div>
							<div class="now-start__content">
								<div class="now-start__title">создайте свой <br> интернет-магазин сейчас!</div>
								<div class="now-start__text">
									Зарегистрируйтесь до 31.01.2025 и пользуйтесь полным функционалом Onion Market
									и&nbsp;<strong>получите доступ ко всем маркетплейсам</strong> в&nbsp;течении первого
									года бесплатно!
								</div>
								<div class="now-start__avtion">
									<a href="{{ route('user.create-shop') }}" class="now-start__btn button">Попробовать бесплатно</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="how-work section-bottom">
				<div class="how-work__container">
					<h2 class="how-work__title title">как это работает</h2>
					<div class="how-work__items">
						<div class="item-how-work">
							<img src="/onion/img/how/01-dec.svg" alt="Image" class="item-how-work__dec">
							<div class="item-how-work__img">
								<img src="/onion/img/how/01.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Регистрация</div>
								<div class="item-how-work__text">Простая регистрация с&nbsp;использованием только номера
									телефона, электронной почты и&nbsp;пароля
								</div>
							</div>
						</div>
						<div class="item-how-work">
							<img src="/onion/img/how/02-dec.svg" alt="Image" class="item-how-work__dec">
							<div class="item-how-work__img">
								<img src="/onion/img/how/02.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Загрузка товаров</div>
								<div class="item-how-work__text">Создайте свой первый магазин легко и&nbsp;быстро, просто
									загрузив товары, описание и&nbsp;информацию о&nbsp;магазине
								</div>
							</div>
						</div>
						<div class="item-how-work">
							<img src="/onion/img/how/03-dec.svg" alt="Image" class="item-how-work__dec">
							<div class="item-how-work__img">
								<img src="/onion/img/how/03.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Подключите Telegram бота</div>
								<div class="item-how-work__text">Всего за один клик подключите Telegram бота к&nbsp;вашему
									магазину и&nbsp;отслеживать заказы станет еще проще
								</div>
							</div>
						</div>
						<div class="item-how-work">
							<img src="/onion/img/how/04-dec.svg" alt="Image" class="item-how-work__dec">
							<div class="item-how-work__img">
								<img src="/onion/img/how/04.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Подключите домен</div>
								<div class="item-how-work__text">Подключите собственный домен к&nbsp;вашему
									интернет-магазину
								</div>
							</div>
						</div>
						<div class="item-how-work">
							<!--                        <img src="/onion/img/how/07-dec.svg" alt="Image" class="item-how-work__dec">-->
							<div class="item-how-work__img">
								<img src="/onion/img/how/05.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Подключите интернет-эквайринг</div>
								<div class="item-how-work__text">Ваши клиенты смогут за пару кликов оплачивать заказы
									картами, через T‑Pay, SberPay, Mir Pay, СБП на&nbsp;сайте, в&nbsp;приложении, в&nbsp;мессенджерах,
									в соцсетях, по e-mail и&nbsp;СМС.
								</div>
							</div>
						</div>
						<div class="item-how-work">
							<img src="/onion/img/how/06-dec.svg" alt="Image" class="item-how-work__dec">
							<div class="item-how-work__img">
								<img src="/onion/img/how/06.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Запустите рекламу</div>
								<div class="item-how-work__text">Наша команда настроит рекламные кампании для вашего
									магазина за клик
								</div>
							</div>
						</div>
						<div class="item-how-work">
							<img src="/onion/img/how/07-dec.svg" alt="Image" class="item-how-work__dec">
							<div class="item-how-work__img">
								<img src="/onion/img/how/07.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Интегрируйтесь с&nbsp;маркетплейсами</div>
								<div class="item-how-work__text">Подключите OZON, Wildberries, Яндекс.Маркет, чтобы ваши
									товары были на&nbsp;всех крупных площадках
								</div>
							</div>
						</div>
						<div class="item-how-work">
							<img src="/onion/img/how/08-dec.svg" alt="Image" class="item-how-work__dec">
							<div class="item-how-work__img">
								<img src="/onion/img/how/08.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Аналитика продаж</div>
								<div class="item-how-work__text">Удобная система аналитики по всем подключенным вами
									маркетплейсам и&nbsp;магазинам в&nbsp;вашем личном кабинете
								</div>
							</div>
						</div>
						<div class="item-how-work">
							<img src="/onion/img/how/09-dec.svg" alt="Image" class="item-how-work__dec">
							<div class="item-how-work__img">
								<img src="/onion/img/how/09.webp" alt="Image" class="ibg">
							</div>
							<div class="item-how-work__body">
								<div class="item-how-work__title">Продавайте и&nbsp;зарабатывайте еще больше</div>
								<div class="item-how-work__text">Удобный интерфейс магазина и&nbsp;простая система оплаты
									позволит вам легко следить за&nbsp;вашими товарами и&nbsp;заказами, вносить изменения
									прямо со&nbsp;своего смартфона, и&nbsp;зарабатывать еще больше!
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="aggregator section-bottom">
				<div class="aggregator__container">
					<h2 class="aggregator__title title">агрегатор маркетплейсов</h2>
					<div class="aggregator__items">
						<div class="aggregator-item">
							<img src="/onion/img/aggregator-img_1.webp" alt="Image" class="aggregator-item__img">
							<div class="aggregator-item__info">
								<strong>Для бизнеса на&nbsp;старте </strong>
								<div class="aggregator-item__text">На старте ведения бизнеса достаточно просто
									зарегистрироваться на&nbsp;Onion Market и&nbsp;начать продавать свои товары уже через 15
									минут
								</div>
							</div>
						</div>
						<div class="aggregator-item">
							<img src="/onion/img/aggregator-img_2.webp" alt="Image" class="aggregator-item__img">
							<div class="aggregator-item__info">
								<strong>Для действующих селлеров</strong>
								<div class="aggregator-item__text">Для бизнеса дополнительный источник продаж, удобная
									система аналитики и&nbsp;управления карточками товаров в&nbsp;одном месте
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="why section-bottom">
				<div class="why__container">
					<h2 class="why__title title">почему нас выбирают</h2>
					<div class="why__accent accent-block">
						<img src="/onion/img/accent-block-bg.svg" alt="Image" class="accent-block__bg">
						<div class="accent-block__content">
							<div class="accent-block__title">Прогрессивное веб-приложение</div>
							<div class="accent-block__text">
								Мы используем технологию в web-разработке, которая визуально и&nbsp;функционально
								трансформирует
								сайт в&nbsp;приложение. Поэтому редактировать информацию, цены на товары, добавлять
								фотографии
								просто и&nbsp;удобно без использования компьютера, a<strong>&nbsp;напрямую с&nbsp;вашего
									смартфона</strong>
							</div>
						</div>
						<div class="accent-block__img">
							<img src="/onion/img/accent-block-img.webp" alt="Image" class="ibg">
						</div>
					</div>
					<div class="why__items">
						<div class="item-why item-why_dark" style="background: #6ACDF8;">
							<div class="item-why__body">
								<div class="item-why__title">Ведение бизнеса</div>
								<div class="item-why__text">Загрузите неограниченное количество товаров в&nbsp;каталог,
									управляйте запасами, настройте параметры доставки и цены.
								</div>
							</div>
						</div>
						<div class="item-why">
							<div class="item-why__body">
								<div class="item-why__title">Встроенная бухгалтерия</div>
								<div class="item-why__text">Наши партнеры возьмут на&nbsp;себя бухгалтерию абсолютно
									бесплатно
								</div>
							</div>
						</div>
						<div class="item-why item-why_img">
							<div class="item-why__body">
								<div class="item-why__title">Подключите маркетплейсы</div>
								<div class="item-why__text">OZON, Wildberries, Яндекс.Маркет и&nbsp;другие</div>
							</div>
							<img src="/onion/img/accent-block-dec-2.webp" alt="Image" class="item-why__img">
						</div>
						<div class="item-why item-why_img">
							<div class="item-why__body">
								<div class="item-why__title">Собственный интернет-магазин</div>
								<div class="item-why__text">
									Вам не нужно обращаться к&nbsp;веб-студии или разработчикам, мы уже создали и&nbsp;настроили
									интернет магазин, а&nbsp;вам остается только загрузить свои товары и&nbsp;начать
									продавать их в&nbsp;Интернете.
									<strong>Станьте первым на нашем интернет-магазине Onion Market</strong>
								</div>
							</div>
							<!--                        <img src="/onion/img/accent-block-dec-1.svg" alt="Image" class="item-why__img">-->
						</div>
						<div class="item-why item-why_light" style="background: #8C6CFF;">
							<div class="item-why__body">
								<div class="item-why__title">Размещение сайта в&nbsp;России</div>
								<div class="item-why__text">Мы находимся в&nbsp;России и разработали полноценную платформу
									для
									ведения бизнеса в&nbsp;России со всеми возможностями для быстрой и&nbsp;стабильной
									работы сайта
								</div>
							</div>
						</div>
						<div class="item-why">
							<div class="item-why__body">
								<div class="item-why__title">Выполнение заказов</div>
								<div class="item-why__text">Отслеживайте движение товаров и&nbsp;исполняйте заказы с&nbsp;одной
									панели
									управления, от этапа покупки до&nbsp;доставки.
								</div>
							</div>
						</div>
						<div class="item-why item-why_light" style="background:var(--accent);">
							<div class="item-why__body">
								<div class="item-why__title">Система аналитики</div>
								<div class="item-why__text">Отслеживайте движение товаров и&nbsp;исполняйте заказы с&nbsp;одной
									панели управления, от&nbsp;этапа покупки до&nbsp;доставки.
								</div>
							</div>
						</div>
					</div>
					<div class="why__settings settings-why">
						<img src="/onion/img/settings-img_dec-l.svg" alt="Image" class="settings-why__dec settings-why__dec-left">
						<img src="/onion/img/settings-img_dec-r.svg" alt="Image" class="settings-why__dec settings-why__dec-right">
						<div class="settings-why__info">
							<strong>Настройка рекламы </strong>
							<div class="settings-why__text">
								Запустите рекламу в&nbsp;один клик на Яндекс.Директ, Авито, МТС ADS, Telegram, Tekegram ADS,
								ВКонтакте, 2ГИС, Яндекс.Бизнес, Яндекс.Промо
							</div>
							<div class="settings-why__img">
								<picture>
									<source media="(min-width: 640px)" srcset="/onion/img/settings-img.webp">
									<img src="/onion/img/settings-img_m.webp" alt="Image">
								</picture>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="tariffs section-bottom">
				<div class="tariffs__container">
					<h2 class="tariffs__title title">Тарифы</h2>
					<div class="tabs" data-tabs="">
						<div class="tabs__navigation-wrapper">
							<nav data-tabs-titles class="tabs__navigation">
								<button type="button" class="tabs__title _tab-active">1 месяц</button>
								<button type="button" class="tabs__title">1 год</button>
								<button type="button" class="tabs__title">Премиум</button>
								<button type="button" class="tabs__title">Индивидуальный</button>
							</nav>
						</div>
						<div data-tabs-body class="tabs__content">
							<div class="tabs__body">
								<div class="tariffs__body swiper">
									<div class="tariffs__wrapper swiper-wrapper">
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Базовый</div>
														<div class="tariff__price">2000 <small><strong>₽</strong>
																/месяц</small></div>
														<!--                                                    <small>2 мес. бесплатно</small>-->
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
															<strong>До 5000 товаров</strong>
														</div>
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
															<strong>Техподдержка 24/7 в&nbsp;мессенджере</strong>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для малого бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Техподдержка 24/7 в мессенджере</li>
														<li class="li-add"><span><strong>Базовая</strong> система аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-close">Подключение маркетплейсов</li>
														<li class="li-close">Реклама</li>
														<li class="li-close">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Продвинутый</div>
														<div class="tariff__price">4000 <small><strong>₽</strong>
																/месяц</small></div>
														<!--                                                    <small>2 мес. бесплатно</small>-->
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
															<strong>До 20 000 товаров</strong>
														</div>
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
															<strong>Приоритетная техподдержка</strong>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для растущего бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Техподдержка 24/7 в мессенджере</li>
														<li class="li-add"><span><strong>Расширенная</strong> система аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-close">Подключение маркетплейсов</li>
														<li class="li-close">Реклама</li>
														<li class="li-close">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Профессиональный</div>
														<div class="tariff__price">8000 <small><strong>₽</strong>
																/месяц</small></div>
														<!--                                                    <small>2 мес. бесплатно</small>-->
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
															<strong>Количество товаров без ограничений </strong>
														</div>
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
															<strong>Техподдержка VIP</strong>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для среднего бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Техподдержка 24/7 в мессенджере</li>
														<li class="li-add"><span><strong>Полный доступ</strong> к системе аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-add"><span>Подключение маркетплейсов: <strong>1&nbsp;платформа</strong></span>
														</li>
														<li class="li-add">Реклама: Настройка 1 кампании в&nbsp;Яндекс
															Директ
														</li>
														<li class="li-close">SEO-оптимизация</li>
														<li class="li-close">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Оптимальный</div>
														<div class="tariff__price">40 000 <small><strong>₽</strong>
																/месяц</small></div>
														<!--                                                    <small>2 мес. бесплатно</small>-->
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
															<strong>Количество товаров без ограничений </strong>
														</div>
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
															<strong>Техподдержка VIP</strong>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для среднего бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Техподдержка 24/7 в мессенджере</li>
														<li class="li-add"><span><strong>Полный доступ</strong> к системе аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-add"><span>Подключение маркетплейсов: <strong>3&nbsp;платформы</strong></span>
														</li>
														<li class="li-add">Реклама: Полное управление Яндекс Директ</li>
														<li class="li-close">SEO-оптимизация</li>
														<li class="li-close">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-pagination"></div>
								</div>
							</div>
							<div class="tabs__body">
								<div class="tariffs__body swiper">
									<div class="tariffs__wrapper swiper-wrapper">
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Базовый</div>
														<div class="tariff__price">20 000 ₽</div>
														<small>2 мес. бесплатно</small>
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
															<strong>До 5000 товаров</strong>
														</div>
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
															<strong>Техподдержка 24/7 в&nbsp;мессенджере</strong>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для малого бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Техподдержка 24/7 в мессенджере</li>
														<li class="li-add"><span><strong>Базовая</strong> система аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-close">Подключение маркетплейсов</li>
														<li class="li-close">Реклама</li>
														<li class="li-close">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Продвинутый</div>
														<div class="tariff__price">40 000 ₽</div>
														<small>2 мес. бесплатно</small>
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
															<strong>До 20 000 товаров</strong>
														</div>
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
															<strong>Приоритетная техподдержка</strong>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для растущего бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Техподдержка 24/7 в мессенджере</li>
														<li class="li-add"><span><strong>Расширенная</strong> система аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-close">Подключение маркетплейсов</li>
														<li class="li-close">Реклама</li>
														<li class="li-close">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Профессиональный</div>
														<div class="tariff__price">80 000 ₽</div>
														<small>2 мес. бесплатно</small>
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
															<strong>Количество товаров без ограничений </strong>
														</div>
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
															<strong>Техподдержка VIP</strong>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для среднего бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Техподдержка 24/7 в мессенджере</li>
														<li class="li-add"><span><strong>Полный доступ</strong> к системе аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-add"><span>Подключение маркетплейсов: <strong>1&nbsp;платформа</strong></span>
														</li>
														<li class="li-add">Реклама: Настройка 1 кампании в&nbsp;Яндекс
															Директ
														</li>
														<li class="li-close">SEO-оптимизация</li>
														<li class="li-close">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Оптимальный</div>
														<div class="tariff__price">400 000 ₽</div>
														<small>2 мес. бесплатно</small>
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
															<strong>Количество товаров без ограничений </strong>
														</div>
														<div class="info-header-tariff__item">
															<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
															<strong>Техподдержка VIP</strong>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для среднего бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Техподдержка 24/7 в мессенджере</li>
														<li class="li-add"><span><strong>Полный доступ</strong> к системе аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-add"><span>Подключение маркетплейсов: <strong>3&nbsp;платформы</strong></span>
														</li>
														<li class="li-add">Реклама: Полное управление Яндекс Директ</li>
														<li class="li-close">SEO-оптимизация</li>
														<li class="li-close">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-pagination"></div>
								</div>
							</div>
							<div class="tabs__body">
								<div class="premium-slider swiper">
									<div class="tariffs__wrapper swiper-wrapper">
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Премиум</div>
														<div class="tariff__price premium-price">
															<div class="premium-price__item">
																100 000 <small><strong>₽</strong>
																	/месяц</small>
															</div>
															<div class="price-label">1 год</div>
															<div class="premium-price__item">
																1 000 000 ₽ <small>2 мес. бесплатно</small>
															</div>
														</div>
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__wrapper">
															<div class="info-header-tariff__item">
																<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
																<strong>Количество товаров без ограничений </strong>
															</div>
															<div class="info-header-tariff__item">
																<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
																<strong>Индивидуальная техподдержка </strong>
															</div>
														</div>
													</div>
													<div class="header-tariff__text">Подходит для крупного бизнеса</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add"><span><strong>Индивидуальная</strong> система аналитики</span>
														</li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-add"><span>Подключение маркетплейсов: <strong>все доступные платформы</strong></span>
														</li>
														<li class="li-add">Реклама: Яндекс.Директ + ВКонтакте, Telegram
															Ads
														</li>
														<li class="li-add">SEO-оптимизация</li>
														<li class="li-add">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
									</div>
									<!--                                <div class="swiper-pagination"></div>-->
								</div>
							</div>
							<div class="tabs__body">
								<div class="premium-slider swiper">
									<div class="tariffs__wrapper swiper-wrapper">
										<div class="tariffs__slide swiper-slide">
											<div class="tariff">
												<div class="tariff__header header-tariff">
													<div class="header-tariff__top">
														<div class="tariff__label">Индивидуальный</div>
														<div class="tariff__price premium-price _no-border">
															<div class="premium-price__item">
																<small>Цена:</small> По договоренности
															</div>

														</div>
													</div>
													<div class="header-tariff__info info-header-tariff">
														<div class="info-header-tariff__wrapper">
															<div class="info-header-tariff__item">
																<img src="/onion/img/icons/shopping.svg" width="24" height="24" alt="Image">
																<strong>Количество товаров без ограничений</strong>
															</div>
															<div class="info-header-tariff__item">
																<img src="/onion/img/icons/headset.svg" width="24" height="24" alt="Image">
																<strong>Индивидуальная техподдержка </strong>
															</div>
														</div>
													</div>
													<div class="header-tariff__text">Для тех, кому нужен индивидуальный
														подход
													</div>
												</div>
												<div class="tariff__body">
													<ul class="list-rules">
														<li class="li-add">Для тех, кому нужен индивидуальный подход</li>
														<li class="li-add"><span><strong>Персональная</strong> система аналитики
															</span></li>
														<li class="li-add">Эквайринг и платежи</li>
														<li class="li-add"><span>Подключение маркетплейсов: <strong>все
																	платформы</strong></span></li>
														<li class="li-add"><span>Реклама: <strong></strong>: Яндекс Директ,
																ВКонтакте, Telegram Ads, Метрика, Аналитика, Маркетплейсы,
																таргетированная реклама</span>
														</li>
														<li class="li-add">SEO-оптимизация</li>
														<li class="li-add">Аналитика бизнеса</li>
													</ul>
												</div>
												<div class="tariff__footer">
													<a href="{{ route('user.create-shop') }}" class="button">Попробовать сейчас</a>
												</div>
											</div>
										</div>
									</div>
									<!--                                <div class="swiper-pagination"></div>-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="alfabank section-bottom">
				<div class="alfabank__container">
					<div class="alfabank__item">
						<h2 class="alfabank__title title">Откройте расчётный счёт <br> в&nbsp;Альфа-Банке — первый год
							бесплатно!</h2>
						<div class="alfabank__clients clients-alfa">
							<div class="clients-alfa__text">Только для наших клиентов — специальное предложение от
								Альфа-Банка
							</div>
							<div class="clients-alfa__items">
								<div class="clients-alfa-item" style="background-color: #8C6CFF;">
									Полностью бесплатное обслуживание первого года при открытии РК!
								</div>
								<div class="clients-alfa-item" style="background-color: #7F96E6;">
									Экономия до 24 000 ₽ на&nbsp;обслуживании
								</div>
								<div class="clients-alfa-item" style="background-color: #3657C8;">
									Доступ к&nbsp;современным банковским инструментам для управления бизнесом
								</div>
							</div>
						</div>
					</div>
					<div class="alfabank__item">
						<div class="alfabank__accent">
							<div class="accent-block _one">
								<img src="/onion/img/accent-block-bg.svg" alt="Image" class="accent-block__bg">
								<div class="accent-block__content">
									<div class="accent-block__title title">Что вы получаете с&nbsp;расчетным счетом в&nbsp;Альфа-Банке?</div>
									<ul class="accent-block__list ul-list">
										<li>Бесплатное открытие и&nbsp;обслуживание: никаких скрытых платежей.</li>
										<li>Бухгалтерия включена: автоматизация налогов, отчётов и&nbsp;взносов.</li>
										<li>Интеграция с&nbsp;маркетплейсами: автоматические выплаты и&nbsp;синхронизация
											заказов.
										</li>
										<li>Эквайринг по&nbsp;выгодным ставкам: увеличение продаж до 30%.</li>
										<li>Кэшбэк до 10% на&nbsp;бизнес-расходы.</li>
										<li>300 000 ₽ бонусов на&nbsp;развитие бизнеса.</li>
										<li>Сервис "Индикатор риска": предупреждение блокировок операций.</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="alfabank__item">
						<h2 class="alfabank__title title">Как воспользоваться предложением?</h2>
						<div class="alfabank__offer offer-alfa">
							<div class="offer-alfa__item">
								<img src="/onion/img/icons/alfa-offer/01.webp" alt="Image" class="offer-alfa__icon">
								<div class="offer-alfa__text">
									<strong>Подключитесь</strong> к&nbsp;нашему сервису и&nbsp;выберите подходящий тариф.
								</div>
							</div>
							<div class="offer-alfa__item">
								<img src="/onion/img/icons/alfa-offer/02.webp" alt="Image" class="offer-alfa__icon">
								<div class="offer-alfa__text">
									<strong>Откройте расчётный счёт в&nbsp;Альфа-Банке через нашу платформу.</strong>
								</div>
							</div>
							<div class="offer-alfa__item">
								<img src="/onion/img/icons/alfa-offer/03.webp" alt="Image" class="offer-alfa__icon">
								<div class="offer-alfa__text">
									Начните пользоваться всеми возможностями для вашего бизнеса бесплатно в&nbsp;первый год!
								</div>
							</div>
						</div>
					</div>
					<div class="alfabank__item">
						<h2 class="alfabank__title title">
							Почему это выгодно?
						</h2>
						<div class="alfabank__why">
							<ul class="ul-list _fw-semi">
								<li>Полная интеграция с нашим сервисом.</li>
								<li>Гарантированная экономия при старте бизнеса.</li>
								<li>Поддержка на каждом этапе: от регистрации счета до настройки платежей и аналитики.</li>
								<li>Начните ваш бизнес легко и без лишних затрат!</li>
							</ul>
						</div>
					</div>
					<div class="alfabank__item">
						<div class="btn-group">
							<a href="{{ route('user.create-shop') }}" class="btn-group__btn button">Активировать бесплатный код</a>
							<a href="{{ route('user.create-shop') }}" class="btn-group__btn button button_white">Оплатить напрямую — 20 000 ₽</a>
						</div>
					</div>
				</div>
			</section>
			<section class="partners section-bottom">
				<div class="partners__container">
					<h2 class="partners__title title">наши партнеры</h2>
					<div class="partners__items">
						<div class="partners-item">
							<img class="ibg" src="/onion/img/partners/01.webp" alt="Image">
						</div>
						<div class="partners-item">
							<img class="ibg" src="/onion/img/partners/02.webp" alt="Image">
						</div>
						<div class="partners-item">
							<img class="ibg" src="/onion/img/partners/03.webp" alt="Image">
						</div>
					</div>
				</div>
			</section>

			<!--        <div class="members section-bottom">-->
			<!--            <div class="members__container">-->
			<!--                <div class="members__inner">-->
			<!--                    <div class="members__text">Только для членов клуба Mind Makers БЕСПЛАТНО весь 2025 год</div>-->
			<!--                    <a href="" class="members__btn button button_white">Узнать подробнее</a>-->
			<!--                </div>-->
			<!--            </div>-->
			<!--        </div>-->
			<!--        <div class="create section-bottom">-->
			<!--            <div class="create__container">-->
			<!--                <div class="now-start">-->
			<!--                    <div class="now-start__wrapper">-->
			<!--                        <img src="/onion/img/now/01.svg" alt="Image" class="now-start__dec">-->
			<!--                        <div class="now-start__img">-->
			<!--                            <img class="ibg" src="/onion/img/now/now-img_footer.webp" alt="Image">-->
			<!--                        </div>-->
			<!--                        <div class="now-start__content">-->
			<!--                            <div class="now-start__title">создайте свой <br> интернет-магазин сейчас!</div>-->
			<!--                            <div class="now-start__text">-->
			<!--                                Зарегистрируйтесь до&nbsp;31.01.2025 и&nbsp;пользуйтесь полным функционалом U-M.Strore в&nbsp;течении-->
			<!--                                первого года бесплатно!-->
			<!--                            </div>-->
			<!--                            <div class="now-start__avtion">-->
			<!--                                <a href="https://u-m.store/auth" class="now-start__btn button">Попробовать бесплатно</a>-->
			<!--                            </div>-->
			<!--                        </div>-->
			<!--                    </div>-->
			<!--                </div>-->
			<!--            </div>-->
			<!--        </div>-->
			<section class="try section-bottom">
				<div class="try__container">
					<img src="/onion/img/try_bg.svg" alt="Image" class="try__dec">
					<h2 class="try__title title">попробуйте сейчас!</h2>
					<div class="try__text">Ваш бизнес начинается с&nbsp;сайта — запустите его за&nbsp;15 минут, без
						программистов и&nbsp;дизайнеров
					</div>
					<a href="{{ route('user.create-shop') }}" class="try__btn button">Создать интернет-магазин</a>
				</div>
			</section>
		</main>
		@livewire('footer-component')
		<footer class="footer">
			<div class="footer__container">

			</div>
		</footer>

	</div>

	<!-- /Chatra {/literal} -->
	<script>
		(function(d, w, c) {
			w.ChatraID = 'ahq2M3nrdgCyWzXbn';
			var s = d.createElement('script');
			w[c] = w[c] || function() {
				(w[c].q = w[c].q || []).push(arguments);
			};
			s.async = true;
			s.src = 'https://call.chatra.io/chatra.js';
			if (d.head) d.head.appendChild(s);
		})(document, window, 'Chatra');
	</script>
	<!-- Chatra {literal} -->

	<script src="/onion/js/app.min.js?_v=20250113092227"></script>
</body>

</html>
