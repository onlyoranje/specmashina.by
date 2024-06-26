@extends('layouts.dashboard')
@section('title', 'Главная')

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

                        <div class="row">
                            <div class="col-12">
                                @if (count($alerts)>0)


                                    @foreach ($alerts as $alert)
                                <div class="card card-alert">

                                    <div class="card-body">
                                        <h5 class="card-title">{{$alert->title}}</h5>
                                        <p class="card-text">{!! $alert->comment!!}</p>
                                        @if (!$alert->read_at)
                                        <a  class="btn btn-primary  btn-sm" id="alert_{{$alert->id}}" onclick="read_alert({{$alert->id}})">Пометить прочитанным</a>
                                        @endif
                                    </div>
                                </div>

                            @endforeach
                            @endif
                        </div>
                    </div>

                    {{ $alerts->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
        </div>
    </section>



@endsection
