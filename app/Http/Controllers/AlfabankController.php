<?php

namespace App\Http\Controllers;

use App\Services\Alfabank\AlfabankService;
use Illuminate\Http\Request;

class AlfabankController extends Controller
{
    public function __invoke(Request $request, AlfabankService $service)
	{
		if (str_starts_with($request->get('phoneNumber'), '8')) {
			$request->merge(['phoneNumber' => '7'.substr($request->get('phoneNumber'), 1)]);
		}

		$request->validate([
			'organizationName' => ['required', 'string', 'max:255'],
			'inn' => ['required', 'numeric', 'regex:/^\d{10}$|^\d{12}$|^$/'],
			'fullName' => ['nullable', 'string', 'max:255'],
			'phoneNumber' => ['required', 'size:11'],
			'cityCode' => ['required'],
		], 
		[], 
		[
			'organizationName' => 'Название организации',
			'inn' => 'ИНН',
			'fullName' => 'ФИО',
			'phoneNumber' => 'Номер телефона',
			'cityCode' => 'Код города',
		]);

		$products = [];

		if ($request->get('products1')) {
			$products[] = $request->get('products1');
		}

		if ($request->get('products2')) {
			$products[] = $request->get('products2');
		}

		return response()->json($service->sendLead(
			$request->get('organizationName'),
			$request->get('inn'),
			$request->get('fullName'),
			$request->get('phoneNumber'),
			$request->get('cityCode'),
			$products
		));
	}
}
