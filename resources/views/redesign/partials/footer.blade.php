{{-- Футер редизайна. Контакты — из config/site.php --}}
<footer class="footer" id="contacts">
  <div class="container">
    <div class="footer__grid">
      <div class="footer__brand">
        <a class="logo logo--invert" href="{{ url('/') }}">
          <span class="logo__mark" aria-hidden="true"></span>спец<span class="logo__accent">машина</span><span class="logo__tld">.by</span>
        </a>
        <p>Аренда и продажа строительной спецтехники в Беларуси с 2014 года.</p>
      </div>

      <nav class="footer__col" aria-label="Разделы">
        <h4>Разделы</h4>
        <ul>
          <li><a href="{{ url('/#categories') }}">Каталог</a></li>
          <li><a href="{{ url('/#advantages') }}">Преимущества</a></li>
          <li><a href="{{ url('/#contacts') }}">Контакты</a></li>
        </ul>
      </nav>

      <nav class="footer__col" aria-label="Категории техники">
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

    <div class="footer__bottom">
      <p>© {{ date('Y') }} «{{ config('site.name') }}». Все права защищены.</p>
      <p>Новый фронтенд: HTML5 + CSS3, без фреймворков</p>
    </div>
  </div>
</footer>
