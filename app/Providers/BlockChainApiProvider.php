<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlockChainApiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        require_once app_path() . '/Helpers/BlockChain/UmtApi.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
