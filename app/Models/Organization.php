<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Organization extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['title', 'location_id','address', 'unp','site','email', 'logo','user_id','phone','content','active'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function location() {
        return $this->belongsTo(Location::class);
    }
    // Объявления компании (withCount активных — в каталоге организаций)
    public function bbs() {
        return $this->hasMany(Bb::class);
    }
    public function count_bbs(){
        $count_bbs = Bb::where('organization_id',$this->id)->select('bbs.*')->Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->count();
        
        if (!isset($count_bbs)) $count_bbs=0;
        return $count_bbs;
    }

}
