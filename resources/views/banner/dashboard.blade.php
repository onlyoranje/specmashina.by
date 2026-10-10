@extends('layouts.dashboard')
@section('title', $title)

@section('main')
    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-12">
                    <!-- Start Dashboard Sidebar -->
                @include('layouts.dashboard_profile')
                <!-- Start Dashboard Sidebar -->
                </div>
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">

                        <!-- Start Activity Log -->
                        <div class="dashboard-block mt-0">
                            <div class="block-head">
                                <h3 class="block-title">Баннеры</h3>
                                <div class="block-actions">
                                    <a href="{{route('banner_add')}}" class="btn">+ Добавить баннер</a>
                                </div>
                            </div>
                            <ul class="adm-list">
                                @forelse ($banners as $banner)
                                    <li>
                                        <img src="{{Storage::url($banner->image)}}" alt="{{$banner->title}}" class="adm-thumb">
                                        <a href="{{route('banner_dashboard', ['banner' => $banner->id])}}" class="title">{{$banner->title}}</a>
                                        <span class="adm-stats">
                                            Показов: <b>{{$banner->views}}</b><br>
                                            Кликов: <b>{{$banner->clicks}}</b>
                                            @if ($banner->views > 0)
                                                <br>CTR: <b>{{round($banner->clicks / $banner->views * 100, 2)}}%</b>
                                            @endif
                                        </span>
                                        <span class="time"><a href="{{route('banner_dashboard', ['banner' => $banner->id])}}">Редактировать</a></span>
                                        <span class="time"><a href="{{route('delete_banner', ['banner' => $banner->id])}}" class="text-danger">Удалить</a></span>
                                    </li>
                                @empty
                                    <li class="adm-empty">Пока нет ни одного баннера</li>
                                @endforelse
                            </ul>

                            {{-- Пагинация в стиле Norwegian Air — как в разделах
                                 городов / производителей / новостей. --}}
                            @if ($banners->hasPages())
                                <div class="adm-list-pages">
                                    {{ $banners->links('pagination::norwegian') }}
                                </div>
                            @endif
                        </div>
                        <!-- End Activity Log -->

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
