<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReviews extends Model
{
    use HasFactory;
    protected $table="product_reviews";
    protected $fillable = ['product_id','user_id','category','theme','review'];

    public function getProductReviews($product_id)
    {
        return  ProductReviews::where('product_id', $product_id)->where('status', 1)->leftJoin('users', 'users.id', '=', 'product_reviews.user_id')->get();
    }

    public function getRatingProduct($product_id)
    {
        $sumrating =  ProductReviews::where('product_id', $product_id)->where('status', 1)->sum('rating');

        if($sumrating)
        {
            return  $sumrating / count(ProductReviews::where('product_id', $product_id)->where('status', 1)->get());
        }
        else
        {
            return false;
        }


    }
}
