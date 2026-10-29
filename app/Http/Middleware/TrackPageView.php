<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Jobs\ProcessTrackingEvent;

class TrackPageView
{
    /**
     * Handle an incoming request.
     *
     * Автоматически отправляет событие page_view в очередь,
     * если у посетителя есть visitor_id и дано согласие на аналитику.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Не трекаем API, админку, ассеты и JSON-запросы
        if ($request->is('api/*') || $request->is('dashboard/*') || $request->expectsJson()) {
            return $response;
        }

        $visitorId = $request->cookie('visitor_id');

        // Если нет идентификатора посетителя — не трекаем
        if (!$visitorId) {
            return $response;
        }

        // Если есть кука отказа — не собираем инфу
        if ($request->cookie('laravel_cookie_consent_refused') === '1') {
            return $response;
        }

        ProcessTrackingEvent::dispatch(
            visitorId: $visitorId,
            sessionId: $request->cookie('tracking_session_id'),
            type: 'page_view',
            payload: [
                'referrer' => $request->headers->get('referer'),
                'method' => $request->method(),
            ],
            timestamp: now()->timestamp,
            url: $request->fullUrl(),
            userAgent: $request->userAgent(),
            ip: $request->ip(),
        );

        return $response;
    }
}