<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\TrackingSession;
use App\Models\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTrackingEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $visitorId,
        public ?string $sessionId = null,
        public string $type = 'page_view',
        public string $url = '',
        public string $userAgent = '',
        public string $ip = '',
        public int $timestamp = 0,
        public array $payload = [],
        public int $tries = 3,
        public int $timeout = 30,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $visitor = Visitor::updateOrCreate(
            ['cookie_id' => $this->visitorId],
            [
                'last_seen_at' => now(),
                'ip_address' => $this->ip,
                'user_agent' => $this->userAgent,
            ]
        );

        // Если это только что созданный посетитель, проставляем first_seen_at
        if ($visitor->wasRecentlyCreated) {
            $visitor->update(['first_seen_at' => now()]);
        }

        // Если согласия нет — не сохраняем персональные нетехнические события
        if (!$visitor->consent_granted && in_array($this->type, ['click', 'scroll_depth', 'time_on_page', 'form_submit'])) {
            return;
        }

        $session = null;
        if ($this->sessionId) {
            $session = TrackingSession::updateOrCreate(
                ['session_id' => $this->sessionId],
                [
                    'visitor_id' => $visitor->id,
                    'started_at' => now(),
                ]
            );
        }

        Event::create([
            'visitor_id' => $visitor->id,
            'tracking_session_id' => $session?->id,
            'type' => $this->type,
            'payload' => $this->payload,
            'timestamp' => $this->timestamp,
            'ip_address' => $this->ip,
            'user_agent' => $this->userAgent,
            'url' => $this->url,
        ]);
    }
}