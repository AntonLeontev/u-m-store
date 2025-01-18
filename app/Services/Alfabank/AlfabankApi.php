<?php

namespace App\Services\Alfabank;

use Illuminate\Support\Facades\Http;

class AlfabankApi
{
	public function createLead(array $data)
	{
		$response =  Http::alfabank()
			->post('/leads', $data);

		if (!empty($response->json('errors.0.code'))) {
			throw new AlfabankException($response->json('errors.0.code') . ': ' . $response->json('errors.0.detail'), 1);
		}

		return $response;
	}

	public function getCities()
	{
		$response =  Http::alfabank()
			->get('/dictionaries?code=cities');

		if (!empty($response->json('errors.0.code'))) {
			throw new AlfabankException($response->json('errors.0.code') . ': ' . $response->json('errors.0.detail'), 1);
		}

		return $response;
	}

	public function getRegions()
	{
		$response =  Http::alfabank()
			->get('/dictionaries?code=regions');

		if (!empty($response->json('errors.0.code'))) {
			throw new AlfabankException($response->json('errors.0.code') . ': ' . $response->json('errors.0.detail'), 1);
		}

		return $response;
	}
}
