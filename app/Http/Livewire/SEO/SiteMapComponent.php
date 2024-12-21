<?php

namespace App\Http\Livewire\SEO;

use App\Models\Category;
use App\Models\Directions;
use App\Models\Product;
use App\Models\Product_to_store;
use App\Models\Store;
use Livewire\Component;


class SiteMapComponent extends Component
{

    public function getSiteMap()
    {

        $products = Product_to_store::leftJoin('products', 'products.id', '=', 'product_to_stores.product_id')
            ->leftJoin('directions', 'directions.id', '=', 'products.direction_id')
            ->leftJoin('stores', 'stores.id', '=', 'product_to_stores.store_id')
            ->where('products.status', 1)
            ->select('products.id', 'products.name','products.image','product_to_stores.store_price', 'directions.name as type', 'stores.slug as city', 'products.created_at')->get();


        return response()->view('livewire.s-e-o.site-map-component', [
            'products' => $products
        ])->header('Content-Type', 'text/xml');
    }

    public function render()
    {
//        return view('livewire.s-e-o.site-map-component', compact('products'));
    }
}
