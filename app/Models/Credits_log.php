<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credits_log extends Model
{
    use HasFactory;
    protected $fillable = [
        'credits',
        'user_id',
        'bb_id',
        'description'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }
    public function bb(){
        return $this->hasOne(Bb::class);
    }
}
