
@extends('layouts.dashboard')
@section('title', 'Главная')

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
                                    <h3 class="block-title">Уведомления</h3>

                                    <ul>
                                        @if (isset($notifications) and count($notifications)>0)
                                            @foreach ($notifications as $notification)
                                        <li>
                                            <div class="log-icon">

                                                <i class="{{($notification->read_at)?'fa-regular':'fa-solid'}} fa-bell"></i>
                                            </div>
                                            <a href="javascript:void(0)"  class="title {{($notification->read_at)?'':'fw-bold'}}">{!! html_entity_decode($notification->data) !!}</a>

                                            <span class="time ">{{ \Carbon\Carbon::parse($notification->created_at)->format('H:i:s d.m.Y') }}</span>
                                            <span class="remove"><a  data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$notification->id}}"><i class="fa-solid fa-expand"></i></a></span>
                                        </li>
                                                @if (!$notification->read_at)
                                                    <div class="modal fade" id="staticBackdrop{{$notification->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">

                                                                <div class="row">


                                                                        <div class="col-12">
                                                                            {!! html_entity_decode($notification->data) !!}
                                                                        </div>


                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Закрыть</button>

                                                                </div>

                                                        </div>
                                                    </div>
                                                @endif
                                                @endforeach
                                            @endif
                                    </ul>
                                </div>

                                <!-- End Activity Log -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-12">
                                @if (count($bbs_moderation)>0)
                                <div class="recent-items dashboard-block">
                                    <h3 class="block-title">На модерации</h3>
                                    <ul>
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
                                            <h3 class="block-title">Не прошло модерацию</h3>
                                            <ul>
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
                                    <h3 class="block-title">Популярные</h3>
                                    <ul>
                                        @foreach($bbs_popular as $bb)

                                        <li>
@include('bb.dashboardcard')

                                        </li>
                                        @endforeach
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
