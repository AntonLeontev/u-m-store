<?php

namespace App\Jobs\ChainApi;

use App\Helpers\BlockChain\UmtApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UMTBurn implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $amount;
    protected $buyer_address;
    public function __construct($amount, $buyer_address)
    {
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
       UmtApi::UMTBurn($this->amount, $this->buyer_address);
    }
}
