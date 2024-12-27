<?php

namespace App\Models\Checkout;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
