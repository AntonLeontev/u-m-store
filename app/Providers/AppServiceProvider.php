<?php

namespace App\Providers;



use App\Helpers\UmHelp;
use App\Models\CloneSiteInformation;
use App\Models\Directions;
use App\Models\Store;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Jenssegers\Date\Date;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            // $this->app->register(TelescopeServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if(env('FORCE_HTTPS',false)) { // Default value should be false for local server
            URL::forceScheme('https');
        }

        if ($domain = UmHelp::checkOurDomain()) {
            session()->put('domain',$domain);
        } else {
			session()->forget('domain');
		}
		
        View::share('domain',$domain);
//        Date::setlocale(config('app.locale'));

    }
}
