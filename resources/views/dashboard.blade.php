
@extends('layouts.dashboard')
@section('title', 'Личный кабинет')

@section('main')

    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">

                @include('layouts.dashboard_profile')

                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="main-content">
                        <!-- Start Details Lists -->
                        <div class="details-lists">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list">
                                        <div class="list-icon">
                                            <i class="lni lni-checkmark-circle"></i>
                                        </div>
                                        <h3>
                                            {{count($bbs)}}
                                            <span>Всего объявлений</span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list two">
                                        <div class="list-icon">
                                            <i class="lni lni-bolt"></i>
                                        </div>
                                        <h3>
                                            {{count($bbs_active)}}
                                            <span>Опубликовано </span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list three">
                                        <div class="list-icon">
                                            <i class="lni lni-emoji-sad"></i>
                                        </div>
                                        <h3>
                                            {{count($bbs_moderation)}}
                                            <span>На модерации </span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                            </div>
                        </div>
                        <!-- End Details Lists -->
                        <div class="row">

                            <div class="col-lg-6 col-md-12 col-12">
                                <div class="activity-log dashboard-block">
                                    <div class="block-head">
                                        <h3 class="block-title">Новые уведомления</h3>
                                        <div class="block-actions">
                                            <a class="btn alt-btn" href="{{route('alerts')}}">Все уведомления</a>
                                        </div>
                                    </div>

                                    <ul class="adm-list">
                                        @if (isset($notifications) and count($notifications)>0)
                                            @foreach ($notifications as $notification)
                                        <li>
                                            <div class="log-icon" id="alert{{$notification->id}}">

                                                <i class="{{($notification->read_at)?'fa-regular':'fa-solid'}} fa-bell"></i>
                                            </div>
                                            <a href="javascript:void(0)" id="alerttext{{$notification->id}}" class="title">{{$notification->title}}</a>

                                            <span class="time ">{{ \Carbon\Carbon::parse($notification->created_at)->format('H:i:s d.m.Y') }}</span>
                                            <span class="remove"><a  data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$notification->id}}"><i class="fa-solid fa-expand"></i></a></span>
                                        </li>

                                                @endforeach
                                            @else
                                                <li class="adm-empty">Уведомлений пока нет</li>
                                            @endif
                                    </ul>
                                </div>

                                <!-- End Activity Log -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-12">
                                @if (count($bbs_moderation)>0)
                                <div class="recent-items dashboard-block">
                                    <div class="block-head">
                                        <h3 class="block-title">На модерации</h3>
                                        <span class="block-count">{{count($bbs_moderation)}}</span>
                                    </div>
                                    <ul class="adm-list">
                                        @foreach($bbs_moderation as $bb)
                                            <li>
                                                @include('bb.dashboardcard')
                                            </li>

                                        @endforeach

                                    </ul>
                                </div>
                            @endif
                                    @if (count($bbs_moderation_fail)>0)
                                        <div class="recent-items dashboard-block">
                                            <div class="block-head">
                                                <h3 class="block-title">Не прошло модерацию</h3>
                                                <span class="block-count">{{count($bbs_moderation_fail)}}</span>
                                            </div>
                                            <ul class="adm-list">
                                                @foreach($bbs_moderation_fail as $bb)
                                                    <li>
                                                        @include('bb.dashboardcard')
                                                    </li>

                                                @endforeach

                                            </ul>
                                        </div>
                                @endif
                                <!-- Start Recent Items -->
                                <div class="recent-items dashboard-block">
                                    <div class="block-head">
                                        <h3 class="block-title">Популярные</h3>
                                        <span class="block-count">{{count($bbs_popular)}}</span>
                                    </div>
                                    <ul class="adm-list">
                                        @forelse($bbs_popular as $bb)

                                        <li>
@include('bb.dashboardcard')

                                        </li>
                                        @empty
                                            <li class="adm-empty">Объявлений пока нет</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <!-- End Recent Items -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">

                    <script>

                    </script>
                </div>
            </div>
        </div>
    </section>


@endsection
