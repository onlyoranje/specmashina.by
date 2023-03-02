<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Bb extends Model
{
    protected $fillable = ['title', 'content', 'rubric_id','location_id', 'vendor_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function rubric() {
        return $this->belongsTo(Rubric::class);
    }
    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
    public function location() {
        return $this->belongsTo(Location::class);
    }
    public function userfile() {
        return $this->hasMany(UserFile::class);
    }
    public function bbprice(){
        return $this->hasOne(BbPrice::class);
    }
    public function BbParameters(){
        return $this->hasMany(BbParameters::class);
    }
    public function bbcontact(){
        return $this->hasMany(BbContact::class);
    }

}
