
@extends('layouts.dashboard')
@section('title', 'Кредиты')

@section('main')

    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">

                    @include('layouts.dashboard_profile')

                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="main-content">

                        <div class="row">

                            <div class="col-lg-6 col-md-12 col-12">
                                <div class="activity-log dashboard-block">
                                    <h3 class="block-title">Новые уведомления</h3>

                                    <ul>
                                        @if (isset($credits_log) and count($credits_log)>0)
                                            @foreach ($credits_log as $notification)
                                                <li>
                                                    <div class="log-icon" id="alert{{$notification->id}}">

                                                        <i class="{{($notification->read_at)?'fa-regular':'fa-solid'}} fa-bell"></i>
                                                    </div>
                                                    <a href="javascript:void(0)" id="alerttext{{$notification->id}}" class="title">{{$notification->description}}</a>
<h6>{{$notification->credits>0?'+'.$notification->credits:$notification->credits}}</h6>
                                                    <span class="time ">{{ \Carbon\Carbon::parse($notification->created_at)->format('H:i:s d.m.Y') }}</span>
                                                    <span class="remove"><a  data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$notification->id}}"><i class="fa-solid fa-expand"></i></a></span>
                                                </li>

                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="button">
                                        <a class="btn" href="{{route('alerts')}}">Все уведомления</a>
                                    </div>
                                </div>

                                <!-- End Activity Log -->
                            </div>
                            <div class="col-lg-6 col-md-12 col-12">

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
