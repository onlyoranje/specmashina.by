<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BbContact extends Model
{
    use HasFactory;
    protected $fillable=['value','bb_id','contact_type_id'];

    public function contactType() {
        return $this->belongsTo(ContactType::class);
    }
}

