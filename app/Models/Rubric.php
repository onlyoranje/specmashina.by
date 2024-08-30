<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Rubric extends Model
{
    use HasFactory;
    use NodeTrait;
    protected $fillable=['title','title_r','parent_id','description', 'level','sort','icon'];
    public function bbs() {
        return $this->hasMany(Bb::class);
    }
    public function rubrics() {
        return $this->hasMany(self::class, 'parent_id');
    }
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function level(){
        return $this->belongsTo(self::class,'level');
    }
    public function parameter(){
        return $this->belongsToMany(Parameter::class);
    }
    public function priceType(){
        return $this->belongsToMany(PriceTypeRubric::class);
    }
    public function title(){
        $breadcrumbs= Rubric::ancestorsAndSelf($this->id);
        $parent_rubric = $breadcrumbs[0];
        $title = $parent_rubric->title.' '.$this->title_r;
        return $title;
    }
}
