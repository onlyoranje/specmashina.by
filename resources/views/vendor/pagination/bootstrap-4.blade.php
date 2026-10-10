{{--
  Пагинация по умолчанию (Paginator::useBootstrap → pagination::bootstrap-4).

  Разметка совмещает два потребителя:
    • легаси-стили main.css:  .pagination .pagination-list li a …
      (обёрки .pagination/.pagination-list сохранены);
    • CSS редизайна 2026 (orgs.css, news.css, location.css, catalog.css,
      ads/index): классы .page-item/.page-link, .active, .disabled.

  Исправления прежней версии:
    • опечатка class="pagination-list""";
    • неактивные стрелки были <a href="#"> (прыжок наверх) → теперь
      <a> без href + класс disabled (CSS гасит pointer-events);
    • многоточие обёрнуто в .page-link — получает ту же кнопочную стилизацию.
--}}
@if ($paginator->hasPages())
    <div class="pagination left">
        <ul class="pagination-list">
            {{-- Назад --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" tabindex="-1" aria-disabled="true" aria-label="Предыдущая страница">&lsaquo;</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Предыдущая страница">&lsaquo;</a>
                </li>
            @endif

            {{-- Номера страниц (окно из $elements: страницы + многоточия) --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a class="page-link">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Вперёд --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Следующая страница">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" tabindex="-1" aria-disabled="true" aria-label="Следующая страница">&rsaquo;</a>
                </li>
            @endif
        </ul>
    </div>
@endif
