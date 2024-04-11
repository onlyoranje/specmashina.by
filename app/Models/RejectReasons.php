<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectReasons extends Model
{
    protected $fillable=['reason'];
    use HasFactory;
}
