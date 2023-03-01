<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BbPrice extends Model
{
    use HasFactory;
    protected $table = 'bb_prices';
    protected $fillable = ['bb_id','price_type_id','price'];

    public function bb()
    {
        return $this->belongsTo(Bb::class);
    }
    public function pricetype(){
        return $this->belongsTo(PriceType::class,'price_type_id');
    }

}
