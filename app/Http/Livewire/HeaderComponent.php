<?php

namespace App\Http\Livewire;

use App\Enums\StatusEnum;
use App\Models\Category;
use App\Models\Checkout\Order;
use App\Models\Directions;
use App\Models\Partners;
use App\Models\Product;
use App\Models\Product_to_category;
use App\Models\Product_to_store;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderComponent extends Component
{

    public $new_orders_count;
    public $categories;

    public function mount()
    {
        // $this->getCategories(1, 'flowers');
    }


    public function getCategories($direction_id, $direction_slug)
    {
        $this->categories = Category::where('direction_id', $direction_id)->orderBY('parent_id', 'ASC')->limit(5)->get();

        foreach ($this->categories as $key => $category)
        {
            $childrens =  Category::where('direction_id', $direction_id)->where('parent_id', $category->id)->where('status', 1)->get();

            $childrens_vs_products = [];

            foreach ($childrens as $child)
            {
                $product = Product::getProducts()->leftJoin('product_to_categories', 'product_to_categories.product_id','=','products.id')
                    ->where('direction_id', $direction_id)
                    ->where('category_id', $child->id)->get();

                if(!$product->isEmpty())
                {
                    $childrens_vs_products[] = $child;
                }
            }

            $this->categories[$key]->childrens = $childrens_vs_products;
            $this->categories[$key]->direction_slug = $direction_slug;
        }

    }


    public function render()
    {
        if(!isset(session('city')['slug'])) {
            Store::store();
        }


       // get ureaded orders count of partner
       if(Auth::check() && Auth::user()->utype === 'ADM')
       {
           $partner = Partners::firstWhere('user_id', Auth::id());
           if($partner && $partner->id)
           {
               $partner_id = $partner->id;
               $this->new_orders_count = Order::where('partner_id', $partner_id)->where('status','!=', StatusEnum::ORDERED)->where('read_status', 0)->get()->count();
           }
       }


       $directions = Directions::where('status', 1)->orderBy('sort')->get();
       $main_directions = [];

        $store_id = Store::store_id();
       foreach ($directions as $dkey=>$direction)
       {
//           dd($direction);
           // if direction has no products
           $product = Product::select('id')
               ->where('direction_id', $direction->id)
               ->where('status', 1)
               ->limit(1)
               ->get();
//           $product = Product::select('id')->where('direction_id', $direction->id)->where('status', 1)->limit(1)->
//               ->get();
           if($product->isEmpty())
           {

               unset($directions[$dkey]);
               continue;
           }
//           if(!$product->isEmpty() and Product_to_store::where('product_id', $product[0]->id)->where('store_id',
//               $store_id)->get
//           ()->isEmpty()) {  unset($directions[$dkey]);continue;}


            // if direction in main menu
           if($direction->in_menu) $main_directions[] = $direction;


           $categories = Category::where('direction_id', $direction->id)->get();

           // get child categories with products
           foreach ($categories as $key => $category)
           {
               $childrens =  Category::where('direction_id', $direction->id)->where('parent_id', $category->id)->where('status', 1)->get();

               $childrens_vs_products = [];

               foreach ($childrens as $child)
               {
                   $product = Product::getProducts()->leftJoin('product_to_categories', 'product_to_categories.product_id','=','products.id')
                       ->where('direction_id', $direction->id)
                       ->where('category_id', $child->id)->get();

                   if(!$product->isEmpty())
                   {
                       $childrens_vs_products[] = $child;
                   }
               }

               $categories[$key]->childrens = $childrens_vs_products;
           }


           $directions[$dkey]->categories = $categories;
       }


//       $main_directions = Directions::where('status', 1)->where('in_menu', 1)->orderBy('sort')->get();
        return view('livewire.header-component', compact('directions', 'main_directions'));
    }
}
