<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsAndCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$regions = [
			['fias' => 'd00e1013-16bd-4c09-b3d5-3cb09fc54bd8', 'name' => 'Краснодарский край'],
			['fias' => '1b507b09-48c9-434f-bf6f-65066211c73e', 'name' => 'Еврейская Аобл'],
		];

		$cities = [
			['fias' => '7339e834-2cb4-4734-a4c7-1fca2c66e562', 'name' => 'Уфа', 'region_fias' => 'd00e1013-16bd-4c09-b3d5-3cb09fc54bd8'],
			['fias' => 'a4859da8-9977-4b62-8436-4e1b98c5d13f', 'name' => 'Хабаровск', 'region_fias' => 'd00e1013-16bd-4c09-b3d5-3cb09fc54bd8'],
			['fias' => 'dd8caeab-c685-4f2a-bf5f-550aca1bbc48', 'name' => 'Чебоксары', 'region_fias' => '1b507b09-48c9-434f-bf6f-65066211c73e'],
			['fias' => 'a376e68d-724a-4472-be7c-891bdb09ae32', 'name' => 'Челябинск', 'region_fias' => '1b507b09-48c9-434f-bf6f-65066211c73e'],
			['fias' => 'c58d0505-54eb-4c34-8216-b14f7cdb0ecb', 'name' => 'Энгельс', 'region_fias' => '1b507b09-48c9-434f-bf6f-65066211c73e'],
		];

		foreach ($regions as $region) {
			DB::table('regions')->insert($region);
		}
		foreach ($cities as $city) {
			DB::table('cities')->insert($city);
		}
    }
}
