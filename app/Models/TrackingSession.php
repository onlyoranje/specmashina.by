<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrackingSession extends Model
{
    protected $table = 'tracking_sessions';

    protected $guarded = [];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'tracking_session_id');
    }
}