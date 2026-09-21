{{-- ==========================================================================
   ПАГИНАЦИЯ КАТАЛОГА  ·  resources/views/catalog/partials/pagination.blade.php
   ==========================================================================
   Кастомный вид пагинатора для каталога: вызывается как
   {{ $equipments->links('catalog.partials.pagination') }}.

   Отличие от стандартного вида Bootstrap-5 (Paginator::useBootstrap):
     • каждая ссылка несёт data-ajax-link — public/js/catalog-filters.js
       перехватывает клик и подгружает страницу без перезагрузки;
     • вместо двух блоков (мобильный/десктопный) — один набор квадратных
       кнопок: стилизуется в public/css/catalog.css, секция «Пагинация»;
     • подпись «Показано N–M из K» не выводится — счётчик общего числа
       уже есть в H1 страницы («Найдено: K»).

   href у ссылок рабочие: без JS пагинация работает обычной перезагрузкой.
   ========================================================================== --}}
@if ($paginator->hasPages())
  <nav aria-label="{{ __('Пагинация') }}">
    <ul class="pagination">
      {{-- Предыдущая страница --}}
      @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
          <span class="page-link" aria-hidden="true">&lsaquo;</span>
        </li>
      @else
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
             aria-label="@lang('pagination.previous')" data-ajax-link>&lsaquo;</a>
        </li>
      @endif

      {{-- Номера страниц и разделитель «…» --}}
      @foreach ($elements as $element)
        @if (is_string($element))
          <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
            @else
              <li class="page-item"><a class="page-link" href="{{ $url }}" data-ajax-link>{{ $page }}</a></li>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Следующая страница --}}
      @if ($paginator->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
             aria-label="@lang('pagination.next')" data-ajax-link>&rsaquo;</a>
        </li>
      @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
          <span class="page-link" aria-hidden="true">&rsaquo;</span>
        </li>
      @endif
    </ul>
  </nav>
@endif
