<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{
    use HasFactory;

    protected $table = "product_option_values";
    protected $fillable = [
        'store_id',
        'partner_id',
        'product_option_id',
        'product_id',
        'option_id',
        'option_value_id',
        'updated_at',
        'quantity',
        'subtract',
        'partner_price',
        'price',
        'price_prefix',
        'points',
        'points_prefix',
        'weight',
        'weight_prefix',
        'updated_at'];

}
