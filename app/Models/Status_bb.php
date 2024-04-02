<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_bb extends Model
{
    use HasFactory;
    protected $fillable=['name','active_status','price','sort','premium_status_days','sort_on_board','color_bg','color_badge'];
    public function bbs() {
        return $this->belongsToMany(Bb::class);
    }
}
