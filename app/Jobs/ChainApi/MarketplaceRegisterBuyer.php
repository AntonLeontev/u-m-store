<?php

namespace App\Jobs\ChainApi;

use App\Helpers\BlockChain\UmtApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarketplaceRegisterBuyer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $address;
    public function __construct($address)
    {

        $this->address =$address;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Запускаем в очередь создание продукты в блокчейне.
        UmtApi::MarketplaceRegisterBuyer($this->address);
    }

}
