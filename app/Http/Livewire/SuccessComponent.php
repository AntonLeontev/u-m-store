<?php

namespace App\Http\Livewire;

use App\Enums\StatusEnum;
use App\Models\Checkout\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;
class SuccessComponent extends Component
{
    public function mount()
    {
        if(Auth::check())
        {
            $lastOrder = Order::where('user_id', Auth::id())->get()->last();
            if($lastOrder)
            {
                if($lastOrder->status === StatusEnum::ORDERED and !session()->has('certificate'))
                {
                   return redirect(route('product.cart'));
                }
            }
        }

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
