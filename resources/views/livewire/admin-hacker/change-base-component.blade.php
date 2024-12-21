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
            <label class="col-md-4 control-label mb-3">Выбор категори для которой создать отзывы</label>
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



