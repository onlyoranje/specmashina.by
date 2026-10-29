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
                                    <form class="default-form-style" action="{{route('settings.site')}}" method="post">
                                        @csrf
                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Название сайта</label>
                                                        <input type="text" value="{{old('site.name', $siteSettings['site.name'] ?? '')}}" name="site.name" placeholder="СпецМашина">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Домен</label>
                                                        <input type="text" value="{{old('site.domain', $siteSettings['site.domain'] ?? '')}}" name="site.domain" placeholder="specmashina.by">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Телефон</label>
                                                        <input type="text" value="{{old('site.phone', $siteSettings['site.phone'] ?? '')}}" name="site.phone" placeholder="+375 (29) 116-66-00">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" value="{{old('site.email', $siteSettings['site.email'] ?? '')}}" name="site.email" placeholder="info@specmashina.by">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Адрес</label>
                                                        <input type="text" value="{{old('site.address', $siteSettings['site.address'] ?? '')}}" name="site.address" placeholder="г. Минск, ул. Промышленная, 12">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Часы работы</label>
                                                        <input type="text" value="{{old('site.work_hours', $siteSettings['site.work_hours'] ?? '')}}" name="site.work_hours" placeholder="Ежедневно 8:00–20:00">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button mb-0 mt-5">
                                                    <button type="submit" class="btn">Сохранить настройки сайта</button>
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