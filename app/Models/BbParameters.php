<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BbParameters extends Model
{
    protected $fillable = ['bb_id','parameter_id','value'];
    use HasFactory;
    public function bb()
    {
        return $this->belongsTo(Bb::class);
    }
    public function parameters(){
        return $this->belongsTo(Parameter::class,'parameter_id');
    }
}
