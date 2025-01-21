<?php

namespace App\Services\Alfabank;

class AlfabankService
{
	public function __construct(public AlfabankApi $api)
	{
	}
	public function sendLead(
		string $organizationName,
		string $inn,
		string $fullName,
		string $phone,
		string $cityCode,
		array $products = [],
	): string {
		$data = [
			'organizationInfo' => [
				'organizationName' => $organizationName,
				'inn' => $inn,
			],
			'contactInfo' => [
				[
					'fullName' => $fullName,
					'phoneNumber' => $phone,
				],
			],
			'requestInfo' => [
				'cityCode' => $cityCode,
			],
			'productInfo' => [
				['productCode' => 'LP_RKO'],
			],
		];

		foreach ($products as $product) {
			$data['productInfo'][] = ['productCode' => $product];
		}

		return $this->api->createLead($data)->json('id');
	}

	public function getCities(): array
	{
		return $this->api->getCities()->json('values');
	}

	public function getRegions(): array
	{
		return $this->api->getRegions()->json('values');
	}
}
