<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Bb extends Model
{
    protected $fillable = ['title', 'content', 'price','rubric_id','location_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function rubric() {
        return $this->belongsTo(Rubric::class);
    }
    public function location() {
        return $this->belongsTo(Location::class);
    }
    public function userfile() {
        return $this->hasMany(UserFile::class);
    }
}
