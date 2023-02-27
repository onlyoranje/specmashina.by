<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceTypeRubric extends Model
{
    public $timestamps = false;
    protected $table = 'price_type_rubric';
    protected $fillable=['rubric_id','price_type_id'];
    use HasFactory;
}
