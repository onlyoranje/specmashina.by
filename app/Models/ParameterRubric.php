<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterRubric extends Model
{
    public $timestamps = false;
    protected $table = 'parameter_rubric';
    protected $fillable=['rubric_id','parameter_id'];
    use HasFactory;
}
