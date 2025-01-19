<?php

namespace App\Http\Livewire\ForClone;

use App\Enums\StatusEnum;
use App\Helpers\SiteClone\CloneInfo;
use App\Helpers\UmHelp;
use App\Http\Livewire\HeaderComponent;
use App\Models\Category;
use App\Models\Checkout\Order;
use App\Models\CloneSiteInformation;
use App\Models\Directions;
use App\Models\Partners;
use App\Models\Product;
use App\Models\SEO\PartnerSeo;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderCloneComponent extends Component
{

    public $clone_info;
    public $metrika;
    public $new_orders_count;
    public $categories;
    public $partner;
    public $partner_id = 0;
    public function mount()
    {

        session()->put('domain', request()->getHost());
//        dd(session()->get('domain'));
        if($this->clone_info = CloneSiteInformation::firstWhere('domain', session()->get('domain')))
        {
            $this->partner_id = $this->clone_info->partner_id;
//            dd($this->clone_info);
            $clone_info = $this->clone_info;
			$direction_slug = Directions::find($clone_info->direction_id)->slug;
            $clone_info_arr = [
                'city_slug' => Store::find($clone_info->store_id)?->slug,
                'direction_slug' => $direction_slug,
                'city_name' => $clone_info->city_name,
                'partner_id' => $clone_info->partner_id,
                'store_id' => $clone_info->store_id,
                'direction_id' => $clone_info->direction_id,
                'logo' => $clone_info->logo,
                'company_name' => $clone_info->company_name,
                'phone' => $clone_info->phone,
                'email' => $clone_info->email,
                'address' => $clone_info->address,
                'inst_link' => $clone_info->inst_link,
                'vk_link' => $clone_info->vk_link,
                'fb_link' => $clone_info->fb_link,
                'youtube_link' => $clone_info->youtube_link,
                'telegram_link' => $clone_info->telegram_link,
                'margin' => $clone_info->margin,
                'year' => date('Y')
            ];
            session()->put('clone_info', $clone_info_arr);
//                dd($clone_info_arr, session()->all());
            session()->put('city', ['name' => $clone_info_arr['city_name'], 'slug' => $clone_info_arr['city_slug']]);
            $metrika = PartnerSeo::select('metrika')->where('partner_id', $clone_info->partner_id)->first();
            if($metrika) $this->metrika =  $metrika->metrika;
            $this->partner = Partners::find($clone_info->partner_id);
        }
        else
        {
//          dd('reditect');
            return redirect()->to('https://unitedmarket.org/');
//          return redirect()->route('home');
        }
//        else{
//            session()->put('domain', false);
//            return redirect()->to('/');
//        }
        $this->getCategories($clone_info->direction_id, $direction_slug);

    }


    public function getCategories($direction_id, $direction_slug)
    {	
		
		$this->categories = Category::where('partner_id', $this->partner_id)->orderBY('parent_id', 'ASC')->limit(5)->get();

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


        $directions = Directions::where('status', 1)->where('id', $this->partner->direction_id)->orderBy('sort')->get();
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

            $categories = Category::where('direction_id', $direction->id)->where('partner_id', $this->partner_id)->get();

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

        $main_categories = Category::select('categories.id','categories.name','categories.slug','directions.slug')
            ->leftJoin('directions', 'directions.id', '=', 'categories.direction_id')
            ->where('partner_id', $this->partner_id)
			->where('menu', 1)
			->where('categories.status', 1)
			->get();


            return view('livewire.for-clone.header-clone-component', compact('directions', 'main_directions','main_categories') );
//        }


    }
}
