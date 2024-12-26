<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partners extends Model
{
    use HasFactory;
	
    protected $table = 'partners';
    protected $guarded = ['id'];

	public function deliveryPrices(): HasMany
	{
		return $this->hasMany(DeliveryPrice::class, 'partner_id', 'id');
	}
}
