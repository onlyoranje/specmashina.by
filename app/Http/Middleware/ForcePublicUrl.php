<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

/**
 * Канонический публичный адрес сайта (PUBLIC_URL).
 *
 * Внешний доступ идёт через HTTPS-прокси роутера (Keenetic): он принимает
 * запрос на https://<домен>, терминирует TLS и проксирует на Apache по
 * http://<LAN-IP>. В таких запросах приложение «видит» http://<LAN-IP> и
 * генерирует абсолютные URL с этим адресом — браузер выдаёт Mixed Content.
 *
 * Middleware всегда форсирует PUBLIC_URL (если задан), чтобы все
 * route()/url()/asset() генерировались с правильным доменом и схемой
 * независимо от того, как пришёл запрос (прямой LAN или через прокси Keenetic).
 *
 * Важно: forceScheme обязателен вместе с forceRootUrl — иначе
 * UrlGenerator::formatRoot() подменит схему forcedRoot на схему запроса
 * (http://) и ссылки снова окажутся нешифрованными.
 */
class ForcePublicUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $publicUrl = rtrim(trim((string) config('app.public_url')), '/');

        if ($publicUrl !== '') {
            $scheme = parse_url($publicUrl, PHP_URL_SCHEME);

            URL::forceRootUrl($publicUrl);

            if (in_array($scheme, ['http', 'https'], true)) {
                URL::forceScheme($scheme);
            }
        }

        return $next($request);
    }
}
