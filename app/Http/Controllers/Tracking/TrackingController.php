<?php

namespace App\Http\Controllers\Tracking;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessTrackingEvent;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Приём пакета событий трекинга от клиента.
     *
     * Ожидает JSON:
     * {
     *   "events": [{ "type": "...", "payload": {...}, "timestamp": 123 }],
     *   "visitor_id": "...",
     *   "session_id": "...",
     *   "url": "...",
     *   "user_agent": "..."
     * }
     *
     * Возвращает 202 Accepted — события помещаются в очередь.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'events' => 'required|array|max:100',
            'events.*.type' => 'required|string|in:page_view,click,scroll_depth,time_on_page,form_submit,outbound_link_click,error,consent_revoked',
            'events.*.payload' => 'sometimes|array',
            'events.*.timestamp' => 'required|integer',
            'visitor_id' => 'required|string|max:64',
            'session_id' => 'sometimes|string|max:64',
            'url' => 'required|url|max:2000',
            'user_agent' => 'sometimes|string|max:1000',
        ]);

        $visitorId = $validated['visitor_id'];
        $sessionId = $validated['session_id'] ?? null;

        foreach ($validated['events'] as $event) {
            ProcessTrackingEvent::dispatch(
                visitorId: $visitorId,
                sessionId: $sessionId,
                type: $event['type'],
                payload: $event['payload'] ?? [],
                timestamp: $event['timestamp'],
                url: $validated['url'],
                userAgent: $validated['user_agent'] ?? $request->userAgent(),
                ip: $request->ip(),
            );
        }

        return response()->json(['status' => 'queued'], 202);
    }

    /**
     * Отзыв согласия на обработку куки.
     * Анонимизирует персональные данные посетителя и удаляет его идентификатор.
     */
    public function revoke(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|string|max:64',
        ]);

        $visitor = Visitor::byCookieId($request->input('visitor_id'))->first();

        if ($visitor) {
            $visitor->revokeConsent();
        }

        // Указываем браузеру удалить куку через Set-Cookie с прошедшим сроком
        return response()->json(['status' => 'revoked'])
            ->withCookie(cookie('laravel_cookie_consent', '', -1))
            ->withCookie(cookie('laravel_cookie_consent_refused', '', -1));
    }
}