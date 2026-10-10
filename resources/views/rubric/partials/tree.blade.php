{{-- Рекурсивный вывод дерева категорий для /dashboard/rubric.
     Разметка — строки .adm-list (стили admin.css, раздел 11 и 23): иконка папки,
     название с HTML-отступом по уровню вложенности и служебные ссылки.

     Строки плоские (все <li> — прямые дети одного <ul id="rubric-tree">), а не
     вложенные списки: так строка остаётся «таблицей без таблицы» из раздела 11
     (иконка, название, действия, разделители). Сворачивание вложенных
     категорий делает public/js/rubric-tree.js: у строки есть data-depth и
     data-id, у родителя — кнопка .adm-tree-toggle с aria-expanded; при
     сворачивании скрываются строки глубже текущей до первой строки не глубже
     неё (класс .adm-tree-hidden, admin.css, раздел 23).

     Вызывается из rubric/dashboard.blade.php и рекурсивно сама собой,
     передавая детям накопленный $prefix и $depth + 1.

     Параметры:
       $rubrics — коллекция узлов дерева (Kalnoy\Nestedset → toTree());
       $prefix  — строка HTML-отступа текущего уровня ('' на корне);
       $depth   — глубина от корня (0), попадает в data-depth.

     Важно: рекурсия сделана через @include, а не через функцию с inline
     PHP (<?php ... ?> внутри @php): Blade сохраняет блок @php…@endphp как
     «сырой» и не компилирует вложенные директивы/{{ }} — из-за этого листинг
     падал с «syntax error, unexpected token else». --}}
@foreach ($rubrics as $rubric)
    <li class="adm-tree-row" data-depth="{{ $depth ?? 0 }}" data-id="{{ $rubric->id }}">
        @if (count($rubric->children) > 0)
            {{-- Кнопка есть только у строк с детьми; у листьев — пустой отступ
                 той же ширины, чтобы названия всех строк начинались на одной
                 вертикали. aria-expanded меняет js/rubric-tree.js. --}}
            <button type="button" class="adm-tree-toggle" aria-expanded="true"
                    aria-label="Свернуть или развернуть категории внутри «{{ $rubric->title }}»"></button>
        @else
            <span class="adm-tree-spacer" aria-hidden="true"></span>
        @endif
        <div class="log-icon">
            <i class="lni lni-folder" aria-hidden="true"></i>
        </div>
        <a href="{{ route('rubric_dashboard_edit', ['rubric' => $rubric->id]) }}" class="title">
            {!! $prefix !!}{{ $rubric->title }}
            <span class="adm-muted">(уровень: {{ $rubric->level }})</span>
        </a>
        <span class="time"><a href="{{ route('rubric_dashboard_edit', ['rubric' => $rubric->id]) }}">Редактировать</a></span>
        <span class="time"><a href="{{ route('rubric_dashboard_delete', ['rubric' => $rubric->id]) }}" class="text-danger">Удалить</a></span>
    </li>
    @include('rubric.partials.tree', ['rubrics' => $rubric->children, 'prefix' => $prefix.'&mdash;&nbsp;', 'depth' => ($depth ?? 0) + 1])
@endforeach