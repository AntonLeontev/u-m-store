<?php

namespace App\Http\Livewire\Admin;

use App\Models\Checkout\Order;
use App\Models\Partners;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
	public function mount()
	{
		$partner_id = Auth::user()->partner_id;

		session()->flash('status', 'Post successfully updated.');

		if (empty($partner_id)) {
			$this->redirectRoute('user.dashboard');
		}
	}

    public function render()
    {

        $partner_id = Auth::user()->partner_id;
        $partner = Partners::find($partner_id);
        $order_last = Order::where('partner_id', $partner_id)->latest()->first();
        if($partner) $store_city = Store::find($partner->store_id)->real_name;

        $saved_products_count = Product::where('partner_id', $partner_id)->count();
        $last_saved_product = Product::where('partner_id', $partner_id)->latest()->first();
        return view('livewire.admin.admin-dashboard-component', compact('partner','store_city', 'order_last', 'saved_products_count','last_saved_product'))->layout('layouts.base');
    }
}
