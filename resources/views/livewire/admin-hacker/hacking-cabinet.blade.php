<div class="container mt-5 col-lg-8">
    <div class="col-3">
        <form metod="POST" wire:submit.prevent="save">
            @csrf
            @if(Session::has('file_load'))
                <div class="alert alert-success mt-4" role="alert">{{Session::get('file_load')}}</div>
            @endif
                <input type="file" wire:model="exel_file" class="form-control">

            @error('exel_file') <span class="error">{{ $message }}</span> @enderror

            <button type="submit" class="btn btn-primary mt-3 mb-3">Загрузить файл exel</button>

        </form>
    </div>
    <div class="col-auto">
        @if(Session::has('file_to_database'))
            <div class="alert alert-success col-lg-5 mt-4" role="alert">{{Session::get('file_to_database')}}</div>
        @endif
        @if(Session::has('file_to_database_error'))
            <div class="alert alert-danger col-lg-5 mt-4" role="alert">{{Session::get('file_to_database_error')}}</div>
        @endif
    <button class="btn btn-primary mt-3 mb-3" wire:click.prevent="loadExelIntoDatabase">Загрузить файл в базу данных
    </button>
</div>
    <form class="row g-6">
        @csrf
        <div class="col-lg-6 mt-6">
            @if(Session::has('user_make'))
                <div class="alert alert-success col-lg-6 mt-4" role="alert">{{Session::get('user_make')}}</div>
            @endif
            @if(Session::has('user_make_error'))
                <div class="alert alert-danger col-lg-6 mt-4" role="alert">{{Session::get('user_make_error')}}</div>
            @endif
            <button class="btn btn-primary mb-3" wire:click.prevent="makeFakeUser">Создать фейковых пользователей
            </button>
        </div>

        <div>
            <div class="form-group">
                <label class="col-md-4 control-label mb-3" >Выбор категори для которой создать отзывы</label>
                <div class="col-md-4">
                    <select class="form-control" wire:model="direction_id">
                        @foreach($directions as $direction)
                        <option value="{{$direction->id}}">{{$direction->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary mt-3 mb-3" wire:click.prevent="makeFakeReviews">Создать
                    фейковые отзывы
                </button>
            </div>
            @if(Session::has('reviews_error'))
                <div class="alert alert-danger col-lg-5 mt-4" role="alert">{{Session::get('reviews_error')}}</div>
            @endif
            @if(Session::has('reviews'))
                <div class="alert alert-success col-lg-5 mt-4" role="alert">{{Session::get('reviews')}}</div>
            @endif
        </div>
    </form>
</div>

</div>

{{--<div>--}}
{{--    <div class="container" style="padding: 30px 0;">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="panel panel-default">--}}
{{--                    <div class="panel-heading">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                Создать фейковые отзывы--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="panel-body">--}}
{{--                        @if(Session::has('message'))--}}
{{--                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>--}}
{{--                        @endif--}}
{{--                        <form class="form-horizontal" >--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-md-4 control-label">Direction_id</label>--}}
{{--                                <div class=" col-md-4">--}}
{{--                                    <select class="form-control" wire:model="direction_id">--}}
{{--                                        <option value="">Выбрать вид деятельности...</option>--}}
{{--                                        @foreach($directions as $direction)--}}
{{--                                            <option value="{{$direction->id}}">{{$direction->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                        @error('name') <p class="text-danger">{{$message}}</p> @enderror--}}

{{--                                </div>--}}
{{--                                <div class="form-group mt-5">--}}
{{--                                    <div class="mt-6 col-md-4">--}}
{{--                                        <button type="submit" class="btn btn-primary">Создать фейковые отзывы</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

