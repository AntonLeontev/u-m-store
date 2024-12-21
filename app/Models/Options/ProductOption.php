<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;
    protected $table="product_options";
 protected $fillable=['store_id', 'partner_id', 'product_id', 'option_id','required','updated_at'];
}
