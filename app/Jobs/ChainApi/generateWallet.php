<?php

namespace App\Jobs\ChainApi;

use App\Helpers\BlockChain\RunNodeJsScript;
use App\Helpers\BlockChain\UmtApi;
use App\Helpers\UmHelp;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class generateWallet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $password_for_wallet;
    protected $auth_user;

    public function __construct($password_for_wallet, User $auth_user)
    {
        $this->password_for_wallet =$password_for_wallet;
        $this->auth_user=$auth_user;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Запускаем в очередь создания кошелька для пользователя в фоне.
        RunNodeJsScript::generateWallet($this->password_for_wallet, $this->auth_user);
    }


}
