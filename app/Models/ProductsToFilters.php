<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsToFilters extends Model
{
    use HasFactory;
    protected $table = 'products_to_filters';
    protected $fillable = ['product_id', 'filter_id'];
}
