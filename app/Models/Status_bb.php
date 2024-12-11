<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Status_bb extends Model
{
    use HasFactory;
    protected $fillable=['name','active','status','price','sort','premium_status_days','sort_on_board','color_bg','color_badge','badge_text'];
    public function bbs() {
        return $this->belongsToMany(Bb::class);
    }
    public function count_bbs()
    {
        $bbs = Auth::user()->bbs()->where('status_bb_id',$this->id)->get();
        return $bbs->count();
    }
    public function getIStatusId($code){
        $status= Status_bb::where('status',$code)->first();
        return $status->id;
    }
}
