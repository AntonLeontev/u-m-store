<?php

namespace App\Http\Livewire\User;

use App\Models\Checkout\Order;
use App\Models\Checkout\OrderProduct;
use App\Models\Product_to_category;
use App\Models\Product_to_store;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Livewire\Component;
use Cart;

class UserOrdersHistoryComponent extends Component
{


    public function repeatOrder($order_id)
    {
        $order_products = OrderProduct::where('order_id', $order_id)->get();
        if($order_products)
        {
            foreach ($order_products as $product)
            {
                $product_in_store = Product_to_store::where('product_id', $product->product_id)->where('store_id', Store::store_id())->first('store_price');
                if($product_in_store)
                {
                    Cart::instance('cart')->add($product->product_id, $product->name, $product->quantity, $product_in_store->store_price, ['image' => $product->image])->associate('App\Models\Product');
                }
            }

            if(Cart::instance('cart')->count() > 0) {
                $this->redirect(route('product.cart'));
            }
            else
            {
                session()->flash('message', 'Не возможно повторить заказ');
            }

        }
    }


    public function render()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'ASC')->get();
        $months = [];
        if($orders && count($orders) > 0)
        {

        $last_month = (int)Date::parse($orders[0]->created_at)->format('mY');


        foreach ($orders as $month)
        {
            $curr_month = (int)Date::parse($month->created_at)->format('mY');

            if($last_month != (int)$curr_month) {
                $last_month = $curr_month;
            } else {
                $month->date = Date::parse($month->created_at)->format('d.m.Y');
                $months[mb_convert_case(Date::parse($month->created_at)->format('F Y'), MB_CASE_TITLE, "UTF-8")][] = $month;
                $month->details = OrderProduct::where('order_id', $month->id)->get('name');

            }
        }
        }
        return view('livewire.user.user-orders-history-component' ,  ['months' => $months])->layout('layouts.base');
    }
}
