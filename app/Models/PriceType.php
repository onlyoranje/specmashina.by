<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    use HasFactory;
    protected $fillable=['type','has_value','sort'];
    public function rubrics() {
        return $this->belongsToMany(Rubric::class);
    }
}
