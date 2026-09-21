{{-- ==========================================================================
  Шапка сайта (Blade-компонент, подключение: <x-header />)
  Стиль: скандинавский минимализм Norwegian Air (norwegian.com).
  Логотип → route('home'), навигация по разделам с активным состоянием
  request()->routeIs(...), панель авторизации @guest/@auth.
  CSS — самодостаточный блок ниже; при переходе на Vite перенести его
  в resources/css/app.css (секция «Шапка») и убрать <style> отсюда.
=========================================================================== --}}
<header class="site-header">
  <div class="site-header__inner container">

    {{-- Управление мобильным меню: чистый CSS, без JS --}}
    <input type="checkbox" id="site-nav-toggle" class="site-nav-toggle">
    <label for="site-nav-toggle" class="site-burger" aria-label="Открыть меню"><span></span></label>

    {{-- 1. Логотип: фирменный SVG (public/images/logo/logo.svg) --}}
    <a class="site-logo" href="{{ route('home') }}">
      <img class="site-logo__img"
           src="{{ asset('images/logo/logo.svg') }}"
           alt="LANDI.BY — аренда и продажа спецтехники в Беларуси">
    </a>

    {{-- 2. Навигация по разделам. Активная страница — класс active.
         У «Аренды» и «Продажи» — выпадающие меню на 2 колонки со списком
         категорий 1-го уровня (данные — View::composer в AppServiceProvider). --}}
    <nav class="site-nav" aria-label="Основная навигация">
      <div class="site-nav__item">
        <a @class(['site-nav__link', 'active' => request()->routeIs('rent.*')])
           href="{{ route('rent.index') }}">Аренда</a>

        <div class="site-nav__menu" aria-label="Категории аренды">
          <ul class="site-nav__menu-cols">
            @foreach ($rentMenuCategories as $cat)
              <li><a href="{{ route('rent.index', $cat->id) }}">{{ $cat->title }}</a></li>
            @endforeach
          </ul>
          <a class="site-nav__menu-all" href="{{ route('catalog.all') }}">Весь каталог
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </div>

      <div class="site-nav__item">
        <a @class(['site-nav__link', 'active' => request()->routeIs('sale.*')])
           href="{{ route('sale.index') }}">Продажа</a>

        <div class="site-nav__menu" aria-label="Категории продажи">
          <ul class="site-nav__menu-cols">
            @foreach ($saleMenuCategories as $cat)
              <li><a href="{{ route('sale.index', $cat->id) }}">{{ $cat->title }}</a></li>
            @endforeach
          </ul>
          <a class="site-nav__menu-all" href="{{ route('catalog.all') }}">Весь каталог
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </div>

      <a @class(['site-nav__link', 'active' => request()->routeIs('organizations', 'organization.*')])
         href="{{ route('organizations') }}">Организации</a>

      <a @class(['site-nav__link', 'active' => request()->routeIs('news.*')])
         href="{{ route('news.index') }}">Новости</a>
    </nav>

    {{-- 3. Правая панель: авторизация + главная CTA --}}
    <div class="site-actions">
      @guest
        <a class="site-actions__auth" href="{{ route('login') }}">Вход / Регистрация</a>
      @endguest

      @auth
        <a class="site-actions__auth" href="{{ route('dashboard') }}" title="Личный кабинет">
          {{ Auth::user()->name }}
        </a>
      @endauth

      <a class="site-btn" href="{{ route('addForm') }}">
        <span class="site-btn__plus" aria-hidden="true">+</span>Добавить объявление
      </a>
    </div>
  </div>
  <style>
    /* ================== СТИЛИ ШАПКИ (Norwegian Air) ================== */

    .site-header {
      position: sticky;         /* шапка всегда на экране при скролле */
      top: 0;
      z-index: 100;
      background-color: var(--bg-white);
      border-bottom: 1px solid var(--border-color);
    }

    .site-header__inner {
      position: relative;       /* якорь для мобильной панели меню */
      display: flex;            /* лого слева, навигация по центру, действия справа */
      align-items: center;
      gap: 2.5rem;
      height: 72px;
    }

    .site-nav-toggle {
      position: absolute;
      opacity: 0;
    }

    /* --- 1. Логотип --- */
    .site-logo {
      font-size: 1.375rem;
      font-weight: 700;
      letter-spacing: 0.01em;
      color: var(--text-dark);
      white-space: nowrap;
    }

    .site-logo:hover {
      color: var(--text-dark);
    }

    .site-logo__dot {
      color: var(--norwegian-red); /* лаконичная красная деталь */
    }

    /* Логотип-картинка (SVG) вместо текстового */
    .site-logo__img {
      display: block;
      height: 36px;
      width: auto;
    }

    /* --- 2а. Выпадающие меню «Аренда»/«Продажа»: категории 1-го уровня
          в 2 колонки. Открываются по :hover/:focus-within, только десктоп;
          в мобильной панели меню скрыты (категории — на страницах разделов). --- */
    .site-nav__item {
      position: relative;
      /* Обёртка пункта с подменю — flex: ссылка внутри становится
         flex-элементом (блоком), её вертикальный padding учитывается в высоте,
         и пункт стоит на той же высоте, что обычные ссылки .site-nav__link
         (у inline-ссылки padding 6px 0 на высоту строки не влияет). */
      display: flex;
      align-items: center;
    }

    .site-nav__menu {
      position: absolute;
      top: 100%;
      left: 50%;
      transform: translate(-50%, 8px);
      display: none;
      min-width: 460px;
      padding: 20px 24px 16px;
      background-color: var(--bg-white);
      border: 1px solid var(--border-color);
      border-top: 2px solid var(--norwegian-red);
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-soft);
      z-index: 110;
    }

    .site-nav__item:hover .site-nav__menu,
    .site-nav__item:focus-within .site-nav__menu {
      display: block;
    }

    /* «Мостик» между пунктом меню и панелью, чтобы меню не схлопывалось
       при движении курсора вниз */
    .site-nav__menu::before {
      content: "";
      position: absolute;
      top: -10px;
      left: 0;
      right: 0;
      height: 10px;
    }

    .site-nav__menu-cols {
      columns: 2;
      column-gap: 24px;
      margin: 0 0 12px;
      padding: 0;
      list-style: none;
    }

    .site-nav__menu-cols li {
      break-inside: avoid;
    }

    .site-nav__menu-cols a {
      display: block;
      padding: 6px 0;
      font-size: 0.875rem;
      color: var(--text-dark);
      white-space: nowrap;
    }

    .site-nav__menu-cols a:hover {
      color: var(--norwegian-red);
    }

    .site-nav__menu-all {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 6px;
      width: 100%;
      padding-top: 10px;
      border-top: 1px solid var(--border-color);
      font-size: 0.8125rem;
      font-weight: 600;
      color: var(--norwegian-red);
    }

    .site-nav__menu-all svg {
      width: 14px;
      height: 14px;
      transition: transform var(--transition-speed) ease;
    }

    .site-nav__menu-all:hover {
      color: var(--norwegian-red-hover);
    }

    .site-nav__menu-all:hover svg {
      transform: translateX(3px);
    }

    /* --- 2. Навигация (по центру за счёт авто-отступов) --- */
    .site-nav {
      display: flex;
      gap: 1.75rem;
      margin-inline: auto;
    }

    .site-nav__link {
      position: relative;
      padding: 6px 0;
      font-size: 0.9375rem;
      font-weight: 500;
      color: var(--text-dark);
      transition: color var(--transition-speed) ease;
    }

    .site-nav__link:hover {
      color: var(--norwegian-red);
    }

    /* Активный раздел: красный текст + 2px подчёркивание */
    .site-nav__link.active {
      color: var(--norwegian-red);
    }

    .site-nav__link.active::after {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 2px;
      border-radius: 2px;
      background-color: var(--norwegian-red);
    }

    /* --- 3. Правая панель: авторизация + CTA --- */
    .site-actions {
      display: flex;
      align-items: center;
      gap: 1.25rem;
    }

    .site-actions__auth {
      font-size: 0.9375rem;
      font-weight: 500;
      color: var(--text-muted);
      white-space: nowrap;
      transition: color var(--transition-speed) ease;
    }

    .site-actions__auth:hover {
      color: var(--norwegian-red);
    }

    /* Главная кнопка — сплошной фирменный красный, белый текст */
    .site-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.375rem;
      padding: 0.625rem 1.25rem;
      border-radius: var(--border-radius);
      background-color: var(--norwegian-red);
      color: var(--bg-white);
      font-size: 0.875rem;
      font-weight: 600;
      line-height: 1;
      white-space: nowrap;
      transition: background-color var(--transition-speed) ease,
                  box-shadow var(--transition-speed) ease;
    }

    .site-btn:hover {
      background-color: var(--norwegian-red-hover);
      color: var(--bg-white);
      box-shadow: var(--shadow-soft);
    }

    .site-btn__plus {
      font-size: 1rem;
      font-weight: 700;
      line-height: 1;
    }

    /* --- Бургер: скрыт на десктопе --- */
    .site-burger {
      display: none;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 5px;
      width: 40px;
      height: 40px;
      cursor: pointer;
    }

    .site-burger span,
    .site-burger::before,
    .site-burger::after {
      content: "";
      display: block;
      width: 22px;
      height: 2px;
      border-radius: 1px;
      background-color: var(--text-dark);
      transition: transform var(--transition-speed) ease,
                  opacity var(--transition-speed) ease;
    }

    /* --- Адаптив: планшет и мобильные (≤ 960px) --- */
    @media (max-width: 960px) {
      .site-header__inner {
        justify-content: space-between;
        gap: 1rem;
      }

      .site-logo {
        order: 1;             /* лого слева */
      }

      .site-actions {
        order: 2;             /* кнопка CTA справа */
        margin-left: auto;
      }

      .site-burger {
        order: 3;             /* бургер — крайний справа */
        display: inline-flex;
        margin-left: 4px;
      }

      /* Навигация превращается в выпадающую панель (CSS-only) */
      .site-nav {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        flex-direction: column;
        gap: 0;
        margin-inline: 0;
        background-color: var(--bg-white);
        border-bottom: 1px solid var(--border-color);
        box-shadow: var(--shadow-soft);
      }

      .site-nav__link {
        padding: 16px 24px;
        border-top: 1px solid var(--border-color);
      }

      /* В мобильной панели обёртка пункта с подменю и её ссылка ведут себя
         как обычные пункты: блочная строка на всю ширину с рамкой сверху */
      .site-nav__item {
        display: block;
      }

      .site-nav__item .site-nav__link {
        display: block;
        width: 100%;
      }

      /* Подчёркивание активного пункта не нужно в списке */
      .site-nav__link.active::after {
        display: none;
      }

      /* Выпадающие меню категорий — только на десктопе */
      .site-nav__menu {
        display: none !important;
      }

      /* Открытие меню и анимация бургера в крестик — без JS */
      #site-nav-toggle:checked ~ .site-nav {
        display: flex;
      }

      #site-nav-toggle:checked ~ .site-burger span {
        opacity: 0;
      }

      #site-nav-toggle:checked ~ .site-burger::before {
        transform: translateY(7px) rotate(45deg);
      }

      #site-nav-toggle:checked ~ .site-burger::after {
        transform: translateY(-7px) rotate(-45deg);
      }
    }

    /* Узкие экраны: прячем ссылку входа/имени — остаётся бургер и CTA */
    @media (max-width: 560px) {
      .site-actions__auth {
        display: none;
      }

      .site-btn {
        padding: 0.5rem 0.875rem;
        font-size: 0.8125rem;
      }
    }
  </style>

</header>
