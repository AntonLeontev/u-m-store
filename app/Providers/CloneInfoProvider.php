<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CloneInfoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/SiteClone/CloneInfo.php';
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
