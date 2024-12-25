<?php

namespace App\Http\Livewire\User;

use App\Enums\StatusEnum;
use App\Helpers\UmHelp;
use App\Models\BonusTransactions;
use App\Models\Checkout\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Livewire\Component;
use Telegram\Bot\Laravel\Facades\Telegram;

class UserCreateShopComponent extends Component
{
	public bool $isSubmited = false;

    public function render()
    {
        $user = auth()->user();

        return view('livewire.user.user-create-shop-component', compact('user'))->layout('layouts.base');
    }

	public function submit(Request $request)
	{
		$message = "Заявка на создание магазина u-m.store\n";

		$message .= "Имя: " . auth()->user()->name . "\n";
		$message .= "Телефон: " . auth()->user()->phone . "\n";
		$message .= "E-mail: " . auth()->user()->email . "\n";

		Telegram::sendMessage([
			'chat_id' => config('telegram.chats.applications'),
			'parse_mode' => 'HTML',
			'text' => $message
		]);

		$this->isSubmited = true;

		return view('livewire.user.user-create-shop-component', ['user' => auth()->user()])->layout('layouts.base');
	}
}
