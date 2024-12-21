<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * пользователь которому принадлежит соц сеть
     */
    public function user() {

        return $this->belongsTo(User::class);
    }

}
