@push('head')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/doc.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush
<div class="wrapper">
    <div class="content">
        <section class="major">
            <div class="container">
                <a href="#" class="major__btn-prev"></a>
                <div class="major__inner">
                    <a href="#" class="major__btn-prev"></a>
                    <div class="major__breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><a href="{{route('admin.dashboard')}}">Профиль</a></li>
                            <li><span>Настройки сайта</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="profile">
            <div class="container">
                <div class="profile__inner">
                    <div class="profile__title active">Профиль партнера</div>
                    <div class="profile__wrapper">
                        @include('livewire.admin.includes.main-menu')
                        <div class="set__inner">
                            @include('livewire.admin.includes.mobile-main-menu')

                            <div class="set__one">
                                <div class="set__step">Информация о вашем сайте:</div>
                                <div class="set__form" style="max-width: 550px; width: 100%">
                                    <form enctype="multipart/form-data" wire:submit.prevent="saveSeoTags">
                                        @csrf
                                        <div class="set__pos">
                                            Мета теги на главной<span class="label__partner"></span></div>
                                        <textarea type="text" wire:model="home_tags"  placeholder="<title>Доставка цветов от оптовой базы. Заказать Цветы на дом</title>" style="border: 2px solid #bfc6e0; width: 100%" rows="10" wrap="off"> </textarea>

                                        <div class="set__pos">
                                            Мета теги на странице категории<span class="label__partner"></span></div>
                                        <textarea type="text" wire:model="category_tags"  placeholder="<title>Доставка цветов от оптовой базы. Заказать Цветы на дом</title>" style="border: 2px solid #bfc6e0; width: 100%" rows="10" wrap="off"> </textarea>

                                        <div class="set__pos">
                                            Мета теги на странице товара<span class="label__partner"></span>
                                        </div>
                                        <textarea type="text" wire:model="product_tags"  placeholder="<title>Доставка цветов от оптовой базы. Заказать Цветы на дом</title>" style="border: 2px solid #bfc6e0; width: 100%" rows="10" wrap="off"> </textarea>

                                        <div class="set__pos">
                                            Метрики<span class="label__partner"></span>
                                        </div>
                                        <textarea type="text" wire:model="metrika"  placeholder="Сюда можно вписать яндекс, qoogle и другие метрики" style="border: 2px solid #bfc6e0; width: 100%" rows="10" wrap="off"> </textarea>

                                        <div class="reg__flex">
                                            <button style="display: block; margin-left: auto; margin-right: auto;" type="submit">Сохранить</button>
                                        </div>
                                    </form>
                                    @if(session()->has('success'))
                                        <div class="alert-success" style="max-width: 550px; margin-top: 15px;"><span>Данные успешно сохранены.</span>
                                        </div>
                                    @elseif(session()->has('error'))
                                        <div class="alert-danger" style="max-width: 550px; margin-top: 15px;"><span>Ошибка такой домен уже зарегистрирован.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('footer')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@endpush
