<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsRemainGeneralPartner extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'questions_remain_general_partners';
}
