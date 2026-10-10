<?php

namespace App\Providers;

use App\Support\RelativeUrlGenerator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\View;

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
        // «Аренда» (id 1) и «Продажа» (id 118) — корни совпадают
        // с CatalogController::index().
        View::composer('components.header', function ($view) {
            $menuCategories = Rubric::query()
                ->where('level', 1)
                ->whereIn('parent_id', [1, 118])
                ->orderBy('sort')
                ->orderBy('title')
                ->get(['id', 'title', 'parent_id']);

            $view->with([
                'rentMenuCategories' => $menuCategories->where('parent_id', 1)->values(),
                'saleMenuCategories' => $menuCategories->where('parent_id', 118)->values(),
            ]);
        });
    }
}
