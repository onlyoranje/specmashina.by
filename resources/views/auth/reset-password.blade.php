{{-- ==========================================================================
  Восстановление пароля — установка нового пароля по токену из письма. landi.by.
  Дизайн: скандинавский минимализм (референс — norwegian.com).
  База: редизайн-лейаут (шапка/футер/токены), стили — public/css/auth.css.
=========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', 'Новый пароль — ' . config('site.name', 'LANDI.BY'))

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

      <h1 class="auth-title">Новый пароль</h1>
      <p class="auth-subtitle">Придумайте новый пароль для вашего аккаунта.</p>

      <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Электронная почта --}}
        <div class="auth-field">
          <label class="auth-label" for="email">Электронная почта</label>
          <input id="email"
                 type="email"
                 name="email"
                 class="auth-input @error('email') auth-input--error @enderror"
                 value="{{ old('email', $request->email) }}"
                 placeholder="you@example.com"
                 required
                 autocomplete="email"
                 autofocus
                 @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
          @error('email')
            <p class="auth-error" id="email-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Новый пароль --}}
        <div class="auth-field">
          <label class="auth-label" for="password">Пароль <span class="auth-label__note">(минимум 8 символов)</span></label>
          <input id="password"
                 type="password"
                 name="password"
                 class="auth-input @error('password') auth-input--error @enderror"
                 placeholder="••••••••"
                 required
                 minlength="8"
                 autocomplete="new-password"
                 @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
          @error('password')
            <p class="auth-error" id="password-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Подтверждение пароля --}}
        <div class="auth-field">
          <label class="auth-label" for="password-confirm">Подтверждение пароля</label>
          <input id="password-confirm"
                 type="password"
                 name="password_confirmation"
                 class="auth-input @error('password_confirmation') auth-input--error @enderror"
                 placeholder="••••••••"
                 required
                 autocomplete="new-password"
                 @error('password_confirmation') aria-invalid="true" aria-describedby="password-confirm-error" @enderror>
          @error('password_confirmation')
            <p class="auth-error" id="password-confirm-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Главная CTA --}}
        <button type="submit" class="btn-auth">Сохранить пароль</button>
      </form>

      {{-- Переход на вход --}}
      <p class="auth-footer">
        Вспомнили пароль?
        <a class="auth-footer__link" href="{{ route('login') }}">Войти</a>
      </p>

    </div>
  </section>

@endsection
