<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Store;
use Livewire\Component;
use Cart;

class NoPartnerComponent extends Component
{


    public function store($product_id,$product_name,$product_price, $product_image)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price, ['image' => $product_image])->associate('App\Models\Product');
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        session()->flash('success_massage', 'Item added in Cart');
        $this->removeFromWishList($product_id);
//          return redirect()->route('product.cart');
    }

    public function addToWishList($product_id,$product_name,$product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('includes.wishlist-count-component', 'refreshComponent');
    }

    public function removeFromWishList($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('includes.wishlist-count-component', 'refreshComponent');
            }
        }

    }

    public function render()
    {

        Cart::instance('cart')->store(Store::store_id());
        Cart::instance('wishlist')->store(Store::store_id());
        return view('livewire.no-partner-component')->layout('layouts.base');
    }
}
