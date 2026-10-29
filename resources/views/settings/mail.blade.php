@extends('layouts.dashboard')
@section('title', $title)

@section('main')
    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-12">
                    @include('layouts.dashboard_profile')
                    </div>
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">
                        <div class="row">
                            <div class="col-12">
                                <div class="profile-settings-block dashboard-block mt-0">
                                    <div class="block-head">
                                        <h3 class="block-title">{{$title}}</h3>
                                        <div class="block-actions">
                                            <a class="btn alt-btn" href="{{route('dashboard')}}">Назад к дашборду</a>
                                        </div>
                                    </div>
                                    <form class="default-form-style" action="{{route('settings.mail')}}" method="post">
                                        @csrf
                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group">
                                                        <label>SMTP хост</label>
                                                        <input type="text" value="{{old('mail.host', $mailSettings['mail.host'] ?? '')}}" name="mail.host" placeholder="smtp.example.com">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12">
                                                    <div class="form-group">
                                                        <label>SMTP порт</label>
                                                        <input type="number" value="{{old('mail.port', $mailSettings['mail.port'] ?? '')}}" name="mail.port" placeholder="587">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group">
                                                        <label>Шифрование</label>
                                                        <input type="text" value="{{old('mail.encryption', $mailSettings['mail.encryption'] ?? '')}}" name="mail.encryption" placeholder="tls">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group">
                                                        <label>Имя пользователя (логин)</label>
                                                        <input type="text" value="{{old('mail.username', $mailSettings['mail.username'] ?? '')}}" name="mail.username" placeholder="user@example.com">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group">
                                                        <label>Пароль</label>
                                                        <input type="password" value="{{old('mail.password', $mailSettings['mail.password'] ?? '')}}" name="mail.password" placeholder="••••••••">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group">
                                                        <label>От кого (адрес)</label>
                                                        <input type="email" value="{{old('mail.from_address', $mailSettings['mail.from_address'] ?? '')}}" name="mail.from_address" placeholder="noreply@example.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Имя отправителя</label>
                                                        <input type="text" value="{{old('mail.from_name', $mailSettings['mail.from_name'] ?? '')}}" name="mail.from_name" placeholder="СпецМашина">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button mb-0 mt-5">
                                                    <button type="submit" class="btn">Сохранить настройки почты</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    @if (session('error'))
                                        <div class="form-group">
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        </div>
                                    @endif

                                    <form class="default-form-style" action="{{ route('settings.mail.test') }}" method="post" style="margin-top:2rem;">
                                        @csrf
                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group button mb-0">
                                                        <button type="submit" class="btn alt-btn">Отправить тестовое письмо на 47@terwa.by</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection