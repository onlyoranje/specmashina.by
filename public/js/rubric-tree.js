/* ==========================================================================
   ДЕРЕВО КАТЕГОРИЙ  ·  public/js/rubric-tree.js
   ==========================================================================
   /dashboard/rubric: 234 строки дерева в одном плоском <ul id="rubric-tree">
   (resources/views/rubric/partials/tree.blade.php). У каждой строки есть
   data-depth (глубина от корня) и data-id, у родителей — кнопка
   .adm-tree-toggle с aria-expanded.

     • клик по шеврону       — свернуть/развернуть все вложенные подкатегории;
     • «Свернуть/Развернуть все» в шапке блока — массовое переключение;
     • у свёрнутого родителя появляется бейдж с числом скрытых строк;
     • состояние (id свёрнутых категорий) хранится в localStorage.

   Сворачивание — это скрытие идущих ниже строк глубже текущей, пока не
   встретится строка не глубже её (класс .adm-tree-hidden, admin.css, раздел
   23). Вложенные состояния сохраняются: разворачивание родителя показывает
   детей, кроме тех, кто был свёрнут сам по себе.

   Скрипт необязателен: без него список просто отображается развёрнутым,
   ссылки «Редактировать»/«Удалить» работают как обычно.
   ========================================================================== */
(function () {
  'use strict';

  var list = document.getElementById('rubric-tree');
  if (!list) return;

  var STORAGE_KEY = 'specmashina:rubric-collapsed';
  var rows = [];
  var collapsed = {};

  // --- Сбор строк -----------------------------------------------------------
  for (var i = 0; i < list.children.length; i++) {
    var child = list.children[i];
    if (child.tagName === 'LI' && child.hasAttribute('data-depth')) rows.push(child);
  }
  if (!rows.length) return;

  function depthOf(row) {
    return parseInt(row.getAttribute('data-depth'), 10) || 0;
  }

  function idOf(row) {
    return row.getAttribute('data-id');
  }

  /** Кнопка-шеврон есть только у строк с детьми; у листьев — .adm-tree-spacer. */
  function buttonOf(row) {
    return row.querySelector('button.adm-tree-toggle');
  }

  function isCollapsed(id) {
    return collapsed[id] === true;
  }

  // --- Состояние в localStorage --------------------------------------------
  function readState() {
    try {
      var raw = window.localStorage.getItem(STORAGE_KEY);
      if (!raw) return;
      var parsed = JSON.parse(raw);
      if (parsed && typeof parsed === 'object') collapsed = parsed;
    } catch (e) {
      // localStorage недоступен (приватный режим) — работаем без сохранения.
    }
  }

  function writeState() {
    try {
      window.localStorage.setItem(STORAGE_KEY, JSON.stringify(collapsed));
    } catch (e) { /* нет места/доступа — состояние живёт только до перезагрузки */ }
  }

  // --- Отрисовка -----------------------------------------------------------
  /** Бейдж «сколько подкатегорий спрятано» на свёрнутой строке. */
  function setHiddenCount(row, count) {
    if (count > 0) row.setAttribute('data-hidden', String(count));
    else row.removeAttribute('data-hidden');
  }

  function render() {
    // hiddenBelow — глубина ближайшего свёрнутого предка; строки глубже неё
    // скрыты. null означает, что цепочка прервалась (все предки развёрнуты).
    var hiddenBelow = null;
    var counterOf = null;
    var counter = 0;

    for (var i = 0; i < rows.length; i++) {
      var row = rows[i];
      var depth = depthOf(row);

      if (hiddenBelow !== null && depth > hiddenBelow) {
        row.classList.add('adm-tree-hidden');
        counter++;
        continue;
      }

      // Видимая строка: закрываем счётчик у предыдущего свёрнутого родителя.
      if (counterOf) {
        setHiddenCount(counterOf, counter);
        counterOf = null;
        counter = 0;
      }

      row.classList.remove('adm-tree-hidden');
      setHiddenCount(row, 0);

      var btn = buttonOf(row);
      if (!btn) {
        hiddenBelow = null; // лист цепочку не продолжает
        continue;
      }

      var on = isCollapsed(idOf(row));
      btn.setAttribute('aria-expanded', on ? 'false' : 'true');
      if (on) {
        hiddenBelow = depth;
        counterOf = row;
      } else {
        hiddenBelow = null;
      }
    }

    if (counterOf) setHiddenCount(counterOf, counter);
  }

  // --- Переключение --------------------------------------------------------
  function toggle(row) {
    var id = idOf(row);
    if (!id) return;
    if (isCollapsed(id)) delete collapsed[id];
    else collapsed[id] = true;
    writeState();
    render();
  }

  function eachParent(handler) {
    for (var i = 0; i < rows.length; i++) {
      if (buttonOf(rows[i])) handler(rows[i]);
    }
  }

  // --- События -------------------------------------------------------------
  // Делегирование: строки подменяются/скрываются, слушатель один на список.
  list.addEventListener('click', function (event) {
    var btn = event.target.closest ? event.target.closest('button.adm-tree-toggle') : null;
    if (!btn || !list.contains(btn)) return;
    event.preventDefault();
    toggle(btn.parentNode);
  });

  var collapseAll = document.getElementById('rubric-collapse-all');
  if (collapseAll) {
    collapseAll.addEventListener('click', function () {
      eachParent(function (row) { collapsed[idOf(row)] = true; });
      writeState();
      render();
    });
  }

  var expandAll = document.getElementById('rubric-expand-all');
  if (expandAll) {
    expandAll.addEventListener('click', function () {
      collapsed = {};
      writeState();
      render();
    });
  }

  readState();
  render();
})();


