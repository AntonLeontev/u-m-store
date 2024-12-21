<?php

namespace App\Http\Livewire;

use App\Enums\StatusEnum;

use App\Helpers\SiteClone\CloneInfo;
use App\Models\Bonus;
use App\Models\Category;
use App\Models\Directions;
use App\Models\Options\ProductOptionValue;
use App\Models\Partners;
use App\Models\Product;
use App\Models\Product_to_category;
use App\Models\ProductReviews;
use App\Models\SEO\PartnerSeo;
use App\Models\SEO\SeoForProductDetails;
use App\Models\Store;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Cart;
use UmHelp;

class DetailsComponent extends Component
{
    public $slug;
    public $qty;
    public $current_price;
    public $price;
    public $old_price;
    public $option;
    public $option_checked;
    public $option_subtotal_price;
    public $product_added = false;
    public $review_theme;
    public $review_branch;
    public $review_rating;
    public $review_text;
    public $direction_slug;
    public $direction_id;

    public function mount($city_slug, $slug)
    {

        $this->slug = $slug;
        $this->qty = 1;
        $store = Store::firstWhere('slug', $city_slug);
        if ($store) {
            session()->put('city', ['name' => $store->real_name, 'slug' => $store->slug]);
            session()->forget('needCity');
        }

        $product = Product::getProduct($slug);
        if ($product) {
            $this->slug = $product->id;
            $this->current_price = $product->store_price;
            $this->price = $product->store_price;
            $this->old_price = $product->store_old_price;
            $this->review_branch = $product->category;
            $this->review_theme = 'Пожелания/ Замечания';
            $this->review_rating = 4;
            $this->direction_id = $product->direction_id;
            session()->put('previous_url', url()->current());
        } else {
            $this->redirect(route('shop', [Route::current()->city_slug, Route::current()->direction_slug]));
//            session()->flash('message', 'К сожалению в данном городе нет такоего букета');
        }
//        session()->forget('review_message');
    }

    public function store($product_id, $product_name, $product_price, $product_image)
    {

        if ($this->option) {

            Cart::instance('cart')->add($product_id . '_' . $this->option['id'], $product_name, $this->qty, $this->option['price'], ['image' => $product_image, 'product_id' => $product_id, 'option_name' => $this->option['name']])->associate('App\Models\Product');

        } else {
            Cart::instance('cart')->add($product_id, $product_name, $this->qty, $product_price, ['image' => $product_image])->associate('App\Models\Product');

        }
        $this->emitTo('includes.cart-count-component', 'refreshComponent');
        session()->flash('success_massage', 'Item added in Cart');
        $this->product_added = true;

    }

    public function increaseQuantity()
    {
        $this->qty++;
        if ($this->option) {
            $this->price += $this->option['price'];
        } else {
            $this->price += $this->current_price;
        }
    }

    public function decreaseQuantity()
    {
        if ($this->qty > 1) {
            if ($this->option) {
                $this->price -= $this->option['price'];

            } else {
                $this->price -= $this->current_price;
            }
            $this->qty--;
        }

    }

    public function recalculatePrice($option_price, $option_name, $option_value, $option_id)
    {

        if ($this->option_checked) {
            $this->price = $option_price * $this->qty;
            $this->product_added = false;
            $this->option = array(
                'id' => $option_id,
                'name' => $option_name . ': ' . $option_value,
                'price' => $option_price
            );
        }
    }


    public function addToWishList($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('includes.wishlist-count-component', 'refreshComponent');
    }

