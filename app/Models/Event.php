<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $table = 'tracking_events';

    protected $guarded = [];

    protected $casts = [
        'payload' => 'array',
        'timestamp' => 'integer',
        'received_at' => 'datetime',
    ];

    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(TrackingSession::class, 'tracking_session_id');
    }
}