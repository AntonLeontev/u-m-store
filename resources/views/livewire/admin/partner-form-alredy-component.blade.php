<div class="content">
    <section class="profile">
        <div class="container">
            <div class="profile__inner">
                <div class="profile__title active"></div>
                <div class="profile__wrapper">
                    <div class="set__inner">
                        <div class="set__one">
                            <div class="set__form">
                                <div class="set__pos">Данные успешно отправлены
                                    - {{$user_check->created_at->format('время G:i:s  дата d.m.Y')}}. Номер заявки
                                    100-500-{{$user_check->id}}.
                                </div>
                                <div class="set__pos">Повторная отправка данных невозможна!</div>
                                <div class="set__pos">После валидации вы сможете изменить или дополнить эти данные в
                                    профиле партнера.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

