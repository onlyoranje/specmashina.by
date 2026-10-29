<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Visitor extends Model
{
    protected $table = 'visitors';

    protected $guarded = [];

    protected $casts = [
        'consent_granted' => 'boolean',
        'first_seen_at' => 'datetime',
        'last_seen_at' => 'datetime',
        'consent_at' => 'datetime',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'visitor_id');
    }

    public function session(): HasOne
    {
        return $this->hasOne(TrackingSession::class, 'visitor_id');
    }

    public function scopeByCookieId($query, string $cookieId)
    {
        return $query->where('cookie_id', $cookieId);
    }

    public function grantConsent(): void
    {
        $this->update([
            'consent_granted' => true,
            'consent_at' => now(),
        ]);
    }

    public function revokeConsent(): void
    {
        $this->update([
            'consent_granted' => false,
            'consent_at' => null,
        ]);

        // Анонимизируем персональные данные существующих визитов
        $this->events()->update([
            'ip_address' => null,
            'user_agent' => null,
        ]);
    }
}