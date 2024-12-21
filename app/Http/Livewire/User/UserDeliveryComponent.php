<?php

namespace App\Http\Livewire\User;

use App\Enums\StatusEnum;
use App\Models\Checkout\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDeliveryComponent extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', Auth::id())->where('is_shipping_different', StatusEnum::DELIVERY)->get();
        $deliveries = [];
        if($orders)
        {
            foreach($orders as $order)
            {
                $status = '';
                switch ($order->status) {
                    case StatusEnum::ORDERED: $status = 'Формирование заказа'; break;
                    case StatusEnum::DELIVERED: $status = 'Заказ доставлен'; break;
                    case StatusEnum::PAYED: $status = 'Заказ оплачен'; break;
                    case StatusEnum::CANCELED: $status = 'Заказ отменён'; break;
                }
                $deliveries[] = array(
                    'date'=> Carbon::parse($order->created_at)->format('d.m.Y'),
                    'id' => $order->id,
                    'address' => $order->address,
                    'total' => $order->total,
                    'status' => $status
                );

            }
        }


        return view('livewire.user.user-delivery-component', ['deliveries'=> $deliveries])->layout('layouts.base');
    }
}
