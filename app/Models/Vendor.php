<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable=['name','logo'];
    public function bbs() {
        return $this->hasMany(Bb::class);
    }
}
