<?php

namespace App\Http\Livewire\User;

use App\Enums\StatusEnum;
use App\Helpers\UmHelp;
use App\Models\BonusTransactions;
use App\Models\Checkout\Order;
use App\Models\Coupon;
use App\Models\Directions;
use App\Models\Partners;
use App\Models\Product;
use App\Models\Store;
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
		if (auth()->user()->partner_id !== null) {
			return redirect(route('admin.dashboard'));
		}

		$direction = Directions::firstWhere('slug', 'konstruktor');

		if (!$direction) {
			$direction = Directions::first();
		}

		$partner = $this->createPartner($direction->id);
		$store = $this->createStore($partner->id, $direction->id);

		$partner->update([
			'store_id' => $store->id,
		]);

		User::where('id', auth()->id())->update([
			'partner_id' => $partner->id,
			'role_id' => 1,
			'utype' => 'ADM',
		]);

		$this->sendTelegramNotification();

		return redirect(route('admin.dashboard'));
	}

	private function createPartner(int $directionId): Partners
	{
		return Partners::create([
			'user_id' => auth()->id(),
			'direction_id' => $directionId,
			'markup' => 0,
		]);
	}

	private function createStore(int $partnerId, int $directionId): Store
	{
		$maxId = Store::max('id');

		return Store::create([
			'partner_id' => $partnerId,
			'direction_id' => $directionId,
			'slug' => $maxId + 1,
			'real_name' => $maxId + 1,
		]);
	}

	private function sendTelegramNotification()
	{
		$message = "Пользователь создал магазин в " . config('app.name') . "\n";

		$message .= "ID: " . auth()->user()->id . "\n";
		$message .= "Имя: " . auth()->user()->name . "\n";
		$message .= "Телефон: " . auth()->user()->phone . "\n";
		$message .= "E-mail: " . auth()->user()->email . "\n";

		Telegram::sendMessage([
			'chat_id' => config('telegram.chats.applications'),
			'parse_mode' => 'HTML',
			'text' => $message
		]);
	}
}