    public function removeFromWishList($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('includes.wishlist-count-component', 'refreshComponent');
            }
        }

    }

    protected function rules()
    {
        return [
            'review_text' => 'required|min:15',
        ];
    }

    public function setReview()
    {
        if (Auth::check()) {
            $this->validate();

            $product_review = new ProductReviews();
            $product_review->product_id = $this->slug;
            $product_review->user_id = Auth::id();
            $product_review->theme = $this->review_theme;
            $product_review->category = $this->review_branch;
            $product_review->rating = $this->review_rating;
            $product_review->review = $this->review_text;
            $product_review->status = 0;
            $product_review->save();

            session()->flash('message', 'Ваш отзыв в ближайшее время будет опубликован, спасибо!');
            $this->review_text = '';
        }
    }

    public function render()
    {

        //breads
        $direction = Directions::find($this->direction_id);

        session()->put('parent_category_name', $direction->name);
        session()->put('parent_category_url', route('shop', [session('city')['slug'], $direction->slug]));
        $product_to_category = Product_to_category::firstWhere('product_id', $this->slug);

        if($product_to_category)
        {
            $category_id = $product_to_category->category_id;
        } else $category_id = false;

        if ($category_id) {
            session()->put('category_name', Category::find($category_id)->name);

            session()->put('category_url', route('product.shop', [session('city')['slug'], $direction->slug, $category_id]));
        }

// end bread
        $product_option_values = ProductOptionValue::select()->where('store_id', Store::store_id())
            ->where('product_id', $this->slug)
            ->leftJoin('options', 'options.id', '=', 'product_option_values.option_id')
            ->leftJoin('option_values', 'option_values.id', '=', 'product_option_values.option_value_id')->get();

        $options = array();

        foreach ($product_option_values as $key => $value) {

            $selected_option = false;
            if ((int)$this->price === (int)$value->price) {
                $selected_option = true;
                $this->option_checked = true;

                $this->option = array(
                    'id' => $value->option_value_id,
                    'name' => $value->option_name . ': ' . $value->name,
                    'price' => $this->price
                );
            }

            $options[$value->option_name][] = array(
                'id' => $value->option_value_id,
                'name' => $value->name,
                'price' => number_format($value->price, 0, '', ''),
                'selected' => $selected_option
            );
        }

        $product = Product::getProduct($this->slug);

        $popular_products = Product::getProducts()->inRandomOrder()->limit(5)->get();
        $popular_products = Product::setProductsRating($popular_products);
        $buy_products = '';
        if($this->direction_id === 1) {
            $buy_products = Product::getProducts()->leftJoin('product_to_categories', 'product_to_categories.product_id','=','products.id')
                ->where('category_id', 109)
                ->inRandomOrder()
                ->limit(5)->get();
        }


        $related_products = Product::inRandomOrder()->limit(4)->get();
        $bonuses = Bonus::firstWhere('product_id', $this->slug);

        $reviews = (new ProductReviews())->getProductReviews($this->slug);
        $user_reviews = ProductReviews::where('user_id', Auth::id())->where('status', 1)->get();
        $rating = (new ProductReviews())->getRatingProduct($this->slug);

        $store_details = Store::find(Store::store_id());
        $partner = Partners::where('store_id', Store::store_id())->where('status', 1)->first();

//        Переменные для SEO
        session()->put('product_name', $product->name);
        session()->put('price', $this->price);

        //Формирование SEO title, description, keywords
        $seo = '';
        if(session()->has('domain')){
            $partner_seo = PartnerSeo::select('product_tags')->where('partner_id', CloneInfo::getParnterId())->first();
           if($partner_seo) $seo = str_replace(["%name%","%price%","%image%"], [$product->name,$this->price, Request::root() .'/storage/'. $product->image], $partner_seo->product_tags);
        } elseif (!session()->has('domain')) {
            $seo = UmHelp::SeoTransformationTemplates('Details', $this->direction_id);
        }




        // вывод дополнительных изображений товара
        $media = DB::table('media')
            ->where('product_id', $product->id)
            ->get()->map(function($img) {
                // приводим к необходимому виду
                $img->image_path = Request::root() .'/storage/'. $img->image_path;
                $img->resize_image_path = Request::root() .'/storage/'. $img->resize_image_path;
                return $img;
            });


        if(count($media) == 0 && $product->image) {
            $app = app();
            $media = [];
            $media[0] = $app->make('stdClass');
            $media[0]->image_path = Request::root() .'/storage/'. $product->image;
            $media[0]->resize_image_path = Request::root() .'/storage/'. $product->image;
        }
//        dd($media);.
        $compounds = DB::table('products_to_compound')
        ->where('product_id', $product->id)->get();

        $parameters = DB::table('products_to_parameters')
        ->where('product_id', $product->id)->get();

        if(isset($parameters[0])) $parameters = $parameters[0];
        else $parameters = false;

        return view('livewire.details-component', compact(
            'product',
            'options',
            'popular_products',
            'related_products',
            'bonuses',
            'reviews',
            'rating',
            'user_reviews',
            'store_details',
            'partner',
            'seo',
            'media',
            'compounds',
            'parameters',
            'buy_products'
        ))->layout('layouts.base');
    }

}
