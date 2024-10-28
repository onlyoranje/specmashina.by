@extends('layouts.base')

@section('title', 'Регистрация на сайте')
@section('main')
    <section class="login registration section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="form-head">
                        <h4 class="title">Регистрация на сайте</h4>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="socila-login">
                                <ul>
                                    <li><a href="javascript:void(0)" class="facebook"><i class="lni lni-facebook-original"></i>Регистрация через Facebook</a></li>
                                    <li><a href="javascript:void(0)" class="google"><i class="lni lni-google"></i>Регистрация через  Google
                                            </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="alt-option">
                                <span>Или</span>
                            </div>
                            <div class="form-group">
                                <label>Имя</label>
                                <input name="name" class="@error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input name="email" type="email" class="@error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Пароль</label>
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Повторите пароль</label>
                                <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="check-and-pass">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input width-auto" id="exampleCheck1">
                                            <label class="form-check-label">Agree to our <a href="javascript:void(0)">Terms and
                                                    Conditions</a></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button">
                                <button type="submit" class="btn">Регистрация</button>
                            </div>
                            <p class="outer-link">Уже есть аккаунт? <a href="{{route('login')}}"> Войти</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
