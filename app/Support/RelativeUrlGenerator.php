<?php

namespace App\Support;

use Illuminate\Routing\UrlGenerator as BaseUrlGenerator;

/**
 * Генератор URL, отдающий на РЕСУРСЫ (css/js/картинки/фавикон) путь от корня
 * сайта — «/css/style.css» вместо «https://домен/css/style.css».
 *
 * Такие ссылки не зависят ни от схемы, ни от имени хоста: одинаково работают
 * при обращении напрямую по LAN-IP, через HTTPS-прокси роутера (Keenetic
 * переписывает Host на IP-адрес — отсюда Mixed Content), при смене домена и
 * за CDN/зеркалом. Остальное поведение URL-генератора (route()/url()/redirect)
 * не меняется — ссылки на страницы по-прежнему строятся от канонического
 * адреса (PUBLIC_URL), как того требуют canonical/og:url/sitemap.
 *
 * Подключается в AppServiceProvider::register() через $app->extend('url', …).
 */
class RelativeUrlGenerator extends BaseUrlGenerator
{
    /**
     * Создаёт экземпляр класса-наследника, копируя внутреннее состояние
     * исходного генератора (routes, request, forcedRoot, resolvers и т.д.).
     */
    public static function inherit(BaseUrlGenerator $source): static
    {
        $instance = (new \ReflectionClass(static::class))->newInstanceWithoutConstructor();

        $properties = new \ReflectionObject($source);
        foreach ($properties->getProperties() as $property) {
            if ($property->isStatic()) {
                continue;
            }

            $property->setAccessible(true);
            $property->setValue($instance, $property->getValue($source));
        }

        return $instance;
    }

    /**
     * URL ресурса = путь от корня сайта («/css/app.css», «/storage/x.jpg»).
     * Уже абсолютные адреса (https://cdn…, //…, mailto:) возвращаются как есть.
     */
    public function asset($path, $secure = null): string
    {
        if ($this->isValidUrl($path)) {
            return $path;
        }

        return '/'.ltrim($path, '/');
    }
}
