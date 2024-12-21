@push('head')
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <div class="major__inner">
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">Профиль</a></li>
                            <li><a href="#">Заказы</a></li>
                            <li><span>Отзывы</span></li>
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
                        <div class="review__inner">
                            <div class="promotions__choose">Фильтры</div>
                            <div class="promotions__hide">
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox1" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox1">Профиль</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox2" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox2">Настройки профиля</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox3" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox3">Уведомления</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox4" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox4">Заказы</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox5" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox5">Бонусы и промокоды</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox6" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox6">Доставки</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox7" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox7">Электронные чеки</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox8" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox8">Реферальная программа</label>
                                </div>
                                <div class="promotion__br">
                                    <input class="custom-checkbox" id="checkbox9" onclick="location.href = '#'" class="promotions__mobClick" type="checkbox"><label for="checkbox9">Выйти</label>
                                </div>
                            </div>
                            <div class="review__choose">
                                <div class="review__item">Добавить отзыв</div>
                                <div class="review__item">Мои отзывы (2)</div>
                            </div>
                            <div class="review__block">
                                <form class="review__form">
                                    @csrf
                                    <div class="review__top">
                                        Добавить оценку (необязательное поле)
                                        <div class="rating-area">
                                            <input type="radio" id="star-5" name="rating" value="5">
                                            <label for="star-5" title="Оценка «5»"></label>
                                            <input type="radio" id="star-4" name="rating" value="4">
                                            <label for="star-4" title="Оценка «4»"></label>
                                            <input type="radio" id="star-3" name="rating" value="3">
                                            <label for="star-3" title="Оценка «3»"></label>
                                            <input type="radio" id="star-2" name="rating" value="2">
                                            <label for="star-2" title="Оценка «2»"></label>
                                            <input type="radio" id="star-1" name="rating" value="1">
                                            <label for="star-1" title="Оценка «1»"></label>
                                        </div>
                                    </div>
                                    <div class="review__top">Тема</div>
                                    <div class="review__unit">
                                        <div class="review__field">
                                            <input type="text" placeholder="Пожелания / Замечания" id="reviewTheme" readonly>
                                            <div class="review__arrow" id="reviewArrow1">
                                                <img src="images/arrowMenu.svg" alt="">
                                            </div>
                                            <div class="review__items" id="reviewItems">
                                                <div class="review__point reviewPoint">Пожелания/ Замечания</div>
                                                <div class="review__point reviewPoint">Оформление заказ</div>
                                                <div class="review__point reviewPoint">Оплата заказа </div>
                                                <div class="review__point reviewPoint">Доставка</div>
                                                <div class="review__point reviewPoint">Возврат</div>
                                                <div class="review__point reviewPoint">Благодарность</div>
                                                <div class="review__point reviewPoint">Вопросы по акциям и скидкам</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review__top">Категория</div>
                                    <div class="review__unit">
                                        <div class="review__field">
                                            <input type="text" placeholder="Категория" id="reviewInput" readonly>
                                            <div class="review__arrow" id="reviewArrow2">
                                                <img src="images/arrowMenu.svg" alt="">
                                            </div>
                                            <div class="review__items" id="reviewCategory">
                                                <div class="review__point reviewUnit">Авто</div>
                                                <div class="review__point reviewUnit">Доставка букетов</div>
                                                <div class="review__point reviewUnit">Детские игрушки</div>
                                                <div class="review__point reviewUnit">Дизайн Интерьеров</div>
                                                <div class="review__point reviewUnit">Доставка еды</div>
                                                <div class="review__point reviewUnit">Зоотовары</div>
                                                <div class="review__point reviewUnit">Кальянные</div>
                                                <div class="review__point reviewUnit">Клининг</div>
                                                <div class="review__point reviewUnit">Кузнечные мастерские</div>
                                                <div class="review__point reviewUnit">Кузнечные мастерские</div>
                                                <div class="review__point reviewUnit">Организация праздников</div>
                                                <div class="review__point reviewUnit">Подарки ручной работы</div>
                                                <div class="review__point reviewUnit">Пошив и ремонт одежды</div>
                                                <div class="review__point reviewUnit">Салон красоты</div>
                                                <div class="review__point reviewUnit">Сервисный центр – ремонт техники</div>
                                                <div class="review__point reviewUnit">Столярные мастерские</div>
                                                <div class="review__point reviewUnit">Строительство</div>
                                                <div class="review__point reviewUnit">Товары 18+</div>
                                                <div class="review__point reviewUnit">Туры и Отели</div>
                                                <div class="review__point reviewUnit">Фитнес и спорт</div>
                                                <div class="review__point reviewUnit">Фотоуслуги и видео услуги</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review__top">Текст</div>
                                    <textarea type="text" placeholder="Введите текст отзыва ..."></textarea>
                                    <button>Отправить</button>
                                </form>
                            </div>
                            <div class="review__block">
                                <div class="review__one">
                                    <div class="review__up">
                                        <div class="review__photo">
                                            <img src="images/review.jpg" alt="">
                                        </div>
                                        <div class="review__pos review__st">
                                            <div class="review__name">Статус:</div>
                                            <div class="review__value">Опубликован</div>
                                            <div class="review__star">4.0</div>
                                        </div>
                                        <div class="review__pos review__dat">
                                            <div class="review__name">Дата отзыва:</div>
                                            <div class="review__value">20.03.2021</div>
                                        </div>
                                        <div class="review__pos review__theme">
                                            <div class="review__name">Тема:</div>
                                            <div class="review__value">Доставка</div>
                                        </div>
                                        <div class="review__pos">
                                            <div class="review__name">Раздел:</div>
                                            <div class="review__value">Услуги</div>
                                        </div>
                                    </div>
                                    <div class="review__up review__up--mob">
                                        <div class="review__flex">
                                            <div class="review__photo">
                                                <img src="images/review.jpg" alt="">
                                            </div>
                                            <div class="review__uno">
                                                <div class="review__pos review__st">
                                                    <div class="review__name">Статус:</div>
                                                    <div class="review__value">Опубликован</div>
                                                </div>
                                                <div class="review__pos review__dat">
                                                    <div class="review__name">Дата отзыва:</div>
                                                    <div class="review__value">20.03.2021</div>
                                                </div>
                                                <div class="review__pos review__theme">
                                                    <div class="review__name">Тема:</div>
                                                    <div class="review__value">Доставка</div>
                                                </div>
                                                <div class="review__pos">
                                                    <div class="review__name">Раздел:</div>
                                                    <div class="review__value">Услуги</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review__star">4.0</div>
                                    </div>
                                    <div class="review__box">
                                        <div class="review__grid">
                                            <div class="review__designation review__designation--review">Отзыв:</div>
                                            <div class="review__star review__star--mob">4.0</div>
                                        </div>
                                        <div class="review__text">Товарищи! постоянное информационно-пропагандистское обеспечение нашей деятельности обеспечивает широкому кругу (специалистов) участие в формировании позиций, занимаемых участниками в отношении поставленных задач. Повседневная практика показывает, что реализация намеченных плановых заданий способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Идейные соображения высшего порядка, а также укрепление и развитие структуры позволяет оценить значение системы обучения кадров, соответствует насущным потребностям. Не следует, однако забывать, что рамки и место обучения кадров в значительной степени обуславливает создание новых предложений. Задача организации, в особенности же укрепление и развитие структуры влечет за собой процесс внедрения и модернизации новых предложений. Идейные соображения высшего порядка, а также рамки и место обучения кадров позволяет оценить значение позиций, занимаемых участниками в отношении поставленных задач.</div>
                                    </div>
                                    <div class="review__box">
                                        <div class="review__designation">Ответ компании:</div>
                                        <div class="review__answer">
                                            <div class="review__comp">
                                                <img src="images/when.jpg" alt="">
                                            </div>
                                            <div class="review__when">20.02.2021</div>
                                        </div>
                                        <div class="review__text">Товарищи! постоянное информационно-пропагандистское обеспечение нашей деятельности обеспечивает широкому кругу (специалистов) участие в формировании позиций, занимаемых участниками в отношении поставленных задач. Повседневная практика показывает, что реализация намеченных плановых заданий способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Идейные соображения высшего порядка, а также укрепление и развитие структуры позволяет оценить значение системы обучения кадров, соответствует насущным потребностям. Не следует, однако забывать, что рамки и место обучения кадров в значительной степени обуславливает создание новых предложений. Задача организации, в особенности же укрепление и развитие структуры влечет за собой процесс внедрения и модернизации новых предложений. Идейные соображения высшего порядка, а также рамки и место обучения кадров позволяет оценить значение позиций, занимаемых участниками в отношении поставленных задач.</div>
                                    </div>
                                </div>
                                <div class="review__one">
                                    <div class="review__up">
                                        <div class="review__photo">
                                            <img src="images/review.jpg" alt="">
                                        </div>
                                        <div class="review__pos review__st">
                                            <div class="review__name">Статус:</div>
                                            <div class="review__value">Опубликован</div>
                                            <div class="review__star">4.0</div>
                                        </div>
                                        <div class="review__pos review__dat">
                                            <div class="review__name">Дата отзыва:</div>
                                            <div class="review__value">20.03.2021</div>
                                        </div>
                                        <div class="review__pos review__theme">
                                            <div class="review__name">Тема:</div>
                                            <div class="review__value">Доставка</div>
                                        </div>
                                        <div class="review__pos">
                                            <div class="review__name">Раздел:</div>
                                            <div class="review__value">Услуги</div>
                                        </div>
                                    </div>
                                    <div class="review__up review__up--mob">
                                        <div class="review__flex">
                                            <div class="review__photo">
                                                <img src="images/review.jpg" alt="">
                                            </div>
                                            <div class="review__uno">
                                                <div class="review__pos review__st">
                                                    <div class="review__name">Статус:</div>
                                                    <div class="review__value">Опубликован</div>
                                                </div>
                                                <div class="review__pos review__dat">
                                                    <div class="review__name">Дата отзыва:</div>
                                                    <div class="review__value">20.03.2021</div>
                                                </div>
                                                <div class="review__pos review__theme">
                                                    <div class="review__name">Тема:</div>
                                                    <div class="review__value">Доставка</div>
                                                </div>
                                                <div class="review__pos">
                                                    <div class="review__name">Раздел:</div>
                                                    <div class="review__value">Услуги</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review__star">4.0</div>
                                    </div>
                                    <div class="review__box">
                                        <div class="review__grid">
                                            <div class="review__designation review__designation--review">Отзыв:</div>
                                            <div class="review__star review__star--mob">4.0</div>
                                        </div>
                                        <div class="review__text">Товарищи! постоянное информационно-пропагандистское обеспечение нашей деятельности обеспечивает широкому кругу (специалистов) участие в формировании позиций, занимаемых участниками в отношении поставленных задач. Повседневная практика показывает, что реализация намеченных плановых заданий способствует подготовки и реализации позиций, занимаемых участниками в отношении поставленных задач. Идейные соображения высшего порядка, а также укрепление и развитие структуры позволяет оценить значение системы обучения кадров, соответствует насущным потребностям. Не следует, однако забывать, что рамки и место обучения кадров в значительной степени обуславливает создание новых предложений. Задача организации, в особенности же укрепление и развитие структуры влечет за собой процесс внедрения и модернизации новых предложений. Идейные соображения высшего порядка, а также рамки и место обучения кадров позволяет оценить значение позиций, занимаемых участниками в отношении поставленных задач.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
