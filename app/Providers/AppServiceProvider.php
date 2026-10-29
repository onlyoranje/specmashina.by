<?php

namespace App\Providers;

use App\Support\RelativeUrlGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Mail;
use App\Models\Location;
use App\Models\Post;
use App\Models\Rubric;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // URL ресурсов (asset()) — путь от корня сайта, без схемы и хоста:
        // ссылки на css/js/картинки не зависят от имени сайта (LAN-IP,
        // внешний домен, CDN). Подробности — App\Support\RelativeUrlGenerator.
        $this->app->extend('url', function ($url, $app) {
            if ($url instanceof RelativeUrlGenerator) {
                return $url;
            }

            return RelativeUrlGenerator::inherit($url);
        });

        // Подстраховка: если фасад уже успел закэшировать прежний генератор —
        // сбрасываем кэш, чтобы дальше отдавался экземпляр выше.
        Facade::clearResolvedInstance('url');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Почта / восстановление пароля.
        //
        // Symfony Mailer бросает исключение "An email must have a \"From\" or a
        // \"Sender\" header.", если глобальный адрес отправителя пуст. Страхуем
        // это на уровне приложения, даже если config('mail.from.address') пуст.
        $fromAddress = config('mail.from.address') ?: 'no-reply@specmashina.by';
        $fromName = config('mail.from.name') ?: config('app.name', 'SpecMashina.by');

        config(['mail.from.address' => $fromAddress, 'mail.from.name' => $fromName]);
        Mail::alwaysFrom($fromAddress, $fromName);

        // Если SMTP не заполнен (пустые host/username/password — типично для
        // локальной разработки/LAN), реальная отправка письма невозможна и
        // приводла бы к ошибке транспорта. В этом случае пишем письма (в т.ч.
        // ссылки восстановления пароля) в лог вместо попытки отправки.
        if (config('mail.default') === 'smtp') {
            $smtp = config('mail.mailers.smtp', []);
            $host = trim((string) ($smtp['host'] ?? ''));
            $username = trim((string) ($smtp['username'] ?? ''));
            $password = trim((string) ($smtp['password'] ?? ''));

            if ($host === '' || $username === '' || $password === '') {
                config(['mail.default' => 'log']);
            }
        }

        //
        Paginator::useBootstrap();

        // Ссылки пагинации («/news?page=2») — путь от корня сайта, без схемы
        // и хоста. По умолчанию Laravel подставляет сюда request()->url()
        // (абсолютный), из-за чего при проксировании ссылки получались
        // http://<LAN-IP>/news?page=2 → Mixed Content.
        Paginator::currentPathResolver(fn () => current_path());

        //URL::forceScheme('https');

        // Шапка сайта: пункты меню «Аренда» и «Продажа» получают выпадающие
        // списки категорий 1-го уровня. Это дети корневых рубрик
        // «Аренда» (id 1000) и «Продажа» (id 2000) — корни совпадают
        // с CatalogController::index().
        View::composer('components.header', function ($view) {
            $menuCategories = Rubric::query()
                ->where('level', 1)
                ->whereIn('parent_id', [1000, 2000])
                ->orderBy('sort')
                ->orderBy('title')
                ->get(['id', 'title', 'parent_id']);

            $view->with([
                'rentMenuCategories' => $menuCategories->where('parent_id', 1000)->values(),
                'saleMenuCategories' => $menuCategories->where('parent_id', 2000)->values(),
            ]);
        });
    }
}
