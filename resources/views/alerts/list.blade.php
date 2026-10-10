@extends('layouts.dashboard')
@section('title', 'Уведомления')

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
                                <h3 class="block-title">Уведомления</h3>
                                <span class="block-count">{{count($alerts)}}</span>
                            </div>
                            <ul class="adm-list">
                                @forelse ($alerts as $alert)
                                    <li id="alert_{{$alert->id}}">
                                        <div class="log-icon">
                                            <i class="{{($alert->read_at)?'fa-regular':'fa-solid'}} fa-bell"></i>
                                        </div>
                                        <div class="title">
                                            {{$alert->title}}
                                            <div class="adm-muted">{!! $alert->comment !!}</div>
                                        </div>
                                        <span class="time">{{date('H:i:s d.m.Y', strtotime($alert->created_at))}}</span>
                                        @if (!$alert->read_at)
                                            <span class="time">
                                                <a href="javascript:void(0)" id="alert_btn_{{$alert->id}}"
                                                   onclick="read_alert({{$alert->id}})">Пометить прочитанным</a>
                                            </span>
                                        @else
                                            <span class="time">Прочитано</span>
                                        @endif
                                    </li>
                                @empty
                                    <li class="adm-empty">Уведомлений пока нет</li>
                                @endforelse
                            </ul>

                            {{-- Пагинация в стиле Norwegian Air — как в разделах
                                 городов / производителей / новостей. --}}
                            @if ($alerts->hasPages())
                                <div class="adm-list-pages">
                                    {{ $alerts->links('pagination::norwegian') }}
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
