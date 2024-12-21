<?php


namespace App\Services;


use App\Http\Livewire\CheckoutComponent;
use App\Models\Store;
use YooKassa\Client;
use Cart;

class YookassaService
{
    public function getClient(): CLient
    {
        $client = new Client();
        $client->setAuth(config('services.yookassa.shop_id'), config('services.yookassa.secret_key'));
        return $client;
    }

    public function createPayment(float $amount, string $description, array $options = [])
    {
        $client  = $this->getClient();
        $payment = $client->createPayment([
            'amount' => [
                'value' => $amount,
                'currency' => 'RUB',
            ],
            'capture' => false,
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('success')
            ],
            'metadata' => $options,
            'description' => $description
        ],uniqid('', true));


        return $payment;
    }


    public function createTokenPayment($token, float $amount, string $description, array $options = [])
    {
        $client  = $this->getClient();
        $payment = $client->createPayment([
            'payment_token' => $token,
            'amount' => [
                'value' => $amount,
                'currency' => 'RUB',
            ],
            'capture' => false,
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('success')
            ],
            'metadata' => $options,
            'description' => $description
        ],uniqid('', true));

        return $payment;


    }
}
