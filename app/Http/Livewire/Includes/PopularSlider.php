<?php

namespace App\Http\Livewire\Includes;

use App\Models\Partners;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Livewire\Component;
use Cart;

class PopularSlider extends Component
{

    public function store($product_id,$product_name,$product_price, $product_image)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price, ['image' => $product_image])->associate('App\Models\Product');
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        session()->flash('success_massage', 'Item added in Cart');
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

    public function render(Request $request)
    {

        Cart::instance('cart')->store($request->ip().Store::store_id());
        Cart::instance('wishlist')->store($request->ip().Store::store_id());

        $popular_products = Product::getProducts()->orderBy('store_price', 'DESC')->limit(8)->get();
        $popular_products = Product::setProductsRating($popular_products);

        return view('livewire.includes.popular-slider', ['popular_products' => $popular_products]);
    }
}
