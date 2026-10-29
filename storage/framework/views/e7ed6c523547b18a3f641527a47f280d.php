
<header class="site-header">
  
  <?php ($unreadAlerts = Auth::check() ? Auth::user()->countAlerts() : 0); ?>
  <div class="site-header__inner container">

    
    <input type="checkbox" id="site-nav-toggle" class="site-nav-toggle">
    <label for="site-nav-toggle" class="site-burger" aria-label="Открыть меню"><span></span></label>

    
    <a class="site-logo" href="<?php echo e(route('home')); ?>">
      <img class="site-logo__img"
           src="<?php echo e(asset('images/logo/logo.svg')); ?>"
           alt="LANDI.BY — аренда и продажа спецтехники в Беларуси">
    </a>

    
    <nav class="site-nav" aria-label="Основная навигация">
      <div class="site-nav__item">
        <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['site-nav__link', 'active' => request()->routeIs('rent.*')]); ?>"
           href="<?php echo e(route('rent.index')); ?>">Аренда</a>

        <div class="site-nav__menu" aria-label="Категории аренды">
          <ul class="site-nav__menu-cols">
            <?php $__currentLoopData = $rentMenuCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="<?php echo e(route('rent.index', $cat->id)); ?>"><?php echo e($cat->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <a class="site-nav__menu-all" href="<?php echo e(route('catalog.all')); ?>">Весь каталог
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </div>

      <div class="site-nav__item">
        <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['site-nav__link', 'active' => request()->routeIs('sale.*')]); ?>"
           href="<?php echo e(route('sale.index')); ?>">Продажа</a>

        <div class="site-nav__menu" aria-label="Категории продажи">
          <ul class="site-nav__menu-cols">
            <?php $__currentLoopData = $saleMenuCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="<?php echo e(route('sale.index', $cat->id)); ?>"><?php echo e($cat->title); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <a class="site-nav__menu-all" href="<?php echo e(route('catalog.all')); ?>">Весь каталог
            <svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8h9M8 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </div>
      </div>

      <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['site-nav__link', 'active' => request()->routeIs('organizations', 'organization.*')]); ?>"
         href="<?php echo e(route('organizations')); ?>">Организации</a>

      <a class="<?php echo \Illuminate\Support\Arr::toCssClasses(['site-nav__link', 'active' => request()->routeIs('news.*')]); ?>"
         href="<?php echo e(route('news.index')); ?>">Новости</a>

      
      <div class="site-nav__auth">
        <?php if(auth()->guard()->guest()): ?>
          <a class="site-nav__auth-link" href="<?php echo e(route('login')); ?>">Вход / Регистрация</a>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
          <span class="site-nav__user">
            <a class="site-nav__auth-link" href="<?php echo e(route('dashboard')); ?>" title="Личный кабинет">
              <?php echo e(Auth::user()->name); ?>

            </a>
            
            <?php if($unreadAlerts > 0): ?>
              <a class="site-alerts-counter" href="<?php echo e(route('alerts')); ?>"
                 title="Новые уведомления: <?php echo e($unreadAlerts); ?>"
                 aria-label="Новые уведомления: <?php echo e($unreadAlerts); ?>">
                <?php echo e($unreadAlerts > 99 ? '99+' : $unreadAlerts); ?>

              </a>
            <?php endif; ?>
          </span>
        <?php endif; ?>
      </div>
    </nav>

    
    <div class="site-actions">
      <?php if(auth()->guard()->guest()): ?>
        <a class="site-actions__auth" href="<?php echo e(route('login')); ?>">Вход / Регистрация</a>
      <?php endif; ?>

      <?php if(auth()->guard()->check()): ?>
        <span class="site-actions__user">
          <a class="site-actions__auth" href="<?php echo e(route('dashboard')); ?>" title="Личный кабинет">
            <?php echo e(Auth::user()->name); ?>

          </a>
          
          <?php if($unreadAlerts > 0): ?>
            <a class="site-alerts-counter" href="<?php echo e(route('alerts')); ?>"
               title="Новые уведомления: <?php echo e($unreadAlerts); ?>"
               aria-label="Новые уведомления: <?php echo e($unreadAlerts); ?>">
              <?php echo e($unreadAlerts > 99 ? '99+' : $unreadAlerts); ?>

            </a>
          <?php endif; ?>
        </span>
      <?php endif; ?>

      <a class="site-btn" href="<?php echo e(route('addForm')); ?>">
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

    /* --- 2б. Вход/личный кабинет в панели бургера (только мобильные).
           На десктопе этот блок скрыт: там авторизация живёт в .site-actions. --- */
    .site-nav__auth {
      display: none;
    }

    .site-nav__auth-link {
      display: block;
      font-size: 0.9375rem;
      font-weight: 500;
      color: var(--text-dark);
      transition: color var(--transition-speed) ease;
    }

    .site-nav__auth-link:hover {
      color: var(--norwegian-red);
    }

    /* Обёртка «логин + счётчик уведомлений» в панели — якорь для красного кружка */
    .site-nav__user {
      position: relative;
      display: inline-flex;
      align-items: center;
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

    /* Обёртка «логин + счётчик уведомлений» — якорь для красного кружка */
    .site-actions__user {
      position: relative;
      display: inline-flex;
      align-items: center;
    }

    /* Красный кружок новых уведомлений: справа вверху от логина */
    .site-alerts-counter {
      position: absolute;
      top: 0;
      right: 0;
      transform: translate(45%, -50%);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 14px;
      height: 14px;
      padding: 0 4px;
      border-radius: 999px;
      background-color: var(--norwegian-red);
      color: var(--bg-white);
      font-size: 0.5625rem;   /* 9px */
      font-weight: 700;
      line-height: 1;
      box-shadow: 0 0 0 2px var(--bg-white); /* белая окантовка поверх шапки */
      transition: background-color var(--transition-speed) ease;
    }

    .site-alerts-counter:hover {
      background-color: var(--norwegian-red-hover);
      color: var(--bg-white);
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

      /* Блок входа/авторизации убираем из шапки — он переезжает
         в панель бургера (см. .site-nav__auth ниже) */
      .site-actions__auth,
      .site-actions__user {
        display: none;
      }

      /* …и появляется последним пунктом самой панели бургера */
      .site-nav__auth {
        display: block;
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

    /* Узкие экраны: уменьшаем CTA-кнопку. Блок входа/имени здесь уже не
       участвует — на мобильных он вынесен в панель бургера
       (см. @media (max-width: 960px)) */
    @media (max-width: 560px) {
      .site-btn {
        padding: 0.5rem 0.875rem;
        font-size: 0.8125rem;
      }
    }
  </style>

</header>
<?php /**PATH /workspaces/php-mariadb/specmashina.by/resources/views/components/header.blade.php ENDPATH**/ ?>