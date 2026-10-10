{{-- ==========================================================================
  Страница входа (Sign In) — landi.by.
  Дизайн: скандинавский минимализм (референс — norwegian.com).
  База: редизайн-лейаут (шапка/футер/токены), стили — public/css/auth.css.
=========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', 'Войти в профиль — ' . config('site.name', 'LANDI.BY'))

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

  <section class="auth-page">
    <div class="auth-container">

      {{-- Логотип — ссылка на главную --}}
      <a class="auth-logo" href="{{ url('/') }}" aria-label="LANDI.BY — на главную">
        LANDI<span class="auth-logo__accent">.BY</span>
      </a>

      <h1 class="auth-title">Войти в профиль</h1>

      {{-- Флеш-сообщение (например, «Вы вышли из аккаунта») --}}
      @if (session('status'))
        <p class="auth-status" role="status">{{ session('status') }}</p>
      @endif

      <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        {{-- Электронная почта --}}
        <div class="auth-field">
          <label class="auth-label" for="email">Электронная почта</label>
          <input id="email"
                 type="email"
                 name="email"
                 class="auth-input @error('email') auth-input--error @enderror"
                 value="{{ old('email') }}"
                 placeholder="you@example.com"
                 required
                 autocomplete="email"
                 autofocus
                 @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
          @error('email')
            <p class="auth-error" id="email-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Пароль --}}
        <div class="auth-field">
          <label class="auth-label" for="password">Пароль</label>
          <input id="password"
                 type="password"
                 name="password"
                 class="auth-input @error('password') auth-input--error @enderror"
                 placeholder="••••••••"
                 required
                 autocomplete="current-password"
                 @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
          @error('password')
            <p class="auth-error" id="password-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Запомнить меня + восстановление пароля --}}
        <div class="auth-row">
          <label class="auth-check" for="remember">
            <input class="auth-visually-hidden" type="checkbox" id="remember" name="remember" @checked(old('remember'))>
            <span class="auth-check__box" aria-hidden="true"></span>
            <span class="auth-check__text">Запомнить меня</span>
          </label>

          @if (Route::has('password.request'))
            <a class="auth-link" href="{{ route('password.request') }}">Забыли пароль?</a>
          @endif
        </div>

        {{-- Главная CTA --}}
        <button type="submit" class="btn-auth">Войти</button>

        {{-- Альтернативный вход --}}
        <div class="auth-divider"><span>или войти с помощью</span></div>

        <div class="auth-social">
          <a class="auth-social__btn" href="{{ route('google.redirect') }}">
            <svg class="auth-social__icon" width="18" height="18" viewBox="0 0 18 18" aria-hidden="true" focusable="false">
              <path fill="#4285F4" d="M17.64 9.2c0-.64-.06-1.25-.16-1.84H9v3.48h4.84a4.14 4.14 0 0 1-1.8 2.72v2.26h2.92a8.78 8.78 0 0 0 2.68-6.62z"/>
              <path fill="#34A853" d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.92-2.26c-.8.54-1.84.86-3.04.86-2.34 0-4.32-1.58-5.03-3.7H.96v2.32A9 9 0 0 0 9 18z"/>
              <path fill="#FBBC05" d="M3.97 10.72a5.41 5.41 0 0 1 0-3.44V4.96H.96a9 9 0 0 0 0 8.08l3.01-2.32z"/>
              <path fill="#EA4335" d="M9 3.58c1.32 0 2.5.45 3.44 1.35l2.58-2.59A9 9 0 0 0 .96 4.96l3.01 2.32C4.68 5.16 6.66 3.58 9 3.58z"/>
            </svg>
            <span>Google</span>
          </a>
          <a class="auth-social__btn" href="#" title="Вход через Яндекс — скоро">
            {{-- TODO: подключить роут Яндекс-авторизации --}}
            <svg class="auth-social__icon" width="18" height="18" viewBox="0 0 18 18" aria-hidden="true" focusable="false">
              <circle cx="9" cy="9" r="9" fill="#FC3F1D"/>
              <text x="9" y="13.2" text-anchor="middle" font-family="Arial, sans-serif" font-size="11" font-weight="700" fill="#FFFFFF">Я</text>
            </svg>
            <span>Яндекс</span>
          </a>
        </div>
      </form>

      {{-- Переход на регистрацию --}}
      <p class="auth-footer">
        Впервые на сайте?
        <a class="auth-footer__link" href="{{ route('register') }}">Зарегистрироваться</a>
      </p>

    </div>
  </section>

@endsection

