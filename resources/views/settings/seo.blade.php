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
                                    <form class="default-form-style" action="{{route('settings.seo')}}" method="post">
                                        @csrf
                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-12 col-12">
                                                    <div class="form-group">
                                                        <label>Заголовок страницы (Title)</label>
                                                        <input type="text" value="{{old('seo.title', $seoSettings['seo.title'] ?? '')}}" name="seo.title" placeholder="Заголовок сайта">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-12">
                                                    <div class="form-group">
                                                        <label>Мета-описание (Description)</label>
                                                        <textarea name="seo.description" rows="4" placeholder="Описание сайта для поисковых систем">{{old('seo.description', $seoSettings['seo.description'] ?? '')}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-12">
                                                    <div class="form-group">
                                                        <label>Ключевые слова (Keywords)</label>
                                                        <input type="text" value="{{old('seo.keywords', $seoSettings['seo.keywords'] ?? '')}}" name="seo.keywords" placeholder="ключевые слова через запятую">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button mb-0 mt-5">
                                                    <button type="submit" class="btn">Сохранить настройки SEO</button>
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