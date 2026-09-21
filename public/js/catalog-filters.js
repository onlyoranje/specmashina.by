/* ==========================================================================
   AJAX-ФИЛЬТРЫ КАТАЛОГА  ·  public/js/catalog-filters.js
   ==========================================================================
   Все фильтры каталога (/rent, /sale, /rent/{rubric}, /sale/{rubric})
   применяются без перезагрузки страницы:

     • город подачи   — <select data-filter="city_id"> (change) и submit формы;
     • категория      — ссылки «Категории» в сайдбаре, «← Все категории»;
     • сортировка     — «по дате» / «по цене»;
     • вид списка     — «Сетка» / «Список» (применяется на сервере классом
                        .is-grid: состояние приходит в разметке);
     • пагинация      — номера страниц и стрелки.

   Источник данных — тот же роут, что и страница: с заголовком
   X-Requested-With он отдаёт JSON с готовыми HTML-фрагментами
   (CatalogController::index → partials/{sidebar,main}). Скрипт лишь
   подменяет элементы #catalog-sidebar / #catalog-main и обновляет
   заголовок, счётчик и адресную строку.

   Всё на нативных ссылках и формах: если JS не загрузился или запрос упал,
   фильтры продолжают работать обычной перезагрузкой страницы.
   ========================================================================== */
(function () {
  'use strict';

  var page = document.getElementById('catalog-page');
  if (!page || !window.fetch || !window.DOMParser) return;

  var loader = document.getElementById('catalog-loading');
  var status = document.getElementById('catalog-status');
  var controller = null;          // AbortController активного запроса

  /** CSRF-токен (из meta в redesign/layouts/base). Для GET не обязателен. */
  function csrfToken() {
    var meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : '';
  }

  /** Индикатор загрузки + блокировка повторных кликов по результатам. */
  function setLoading(on) {
    if (loader) loader.hidden = !on;
    page.classList.toggle('is-loading', on);
    var layout = document.getElementById('catalog-layout');
    if (layout) layout.setAttribute('aria-busy', on ? 'true' : 'false');
  }

  /** Плавно подводим пользователя к результатам (на мобильных фильтры сверху). */
  function scrollToResults() {
    var layout = document.getElementById('catalog-layout');
    if (!layout) return;
    var top = layout.getBoundingClientRect().top + window.pageYOffset - 16;
    if (window.scrollY > top) {
      window.scrollTo({ top: top, behavior: 'smooth' });
    }
  }

  /** Обновление шапки: заголовок вкладки, H1, счётчик, крошка. */
  function updateHeader(data) {
    if (data.title) document.title = data.title;

    var crumb = document.getElementById('catalog-crumb');
    if (crumb && data.crumb) crumb.textContent = data.crumb;

    var heading = document.getElementById('catalog-heading');
    if (heading && data.heading) heading.textContent = data.heading;

    var counter = document.getElementById('catalog-counter');
    if (counter && data.counter) counter.textContent = data.counter;

    if (status && data.counter) {
      status.textContent = data.counter + ' — список обновлён';
    }
  }

  /** Подмена колонок фильтров и результатов пришедшими фрагментами. */
  function replaceColumns(data) {
    var parsed = new DOMParser().parseFromString(data.sidebar + data.main, 'text/html');

    var oldSidebar = document.getElementById('catalog-sidebar');
    var oldMain = document.getElementById('catalog-main');
    var newSidebar = parsed.getElementById('catalog-sidebar');
    var newMain = parsed.getElementById('catalog-main');

    if (oldSidebar && newSidebar) oldSidebar.replaceWith(newSidebar);
    if (oldMain && newMain) oldMain.replaceWith(newMain);
  }

  /**
   * Загрузка состояния каталога.
   * @param {string} url
   * @param {{push?: boolean, scroll?: boolean, focus?: boolean}} options
   */
  function load(url, options) {
    options = options || {};

    // Предыдущий запрос больше не нужен — отменяем (быстрые клики по фильтрам).
    if (controller) controller.abort();
    controller = new AbortController();

    setLoading(true);

    fetch(url, {
      signal: controller.signal,
      credentials: 'same-origin',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken()
      }
    })
      .then(function (response) {
        if (!response.ok) throw new Error('HTTP ' + response.status);
        return response.json();
      })
      .then(function (data) {
        replaceColumns(data);
        updateHeader(data);

        if (options.push !== false) {
          window.history.pushState({ catalog: true }, '', data.url || url);
        }

        setLoading(false);

        if (options.scroll) scrollToResults();

        // Клавиатурный сценарий: переводим фокус на результаты,
        // чтобы скринридер прочитал обновлённый список.
        if (options.focus) {
          var main = document.getElementById('catalog-main');
          if (main) {
            main.setAttribute('tabindex', '-1');
            main.focus({ preventScroll: true });
          }
        }
      })
      .catch(function (error) {
        if (error && error.name === 'AbortError') return;   // отменённый запрос — норма
        // Любая другая ошибка: не оставляем пользователя с пустым экраном,
        // применяем фильтр обычной перезагрузкой.
        window.location.href = url;
      });
  }

  // --- 1. Ссылки: категории, сортировка, вид, пагинация -------------------
  page.addEventListener('click', function (event) {
    var link = event.target.closest('[data-ajax-link]');
    if (!link || !link.href) return;

    // Не вмешиваемся в открытие новой вкладки/окна.
    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button > 0) return;
    if (link.target && link.target !== '_self') return;

    event.preventDefault();

    load(link.href, {
      push: true,
      // К результатам прокручиваем при выборе категории и листании страниц:
      // сортировка и вид — это панель над списком, прокрутка не нужна.
      scroll: !!(link.closest('.catalog-categories') || link.closest('.catalog-pagination')),
      focus: event.detail === 0      // активация с клавиатуры (Enter/Space)
    });
  });

  // --- 2. Смена города в <select> -----------------------------------------
  page.addEventListener('change', function (event) {
    var select = event.target.closest('select[data-filter]');
    if (!select) return;

    var url = new URL(window.location.href);

    // Смена фильтра всегда возвращает на первую страницу.
    url.searchParams.delete('page');

    if (select.value) {
      url.searchParams.set(select.name, select.value);
    } else {
      url.searchParams.delete(select.name);
    }

    load(url.toString(), { push: true, scroll: false, focus: false });
  });

  // --- 3. Отправка формы фильтрации (fallback и «Показать» без JS) --------
  page.addEventListener('submit', function (event) {
    var form = event.target.closest('.city-filter-form');
    if (!form) return;

    event.preventDefault();

    var url = new URL(form.action || window.location.href, window.location.origin);
    var data = new URLSearchParams(new FormData(form));
    data.delete('page');                 // смена фильтра → первая страница

    url.search = data.toString();
    load(url.toString(), { push: true, scroll: false, focus: true });
  });

  // --- 4. Кнопки «назад/вперёд» браузера ---------------------------------
  window.addEventListener('popstate', function () {
    load(window.location.href, { push: false, scroll: false, focus: false });
  });
})();