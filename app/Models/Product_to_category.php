<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_to_category extends Model
{
    use HasFactory;

    protected $table = "product_to_categories";

    protected $fillable = ['product_id', 'category_id'];


    public function category_products()
    {

        return $this->hasMany(Product_to_store::class);
    }

}
