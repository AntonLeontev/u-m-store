
<div class="container p-4">

    <div class="">
        <button type="button" class="btn btn-primary mb-3 " wire:click.prevent="sql" disabled>Запуск запроса</button>
    </div>
    <div>
        <button type="button" class="btn btn-primary mb-3" wire:click.prevent="roundPriceProduct">цены 99 в таблице Products</button>
    </div>
    <div>
        <button type="button" class="btn btn-primary mb-3" wire:click.prevent="roundPriceProductToStore">цены 99 в таблице Product_to_store</button>
    </div>
    <div>
        <button type="button" class="btn btn-primary mb-3" wire:click.prevent="roundPriceProductOptionValue">цены 99 в таблице Product_option_value</button>
    </div>
    <div>
        <button type="button" class="btn btn-primary mb-3" wire:click.prevent="makeSlag">Slug in categories</button>
    </div>
</div>

