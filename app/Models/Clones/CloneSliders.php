<?php

namespace App\Models\Clones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloneSliders extends Model
{
    use HasFactory;

    protected $table = 'clone_sliders';
    protected $guarded = ['id'];
}
