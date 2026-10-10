 {{-- ==========================================================================
   ПАРТИАЛ: КАРТОЧКА-БИЛЕТ ОБЪЯВЛЕНИЯ
   resources/views/catalog/partials/ticket.blade.php
   ==========================================================================
   Ожидает: $item (модель Bb или plain-объект) + $priceUnit / $priceLabel /
   $actionLabel из CatalogController::catalogData().

   Собирает данные карточки с graceful fallback-ами, поэтому работает и с
   моделью Bb (time_update(), images(), bbprice, location), и с «чистыми»
   объектами. Рендерится в полной странице и в AJAX-фрагменте.
   ========================================================================== --}}
@php
    // --- Сборка данных карточки (работает с Bb и с plain-объектами) ---
    $price  = $item->price ?? ($item->bbprice?->price ?? 0);
    $priceF = number_format((float) $price, 0, '', ' ');

    $city = $item->city ?? ($item->location?->title ?? null);

    // Название объявления: для модели Bb — полное имя Bb::title()
    // («Аренда колесного асфальтоукладчика Caterpillar 3222» =
    //  рубрика-предок + рубрика в род. падеже + вендор + модель),
    // а не только модель из колонки title («3222»).
    // Для plain-объектов — graceful fallback на исходное поле title.
    $cardTitle = method_exists($item, 'title')
        ? $item->title()
        : ($item->title ?? 'Спецтехника');

    if (method_exists($item, 'time_update')) {
        // «Обновлено: 1 год назад» / «Добавлено: ...»  (локаль ru)
        $date = $item->time_update();
    } elseif (isset($item->updated_at)) {
        $date = 'Обновлено: ' . $item->updated_at->diffForHumans();
    } else {
        $date = '';
    }

    // Фото: $item->image | 1-я загруженная картинка | placeholder.
    // Вывод — через глобальный хелпер resizeImage($url, W, H) → готовый src.
    $imageUrl = null;
    if ($item->image ?? null) {
        $imageUrl = resizeImage($item->image, 480, 360);
    } elseif (method_exists($item, 'images')) {
        $file = $item->images()->first();
        if ($file) {
            $imageUrl = resizeImage($file->url, 480, 360);
        }
    }
    $imageUrl = $imageUrl ?: asset('images/placeholder/no-image.svg');

    // alt и title — динамические и уникальные, построены из названия и города.
    $cityForAlt = $city ?? null;
    $alt   = $cardTitle . ($cityForAlt ? ' в г. ' . $cityForAlt : '') . ' — фото';
    $title = $cardTitle . ($cityForAlt ? ' — аренда и продажа в г. ' . $cityForAlt : ' — аренда и продажа в Беларуси');

    $href  = $item->url ?? ($item->id ? route('listings.show', $item->id) : '#');
@endphp

{{-- Карточка-билет: горизонтальная строка на десктопе, плашка на мобильных --}}
<article class="catalog-ticket" data-bb-id="{{ $item->id ?? '' }}">
  <a class="catalog-ticket__link" href="{{ $href }}">

    {{-- Зона 1 (лево): фотография техники --}}
    <div class="ct__media">
      <img class="ct__img" src="{{ $imageUrl }}" alt="{{ $alt }}" title="{{ $title }}" loading="lazy">
    </div>

    {{-- Зона 2 (центр): название + гео + дата --}}
    <div class="ct__body">
      <h3 class="ct__title">{{ $cardTitle }}</h3>
      <p class="ct__meta">
        @if ($city)
          <span class="ct__city">{{ $city }}</span>
        @endif
        @if ($date)
          <span class="ct__date">{{ $date }}</span>
        @endif
      </p>
    </div>

    {{-- Зона 3 (право): цена + плоская кнопка --}}
    <div class="ct__price-zone">
      <div class="ct__price-block">
        <span class="ct__price-label">{{ $priceLabel }}</span>
        <span class="ct__price-amount">
          {{ $priceF }} <span class="ct__price-unit">{{ $priceUnit }}</span>
        </span>
      </div>
      <span class="ct__action">{{ $actionLabel }}</span>
    </div>

  </a>
</article>
