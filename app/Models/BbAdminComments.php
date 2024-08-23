<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BbAdminComments extends Model
{
    use HasFactory;
    protected $fillable = ['bb_id', 'comment','read_at','title'];

    public function bb()
    {
        return $this->belongsTo(Bb::class);
    }

}
