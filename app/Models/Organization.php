<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['title', 'address', 'unp','site','email', 'logo','user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
