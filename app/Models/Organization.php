<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['title', 'location_id','address', 'unp','site','email', 'logo','user_id','phone'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function location() {
        return $this->belongsTo(Location::class);
    }
}
