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
 * http://<LAN-IP>, перезаписывая Host на IP-адрес и не передавая
 * X-Forwarded-*. В таких запросах приложение «видит» http://192.168.1.5 и
 * генерирует абсолютные URL (route()/url()/asset()) с этим адресом —
 * браузер выдаёт Mixed Content, так как IP-адрес не апгрейдится до HTTPS.
 *
 * Если запрос пришёл от доверенного прокси (TRUSTED_PROXY_IPS), все
 * генерируемые URL принудительно строятся от PUBLIC_URL. Прямые запросы
 * по LAN (http://192.168.1.5[:порт]) не затрагиваются: без этих настроек
 * поведение приложения не меняется.
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

        if ($publicUrl !== '' && $this->fromTrustedProxy($request)) {
            $scheme = parse_url($publicUrl, PHP_URL_SCHEME);

            URL::forceRootUrl($publicUrl);

            if (in_array($scheme, ['http', 'https'], true)) {
                URL::forceScheme($scheme);
            }
        }

        return $next($request);
    }

    /**
     * Пришёл ли запрос от прокси, которому мы доверяем определение
     * публичного адреса (X-Forwarded-* от него не приходят, поэтому
     * сравниваем IP источника напрямую).
     */
    private function fromTrustedProxy(Request $request): bool
    {
        $proxies = array_filter(array_map('trim', explode(',', (string) config('app.trusted_proxy_ips'))));

        return $proxies !== [] && in_array($request->ip(), $proxies, true);
    }
}
