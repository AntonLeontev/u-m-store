@push('head')
    <link rel="stylesheet" href="{{ asset('css/cooperation.css?0') }}">
@endpush
@push('footer')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script defer src="{{ asset('js/cooperation.js?1') }}"></script>
@endpush
<div class="page-section">
    <div class="cooperation">
        <div class="container">
            <section class="cooperation__hero">
                <div class="cooperation__container">
                    <div class="cooperation__text-wrapper">
                        <h1 class="cooperation__title">
                            Стань партнером Onion Market
                        </h1>

                        <p class="cooperation__desc">
                            Мы предоставляем возможность для вывода Вашего бизнеса в Интернет
                        </p>
                    </div>

                    <div class="cooperation__buttons-wrapper">
                        <a href="#terms" class="cooperation__button">Узнать условия</a>
                    </div>
                </div>

                <div class="cooperation__hero-img">
                    <img src="{{asset('images/cooperation').'/cooperation-hero.png'}}" alt="#">
                </div>
            </section>
        </div>

        <div class="cooperation__goal cooperation__section">
            <div class="container">
                <div class="cooperation__goal-wrapper">
                    <div class="cooperation__goal-img">
                        <img src="{{asset('images/cooperation').'/goal.png'}}" alt="#">
                    </div>

            <div class="cooperation__goal-info">
              <h3 class="cooperation__goal-title">
                  Наша миссия — создание электронной экосистемы на блокчейн для легкого и безопасного вывода Вашего бизнеса в Интернет
              </h3>
              <p class="cooperation__goal-desc">
                Onion Market - российская компания, целью которой является объединение предпринимателей и их компаний и
                клиентов на
                единой уникальной онлайн-платформе для увеличения количества заказов и объема прибыли с одной стороны, и
                для удобного и
                быстрого заказа товаров и услуг с другой. Onion Market предлагает сотрудничество с различными сферами
                бизнеса: цветы,
                еда, автосервис, клининг и пр. по всей России.
              </p>

              <p class="cooperation__goal-desc">
                <strong>Для наших партнеров мы разработали:</strong>
              </p>

              <p class="cooperation__goal-desc">
                – Платформу для размещения товаров и услуг
              </p>

              <p class="cooperation__goal-desc">
                – Возможность создания индивидуального сайта
              </p>

              <p class="cooperation__goal-desc">
                – Автоматизированную систему оповещения партнеров и потребителей о заказах
              </p>

              <p class="cooperation__goal-desc">
                <strong>На стадии разработки:</strong>
              </p>

              <p class="cooperation__goal-desc">
                – Блокчейн для безопасных, прозрачных и невозвратных транзакций между предпринимателем и потребителем
                без посредников
              </p>

              <p class="cooperation__goal-desc">
                – CRM система для ведения бизнеса
              </p>

              <p class="cooperation__goal-desc">
                – Искусственный интеллект для платформы onionmarket.ru
              </p>

              <p class="cooperation__goal-desc">
                – Модуль бронирования для услуг
              </p>

              <p class="cooperation__goal-desc">
                – Интеграция с маркетплейсами
              </p>
            </div>
          </div>
        </div>
      </div>

        <section class="cooperation__adv cooperation__section">
            <div class="container">
                <h2 class="cooperation__section-title">Что вы получите</h2>

                <div class="cooperation__adv-wrapper">
                    <div class="cooperation__adv-item cooperation__adv-item_indent-top">

                        <div class="cooperation__adv-decor">
                            <img src="{{asset('images/cooperation').'/adv-1.png'}}" alt="#">
                        </div>

                        <div class="cooperation__adv-title">Рекламу и продвижение</div>

                        <div class="cooperation__adv-desc">
                            На данный момент платформа находится на стадии разработки. В будущем мы планируем все маркетинговые вопросы платформы onionmarket.ru брать на себя: таргетированная реклама, реклама вашего товара в социальных сетях и т.д.
                        </div>
                    </div>

                    <div class="cooperation__adv-item cooperation__adv-item_indent-top">
                        <div class="cooperation__adv-title">Честную комиссию</div>

                        <div class="cooperation__adv-decor">
                            <img src="{{asset('images/cooperation').'/adv-2.png'}}" alt="#">
                        </div>

                        <div class="cooperation__adv-desc">
                            Мы берем вознаграждение только за товары, купленные на нашем сайте
                        </div>
                    </div>

                    <div class="cooperation__adv-item cooperation__adv-item_indent-top">
                        <div class="cooperation__adv-title">Прибыль с минимальными усилиями</div>

                        <div class="cooperation__adv-decor">
                            <img src="{{asset('images/cooperation').'/adv-3.png'}}" alt="#">
                        </div>

                        <div class="cooperation__adv-desc">
                            Вы делаете свою любимую работу, а мы решаем все технические вопросы
                        </div>
                        <a name="terms"></a>
                    </div>
                </div>
            </div>
        </section>

      <div class="cooperation__terms  cooperation__section">
        <div class="container">
          <h2 class="cooperation__section-title">Условия сотрудничества</h2>

          <!-- desktop версия -->
          <div class="cooperation__terms-desktop">
            <table class="cooperation__terms-table">
              <tr>
                <th></th>
                <th>
                  <h3 class="cooperation__terms-title">Контрагент</h3>
                </th>
                <th>
                  <h3 class="cooperation__terms-title">Партнер</h3>
                </th>
                <th>
                  <h3 class="cooperation__terms-title">Генеральный партнер</h3>
                </th>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Неограниченное количество товаров или услуг</span></td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Индивидуальный сайт</span></td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Индивидуальный домен</span></td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Домен на 1 год в подарок</span></td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>CRM система</span></td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Наша команда – ваша команда</span>
                </td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Техническая поддержка для партнеров</span></td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Поддержка и обслуживание onionmarket.ru</span></td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Обеспечение вывеской и рекламными материалами за счет нашей
                    компании</span></td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Программа лояльности: кэшбек, реферальная программа</span>
                </td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Один партнер - один город</span></td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Один город - до 5 партнеров</span></td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
                <td>
                  <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                      stroke-linecap="round" />
                  </svg>
                </td>
                <td>
                  <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="close">
                      <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                      <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                        stroke-linecap="round" />
                    </g>
                  </svg>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name"><span>Комиссия с продаж на Маркетплейс</span></td>
                <td>
                  <div class="cooperation__terms-table-error">20%</div>
                </td>
                <td>
                  <div class="cooperation__terms-table-success">8%</div>
                </td>
                <td>
                  <div class="cooperation__terms-table-success">8%</div>
                </td>
              </tr>

              <tr>
                <td class="cooperation__terms-name" ><span>Стоимость</span></td>
                  <td colspan="3">
                      <div class="cooperation__terms-price">Индивидуально для каждого региона</div>
                  </td>
{{--                <td>--}}
{{--                  <div class="cooperation__terms-price">15000₽</div>--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                  <div class="cooperation__terms-price">40000₽</div>--}}
{{--                </td>--}}
              </tr>

              <tr>
                <td class="cooperation__terms-name cooperation__terms-btn"></td>
                <td class="cooperation__terms-btn"><button class="cooperation__button" onclick="cooperation('Стать Контрагентом')">Стать Контрагентом</button></td>
                <td class="cooperation__terms-btn"><button class="cooperation__button" onclick="cooperation('Стать Партнером')">Стать Партнером</button></td>
                <td class="cooperation__terms-btn"><button class="cooperation__button" onclick="cooperation('Стать Генеральным партнером')">Стать Генеральным партнером</button></td>
{{--                <td class="cooperation__terms-btn"><a href="#" class="cooperation__button" onclick="cooperation('Стать Партнером')">Стать Партнером</a></td>--}}
{{--                <td class="cooperation__terms-btn"><a href="{{route('general.partner')}}" class="cooperation__button">Стать Генеральным--}}
{{--                    партнером</a></td>--}}
              </tr>
            </table>
          </div>

          <!-- mobile версия -->
          <div class="cooperation__terms-mobile">
            <div class="cooperation__terms-list">
              <h3 class="cooperation__terms-title">Контрагент</h3>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Неограниченное количество товаров или услуг</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Индивидуальный сайт</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Индивидуальный домен</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Домен на 1 год в подарок</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">CRM система</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Наша команда – ваша команда</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Техническая поддержка для партнеров</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Поддержка и обслуживание onionmarket.ru</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Обеспечение вывеской и рекламными материалами за счет нашей
                  компании</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Программа лояльности: кэшбек, реферальная программа</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Один партнер - один город</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Один город - до 5 партнеров</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Комиссия с продаж на onionmarket.ru</div>
                <div class="cooperation__terms-table-error">20%</div>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Стоимость</div>
{{--                <div class="cooperation__terms-price">Индивидуально для каждого региона</div>--}}
                <div class="cooperation__terms-name">Индивидуально для каждого региона</div>
              </div>

              <div class="cooperation__terms-item">
                <button class="cooperation__button" style="margin: auto;" onclick="cooperation('Стать Контрагентом')">Стать Контрагентом</button>
              </div>
            </div>

            <div class="cooperation__terms-list">
              <h3 class="cooperation__terms-title">Партнер</h3>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Неограниченное количество товаров или услуг</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Индивидуальный сайт</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Индивидуальный домен</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Домен на 1 год в подарок</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">CRM система</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Наша команда – ваша команда</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Техническая поддержка для партнеров</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Поддержка и обслуживание onionmarket.ru</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Обеспечение вывеской и рекламными материалами за счет нашей
                  компании</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Программа лояльности: кэшбек, реферальная программа</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Один партнер - один город</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Один город - до 5 партнеров</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Комиссия с продаж на onionmarket.ru</div>
                <div class="cooperation__terms-table-success">8%</div>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Стоимость</div>
{{--                <div class="cooperation__terms-price">Индивидуально для каждого региона</div>--}}
                <div class="cooperation__terms-name">Индивидуально для каждого региона</div>
              </div>

              <div class="cooperation__terms-item">
                <button class="cooperation__button" style="margin: auto;" onclick="cooperation('Стать Партнером')">Стать Партнером</button>
              </div>
            </div>

            <div class="cooperation__terms-list">
              <h3 class="cooperation__terms-title">Генеральный Партнер</h3>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Неограниченное количество товаров или услуг</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Индивидуальный сайт</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Индивидуальный домен</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Домен на 1 год в подарок</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">CRM система</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Наша команда – ваша команда</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Техническая поддержка для партнеров</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Поддержка и обслуживание onionmarket.ru</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Обеспечение вывеской и рекламными материалами за счет нашей
                  компании</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Программа лояльности: кэшбек, реферальная программа</div>
                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Один партнер - один город</div>

                <svg width="34" height="26" viewBox="0 0 34 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.33301 13.832L11.4997 22.9987L31.6663 2.83203" stroke="#4CD964" stroke-width="4"
                    stroke-linecap="round" />
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Один город - до 5 партнеров</div>
                <svg width="40" height="40" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g id="close">
                    <path id="Path 2" d="M32.3712 32.3702L11.6294 11.6284" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                    <path id="Path 2_2" d="M32.3706 11.6284L11.6288 32.3702" stroke="#D24B6C" stroke-width="4"
                      stroke-linecap="round" />
                  </g>
                </svg>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Комиссия с продаж на onionmarket.ru</div>
                <div class="cooperation__terms-table-success">8%</div>
              </div>

              <div class="cooperation__terms-item">
                <div class="cooperation__terms-name">Стоимость</div>
{{--                <div class="cooperation__terms-price">Индивидуально для каждого региона</div>--}}
                <div class="cooperation__terms-name">Индивидуально для каждого региона</div>
              </div>

