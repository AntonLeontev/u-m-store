<?php

namespace App\Http\Livewire;

use App\Helpers\SiteClone\CloneInfo;
use App\Models\Directions;
use App\Models\Filters;
use App\Models\Product;

use App\Models\SEO\PartnerSeo;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;
use UmHelp;

class ShopComponent extends Component
{

    public $direction_slug;
    public $direction_id;

    public $sorting;
    public $pagesize;
    public $category_slug;
    public $min_price;
    public $max_price;
    public $active_category;
//    public $currentPage;
//    public $lastPage;
    use WithPagination;

    public function mount($direction_slug, $slug = 0)
    {
        $this->direction_slug = $direction_slug;
        $direction = Directions::firstWhere('slug', $direction_slug);

        if($direction_slug == 'flowers' && $slug == 0) $slug = 81;

        if($direction) {
            $this->direction_id = $direction->id;
            session(['direction_name'=> $direction->name]);
            session(['direction_id'=> $direction->id]);
        }

        $this->sorting = "date";
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
//        $paginator
        $this->pagesize +=  $this->pagesize;
        $this->resetPage();
    }

    private function seoPartnerTags() {
        $seo = PartnerSeo::firstwhere('partner_id', );
    }

    public function render(Request $request)
    {
        Cart::instance('cart')->store($request->ip().Store::store_id());
        Cart::instance('wishlist')->store($request->ip().Store::store_id());


        $current_category_id = 0;
        if($this->category_slug==0)
        {

            $products = Product::getAllProducts($this->direction_id, $this->sorting, $this->pagesize, $this->min_price, $this->max_price);
            $this->category_slug = 0;
        }
        else
        {

            $products = Product::getProductsToCategory($this->direction_id, $this->category_slug, $this->sorting, $this->pagesize, $this->min_price, $this->max_price);



//            Добавил  проверку.
            //            $current_category_id = Category::find($this->category_slug)->parent_id;
            $current_category_id = Category::find($this->category_slug);
            if($current_category_id) $current_category_id = $current_category_id->parent_id;
//
            if($current_category_id == 0)  $current_category_id = $this->category_slug;
        }
        $partner_id = '';
        if(session()->has('domain')) {
            $partner_id = CloneInfo::getParnterId();
            $categories = Category::where('direction_id', $this->direction_id)->where('parent_id', 0)->where('partner_id', $partner_id)->where('status', 1)->get();
        } else {
            $categories = Category::where('direction_id', $this->direction_id)->where('parent_id', 0)->where('status', 1)->get();
        }

        foreach ($categories as $key => $category)
        {

            $childrens =  Category::where('direction_id', $this->direction_id)->where('parent_id', $category->id)->where('status', 1)->get();

            $childrens_vs_products = [];


                foreach ($childrens as $child)
                {
                    $product = Product::getProducts()->leftJoin('product_to_categories', 'product_to_categories.product_id','=','products.id')
                        ->where('direction_id', $this->direction_id)
                        ->where('category_id', $child->id)->get();

                    if(!$product->isEmpty())
                    {
                        $childrens_vs_products[] = $child;
                    }

                }

                $categories[$key]->childrens = $childrens_vs_products;
        }



        //Данные для формирования хлебных крошек
        session()->forget('parent_category_name');
        session()->forget('category_name');
        session()->forget('category_url');

        $category_bread = Category::find($this->category_slug);

        if($category_bread)
        {
          if($category_bread->parent_id) session(['parent_category_name'=> Category::find($category_bread->parent_id)->name]);
            session(['parent_category_url'=> route('product.shop', [session('city')['slug'], $this->direction_slug, $category_bread->parent_id ])]);

            session(['category_name' => $category_bread->name]);
            session(['category_url' => route('product.shop', [session('city')['slug'], $this->direction_slug, $category_bread->id])]);

        }
//        dd(Directions::firstWhere('slug', $this->direction_slug)->name);
//        session(['direction_name'=> Directions::firstWhere('slug', $this->direction_slug)->name]);
//            $url = route('product.shop');
        if(url()->previous() == URL::to('/'))
        {
            session(['direction_url' => url()->current()]);
        }

        $category = Category::find($this->category_slug);
        $allFilters = Filters::all();
        $parentFilter = $allFilters->where('parent_id',0);
        //SEO  title, description, keywords получаем из хелпера.
        $seo = '';
        if(session()->has('domain')) {
            $seo = PartnerSeo::select('category_tags')->where('partner_id', CloneInfo::getParnterId())->first();
            if($seo) {
                $seo = str_replace("%name%", $category->name, $seo->category_tags);
                $seo = str_replace("%price%", $this->min_price, $seo);
            }

        } else if(!session()->has('domain')) {
            $seo = UmHelp::SeoTransformationTemplates('Shop',$this->direction_id);
        }
//        $product->onEachSide(3);
        return view('livewire.shop-component', ['products'=> $products,'categories'=> $categories, 'current_category_id' => $current_category_id, 'allFilters'=>$allFilters,'parentFilter'=>$parentFilter, 'seo'=>$seo, 'category' => $category])->layout("layouts.base");
    }
}
