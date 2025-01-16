<?php

return [

    'yookassa' => [
        'shop_id' => env('YOOKASSA_SHOP_ID', null),
        'secret_key' => env('YOOKASSA_SECRET_KEY', null)
    ],

    'sms' => [
        'sms_key' => env('SMS_SERVICE')
    ],
    'vkontakte' => [
		'client_id' => env('VKONTAKTE_CLIENT_ID'),
		'client_secret' => env('VKONTAKTE_CLIENT_SECRET'),
		'redirect' => env('VKONTAKTE_REDIRECT_URI')
    ],
    'odnoklassniki' => [
		'client_id' => env('ODNOKLASSNIKI_CLIENT_ID'),
		'client_public' => env('ODNOKLASSNIKI_CLIENT_PUBLIC'),
		'client_secret' => env('ODNOKLASSNIKI_CLIENT_SECRET'),
		'redirect' => env('ODNOKLASSNIKI_REDIRECT_URI')
    ],
    'telegram' => [
		'bot' => env('TELEGRAM_BOT_NAME'),  // The bot's username
		'client_id' => null,
		'client_secret' => env('TELEGRAM_TOKEN'),
		'redirect' => env('TELEGRAM_REDIRECT_URI'),
	],
	'yandex_metrica_counter' => env('YANDEX_METRICA_COUNTER'),
];
