-- SVG-иконки категорий (rubrics.icon).
-- Формат: инлайн SVG без <svg>-обёртки атрибутов класса — класс (размер/цвет) задаётся во вьюхе.
-- Обновляются корневые рубрики (level=0) и категории 1-го уровня (level=1).
-- Горизонтальная линия-«дорога» в иконках не используется.
-- Иконки общие для пар «Аренда / Продажа» (id 2..9 ↔ 119..126 и т.д.), т.к. названия совпадают.

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="24" cy="24" r="16"/><path d="M24 14v10l7 4"/></svg>'
WHERE title='Аренда' AND level=0;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 24 24 6h14v14L20 38 6 24z"/><circle cx="31" cy="13" r="3"/></svg>'
WHERE title='Продажа' AND level=0;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="14" cy="37" r="3.5"/><circle cx="26" cy="37" r="3.5"/><path d="M9 33v-8h13"/><path d="M22 25l9-11 8 4"/><path d="M39 18l4 4-5 5-4-4z"/></svg>'
WHERE title='Экскаватор' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="17" width="18" height="14" rx="2"/><circle cx="14" cy="35" r="4"/><circle cx="27" cy="36" r="3"/><path d="M27 20h9v11"/><path d="M40 12v27"/><path d="M31 15l9-6"/></svg>'
WHERE title='Погрузчик' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M24 42V10"/><path d="M10 10h28"/><path d="M14 10l10 6 10-6"/><path d="M34 10v8"/><path d="M29 18h10l-5 7z"/></svg>'
WHERE title='Кран' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="40" r="4"/><circle cx="32" cy="40" r="4"/><path d="M6 40h26"/><path d="M6 40V20h14"/><path d="M20 20l8-12"/><rect x="28" y="6" width="10" height="8" rx="1.5"/></svg>'
WHERE title='Подъемник' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 34v-8h17"/><path d="M23 34l9-11 10 3-2 14"/><circle cx="12" cy="38" r="4"/><circle cx="32" cy="38" r="4"/></svg>'
WHERE title='Самосвал' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="24" width="14" height="12" rx="2"/><circle cx="12" cy="38" r="4"/><circle cx="32" cy="38" r="4"/><path d="M20 30h6"/><ellipse cx="31" cy="24" rx="8" ry="6" transform="rotate(-20 31 24)"/><path d="M24 34l8-12"/></svg>'
WHERE title='Техника для бетона' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="18" width="24" height="14" rx="2"/><path d="M28 22h8l6 6v4h-8"/><circle cx="12" cy="36" r="4"/><circle cx="36" cy="36" r="4"/><path d="M10 18v-6h12v6"/></svg>'
WHERE title='Транспортировка' AND level=1;

-- Дорожно-строительная техника: дорожный каток (переработанная иконка).
UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="13" cy="32" r="7"/><circle cx="13" cy="32" r="2"/><path d="M20 32h4"/><path d="M24 32V14h12v18"/><rect x="27" y="18" width="6" height="6"/><circle cx="36" cy="36" r="4"/><path d="M32 14V8"/></svg>'
WHERE title='Дорожно-строительная техника' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M35 7a9 9 0 0 0-11 11L10 32a4.2 4.2 0 1 0 6 6l14-14a9 9 0 0 0 11-11l-6 6-4-4 6-6z"/></svg>'
WHERE title='Инструмент' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="16" width="28" height="18" rx="2"/><circle cx="15" cy="38" r="4"/><circle cx="31" cy="38" r="4"/><path d="M36 16v-6h6"/><path d="M24 21l-4 5h6l-4 5"/></svg>'
WHERE title='Электрогенераторы' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="13" cy="36" r="4"/><circle cx="34" cy="36" r="4"/><path d="M17 36h17"/><path d="M8 30v-8h16l6 8"/><path d="M27 6l-5 8h6l-5 8"/></svg>'
WHERE title='Электротранспорт' AND level=1;

UPDATE rubrics SET icon='<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="15" cy="36" r="7"/><circle cx="37" cy="38" r="4"/><path d="M22 36h12"/><path d="M15 29v-8h12l8 8"/><path d="M10 21h8"/></svg>'
WHERE title='Трактор' AND level=1;
