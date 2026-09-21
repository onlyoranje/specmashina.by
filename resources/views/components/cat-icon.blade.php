{{-- ==========================================================================
  Иконка категории техники (Blade-компонент, <x-cat-icon :title="$cat->title" />).
  Приоритет: инлайн SVG из БД (rubrics.icon, передаётся как :icon) —
  иконки подобраны по названию рубрики; при отсутствии иконки в БД
  используется карта ниже, а неизвестным категориям — универсальная иконка.
  По умолчанию класс .cat-card__icon из public/css/home.css.
=========================================================================== --}}
@props(['title' => '', 'icon' => null, 'class' => 'cat-card__icon'])

@php
if ($icon) {
    // Иконка из БД — полноценный <svg>. Добавляем класс для размеров/цвета,
    // остальные атрибуты (viewBox, stroke) уже в самой строке из БД.
    $svg = str_replace('<svg ', '<svg class="'.e($class).'" ', trim($icon));
} else {
$icons = [
    'Экскаватор'                   => '<circle cx="14" cy="37" r="3.5"/><circle cx="26" cy="37" r="3.5"/><path d="M9 33v-8h13"/><path d="M22 25l9-11 8 4"/><path d="M39 18l4 4-5 5-4-4z"/>',
    'Погрузчик'                    => '<circle cx="15" cy="37" r="3.5"/><circle cx="28" cy="37" r="3.5"/><path d="M10 33v-9h9v9"/><path d="M19 26h7l8 7"/><path d="M34 33h8v-8l-8 2z"/>',
    'Кран'                         => '<path d="M12 42V10"/><path d="M12 10h26"/><path d="M38 10v8"/><circle cx="38" cy="22" r="3"/><path d="M12 16h8"/><path d="M6 10l6-6 6 6"/>',
    'Самосвал'                     => '<circle cx="14" cy="38" r="3"/><circle cx="24" cy="38" r="3"/><circle cx="35" cy="38" r="3"/><path d="M9 35v-8h8l3 8"/><path d="M25 35l-3-11 12-4 6 15z"/>',
    'Электрогенераторы'            => '<circle cx="14" cy="38" r="3"/><circle cx="26" cy="38" r="3"/><rect x="8" y="16" width="28" height="18" rx="2"/><path d="M36 16v-6h5"/><path d="M24 21l-5 6h6l-5 6"/>',
    'Дорожно-строительная техника' => '<circle cx="13" cy="32" r="7"/><circle cx="13" cy="32" r="2"/><path d="M20 32h4"/><path d="M24 32V14h12v18"/><rect x="27" y="18" width="6" height="6"/><circle cx="36" cy="36" r="4"/><path d="M32 14V8"/>',
];

// Универсальная иконка (фура с грузом) для категорий без своей иконки.
$paths = $icons[$title] ?? '<circle cx="14" cy="37" r="3.5"/><circle cx="26" cy="37" r="3.5"/><rect x="8" y="16" width="28" height="18" rx="2"/>';
}
@endphp

@if ($icon)
  {!! $svg !!}
@else
<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $paths !!}</svg>
@endif
