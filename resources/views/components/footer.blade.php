{{-- ==========================================================================
  Футер сайта (Blade-компонент, подключение: <x-footer />).
  Стиль: Norwegian Air — светлый фон, тонкие разделители, много «воздуха».

  Нижняя плашка (.footer__bottom) — юридические документы (роуты legal.*)
  и обязательные для Беларуси реквизиты владельца (реестр рекламораспространителей,
  УНП, свидетельство, Торговый реестр).
=========================================================================== --}}
<footer class="footer" id="contacts">
  <div class="container">

    {{-- ================= Основные колонки ================= --}}
    <div class="footer__grid">
      <div class="footer__brand">
        <a class="logo" href="{{ route('home') }}">
          LANDI<span class="logo__dot">.</span>BY
        </a>
        <p>Открытая площадка объявлений аренды и продажи строительной техники в Беларуси.</p>
      </div>

      <nav class="footer__col" aria-label="Разделы">
        <h4>Разделы</h4>
        <ul>
          <li><a href="{{ url('/#catalog') }}">Каталог</a></li>
          <li><a href="{{ route('rent.index') }}">Аренда</a></li>
          <li><a href="{{ route('sale.index') }}">Продажа</a></li>
          <li><a href="{{ route('news.index') }}">Новости</a></li>
        </ul>
      </nav>

      <nav class="footer__col" aria-label="Техника">
        <h4>Техника</h4>
        <ul>
          <li><a href="{{ url('/#catalog') }}">Экскаваторы</a></li>
          <li><a href="{{ url('/#catalog') }}">Погрузчики</a></li>
          <li><a href="{{ url('/#catalog') }}">Автокраны</a></li>
          <li><a href="{{ url('/#catalog') }}">Самосвалы</a></li>
        </ul>
      </nav>

      <div class="footer__col">
        <h4>Контакты</h4>
        <ul>
          <li>{{ config('site.address') }}</li>
          <li><a href="{{ config('site.phone_link') }}">{{ config('site.phone') }}</a></li>
          <li><a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></li>
          <li>{{ config('site.work_hours') }}</li>
        </ul>
      </div>
    </div>

    {{-- ================= Нижняя плашка: документы и юр. информация ================= --}}
    <div class="footer__bottom">
      <nav class="footer__legal" aria-label="Правовые документы">
        <a href="{{ route('legal.user-agreement') }}">Пользовательское соглашение</a>
        <a href="{{ route('legal.privacy-policy') }}">Политика обработки персональных данных</a>
        <a href="{{ route('legal.offer') }}">Публичная оферта</a>
      </nav>

      <p class="footer__legal-info">Зарегистрирован в реестре рекламораспространителей под номером 4682</p>
      <p class="footer__legal-owner">© {{ date('Y') }} LANDI.BY. ООО «[Название компании]», УНП [000000000]. Свидетельство о государственной регистрации выдано [Кем и когда]. В Торговом реестре РБ с [Дата].</p>
    </div>

  </div>
</footer>