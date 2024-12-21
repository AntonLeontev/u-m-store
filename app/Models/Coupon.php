<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = "coupons";

    public  function getCouponHistory() {
        return $this->hasMany(CouponHistory::class);
    }
}
