{{--
    Список городов + пагинация — resources/views/location/partials/list.blade.php
    --------------------------------------------------------------------------
    Общий фрагмент для двух способов отрисовки:
      * обычной загрузки /dashboard/location (включается из location/dashboard.blade.php);
      * AJAX-поиска (LocationsController::search() отдаёт его как JSON «html»).

    Пагинация — в стиле Norwegian Air (см. vendor/pagination/norwegian.blade.php)
    и не перезагружает страницу: клик перехватывает public/js/location-search.js,
    без JS ссылки работают как обычные (?q=…&page=N).
--}}
<ul class="adm-list">
    @forelse ($locations as $location)
        <li>
            <div class="log-icon">
                <i class="lni lni-flag-alt"></i>
            </div>
            <a href="{{ route('location_dashboard_edit', ['location' => $location->id]) }}" class="title">{{ $location->title }}</a>
            <span class="time"><a href="{{ route('location_dashboard_edit', ['location' => $location->id]) }}">Редактировать</a></span>
            <span class="time"><a href="{{ route('location_dashboard_delete', ['location' => $location->id]) }}" class="text-danger">Удалить</a></span>
        </li>
    @empty
        <li class="adm-empty">
            @if ($q ?? '')
                По запросу «{{ $q }}» ничего не найдено
            @else
                Пока нет ни одного региона или города
            @endif
        </li>
    @endforelse
</ul>

@if ($locations->hasPages())
    <div class="adm-list-pages">
        {{ $locations->onEachSide(1)->links('pagination::norwegian') }}
    </div>
@endif
