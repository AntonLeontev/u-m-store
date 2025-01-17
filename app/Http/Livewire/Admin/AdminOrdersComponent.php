<?php

namespace App\Http\Livewire\Admin;

use App\Enums\StatusEnum;
use App\Models\Checkout\Order;
use App\Models\Checkout\OrderProduct;
use App\Models\Partners;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Livewire\Component;

class AdminOrdersComponent extends Component
{

    public $partner_id;
    public $orders;

    public function mount() {
        $this->partner_id = Auth::user()->partner_id;
        $this->selectMonth(0);
    }

    public function updateStatus($id, $value) {

        $order = Order::find($id);
        if($order)
        {
            $order->status = $value;
            if($value === StatusEnum::DELIVERED || $value === StatusEnum::CANCELED)
            {
                $order->read_status = 1;
            }
            $order->save();
        }
    }

    public function selectMonth($month) {
//        dd($month);
        if($month == 0) {
            $this->orders = Order::query()
				->where('partner_id', $this->partner_id)
				->orderBy('id', 'DESC')
				->get();
        } else {
            $this->orders = Order::whereBetween('created_at', ['2022-'.$month.'-01', '2022-'.$month.'-31'])
				->where('partner_id', $this->partner_id)
                ->orderBy('id', 'DESC')
                ->get();
        }

//        dd($orders);

        $this->emit('refreshComponent');

    }

    public function render()
    {

//        $this->selectMonth(8);

        $store_id = Partners::firstWhere('id',$this->partner_id)->store_id;
//        $orders = Order::where('partner_id', $this->partner_id)->where('status','!=', StatusEnum::ORDERED)->orderBy('id', 'DESC')->get();
//        $orders = Order::where('partner_id', 0)->orderBy('id', 'DESC')->get();
//        $city_slug = Store::firstWhere('partner_id', $partner_id)->slug;
        $city_slug = Store::firstWhere('id',$store_id)->slug;
        $total = 0;
        if($this->orders)
        {
            foreach ($this->orders as $order)
            {
                $order_products = OrderProduct::where('order_id', $order->id)->get();
                foreach ($order_products as $product)
                {
                    $product->total = number_format($product->total,0, '','');
                    $product->link = route('product.details', ['city_slug'=> $city_slug,'slug'=> $product->product_id]);
                }
                $order->products = $order_products;
                $order->user_phone = User::find($order->user_id)->phone;
                $total += $order->total;
            }
        }

        return view('livewire.admin.admin-orders-component', compact('total'))->layout('layouts.base');
    }
}
