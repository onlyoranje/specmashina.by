@extends('layouts.dashboard')
@section('title', 'Статусы объявлений')

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
                                <h3 class="block-title">Статусы объявлений</h3>
                                <div class="block-actions">
                                    <a href="{{route('status_dashboard_add')}}" class="btn">+ Добавить статус</a>
                                </div>
                            </div>
                            <ul class="adm-list">
                                @forelse ($statuses as $status)
                                    <li>
                                        <div class="log-icon">
                                            <i class="fa-solid fa-tag" style="color:#{{$status->color_badge}}"></i>
                                        </div>
                                        <a href="{{route('status_dashboard_edit', ['status' => $status])}}" class="title">
                                            {{$status->name}} <span class="adm-muted">(код: {{$status->status}})</span>
                                        </a>
                                        <span class="status-badge" style="--badge: #{{$status->color_badge}}">{{$status->badge_text ?: $status->name}}</span>
                                        <span class="time"><a href="{{route('status_dashboard_edit', ['status' => $status])}}">Редактировать</a></span>
                                        <span class="time"><a href="{{route('status_dashboard_delete', ['status' => $status])}}" class="text-danger">Удалить</a></span>
                                    </li>
                                @empty
                                    <li class="adm-empty">Пока нет ни одного статуса</li>
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
