<?php

namespace App\Console\Commands;

use App\Services\Alfabank\AlfabankService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LoadCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-cities';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(AlfabankService $service)
    {
		$this->info('Загрузка регионов...');

		DB::table('regions')->delete();

		$response = $service->getRegions();

		foreach ($response as $region) {
			DB::table('regions')->insert([
				'fias' => $region['fias'],
				'name' => $region['name'],
			]);
		}

		$this->info('Загрузка городов...');

		DB::table('cities')->delete();

		$response = $service->getCities();

		foreach ($response as $city) {
			DB::table('cities')->insert([
				'fias' => $city['fias'],
				'name' => $city['name'],
				'region_fias' => $city['regionFias'],
			]);
		}

        return 0;
    }
}
