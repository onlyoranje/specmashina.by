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
                                <h3 class="block-title">Статические страницы</h3>
                                <div class="block-actions">
                                    <a href="{{route('page_add')}}" class="btn">+ Добавить страницу</a>
                                </div>
                            </div>
                            <ul class="adm-list">
                                @forelse ($pages as $page)
                                    <li>
                                        <div class="log-icon">
                                            <i class="lni lni-flag-alt"></i>
                                        </div>
                                        <a href="{{route('page_dashboard', ['page' => $page->id])}}" class="title">{{$page->title}}</a>
                                        <span class="time"><a href="{{route('page', ['page' => $page->id])}}" target="_blank">Открыть</a></span>
                                        <span class="time"><a href="{{route('page_dashboard', ['page' => $page->id])}}">Редактировать</a></span>
                                        <span class="time"><a href="{{route('delete_page', ['page' => $page->id])}}" class="text-danger">Удалить</a></span>
                                    </li>
                                @empty
                                    <li class="adm-empty">Пока нет ни одной статической страницы</li>
                                @endforelse
                            </ul>
                        </div>
                        <!-- End Activity Log -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
