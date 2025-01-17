<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_to_store extends Model
{
    use HasFactory;

    protected $table = "product_to_stores";
    protected $fillable = [
        'store_id',
        'partner_id',
        'product_id',
        'partner_price',
        'store_price',
        'updated_at'
	];

}

