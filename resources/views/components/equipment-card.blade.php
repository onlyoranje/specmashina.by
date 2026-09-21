{{-- ==========================================================================
  Карточка спецтехники (Blade-компонент). Стиль: norwegian.com.
  Режим отображения задаёт РОДИТЕЛЬСКИЙ контейнер-класс:
    <div class="view-grid"> — плитка/сетка (вид по умолчанию);
    <div class="view-list"> — строка/список.

  Вызов:
    <x-equipment-card :listing="$listing" />     — основной интерфейс
    <x-equipment-card :equipment="$equipment" /> — легаси-совместимость

  Соответствие данным реальной модели Bb (в таблице bbs нет колонок
  image/city/capacity/price_*):
    - фото   -> images()   : UserFile, вывод через Storage::url(resize(600,400))
    - город  -> location->title
    - дата   -> created_at (дата публикации)
    - теги   -> BbParameters (до 4 шт.: «Масса: 20 т», «Ковш: 1.1 м³» …)
    - цена   -> bbprice: price + pricetype->type
                 «руб/час»  -> бэйдж «Аренда»,  «Цена от X BYN / час»
                 «руб/день» -> бэйдж «Аренда»,  «Цена от X BYN / смена»
                 «руб»/нет  -> бэйдж «Продажа», «Цена X BYN»
    - ссылка -> route('listings.show', $listing->id)
=========================================================================== --}}
@props(['listing' => null, 'equipment' => null])

@php
    $bb  = $listing ?? $equipment;
    $url = route('listings.show', $bb->id);

    $file  = $bb->images()->first();
    $price = $bb->bbprice;
    $unit  = $price?->pricetype?->type;               // «руб/час», «руб/день», «руб»
    $isSale = ! $price || ! $unit || $unit === 'руб'; // продажа: цена без периода

    // Период тарифа: «/ час» или «/ смена» (из «руб/час», «руб/день», «руб/…»)
    $unitShort = 'час';
    if ($unit && str_contains($unit, 'день')) {
        $unitShort = 'смена';
    } elseif ($unit) {
        $unitShort = str_replace('руб/', '', $unit);
    }

    // До 4 тегов характеристик: «Масса: 20 т», «Ковш: 1.1 м³», «С оператором»…
    $tags = $bb->BbParameters->filter(fn ($p) => $p->parameters)->take(4);
@endphp

<article class="eq-card">

    {{-- 1. Фото + плоский бэйдж типа сделки в углу --}}
    <div class="eq-card__media">
        <a class="eq-card__media-link" href="{{ $url }}" tabindex="-1" aria-hidden="true">
            @if ($file)
                <img class="card-img"
                     src="{{ Storage::url($file->resize(600, 400)) }}"
                     alt="{{ $bb->title() }}" loading="lazy">
            @else
                <img class="card-img card-img--placeholder"
                     src="{{ asset('images/placeholder/no-image.svg') }}"
                     alt="Фото не добавлено" loading="lazy">
            @endif
        </a>
        <span @class(['eq-card__badge', 'eq-card__badge--sale' => $isSale])>
            {{ $isSale ? 'Продажа' : 'Аренда' }}
        </span>
    </div>

    {{-- 2. Контент: название, ГЕО + дата публикации, теги характеристик --}}
    <div class="eq-card__body">
        <h3 class="eq-card__title">
            <a href="{{ $url }}">{{ $bb->title() }}</a>
        </h3>

        <p class="eq-card__meta">
            <span class="eq-card__meta-item">
                <svg width="12" height="12" viewBox="0 0 16 16" aria-hidden="true"><path d="M8 1.5A4.5 4.5 0 0 1 12.5 6c0 3.2-4.5 8.5-4.5 8.5S3.5 9.2 3.5 6A4.5 4.5 0 0 1 8 1.5Z" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="8" cy="6" r="1.6" fill="currentColor"/></svg>
                {{ $bb->location?->title ?? 'Беларусь' }}
            </span>
            <span class="eq-card__meta-item">{{ optional($bb->created_at)->format('d.m.Y') }}</span>
        </p>

        @if ($tags->isNotEmpty())
            <ul class="eq-card__tags">
                @foreach ($tags as $tag)
                    <li>{{ $tag->parameters->name }}: {{ $tag->value }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- 3. Прайсинг «как у авиабилета»: лейбл, цена, кнопка --}}
    <div class="eq-card__action">
        <p class="eq-card__price-label">{{ $isSale ? 'Цена' : 'Цена от' }}</p>

        @if ($isSale)
            <p class="eq-card__price">
                {{ number_format($price?->price ?? 0, 0, '', ' ') }} <span>BYN</span>
            </p>
        @else
            <p class="eq-card__price">
                от {{ number_format((float) $price->price, 0, '', ' ') }} <span>BYN / {{ $unitShort }}</span>
            </p>
        @endif

        <a class="btn-action" href="{{ $url }}">Показать контакты</a>
    </div>
</article>
