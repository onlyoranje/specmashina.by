<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_credit extends Model
{
    use HasFactory;
    protected $fillable = [
        'credits',
        'user_id'
    ];
    public function user(){
        return $this->hasOne(User::class);
    }
}
