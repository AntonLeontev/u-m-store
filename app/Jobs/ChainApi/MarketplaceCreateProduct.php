<?php

namespace App\Jobs\ChainApi;

use App\Helpers\BlockChain\UmtApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarketplaceCreateProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $id;
    protected $price;
    protected $seller_address;

    public function __construct($id, $price, $seller_address)
    {
        $this->id =$id;
        $this->price =$price;
        $this->seller_address =$seller_address;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Запускаем в очередь создание продукта в блокчейне.
        UmtApi::MarketplaceCreateProduct($this->id, $this->price, $this->seller_address);

    }

}
