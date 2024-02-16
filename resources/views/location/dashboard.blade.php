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
                                    <h3 class="block-title">Города</h3>


                                    <ul>

                                        @if (count($locations)>0)
                                            <?
                                            $traverse = function ($locations, $prefix = '-') use (&$traverse) {
                                            foreach ($locations as $location) {
                                            ?>


                                                <li>
                                                    <div class="log-icon">
                                                        <i class="lni lni-flag-alt"></i>
                                                    </div>
                                                    <a href="" class="title">{{PHP_EOL . $prefix . ' ' . $location->title}}</a>
                                                    <span class="time"><a href='{{route('location_dashboard_edit', ['location' => $location->id])}}'>Редактировать </a></span>
                                                    <span class="time"><a href='{{route('location_dashboard_delete', ['location' => $location->id])}}'>Удалить </a></span>


                                                </li>

                                            <?



                                            $traverse($location->children, $prefix . '-');
                                            }
                                            };

                                            $traverse($locations);
                                            ?>
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <div class="form-group button mb-0 mt-5">
                                        <a href="{{route('location_dashboard_add')}}" class="btn ">Добавить Регион/Город</a>
                                    </div>
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
