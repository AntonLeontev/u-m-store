<?php

namespace App\Models;

use App\Models\Options\Option;
use App\Models\Options\ProductOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    protected $table="products";

    public function category()
    {
        return $this->hasMany(Product_to_category::class, 'category_id');
    }

    /**
     * КОД ДОБАВЛЕН В ОКТЯБРЕ 2021
     * gart.service@yandex.ru
     */
    public function getCategory()
    {
        return $this->belongsToMany(Category::class,'product_to_categories', 'product_id', 'category_id');
    }
    public function getFilters()
    {
        return $this->belongsToMany(Filters::class,'products_to_filters', 'product_id', 'filter_id');
    }

    public function getOptions()
    {


        return $this->belongsToMany(Option::class,'product_options', 'product_id', 'option_id');
    }

    /** end code gart.service */

    public static function getProduct($slug)
    {
        $product_id = (int)$slug;

        $product_id = $product_id ?: Product::firstWhere('slug', $slug)->id;

        return Product_to_store::where('store_id', Store::store()->id)->leftJoin('products', 'products.id', '=', 'product_to_stores.product_id')
            ->where('store_id', Store::store_id())
            ->where('status', 1)
            ->where('moderated', 1)
            ->where('product_status', 1)
            ->where('product_to_stores.product_id', '=', $product_id)->first();
    }

    public static function getAdminProduct($product_id)
    {
        return Product_to_store::where('store_id', Store::store_id())->leftJoin('products', 'products.id', '=', 'product_to_stores.product_id')
            ->where('status', 1)
            ->where('product_to_stores.product_id', '=', $product_id)->first();
    }

    public static function getProducts()
    {
        return Product_to_store::where('store_id', Store::store()?->id)->leftJoin('products', 'products.id', '=', 'product_to_stores.product_id')
            ->where('status', 1)
            ->where('product_status', 1)
            ->where('moderated', 1)
            ->where('store_price', '>', 0);
    }


    public static function getAllProducts($direction_id, $sorting, $pagesize, $min_price, $max_price)
    {
        $store = Store::store();
        if($sorting =='date') {
            $products = Product::select(
                'products.id',
                'products.sort',
                'product_to_stores.product_id',
                'name',
                'slug',
                'short_description',
                'products.image',
                'store_price',
                'store_old_price',
                'delivery_price',
                'products.created_at'
            )->leftJoin('product_to_stores', 'product_to_stores.product_id', '=', 'products.id')
                ->leftJoin('partners', 'partners.id', '=', 'product_to_stores.partner_id')
                ->where('products.direction_id', $direction_id)
                ->where('product_to_stores.store_id', $store->id)
                ->where('store_price', '>', 0)
                ->where('products.status', 1)
                ->where('moderated', 1)
                ->where('product_status', 1)
                ->orderBy('products.created_at', 'DESC')
                ->paginate($pagesize);

        } else if($sorting =='price') {
            $products = Product::select(
                'products.id',
                'products.sort',
                'product_to_stores.product_id',
                'name',
                'slug',
                'short_description',
                'products.image',
                'store_price',
                'store_old_price',
                'delivery_price',
                'products.created_at'
            )->leftJoin('product_to_stores', 'product_to_stores.product_id', '=', 'products.id')
                ->leftJoin('partners', 'partners.id', '=', 'product_to_stores.partner_id')
                ->where('products.direction_id', $direction_id)
                ->where('product_to_stores.store_id', $store->id)
                ->where('store_price', '>', 0)
                ->where('products.status', 1)
                ->where('moderated', 1)
                ->where('product_status', 1)
                ->whereBetween('store_price', [$min_price,$max_price])
                ->orderBy('store_price', 'ASC')
                ->paginate($pagesize);

        } else if($sorting =='price-desc') {
            $products = Product::select(
                'products.id',
                'products.sort',
                'product_to_stores.product_id',
                'name',
                'slug',
                'short_description',
                'products.image',
                'store_price',
                'store_old_price',
                'delivery_price',
                'products.created_at'
            )->leftJoin('product_to_stores', 'product_to_stores.product_id', '=', 'products.id')
                ->leftJoin('partners', 'partners.id', '=', 'product_to_stores.partner_id')
                ->where('products.direction_id', $direction_id)
                ->where('product_to_stores.store_id', $store->id)
                ->where('store_price', '>', 0)
                ->where('products.status', 1)
                ->where('moderated', 1)
                ->where('product_status', 1)
                ->whereBetween('store_price', [$min_price,$max_price])
                ->orderBy('store_price', 'DESC')
                ->paginate($pagesize);
        } else {
//            dd('else');
            $products = Product::select(
                'products.id',
                'products.sort',
                'product_to_stores.product_id',
                'name',
                'slug',
                'short_description',
                'products.image',
                'store_price',
                'store_old_price',
                'delivery_price',
                'products.created_at'
            )->leftJoin('product_to_stores', 'product_to_stores.product_id', '=', 'products.id')
                ->leftJoin('partners', 'partners.id', '=', 'product_to_stores.partner_id')
                ->where('products.direction_id', $direction_id)
                ->where('product_to_stores.store_id', $store->id)
                ->where('store_price', '>', 0)
                ->where('products.status', 1)
                ->where('moderated', 1)
                ->where('product_to_stores.product_status', 1)
                ->whereBetween('store_price', [$min_price, $max_price])
                ->orderBy('products.sort', 'ASC')
                ->orderBy('product_to_stores.id', 'DESC')
                ->paginate($pagesize);
        }

        //get rating
//                    dd($min_price, $max_price);
//        dd($direction_id,$store->id,$min_price,$max_price);
        return self::setProductsRating($products);
    }


    public static function getProductsToCategory($direction_id, $category_slug, $sorting, $pagesize, $min_price, $max_price)
    {
        $store = Store::store();

        if($sorting =='date') {

            $products = Product::select(
                'products.id',
                'products.sort',
                'product_to_stores.product_id',
                'name',
                'slug',
                'short_description',
                'products.image',
                'store_price',
                'store_old_price',
                'delivery_price',
                'products.created_at'
            )->leftJoin('product_to_categories', 'product_to_categories.product_id','=','products.id')
                ->where('category_id', (int)$category_slug)
                ->leftJoin('product_to_stores', 'product_to_stores.product_id', '=', 'products.id')
                ->where('category_id', (int)$category_slug)
                ->leftJoin('partners', 'partners.id', '=', 'product_to_stores.partner_id')
                ->where('products.direction_id', $direction_id)
                ->where('product_to_stores.store_id', $store->id)
                ->where('store_price', '>', 0)
                ->where('products.status', 1)
                ->where('moderated', 1)
                ->where('product_status', 1)
                ->whereBetween('store_price', [$min_price, $max_price])
                ->orderBy('products.created_at', 'DESC')
                ->orderBy('products.sort', 'ASC')
                ->paginate($pagesize);

        } else if($sorting =='price') {

            $products = Product::select(
                'products.id',
                'products.sort',
                'product_to_stores.product_id',
                'name',
                'slug',
                'short_description',
                'products.image',
                'store_price',
                'store_old_price',
                'delivery_price',
                'products.created_at'
            )->leftJoin('product_to_categories', 'product_to_categories.product_id','=','products.id')
                ->where('category_id', (int)$category_slug)
                ->leftJoin('product_to_stores', 'product_to_stores.product_id', '=', 'products.id')
                ->where('category_id', (int)$category_slug)
                ->leftJoin('partners', 'partners.id', '=', 'product_to_stores.partner_id')
                ->where('products.direction_id', $direction_id)
                ->where('product_to_stores.store_id', $store->id)
                ->where('store_price', '>', 0)
                ->where('products.status', 1)
                ->where('moderated', 1)
                ->where('product_status', 1)
                ->whereBetween('store_price', [$min_price, $max_price])
                ->orderBy('store_price', 'ASC')
                ->orderBy('products.sort', 'ASC')
                ->paginate($pagesize);


        } else if($sorting =='price-desc') {

            $products = Product::select(
                'products.id',
                'products.sort',
                'product_to_stores.product_id',
                'name',
                'slug',
                'short_description',
                'products.image',
                'store_price',
                'store_old_price',
                'delivery_price',
                'products.created_at'
            )->leftJoin('product_to_categories', 'product_to_categories.product_id','=','products.id')
                ->where('category_id', (int)$category_slug)
                ->leftJoin('product_to_stores', 'product_to_stores.product_id', '=', 'products.id')
                ->where('category_id', (int)$category_slug)
                ->leftJoin('partners', 'partners.id', '=', 'product_to_stores.partner_id')
                ->where('products.direction_id', $direction_id)
                ->where('product_to_stores.store_id', $store->id)
                ->where('store_price', '>', 0)
                ->where('products.status', 1)
                ->where('moderated', 1)
                ->where('product_status', 1)
                ->whereBetween('store_price', [$min_price, $max_price])
                ->orderBy('store_price', 'DESC')
                ->orderBy('products.sort', 'ASC')
                ->paginate($pagesize);

        } else {
//            dd('Hello');
            $products = Product::select(
                'products.id',
                'products.sort',
                'product_to_stores.product_id',
                'name',
                'slug',
                'short_description',
                'products.image',
                'store_price',
                'store_old_price',
                'delivery_price',
                'products.created_at'
            )->leftJoin('product_to_categories', 'product_to_categories.product_id','=','products.id')
                ->where('category_id', (int)$category_slug)
                ->leftJoin('product_to_stores', 'product_to_stores.product_id', '=', 'products.id')
                ->where('category_id', (int)$category_slug)
                ->leftJoin('partners', 'partners.id', '=', 'product_to_stores.partner_id')
                ->where('products.direction_id', $direction_id)
                ->where('product_to_stores.store_id', $store->id)
                ->where('store_price', '>', 0)
                ->where('products.status', 1)
                ->where('moderated', 1)
                ->where('product_status', 1)
                ->whereBetween('store_price', [$min_price, $max_price])
//                ->orderBy('products.created_at', 'DESC')
                ->orderBy('products.sort', 'ASC')
                ->paginate($pagesize);

        }

        return self::setProductsRating($products);
    }


    public static function setProductsRating($products)
    {
        if($products)
        {
            foreach ($products as $product)
            {

                $reviews =  ProductReviews::where('product_id', $product->id)->where('status', 1);

                if($reviews)
                {
                    $rating_sum =  $reviews->sum('rating');
                    if($rating_sum)
                    {
                        $reviews_count = $reviews->count();
                        $product->reviews_count = $reviews_count .' '. self::incline($reviews_count);
                        $product->rating = $rating_sum/ $reviews_count;
                    }
                }
            }
        }
        return $products;
    }

    public static function incline($count)
    {

        $words = array('отзыв','отзыва','отзывов');
        if($count%100>4 && $count%100<20){
            return $words[2];
        }
        $a = array(2,0,1,1,1,2);
        return $words[$a[min($count%10,5)]];
    }

    public static function getMinPriceInCategory($category_id)
    {
        if($category_id)
        {
            return Product::getProducts()->leftJoin('product_to_categories', 'product_to_categories.product_id','=','product_to_stores.product_id')
                ->where('category_id', (int)$category_id)->min('store_price');
        }
        else
        {
            return Product::getProducts()->min('store_price');
        }
    }

    public static function getMaxPriceInCategory($category_id)
    {
        if($category_id)
        {
        return Product::getProducts()->leftJoin('product_to_categories', 'product_to_categories.product_id','=','product_to_stores.product_id')
            ->where('category_id', (int)$category_id)->max('store_price');
        }
        else
        {
            return Product::getProducts()->max('store_price');
        }
    }

}
