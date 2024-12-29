<?php

namespace App\Http\Livewire\Admin;

use App\Models\Options\ProductOption;
use App\Models\Options\ProductOptionValue;
use App\Models\Partners;
use App\Models\Product;
use App\Models\Product_to_category;
use App\Models\Product_to_store;
use App\Models\ProductsToFilters;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    public $pagesize;
    public $store_id;
    public $partner;
    public $user;
    public $partner_id;
    public $search;
    public $site_status;
    public $partner_type;
    use WithPagination;

    protected function rules()
    {
        $rules = [
            'image' => 'image|max:8069',
            'name' => 'required',
            'regular_price' => 'required|numeric',
        ];


        return $rules;
    }

    public function mount()
    {
        $this->pagesize = 12;
        $user = auth()->user();

        if ($user) {
            $this->user = $user;
            $this->partner_id = $user->partner_id;

            if ($this->partner_id) {
                $this->partner = Partners::find($this->partner_id);
                if ($this->partner) {
                    $this->store_id = $this->partner->store_id;
                }

                #Сохраняем в сессию данные партнера
//                if(session()->missing('partner_info'))
//                {
                    $partner_session_info = [
                        'type' => $this->partner->partner_type,
                        'site_status' => $this->partner->site_status,
                        'id' => $this->partner->id,
                        'direction_id' => $this->partner->direction_id,
                        'store_id' => $this->partner->store_id,
                    ];
                    $this->site_status = $this->partner->site_status;
                    session()->put('partner_info', $partner_session_info);
//                    dd( session()->get('partner_info'));
//                } else {
//                    $this->site_status = session('partner_info')['site_status'];
//                }

            }
        }
//        if ($user->role_id === 1) {
//            $this->store_id = Store::store_id();
//            $this->partner_id = Store::find($this->store_id)->partner_id;
//        }
        if (!$this->store_id) {
			$this->redirect(route('home'));
		}


    }

    public function updatePrice($id, $value)
    {

        $product = Product_to_store::find($id);
        if ($product) {
            $value = (int)$value;
            #Старый код изменения цены базовой.
//           $product->partner_price = $value;
//           $product->store_price = $this->roundPrice($value + ($value * ($this->partner->markup/100)));
            #Новый код установка окончательной цены на сейте.
            $product->store_price = $value;
            $product->partner_price = $this->roundPrice($value - ($value * ($this->partner->markup / 100)));

            $product->store_old_price =  $product->store_price*1.15;//старая цена + 15%
            $product->save();
        }

    }


    public function updateStatus($id, $value)
    {

        $product = Product_to_store::find($id);
        if ($product) {
            $product->product_status = (int)$value;
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

    public function deleteProduct($id)
    {

        $product_to_store = Product_to_store::where('partner_id', $this->partner_id)->where('product_id', $id)->first();

        if ($product_to_store) {
            $product_to_store->delete();
        }
        $product = Product::where('id', $id)->where('partner_id', $this->partner_id)->first();

        if ($product) {

//            unlink('storage/'.$product->image);

            DB::table('media')
                ->where('product_id', $id)
                ->get()->map(function($img) {

                    // delete images
                    $path = 'storage/'.$img->image_path;
                    if(file_exists($path)) unlink($path);
                    $path = 'storage/'.$img->resize_image_path;
                    if(file_exists($path)) unlink($path);

                    return $img;
                });

            Product_to_category::where('product_id', $id)->delete();
            ProductOption::where('product_id', $id)->delete();
            ProductOptionValue::where('product_id', $id)->delete();
            ProductsToFilters::where('product_id', $id)->delete();
            DB::table('products_to_additional_info')->where('product_id', $id)->delete();
            DB::table('products_to_another_opt')->where('product_id', $id)->delete();
            DB::table('products_to_compound')->where('product_id', $id)->delete();
            DB::table('products_to_info')->where('product_id', $id)->delete();
            DB::table('products_to_materials')->where('product_id', $id)->delete();
            DB::table('products_to_specifications')->where('product_id', $id)->delete();
            DB::table('media')->where('product_id', $id)->delete();

            Product::find($id)->delete();
        }
        session()->flash('message', 'Товар успешно удален!');
    }

    public function seeMore()
    {
        $this->pagesize += $this->pagesize;
    }

//    public function search(){
//
//    }

    public function render(Request $request)
    {
        if($request->input('search') !== null) {
            $this->search = $request->input('search');
        }

        if($this->search && strlen($this->search) > 2) {

            $products = Product::select('product_to_stores.id', 'product_id', 'name','description', 'image', 'product_to_stores.store_price', 'product_to_stores.partner_price', 'products.partner_id', 'products.direction_id', 'moderated', 'products.status', 'product_status')
                ->leftJoin('product_to_stores', 'products.id', '=', 'product_to_stores.product_id')
                ->where('products.status', 1)
                // ->where('products.direction_id', $this->partner->direction_id)
                ->where('products.partner_id', $this->partner_id)
                ->where('name', 'like' , '%'.$this->search.'%')
//                ->orWhere('description', 'LIKE' ,'%'.$this->search.'%')
                ->orderBy('products.created_at', 'DESC')
                ->paginate($this->pagesize);
        } else {
            $products = Product::select('product_to_stores.id', 'product_id', 'name', 'image', 'product_to_stores.store_price', 'product_to_stores.partner_price', 'products.partner_id', 'products.direction_id', 'moderated', 'products.status', 'product_status', 'product_to_stores.partner_id')
                ->leftJoin('product_to_stores', 'products.id', '=', 'product_to_stores.product_id')
                ->where('products.status', 1)
                // ->where('products.direction_id', $this->partner->direction_id)
                ->where('products.partner_id', $this->partner_id)
                ->orderBy('products.created_at', 'DESC')
                ->paginate($this->pagesize);
        }

//        dd($products);

        return view('livewire.admin.product.admin-product-component', ['products' => $products])->layout('layouts.base');
    }
}
