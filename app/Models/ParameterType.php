<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterType extends Model
{
    protected $fillable=['type','type_name'];
    use HasFactory;
    public function parameter(){
        return $this->belongsToMany(Parameter::class);
    }
}
