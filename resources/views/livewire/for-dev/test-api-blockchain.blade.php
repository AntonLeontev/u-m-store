{{--GetInfo--}}
<div class="container mt-5">
    <div>
        <label for="basic-url" class="form-label">URL запроса</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">https://host/</span>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>
    </div>
    <button type="button" class="btn btn-success" wire:click.prevent="GetInfo">GetInfo</button>
    <button type="button" class="btn btn-danger" wire:click.prevent="SessionFlushClear">Удалить ответ</button>
    @if(session()->has('GetInfo'))
        <div class="alert alert-success mt-3" role="alert">
            <pre>
            {{session()->get('GetInfo')}}
            </pre>
        </div>
    @endif
</div>
<hr>
{{--GetTxStatus--}}
<div class="container mt-5">
    <div>
        <label for="basic-url" class="form-label">URL запроса</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">http://@{{HOST}}/tx/</span>
            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" wire:model="GetTxStatus">
        </div>
    </div>
    <button type="button" class="btn btn-success" wire:click.prevent="GetTxStatus">GetTxStatus</button>
    <button type="button" class="btn btn-danger" wire:click.prevent="SessionFlushClear">Удалить ответ</button>
    @if(session()->has('GetTxStatus'))
        <div class="alert alert-success" role="alert">
            <pre>
            {{session()->get('GetTxStatus')}}
            </pre>
        </div>
    @endif
</div>
