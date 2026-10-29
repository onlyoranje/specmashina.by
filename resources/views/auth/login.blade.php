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
            <input class="auth-visually-hidden auth-check__input" type="checkbox" id="remember" name="remember" @checked(old('remember'))>
            <span class="auth-check__box" aria-hidden="true"></span>
            <span class="auth-check__text">Запомнить меня</span>
          </label>

          @if (Route::has('password.request'))
            <a class="auth-link" href="{{ route('password.request') }}">Забыли пароль?</a>
          @endif
        </div>

        {{-- Главная CTA --}}
        <button type="submit" class="btn-auth">Войти</button>
      </form>

      {{-- Переход на регистрацию --}}
      <p class="auth-footer">
        Впервые на сайте?
        <a class="auth-footer__link" href="{{ route('register') }}">Зарегистрироваться</a>
      </p>

    </div>
  </section>

@endsection

