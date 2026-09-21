<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
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
        //
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
