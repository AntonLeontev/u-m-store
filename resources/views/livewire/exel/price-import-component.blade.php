<div class="container mt-5 col-lg-8">
    <div class="form-group  mb-3 col-md-6">
        <label class="control-label mb-2" for="name">Выбор города</label>
        <div>
            <select class="form-control"  wire:model="store_id">
                {{--                                                Выводим все города --}}
                <option value="0" >Выберите город</option>
                @foreach($allStores as $store)
                    <option value="{{ $store->id }}" >{{ $store->real_name}}</option>
                @endforeach
            </select>
            @if(Session::has('no_store'))
                <div class="alert alert-danger mt-4" role="alert">{{Session::get('no_store')}}</div>
            @endif
        </div>
    </div>
    <div class="col-6">
        <form metod="POST" wire:submit.prevent="save">
            @csrf
            @if(Session::has('file_load'))
                <div class="alert alert-success mt-4" role="alert">{{Session::get('file_load')}}</div>
            @endif
                @if(Session::has('file_not_load'))
                    <div class="alert alert-danger mt-4" role="alert">{{Session::get('file_not_load')}}</div>
                @endif
            <div>
            <input type="file" wire:model="exel_file" class="form-control">
                <div wire:loading wire:target="exel_file">Загрузка файла на проверку...</div>
            </div>
            @error('exel_file') <span class="error">{{ $message }}</span> @enderror

            <button type="submit" class="btn btn-primary mt-3 mb-3">Загрузить файл exel</button>

        </form>
    </div>

    <div class="col-auto">
        @if(Session::has('file_to_database'))
            <div class="alert alert-success col-lg-6 mt-4" role="alert">{{Session::get('file_to_database')}}</div>
        @endif
        @if(Session::has('file_to_database_error'))
            <div class="alert alert-danger col-lg-6 mt-4" role="alert">{{Session::get('file_to_database_error')}}</div>
        @endif
        @if(Session::has('no_file'))
            <div class="alert alert-danger col-lg-6 mt-4" role="alert">{{Session::get('no_file')}}</div>
        @endif

        <button class="btn btn-primary mt-3 mb-3" wire:click.prevent="loadExelIntoDatabase">Загрузить файл в базу
            данных</button>


    </div>
</div>



