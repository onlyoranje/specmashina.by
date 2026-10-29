<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Исправляет хост в заголовке Location у всех редиректов,
 * чтобы браузер всегда шёл на PUBLIC_URL (https://landi.onlyoranje.keenetic.pro),
 * а не на внутренний LAN-адрес прокси (http://192.168.1.5).
 *
 * Ставится в группу 'web' сразу после ForcePublicUrl.
 */
class FixRedirectHost
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        if (! $response->isRedirect()) {
            return $response;
        }

        $publicUrl = rtrim(trim((string) config('app.public_url')), '/');
        if ($publicUrl === '') {
            $publicUrl = rtrim(trim((string) config('app.url')), '/');
        }

        if ($publicUrl === '') {
            return $response;
        }

        $location = $response->headers->get('Location');
        if ($location === null || $location === '') {
            return $response;
        }

        // Если Location — относительный (/dashboard), дополняем до абсолютного с PUBLIC_URL.
        if (str_starts_with($location, '/')) {
            $response->headers->set('Location', $publicUrl . $location);
            return $response;
        }

        // Если Location — абсолютный URL с чужим хостом, заменяем хост на PUBLIC_URL.
        if (str_starts_with($location, 'http')) {
            $location = preg_replace('#^https?://[^/]+#', $publicUrl, $location);
            $response->headers->set('Location', $location);
        }

        return $response;
    }
}