{{-- ==========================================================================
  Восстановление пароля — запрос ссылки на сброс. landi.by.
  Дизайн: скандинавский минимализм (референс — norwegian.com).
  База: редизайн-лейаут (шапка/футер/токены), стили — public/css/auth.css.
=========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', 'Восстановление пароля — ' . config('site.name', 'LANDI.BY'))

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

      <h1 class="auth-title">Восстановление пароля</h1>
      <p class="auth-subtitle">
        Укажите электронную почту, на которую зарегистрирован аккаунт.
        Мы отправим ссылку для создания нового пароля.
      </p>

      {{-- Флеш-статус (например, «Ссылка для сброса пароля отправлена») --}}
      @if (session('status'))
        <p class="auth-status" role="status">{{ session('status') }}</p>
      @endif

      <form method="POST" action="{{ route('password.email') }}" class="auth-form">
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

        {{-- Главная CTA --}}
        <button type="submit" class="btn-auth">Отправить ссылку</button>
      </form>

      {{-- Переход на вход --}}
      <p class="auth-footer">
        Вспомнили пароль?
        <a class="auth-footer__link" href="{{ route('login') }}">Войти</a>
      </p>

    </div>
  </section>

@endsection
