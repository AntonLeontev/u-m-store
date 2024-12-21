<?php

namespace App\Http\Livewire\User;

use App\Models\Coupon;
use Jenssegers\Date\Date;
use Livewire\Component;

class UserPromoComponent extends Component
{
    public function render()
    {
        $active_promo = Coupon::where('promo_code', 1)->where('date_end' ,'>', Date::now())->where('status', 1)->get();
        $old_promo = Coupon::where('promo_code', 1)->where('date_end' ,'<', Date::now())->where('status', 1)->get();
        return view('livewire.user.user-promo-component', compact('active_promo', 'old_promo'))->layout('layouts.base');
    }
}
