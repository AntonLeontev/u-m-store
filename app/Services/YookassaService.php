<?php


namespace App\Services;


use App\Http\Livewire\CheckoutComponent;
use App\Models\Partners;
use App\Models\Store;
use Cart;
use Illuminate\Support\Str;
use YooKassa\Client;

class YookassaService
{
	private string $shopId;
	private string $secretKey;

	public function __construct(string $shopId, string $secretKey)
	{
		$this->shopId = $shopId;
		$this->secretKey = $secretKey;
	}

    public function getClient(): Client
    {
        $client = new Client();
        $client->setAuth($this->shopId, $this->secretKey);
        return $client;
    }

    public function createPayment(float $amount, string $description, int $transactionId, array $options = [])
    {
        $client  = $this->getClient();
        $payment = $client->createPayment([
            'amount' => [
                'value' => $amount,
                'currency' => 'RUB',
            ],
            'capture' => true,
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('success', ['transactionId' => $transactionId])
            ],
            'metadata' => $options,
            'description' => $description
        ],uniqid('', true));


        return $payment;
    }

	/**
	 * Проверка оплаты
	 * 
	 * @param string $id - id платежа в yookassa
	 * @return boolean
	 */
	public function checkPayment(string $id): bool
	{
		$client  = $this->getClient();
		$payment = $client->getPaymentInfo($id);

		return $payment->status === 'succeeded';
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
