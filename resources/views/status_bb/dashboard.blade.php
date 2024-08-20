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
                                <!-- Start Activity Log -->
                                <ul class="activity-log dashboard-block mt-0">
                                    <h3 class="block-title">Статусы</h3>




                                    <ul>
                                        <li>
                                            <div class="form-group button mb-0 mt-0"><a href="{{route('status_dashboard_add')}}" class="btn ">Добавить статус</a></div>
                                        </li>
                                        @if (count($statuses)>0)


                                            @foreach ($statuses as $status)



                                                <li>
                                                    <div class="log-icon">
                                                        <i class="fa-solid fa-tag" style="color:#{{$status->color_badge}}"></i>
                                                    </div>
                                                    <a href="" class="title">{{$status->name}} </a>
                                                    <span class="time"><a href='{{route('status_dashboard_edit', ['status' => $status])}}'>Редактировать </a></span>
                                                    <span class="time"><a href='{{route('status_dashboard_delete', ['status' => $status])}}'>Удалить </a></span>


                                                </li>

                                            @endforeach
                                        @endif
                                    </ul>
                            </div>

                            <!-- End Activity Log -->
                        </div>

                    </div>



                </div>
            </div>
        </div>
        </div>
    </section>




@endsection

