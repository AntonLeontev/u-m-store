<div>
    <div class="container">
        <p class="text-danger fs-3">Ошибка! Данного города нет в базе данных.</p>
        <p class="text-secondary">Если хотите быстро добавить данный город воспользуйтесь этой формой.</p>
        <form wire:submit.prevent="addCityToBase">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Название города</label>
                <input type="text" class="form-control" wire:model.debounce.500ms="new_city_name">
                <div id="emailHelp" class="form-text">Измените название города, если нужно. </div>
                @error('new_city_name')
                <div><span class="text-danger">{{ $message }}</span></div>@enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Статус города.</label>
                <select class="form-select" aria-label="Default select example" wire:model="status">
                    <option value="1">Включен</option>
                    <option value="0" selected>Выключен</option>
                </select>
                <div id="emailHelp" class="form-text">Можете оставить значение по умолчанию.</div>
                @error('status')
                <div><span class="text-danger">{{ $message }}</span></div>@enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Slug</label>
                <input type="text" class="form-control" wire:model="slug">
                <div id="emailHelp" class="form-text">Можете оставить значения по умолчанию.</div>
            </div>
            <div class="mb-3">
                <div id="emailHelp" class="form-text">Остальные значения вносятся автоматически.</div>
            </div>
            @error('slug')
            <div><span class="text-danger">{{ $message }}</span></div>@enderror
            <x-honey/>
            <x-honey recaptcha/>
            <button type="submit" class="btn btn-primary">Добавить город в базу</button>
        </form>
        @if(session()->has('message'))
        <div class="alert alert-success mt-3" role="alert">
            {{session()->get('message')}}
        </div>

        @endif
        @if(session()->has('error-massege'))
            <div class="alert alert-danger mt-3" role="alert">
                {{session()->get('error-message')}}
            </div>
        @endif
        <a class="btn btn-primary mt-3" href="{{$url_back}}" role="button">Вернутся к валидации партнера</a>
    </div>
</div>
