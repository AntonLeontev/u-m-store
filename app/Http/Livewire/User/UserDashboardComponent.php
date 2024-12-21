<?php

namespace App\Http\Livewire\User;

use App\Enums\StatusEnum;
use App\Models\BonusTransactions;
use App\Models\Checkout\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Livewire\Component;

class UserDashboardComponent extends Component
{

    public function render()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);


        $orders = Order::where('user_id', Auth::id())->where('is_shipping_different', StatusEnum::DELIVERY)->limit(2)->orderBy('created_at', 'ASC')->get();
        $user_bonuses_count = BonusTransactions::where('user_id', $user_id )->where('status', StatusEnum::BUYED)->sum('qty');
        $active_promo = Coupon::where('promo_code', 1)->where('date_end' ,'>', Date::now())->where('status', 1)->limit(2)->get();

        return view('livewire.user.user-dashboard-component', compact('user', 'orders', 'user_bonuses_count', 'active_promo'))->layout('layouts.base');
    }
}
