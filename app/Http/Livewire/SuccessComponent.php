<?php

namespace App\Http\Livewire;

use App\Enums\StatusEnum;
use App\Enums\TransactionStatus;
use App\Models\Checkout\Order;
use App\Models\Checkout\Transaction;
use App\Models\Partners;
use App\Models\Store;
use App\Services\YookassaService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SuccessComponent extends Component
{
    public function mount(int $transactionId)
    {
		if(Auth::check())
        {
			$transaction = Transaction::find($transactionId);
	
			if (!$transaction) {
				return redirect(route('product.cart'));
			}

			if ($transaction->user_id !== Auth::id()) {
				abort(404);
			}

			if ($transaction->status === TransactionStatus::CONFIRMED) {
				$this->success();
				return;
			}

			$partner = Partners::firstWhere('store_id', Store::store_id());

			if (!empty($partner?->yookassa_shop_id) && !empty($partner?->yookassa_secret_key)) {
				$service = new YookassaService($partner?->yookassa_shop_id, $partner?->yookassa_secret_key);
				if (!$service->checkPayment($transaction->payment_id)) {
					return redirect(route('product.cart'));
				}
	
				$transaction->status = TransactionStatus::CONFIRMED;
				$transaction->save();
	
				$order = Order::find($transaction->order_id);
				$order->status = StatusEnum::PAYED;
				$order->save();
			}
        }

        $this->success();
    }

	private function success() {
		Cart::instance('cart')->destroy();
        session()->forget('discount');
        session()->forget('checkout');
        session()->forget('order');
        session()->forget('shipping');
        session()->forget('coupon');
	}


    public function render()
    {
        return view('livewire.success-component')->layout("layouts.base");
    }
}