{{--                        <div class="cooperation__terms-item">--}}
{{--                            <a href="{{route('general.partner')}}" target="_blank" class="cooperation__button" style="margin: auto;">Стать Генеральным Партнером</a>--}}
{{--                        </div>--}}
                <div class="cooperation__terms-item">
                    <button class="cooperation__button" style="margin: auto;" onclick="cooperation('Стать Генеральным Партнером')">Стать Генеральным Партнером</button>
                </div>
                    </div>
                </div>
            </div>
        </div>

      <section class="cooperation__section">
        <div class="cooperation__wrapper" style="background: #3657C8;">
          <div class="container">
            <h2 class="cooperation__section-title cooperation__section-title_white">Как начать</h2>

            <ol class="cooperation__list">
              <li>
                01.Выбрать вариант сотрудничества
              </li>
              <li>
                02.Заключить договор
              </li>
              <li>
                03.Регистрация на onionmarket.ru
              </li>
              <li>
                04.Загрузка товара и установка цен на сайт
              </li>
              <li>
                05.Заказы на onionmarket.ru
              </li>
              <li>
                06.Выплаты за заказы на onionmarket.ru
              </li>
            </ol>
          </div>

        </div>
      </section>

      <section class="cooperation__faq cooperation__section">
        <div class="container">
          <h2 class="cooperation__section-title">Частые вопросы</h2>

          <ol class="cooperation__faq__list">
            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                  Когда я могу приступить к работе на вашей площадке?
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                  После заключения договора в тот же день Вы сможете загружать свои товары на сайт
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                  Как и где покупатель найдет вашу площадку?
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                    В данный момент мы находимся в стадии разработки, нашим партнерам в Пакете Партнер и Генеральный партнер мы предоставляем вывеску – один из вариантов продвижения бренда. А так же Вы можете давать ссылки на свои страницы с товаром или услугами своим клиентам. В дальнейшем мы будем заниматься рекламой и продвижением площадки onionmarket.ru
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                  Цены постоянно растут, и в личном кабинете могу не успеть их поменять, и нет времени
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                  Мы даем Вам возможность развивать свой бизнес онлайн, поэтому ассортимент товаров и услуг полностью под Вашим контролем, достаточно обновлять ассортимент в день поставки товара или появления новой услуги в Ваш магазин и регулировать цену в личном кабинете.
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                    Почему я должен платить за Ваши услуги, если друге сайты предоставляют услуги только за комиссию
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                    Оплачивая пакет Генеральный партнер, мы предоставляем своим партнерам не только площадку для размещения товаров, но так же сотрудничаем только с одним партнером в городе (В пакете Партнер до 5 партнеров в городе). А так же предоставляем много инструментов для ведения бизнеса. Вы можете выбрать вариант сотрудничества Контрагент и сотрудничать с нами, оплачивая комиссию с продаж на нашей платформе
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                    Можно попробовать начать работать без оплаты,а там посмотрим по заказам и возможно купим другой пакет?
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                    Да, конечно! Выбирайте Пакет сотрудничества Контрагент и продавайте свои товары или услуги с использованием CMS на нашем домене. Но так как мы ограничиваем количество партнеров в городе в платных пакетах, то возможно, место займет другой партнер.
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                  Я должен убрать свои вывески, название и рекламу?
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                    Нет. Вы можете работать под своим именем. В пакете Генеральный партнер и в пакете Партнер мы предоставляем своим партнерам нашу вывеску, промоматериалы и  индивидуальный интернет-магазин, каждый партнер может параллельно с нашей площадкой развивать свой бренд.
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                  Какая у вас комиссия?
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                    В Пакете Генеральный партнер и в пакете Партнер пониженная комиссия, и составляет 8%. В Пакете Контрагент комиссия составляет 20%
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                  Когда и как переводите деньги за товар?
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                    На данный момент переводим деньги за товар по запросу партнера. В планах после интеграции Блокчейн сделать возможность вывода средств самим партнером с баланса площадки onionmarket.ru на банковский счет партнера
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                  У меня будет связь с заказчиком?
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                  Да. После оформления заказа на сайте, вы получаете сообщение о поступившем заказе и можете связаться с
                  покупателем, чтобы
                  сделать изменение в заказе при необходимости.
                </p>
              </div>
            </li>

            <li class="cooperation__faq__item">
              <div class="cooperation__faq__item-top">
                <div class="cooperation__faq__title">
                  Если клиент закажет товар, а его не будет в наличии. Предусмотрены ли какие-то штрафные санкции за
                  отказ от выполнения
                  заказа?
                </div>
                <span class="cooperation__faq__sign"></span>
              </div>

              <div class="cooperation__faq__dropdown">
                <p>
                    После оформления покупателем товара на сайте, у вас будет возможность связаться с заказчиком и обсудить возможность замены товара или услуги. В случае отмены заказа партнером или не выполнения заказа с нашей стороны предусмотрены штрафные санкции.
                </p>
              </div>
            </li>
          </ol>
        </div>
      </section>

      <section class="cooperation__social">
        <div class="container">
          <h2 class="cooperation__section-title">Подпишись на наши социальные сети</h2>

          <div class="cooperation__social-wrapper">
            <div class="cooperation__social-list-wrapper">
              <div class="cooperation__social-list">
                <div class="cooperation__social-item">
                  <a href="https://vk.com/unitedmarketorg" class="cooperation__social-link" target="_blank">
                    <svg width="164" height="164" viewBox="0 0 164 164" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M56.8533 0H107.147C153.067 0 164 10.9333 164 56.8533V107.147C164 153.067 153.067 164 107.147 164H56.8533C10.9333 164 0 153.067 0 107.147V56.8533C0 10.9333 10.9333 0 56.8533 0Z"
                        fill="#2787F5" />
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M134.304 56.5012C135.063 53.9674 134.304 52.1055 130.687 52.1055H118.729C115.688 52.1055 114.287 53.7139 113.526 55.4875C113.526 55.4875 107.445 70.3103 98.8303 79.9387C96.0431 82.7258 94.7761 83.6126 93.2558 83.6126C92.4958 83.6126 91.3954 82.7258 91.3954 80.1921V56.5012C91.3954 53.4606 90.513 52.1055 87.979 52.1055H69.1873C67.2872 52.1055 66.1444 53.5167 66.1444 54.8542C66.1444 57.7366 70.4516 58.4013 70.8956 66.5096V84.1195C70.8956 87.9805 70.1984 88.6805 68.6781 88.6805C64.6241 88.6805 54.7629 73.7914 48.9143 56.7545C47.7681 53.4431 46.6185 52.1055 43.5623 52.1055H31.6039C28.1873 52.1055 27.5039 53.7139 27.5039 55.4875C27.5039 58.6548 31.558 74.3644 46.3807 95.1415C56.2623 109.331 70.1849 117.022 82.8539 117.022C90.4553 117.022 91.3956 115.314 91.3956 112.371V101.647C91.3956 98.2305 92.1157 97.5486 94.5228 97.5486C96.2964 97.5486 99.337 98.4354 106.432 105.277C114.54 113.385 115.877 117.022 120.437 117.022H132.396C135.812 117.022 137.521 115.314 136.535 111.943C135.457 108.582 131.586 103.708 126.449 97.9286C123.661 94.6347 119.481 91.0876 118.214 89.3136C116.44 87.0334 116.947 86.0197 118.214 83.9928C118.214 83.9928 132.783 63.469 134.304 56.5012Z"
                        fill="white" />
                    </svg>
                  </a>
                </div>

                <div class="cooperation__social-item">
                  <a href="https://ok.ru/group/63166575542457" class="cooperation__social-link" target="_blank">
                    <svg width="164" height="162" viewBox="0 0 164 162" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M164 138.294C164 151.387 153.31 162 140.123 162H23.8766C10.6898 162 0 151.387 0 138.294V23.7064C0 10.6136 10.6898 0 23.8766 0H140.123C153.31 0 164 10.6136 164 23.7064V138.294Z"
                        fill="#FAAB62" />
                      <path
                        d="M163.158 137.705C163.158 150.663 152.578 161.168 139.527 161.168H24.4739C11.4226 161.168 0.842773 150.663 0.842773 137.705V24.2947C0.842773 11.3365 11.4231 0.832031 24.4739 0.832031H139.527C152.578 0.832031 163.158 11.3369 163.158 24.2947V137.705Z"
                        fill="#F7931E" />
                      <path
                        d="M81.9091 24.2109C65.6554 24.2109 52.4795 37.2933 52.4795 53.4307C52.4795 69.5685 65.6554 82.6517 81.9091 82.6517C98.1628 82.6517 111.339 69.5685 111.339 53.4307C111.339 37.2933 98.1628 24.2109 81.9091 24.2109ZM81.9091 65.5103C75.1904 65.5103 69.7435 60.1019 69.7435 53.4311C69.7435 46.7603 75.1904 41.3523 81.9091 41.3523C88.6278 41.3523 94.0746 46.7603 94.0746 53.4311C94.0746 60.1019 88.6278 65.5103 81.9091 65.5103Z"
                        fill="white" />
                      <path
                        d="M92.2985 105.903C104.08 103.52 111.141 97.9801 111.514 97.6828C114.962 94.9376 115.516 89.9374 112.751 86.5139C109.986 83.0909 104.95 82.541 101.502 85.2858C101.429 85.3444 93.8988 91.0798 81.5088 91.0881C69.1193 91.0798 61.4298 85.3444 61.3569 85.2858C57.9085 82.541 52.8727 83.0909 50.1083 86.5139C47.3434 89.9374 47.8972 94.9376 51.3448 97.6828C51.7234 97.9843 59.0751 103.668 71.1871 105.995L54.3068 123.511C51.2391 126.67 51.3313 131.699 54.5127 134.745C56.0655 136.232 58.0669 136.97 60.0665 136.97C62.163 136.97 64.2574 136.157 65.8275 134.54L81.5093 117.954L98.775 134.648C101.903 137.749 106.969 137.744 110.091 134.639C113.214 131.534 113.21 126.503 110.083 123.403L92.2985 105.903Z"
                        fill="white" />
                    </svg>
                  </a>
                </div>

                <div class="cooperation__social-item">
                  <a href="https://www.youtube.com/channel/UCns7aIJwqWZFPPwWXd6iq6g" class="cooperation__social-link" target="_blank">
                    <svg width="164" height="164" viewBox="0 0 164 164" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect width="164" height="164" rx="23" fill="#FF0000" />
                      <path
                        d="M158.843 42.9766C156.965 36.063 151.55 30.6493 144.609 28.8002C135.284 25.215 44.9709 23.4584 18.7721 28.9029C11.8305 30.7726 6.39475 36.1657 4.53815 43.0793C0.329848 61.4675 0.0101 101.223 4.64129 120.022C6.51853 126.936 11.9336 132.349 18.8753 134.198C37.3382 138.431 125.114 139.027 144.712 134.198C151.653 132.329 157.089 126.936 158.946 120.022C163.433 99.9902 163.752 62.7002 158.843 42.9766Z"
                        fill="#FF0000" />
                      <path d="M108.302 81.4991L66.2188 57.4609V105.537L108.302 81.4991Z" fill="white" />
                    </svg>
                  </a>
                </div>

                <div class="cooperation__social-item">
                  <a href="https://t.me/unitedmarket" class="cooperation__social-link" target="_blank">
                    <svg width="164" height="164" viewBox="0 0 164 164" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g clip-path="url(#clip0_3368_45826)">
                        <path
                          d="M82.0342 164.068C127.34 164.068 164.068 127.34 164.068 82.0342C164.068 36.728 127.34 0 82.0342 0C36.728 0 0 36.728 0 82.0342C0 127.34 36.728 164.068 82.0342 164.068Z"
                          fill="url(#paint0_linear_3368_45826)" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M37.0893 81.1465C60.996 70.7641 76.911 63.8653 84.9027 60.5184C107.648 51.024 112.43 49.3847 115.503 49.3164C116.186 49.3164 117.689 49.453 118.714 50.2727C119.533 50.9557 119.738 51.8437 119.875 52.5267C120.011 53.2098 120.148 54.6442 120.011 55.7371C118.782 68.715 113.454 100.204 110.722 114.684C109.561 120.832 107.307 122.881 105.121 123.086C100.34 123.495 96.7194 119.944 92.143 116.938C84.9027 112.225 80.8727 109.288 73.8373 104.643C65.709 99.3156 70.9685 96.3784 75.6132 91.5971C76.8427 90.3676 97.8123 71.2423 98.2221 69.5346C98.2905 69.3297 98.2904 68.5101 97.8123 68.1002C97.3342 67.6904 96.6511 67.827 96.1047 67.9636C95.3533 68.1002 83.8781 75.7504 61.5424 90.8458C58.2638 93.0998 55.3267 94.1927 52.6628 94.1244C49.7257 94.0561 44.1247 92.4851 39.8898 91.119C34.7669 89.4797 30.6686 88.5917 31.0101 85.7229C31.2151 84.2202 33.2642 82.7175 37.0893 81.1465Z"
                          fill="white" />
                      </g>
                      <defs>
                        <linearGradient id="paint0_linear_3368_45826" x1="81.9659" y1="0" x2="81.9659" y2="162.771"
                          gradientUnits="userSpaceOnUse">
                          <stop stop-color="#2AABEE" />
                          <stop offset="1" stop-color="#229ED9" />
                        </linearGradient>
                        <clipPath id="clip0_3368_45826">
                          <rect width="164" height="164" fill="white" />
                        </clipPath>
                      </defs>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
              <div class="cooperation__social-img">
                  <img src="{{asset('images/cooperation/social_banner.png')}}" alt="#">
              </div>
          </div>
        </div>
        </section>
    </div>
</div>
@include('livewire.includes.collaboration-partner-form')