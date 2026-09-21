{{-- Шапка редизайна. Мобильное меню — CSS-only (checkbox + :checked ~), без JS. --}}
<header class="header">
  <div class="container header__inner">
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="burger" aria-label="Открыть меню"><span></span></label>

    <a class="logo" href="{{ url('/') }}">
      <span class="logo__mark" aria-hidden="true"></span>спец<span class="logo__accent">машина</span><span class="logo__tld">.by</span>
    </a>

    <nav class="nav" aria-label="Основная навигация">
      <a href="{{ url('/#categories') }}">Каталог</a>
      <a href="{{ url('/#advantages') }}">Преимущества</a>
      <a href="{{ url('/#contacts') }}">Контакты</a>
    </nav>

    <div class="header__actions">
      <a class="header__phone" href="{{ config('site.phone_link') }}">{{ config('site.phone') }}</a>
      <a class="btn btn--primary btn--sm" href="{{ url('/#contacts') }}">Оставить заявку</a>
    </div>
  </div>
</header>
