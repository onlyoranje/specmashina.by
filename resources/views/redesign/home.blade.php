@extends('redesign.layouts.base')

@section('title', config('site.name') . ' — аренда и продажа строительной техники в Беларуси')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

  {{-- ================= HERO + ПОИСКОВЫЙ ВИДЖЕТ ================= --}}
  <section class="hero">
    <div class="container hero__inner">
      <div class="hero__content">
        <p class="eyebrow">Каталог спецтехники · landi.by</p>
        <h1 class="hero__title">Аренда и продажа строительной техники в Беларуси</h1>
        <p class="hero__lead">Экскаваторы, погрузчики, краны и самосвалы от проверенных организаций. Сравните объявления, подайте заявку онлайн и получите технику на объект в день обращения.</p>
        <dl class="hero__stats">
          <div class="hero__stat"><dt>194</dt><dd>категории техники</dd></div>
          <div class="hero__stat"><dt>6</dt><dd>областных городов подачи</dd></div>
          <div class="hero__stat"><dt>24/7</dt><dd>приём заявок онлайн</dd></div>
        </dl>
      </div>

      <div class="search-widget">
        <p class="search-widget__title">Поиск техники</p>

        {{-- Табы: переключают скрытый инпут #search-type (JS внизу страницы) --}}
        <div class="search-widget__tabs" role="group" aria-label="Тип сделки">
          <button type="button" class="search-widget__tab is-active" data-type="rent" aria-pressed="true">Аренда</button>
          <button type="button" class="search-widget__tab" data-type="sale" aria-pressed="false">Продажа</button>
        </div>

        <form action="{{ route('search') }}" method="GET" class="search-widget__form">
          <input type="hidden" name="type" id="search-type" value="rent">

          <div class="search-widget__field">
            <label class="search-widget__label" for="sw-category">Категория техники</label>
            {{-- Категории верхнего уровня (рубрики 1-го уровня) по алфавиту,
                 сгруппированные по секциям: «Аренда» и «Продажа». Список
                 фильтруется по активной вкладке (data-section, JS ниже):
                 по умолчанию открыта вкладка «Аренда», поэтому группа
                 «Продажа» изначально hidden+disabled. Без JS видны обе
                 группы, а секцию выдачи окончательно определяет сервер
                 (SearchController::redirectToCatalog). --}}
            <select class="search-widget__select" id="sw-category" name="category_id">
              <option value="">Любая категория</option>
              @foreach($categories->groupBy('root_title') as $rootTitle => $rootCategories)
                @php
                  $section = $rootCategories->first()->root_id === 118 ? 'sale' : 'rent';
                @endphp
                <optgroup label="{{ $rootTitle }}" data-section="{{ $section }}" @if($section !== 'rent') hidden disabled @endif>
                  @foreach($rootCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                  @endforeach
                </optgroup>
              @endforeach
            </select>
          </div>

          <div class="search-widget__field">
            <label class="search-widget__label" for="sw-city">Город подачи</label>
            <select class="search-widget__select" id="sw-city" name="city">
              <option value="">Вся Беларусь</option>
              @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->title }}</option>
              @endforeach
            </select>
          </div>

          <button class="btn-submit" type="submit">Найти технику</button>
        </form>
      </div>
    </div>
  </section>

  {{-- Взаимодействие виджета:
       1) табы Аренда/Продажа меняют скрытый инпут #search-type и показывают
          в списке категории только активной секции (data-section у optgroup);
       2) если выбранная категория осталась от другой секции — выбор сбрасывается
          на «Любая категория»;
       3) отправка формы ведёт на /search, откуда SearchController
          редиректит в каталог (/rent[/категория], /sale[/категория]) с
          выбранным городом. Без JS список показывает обе группы, а сервер
          сам определит секцию (type="rent" по умолчанию). --}}
  <script>
    (function () {
      var hidden     = document.getElementById('search-type');
      var tabs       = document.querySelectorAll('.search-widget__tab');
      var categories = document.getElementById('sw-category');
      var groups     = categories ? categories.querySelectorAll('optgroup[data-section]') : [];

      function activateTab(type) {
        tabs.forEach(function (t) {
          var active = t.dataset.type === type;
          t.classList.toggle('is-active', active);
          t.setAttribute('aria-pressed', active ? 'true' : 'false');
          if (active) hidden.value = type;
        });

        // В списке категорий оставляем только активную секцию.
        groups.forEach(function (g) {
          var show = g.dataset.section === type;
          g.hidden = !show;
          g.disabled = !show;
          g.querySelectorAll('option').forEach(function (o) {
            o.hidden = !show;
          });
        });

        // Выбранная категория относится к другой секции — сбрасываем на «Любая».
        var selected = categories.options[categories.selectedIndex];
        if (selected && selected.value && selected.hidden) {
          categories.value = '';
        }
      }

      tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
          activateTab(tab.dataset.type);
        });
      });

      // Подстраховка (например, при нестандартном DOM или до первого запуска
      // activateTab): выбор категории включает вкладку её секции.
      if (categories) {
        categories.addEventListener('change', function () {
          var option  = categories.options[categories.selectedIndex];
          var section = option ? option.closest('optgroup[data-section]') : null;
          if (section) activateTab(section.dataset.section);
        });
      }

      // Начальное состояние: список категорий соответствует вкладке по умолчанию.
      activateTab(hidden.value === 'sale' ? 'sale' : 'rent');
    })();
  </script>

  {{-- ================= КАТЕГОРИИ =================
       Реальные рубрики 1-го уровня с АКТИВНЫМИ объявлениями (с учётом
       потомков), не больше 6 блоков, сортировка по количеству по убыванию. --}}
  <section class="section section--light" id="categories">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Каталог</p>
          <h2>Категории техники</h2>
        </div>
        <a class="section__link" href="{{ route('catalog.all') }}">Весь каталог
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="cats">
        @forelse($cats as $cat)
          <a class="cat-card" href="{{ $cat->parent_id === 118 ? route('sale.index', $cat->id) : route('rent.index', $cat->id) }}">
            <x-cat-icon :title="$cat->title" :icon="$cat->icon" />
            {{-- cardTitle(): «Аренда погрузчика» — первое слово из родительской
                 категории + название рубрики в родительном падеже (title_r). --}}
            <span class="cat-card__name">{{ $cat->cardTitle() }}</span>
            <span class="cat-card__count">{{ $cat->ads_count ? bbs_count_title($cat->ads_count) : 'Нет объявлений' }}</span>
          </a>
        @empty
          <p class="section__empty">Пока нет объявлений.</p>
        @endforelse
      </div>
    </div>
  </section>
  {{-- ================= ПОПУЛЯРНАЯ ТЕХНИКА =================
       Активные объявления с наибольшим количеством просмотров. --}}
  <section class="section" id="catalog">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Востребовано сейчас</p>
          <h2>Популярная техника</h2>
        </div>
        <a class="section__link" href="{{ route('ads.index') }}">Все объявления
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="cards-grid">
        @forelse($popular as $equipment)
          <x-equipment-card :equipment="$equipment" />
        @empty
          <p class="section__empty">Пока нет объявлений.</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- ================= АКТУАЛЬНЫЕ ОБЪЯВЛЕНИЯ =================
       Те же карточки, сортировка по дате обновления (updated_at). --}}
  <section class="section section--light" id="actual">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Свежие предложения</p>
          <h2>Актуальные объявления</h2>
        </div>
        <a class="section__link" href="{{ route('ads.index') }}">Все объявления
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="cards-grid">
        @forelse($actual as $equipment)
          <x-equipment-card :equipment="$equipment" />
        @empty
          <p class="section__empty">Пока нет объявлений.</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- ================= НОВОСТИ =================
       Последние активные публикации (Post). Подробная страница — route('post'). --}}
  <section class="section" id="news">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Журнал</p>
          <h2>Новости</h2>
        </div>
        <a class="section__link" href="{{ route('news.index') }}">Все новости
          <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>

      <div class="news-grid">
        @forelse($posts as $post)
          @php
            // resizeImage возвращает 'images/placeholder/no-image.svg',
            // если файла нет на диске — тогда нужен asset(), а не Storage::url()
            $newsImage = $post->image ? $post->resizeImage($post->image, 480, 320) : null;
            $newsSrc = ($newsImage && ! str_starts_with($newsImage, 'images/placeholder'))
                ? Storage::url($newsImage)
                : asset('images/placeholder/no-image.svg');
          @endphp
          <article class="news-card">
            <a class="news-card__media" href="{{ route('post', $post->id) }}" tabindex="-1" aria-hidden="true">
              <img class="news-card__img"
                   src="{{ $newsSrc }}"
                   alt="{{ $post->title }}" loading="lazy">
            </a>
            <div class="news-card__body">
              @if ($post->category)
                <span class="news-card__category">{{ $post->category }}</span>
              @endif
              <h3 class="news-card__title"><a href="{{ route('post', $post->id) }}">{{ $post->title }}</a></h3>
              @if ($post->preview_text)
                <p class="news-card__text">{{ $post->preview_text }}</p>
              @endif
              <p class="news-card__meta">{{ optional($post->created_at)->format('d.m.Y') }}</p>
            </div>
          </article>
        @empty
          <p class="section__empty">Скоро здесь появятся новости.</p>
        @endforelse
      </div>
    </div>
  </section>
  {{-- ================= ПРЕИМУЩЕСТВА (маркетплейс) ================= --}}
  <section class="section" id="advantages">
    <div class="container">
      <div class="section__head">
        <div>
          <p class="eyebrow">Почему landi.by</p>
          <h2>Маркетплейс спецтехники Беларуси</h2>
        </div>
      </div>

      <div class="adv">
        <div class="adv__item">
          <svg class="adv__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="6" y="6" width="15" height="15" rx="2"/><rect x="27" y="6" width="15" height="15" rx="2"/><rect x="6" y="27" width="15" height="15" rx="2"/><rect x="27" y="27" width="15" height="15" rx="2"/></svg>
          <h3 class="adv__title">Огромный выбор</h3>
          <p class="adv__text">Сотни арендодателей по всей Беларуси в одном месте.</p>
        </div>
        <div class="adv__item">
          <svg class="adv__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="24" cy="15" r="8"/><path d="M8 42c2.5-9.5 8.5-14 16-14s13.5 4.5 16 14"/></svg>
          <h3 class="adv__title">Прямые контакты</h3>
          <p class="adv__text">Общайтесь напрямую с владельцами техники — без посредников и комиссий сайта.</p>
        </div>
        <div class="adv__item">
          <svg class="adv__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 22l36-12v24L6 28v-6z"/><path d="M24 34a7 7 0 1 1-13-4"/></svg>
          <h3 class="adv__title">Бесплатное размещение</h3>
          <p class="adv__text">Для собственников техники публикация объявлений абсолютно бесплатна.</p>
        </div>
        <div class="adv__item">
          <svg class="adv__icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="22" cy="22" r="13"/><path d="M32 32l9 9"/></svg>
          <h3 class="adv__title">Быстрый поиск</h3>
          <p class="adv__text">Фильтры по городам РБ и категориям машин — как при поиске авиабилетов.</p>
        </div>
      </div>
    </div>
  </section>

@endsection
