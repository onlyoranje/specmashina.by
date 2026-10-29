{{-- ==========================================================================
  Страница регистрации (Sign Up) — landi.by.
  Дизайн: скандинавский минимализм (референс — norwegian.com).
  База: редизайн-лейаут (шапка/футер/токены), стили — public/css/auth.css.
=========================================================================== --}}
@extends('redesign.layouts.base')

@section('title', 'Создать аккаунт — ' . config('site.name', 'LANDI.BY'))

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

      <h1 class="auth-title">Создать аккаунт</h1>

      <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        {{-- Тип аккаунта: радио-группа account_type.
             Визуально — плоские «тарифные» табы Norwegian, технически —
             обычные radio: значение скрытого (sr-only) инпута меняется
             при переключении без единой строки JS. --}}
        <div class="auth-field">
          <span class="auth-label" id="account-type-label">Тип аккаунта</span>
          <div class="auth-tabs" role="radiogroup" aria-labelledby="account-type-label">
            <input class="auth-visually-hidden auth-check__input" type="radio" id="type-customer" name="account_type" value="customer"
                   @checked(old('account_type', 'customer') === 'customer')>
            <label class="auth-tabs__label" for="type-customer">
              <span class="auth-tabs__title">Я ищу технику</span>
              <span class="auth-tabs__hint">Заказчик</span>
            </label>

            <input class="auth-visually-hidden auth-check__input" type="radio" id="type-owner" name="account_type" value="owner"
                   @checked(old('account_type') === 'owner')>
            <label class="auth-tabs__label" for="type-owner">
              <span class="auth-tabs__title">У меня свой парк</span>
              <span class="auth-tabs__hint">Владелец / Компания</span>
            </label>
          </div>
          @error('account_type')
            <p class="auth-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Имя / название компании --}}
        <div class="auth-field">
          <label class="auth-label" for="name">Ваше имя / Название компании</label>
          <input id="name"
                 type="text"
                 name="name"
                 class="auth-input @error('name') auth-input--error @enderror"
                 value="{{ old('name') }}"
                 placeholder="ООО «СтройТехПарк»"
                 required
                 autocomplete="name"
                 autofocus
                 @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
          @error('name')
            <p class="auth-error" id="name-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

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
                 @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
          @error('email')
            <p class="auth-error" id="email-error" role="alert">{{ $message }}</p>
          @enderror
        </div>


        {{-- Телефон в международном формате --}}
        <div class="auth-field">
          <label class="auth-label" for="phone">Номер телефона</label>
          <input id="phone"
                 type="tel"
                 name="phone"
                 class="auth-input @error('phone') auth-input--error @enderror"
                 value="{{ old('phone') }}"
                 placeholder="+375 29 123-45-67"
                 required
                 inputmode="tel"
                 autocomplete="tel"
                 @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror>
          @error('phone')
            <p class="auth-error" id="phone-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Пароль --}}
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

        {{-- Юридическое согласие (обязательно для РБ) --}}
        <div class="auth-field auth-field--legal">
          <label class="auth-check auth-check--legal" for="agreement">
            <input class="auth-visually-hidden auth-check__input" type="checkbox" id="agreement" name="agreement" value="1"
                   required
                   @checked(old('agreement'))>
            <span class="auth-check__box" aria-hidden="true"></span>
            <span class="auth-check__text auth-check__text--legal">
              Нажимая кнопку, вы соглашаетесь с
              <a href="{{ route('legal.user-agreement') }}">Пользовательским соглашением</a>
              и <a href="{{ route('legal.privacy-policy') }}">Политикой обработки персональных данных</a>
            </span>
          </label>
          @error('agreement')
            <p class="auth-error" role="alert">{{ $message }}</p>
          @enderror
        </div>

        {{-- Главная CTA --}}
        <button type="submit" class="btn-auth">Создать аккаунт</button>
      </form>

      {{-- Переход на вход --}}
      <p class="auth-footer">
        Уже есть аккаунт?
        <a class="auth-footer__link" href="{{ route('login') }}">Войти</a>
      </p>

    </div>
  </section>

@endsection

