<?php

namespace App\Models\Options;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = "options";

    public  function productOptions()
    {
        return $this->hasMany(ProductOptionValue::class);

    }


}
