<?php

namespace App\Models;

use Ably\Laravel\Facades\Ably;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
