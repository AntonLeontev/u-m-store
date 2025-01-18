<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class HttpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Http::macro('alfabank', function () {
			return Http::baseUrl('https://partner.alfabank.ru/public-api/v2')
				->asJson()
				->withHeaders([
					'API-key' => config('services.alfabank.key'),
				]);
		});
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
