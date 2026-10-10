{{--
    Пагинация в стиле Norwegian Air — resources/views/vendor/pagination/norwegian.blade.php
    --------------------------------------------------------------------------
    Вызывается явно: {{ $items->links('pagination::norwegian') }}.

    Разметка Bootstrap (.pagination > .page-item > .page-link), поэтому её
    подхватывает раздел 8 файла public/css/admin.css: квадратные ссылки со
    скруглением 4px, активная страница — красная заливка #D92323, стрелки и
    «…» — приглушённые. Легаси-вид bootstrap-4 (класс .pagination-list и
    фиолетовый #5830E0 из main.css) на других страницах не затрагивается.
--}}
@if ($paginator->hasPages())
    <nav aria-label="Постраничная навигация">
        <ul class="pagination">

            {{-- Предыдущая страница --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       aria-label="Предыдущая страница">&lsaquo;</a>
                </li>
            @endif

            {{-- Номера страниц с многоточием --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Следующая страница --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="Следующая страница">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif

        </ul>
    </nav>
@endif
