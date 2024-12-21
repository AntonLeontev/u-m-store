<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class SearchComponent extends Component
{

    public $sorting;
    public $pagesize;
    public $search;
    public $product_cat;
    public $product_cat_id;


    public function mount() {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->fill(request()->only('search','product_cat','product_cat_id'));
    }

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

    public function sort($sort)
    {
        $this->sorting = $sort;
    }

    public function seeMore()
    {
        $this->pagesize += $this->pagesize;
    }

    use WithPagination;
    public function render(Request $request)
    {

        Cart::instance('cart')->store($request->ip().Store::store_id());
        Cart::instance('wishlist')->store($request->ip().Store::store_id());


        if($this->sorting =='date') {
            $products = Product::getProducts()->where('name','like', '%'.$this->search . '%')->orderBy('store_price', 'DESC')->paginate($this->pagesize);
        } else if($this->sorting =='price') {
            $products = Product::getProducts()->where('name','like', '%'.$this->search . '%')->orderBy('store_price', 'ASC')->paginate($this->pagesize);
        } else if($this->sorting =='price-desc') {
            $products = Product::getProducts()->where('name','like', '%'.$this->search . '%')->orderBy('store_price', 'DESC')->paginate($this->pagesize);
        } else {
            $products = Product::getProducts()->where('name','like', '%'.$this->search . '%')->paginate($this->pagesize);
        }


        $products = Product::setProductsRating($products);

        $categories = Category::where('parent_id', 0)->get();
        foreach ($categories as $key => $category)
        {
            $childrens =  Category::where('parent_id', $category->id)->get();
            if($childrens) {
                $categories[$key]->childrens = $childrens;
            }

        }

        return view('livewire.search-component', ['products'=> $products,'categories'=> $categories])->layout("layouts.base");
    }
}
