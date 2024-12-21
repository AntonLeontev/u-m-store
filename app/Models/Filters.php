<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filters extends Model
{
    use HasFactory;

    /**
     * Диапазон запроса, включающий только фильтры со статусом 1.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Диапазон запроса, включающий partner если он есть.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasPartner($query)
    {
        $direction_id = session()->has('partner_info')
            ? session()->get('partner_info')['direction_id'] : null;

        return  !is_null($direction_id) ? $query->where('direction_id', $direction_id) : $query;
    }
}
