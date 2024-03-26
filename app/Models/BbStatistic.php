<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BbStatistic extends Model
{
    use HasFactory;
    protected $fillable=['bb_id','user_token','views'];
}
