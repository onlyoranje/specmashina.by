<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $fillable=['name','type','measure', 'sort','options','min','max'];
    use HasFactory;
    public function rubrics() {
        return $this->belongsToMany(Rubric::class);
    }
    public function parametertypes(){
        return $this->belongsTo(ParameterType::class);
    }

}
