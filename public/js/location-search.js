/* ==========================================================================
   AJAX-ПОИСК ПО ГОРОДАМ  ·  public/js/location-search.js
   ==========================================================================
   Страница /dashboard/location: строка поиска над списком городов.

     • ввод (debounce 300 мс)  — GET /dashboard/location/search?q=… отвечает
       JSON {html, total}; скрипт подменяет содержимое #location-results
       (список + пагинация) и счётчик #location-count;
     • клик по номеру страницы — тот же AJAX, адресная строка обновляется
       через history.replaceState;
     • кнопка «×» / Escape     — сброс поиска и возврат к полному списку.

   Источник данных — LocationsController::search(). Форма остаётся обычной
   GET-формой (action=/dashboard/location, поле name=q), поэтому без JS или
   при ошибке запроса поиск продолжает работать обычной перезагрузкой страницы.
   ========================================================================== */
(function () {
  'use strict';

  var form = document.getElementById('location-search');
  if (!form || !window.fetch || !window.URL) return;

  var input = form.querySelector('#location-search-input');
  var clear = form.querySelector('#location-search-clear');
  var searchUrl = form.getAttribute('data-search-url');
  var results = document.getElementById('location-results');
  var count = document.getElementById('location-count');

  if (!input || !searchUrl || !results) return;

  var debounceTimer = null;
  // Номер текущего запроса: ответ устаревшего (более медленного) запроса
  // отбрасывается, иначе быстрый набор отрисует старый результат.
  var requestId = 0;
  var DEBOUNCE_MS = 300;

  /** Текст счётчика: «Всего» без запроса, «Найдено» — с ним. */
  function countLabel(total) {
    return (input.value.trim() ? 'Найдено' : 'Всего') + ': ' + total;
  }

  /** Показ/скрытие кнопки сброса. */
  function syncClear() {
    if (clear) clear.hidden = input.value === '';
  }

  /** Адрес строки: /dashboard/location?q=…&page=N (без лишних параметров). */
  function pageUrl(q, page) {
    var params = [];
    if (q) params.push('q=' + encodeURIComponent(q));
    if (page > 1) params.push('page=' + page);
    return form.getAttribute('action') + (params.length ? '?' + params.join('&') : '');
  }

  /** Загрузка фрагмента списка (page — 1-based). */
  function load(q, page) {
    page = page || 1;
    var id = ++requestId;
    var url = searchUrl + '?q=' + encodeURIComponent(q) + (page > 1 ? '&page=' + page : '');

    results.classList.add('is-loading');

    fetch(url, { headers: { 'Accept': 'application/json' } })
      .then(function (response) {
        if (!response.ok) throw new Error('HTTP ' + response.status);
        return response.json();
      })
      .then(function (data) {
        if (id !== requestId) return; // устаревший ответ — игнорируем
        results.innerHTML = data.html;
        if (count) count.textContent = countLabel(data.total);
        window.history.replaceState({}, '', pageUrl(q, page));
      })
      .catch(function () {
        // Сбрасываем состояние загрузки; при ошибке список остаётся прежним,
        // а форматный submit продолжит работать штатной перезагрузкой.
      })
      .then(function () {
        if (id === requestId) results.classList.remove('is-loading');
      });
  }

  /** Отложить запрос до паузы во вводе. */
  function scheduleSearch() {
    window.clearTimeout(debounceTimer);
    debounceTimer = window.setTimeout(function () {
      load(input.value.trim(), 1);
    }, DEBOUNCE_MS);
  }

  // --- Ввод: поиск по мере набора -----------------------------------------
  input.addEventListener('input', function () {
    syncClear();
    scheduleSearch();
  });

  // Enter — не даём форме уезжать на полную перезагрузку, ищем сразу.
  form.addEventListener('submit', function (event) {
    event.preventDefault();
    window.clearTimeout(debounceTimer);
    load(input.value.trim(), 1);
  });

  // Escape — сброс поля (если оно пустое — очистка результата поиска).
  input.addEventListener('keydown', function (event) {
    if (event.key !== 'Escape') return;
    if (input.value === '') return;
    event.preventDefault();
    resetSearch();
  });

  if (clear) {
    clear.addEventListener('click', function () {
      resetSearch();
    });
  }

  function resetSearch() {
    input.value = '';
    syncClear();
    window.clearTimeout(debounceTimer);
    load('', 1);
    input.focus();
  }

  // --- Пагинация: номера страниц и стрелки работают через AJAX -------------
  results.addEventListener('click', function (event) {
    var link = event.target.closest ? event.target.closest('a.page-link') : null;
    if (!link || !results.contains(link)) return;

    var href = link.getAttribute('href');
    if (!href) return;

    event.preventDefault();

    var page = parseInt(new URL(href, window.location.origin).searchParams.get('page'), 10);
    load(input.value.trim(), isNaN(page) ? 1 : page);
  });

  syncClear();
})();
