@extends('layouts.base')

@section('title', 'Авторизация на сайте')
@section('main')
    <section class="login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="form-head">
                        <h4 class="title">Авторизация на сайте</h4>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>E-mail</label>
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>@error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Пароль</label>
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="check-and-pass">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label">Запомнить меня на этом сайте</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="lost-pass">Забыли пароль?</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="button">
                                <button type="submit" class="btn"> Вход</button>
                            </div>
                            <div class="alt-option">
                                <span>Или</span>
                            </div>
                            <div class="socila-login">
                                <ul>
                                    <li><a href="javascript:void(0)" class="facebook"><i class="lni lni-facebook-original"></i>Войти через
                                            Facebook</a></li>
                                    <li><a href="javascript:void(0)" class="google"><i class="lni lni-google"></i>Войти через Google
                                            </a>
                                    </li>
                                </ul>
                            </div>
                            <p class="outer-link">Нет аккаунта? <a href="{{route('register')}}">Зарегистрироваться</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
