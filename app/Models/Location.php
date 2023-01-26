<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
class Location extends Model
{
    use HasFactory;
    use NodeTrait;
    protected $fillable=['title','parent_id', 'level','sort'];
    public function bbs() {
        return $this->hasMany(Bb::class);
    }
    public function locations() {
        return $this->hasMany(self::class, 'parent_id');
    }
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function level(){
        return $this->belongsTo(self::class,'level');
    }
}
