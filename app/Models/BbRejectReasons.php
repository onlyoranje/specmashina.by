<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BbRejectReasons extends Model
{
    protected $fillable=['reason_id', 'bb_id'];
    use HasFactory;

    public function bb()
{
return $this->hasOne(Bb::class);
}
public function reason()
{
    return $this->hasOne(RejectReasons::class);
}
}
