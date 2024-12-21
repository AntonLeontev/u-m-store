<?php

namespace App\Http\Livewire;

use App\Helpers\Price\MakePrice;
use App\Models\Category;
use App\Models\Filters;
use App\Models\Options\ProductOption;
use App\Models\Options\ProductOptionValue;
use App\Models\Partners;
use App\Models\Product;
use App\Models\Product_to_store;
use App\Models\Store;
use Illuminate\Support\Str;
use Livewire\Component;

class SqlReguest extends Component
{
    public function makeSlag()
    {

        $categoties = Category::all();
//        $categoties = Filters::all();

        foreach ($categoties as $category) {
            $category->slug = Str::slug($category->slug);
            $category->save();


        }

    }

    public function sql()
    {

        $products_to_store = Product_to_store::all();

        foreach ($products_to_store as $pr_to_st) {
            $p_id = Store::find($pr_to_st->store_id);
            if ($p_id) {
                Product::where('id', $pr_to_st->product_id)->update(['partner_id' => $p_id->partner_id]);
            }
//
        }

    }

    public function roundPriceProduct()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->price = MakePrice::salePrice($product->price);
            $product->save();
        }
    }
    public function roundPriceProductToStore()
    {
        $products = Product_to_store::all();
        foreach ($products as $product) {
            $product->store_price = MakePrice::salePrice($product->store_price);
            $product->save();
        }
    }
    public function roundPriceProductOptionValue()
    {
        $products = ProductOptionValue::all();
        foreach ($products as $product) {
            $product->price = MakePrice::salePrice($product->price);
            $product->save();
        }
    }

    public function roundPrice($price)
    {
        if ($price == 0) {
            return 0;
        }
        $price_big = (int)($price / 100);
        $price_small = ($price - $price_big * 100);
        if ($price_small > 0) {
            $price_small = 99;
            $newprice = $price_big * 100 + $price_small;
        } else $newprice = $price_big * 100 - 1;
        return $newprice;

    }

    public function render()
    {
//        $partners = Partners::all();
//
//        foreach ($partners as $partner)
//        {
//            $stores = Store::where($partner->store_id);
//            $stores->partner_id = $partner->id;
//        }
        return view('livewire.sql-reguest')->layout('layouts.test');

    }
}
