<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Directions;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Livewire\Component;
use Cart;
use Livewire\WithPagination;

class WishlistComponent extends Component
{

    public $direction_slug;
    public $direction_id;

    public $sorting;
    public $pagesize;
    public $category_slug;
    public $min_price;
    public $max_price;
    public $active_category;
    use WithPagination;

    public function mount($direction_slug ,$slug = 0)
    {
        $this->direction_slug = $direction_slug;
        $direction = Directions::firstWhere('slug', $direction_slug);
        if($direction) $this->direction_id = $direction->id;

        $this->sorting = "default";
        $this->pagesize = 12;

        $this->min_price = Product::getMinPriceInCategory($slug);
        $this->max_price = Product::getMaxPriceInCategory($slug);
        $this->category_slug = $slug;

    }

    public function store($product_id,$product_name,$product_price, $product_image)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price, ['image' => $product_image])->associate('App\Models\Product');
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        session()->flash('success_massage', 'Item added in Cart');
        $this->removeFromWishList($product_id);
//          return redirect()->route('product.cart');
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


    public function seeMore()
    {
        $this->pagesize += $this->pagesize;
    }

    public function render(Request $request)
    {

        Cart::instance('cart')->store($request->ip().Store::store_id());
        Cart::instance('wishlist')->store($request->ip().Store::store_id());

        $categories = Category::where('parent_id', 0)->get();
        foreach ($categories as $key => $category)
        {
            $childrens =  Category::where('parent_id', $category->id)->get();
            if($childrens) {
                $categories[$key]->childrens = $childrens;
            }

        }

        return view('livewire.wishlist-component' ,['categories' => $categories])->layout('layouts.base');
    }
}
