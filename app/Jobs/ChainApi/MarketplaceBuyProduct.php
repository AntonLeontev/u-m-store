<?php

namespace App\Jobs\ChainApi;

use App\Helpers\BlockChain\UmtApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarketplaceBuyProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $id;
    protected $amount;
    protected $buyer_address;

    public function __construct($id, $amount, $buyer_address)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->buyer_address = $buyer_address;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Запускаем в очередь покупку продукта в блокчейне.
        UmtApi::MarketplaceBuyProduct($this->id, $this->amount, $this->buyer_address);
    }

}
