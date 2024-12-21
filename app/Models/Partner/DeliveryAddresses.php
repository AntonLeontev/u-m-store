<?php

namespace App\Models\Partner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddresses extends Model
{
    use HasFactory;
    protected $table = "delivery_addresses";

    protected $fillable = [
        'partner_id',
        'address',
        'status'
    ];
}
