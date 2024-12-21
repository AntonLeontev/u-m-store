<?php

namespace App\Jobs\ChainApi;

use App\Helpers\BlockChain\UmtApi;
use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarketplaceRegisterSeller implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $address;
    protected $commission;
    public function __construct($address,$commission)
    {
        //
        $this->address = $address;
        $this->commission = $commission;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Запуск в очередь регистрации продавца в блокчейне.
        UmtApi::MarketplaceRegisterSeller($this->address, $this->commission);
    }

}
