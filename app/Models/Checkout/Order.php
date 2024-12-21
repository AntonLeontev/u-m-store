<?php

namespace App\Models\Checkout;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
       return $this->hasMany(OrderItem::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function getCreatedAtAttribute($value)
        {
            $date = Carbon::parse($value);
            return $date->format('Y-m-d H:i');
        }
    public function getUpdatedAtAttribute($value)
        {
            $date = Carbon::parse($value);
            return $date->format('Y-m-d H:i');
        }
}
