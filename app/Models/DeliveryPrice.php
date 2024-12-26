<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPrice extends Model
{
    use HasFactory;

	public $timestamps = false;

	public $fillable = [
		'partner_id',
		'region',
		'price',
	];
}
