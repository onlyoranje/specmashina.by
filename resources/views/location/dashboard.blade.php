@extends('layouts.dashboard')
@section('title', 'Города')

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
                                        <li>
                                            <div class="form-group button mb-0 mt-0"><a href="{{route('location_dashboard_add')}}" class="btn ">Добавить Регион/Город</a></div>
                                        </li>
                                        @if (count($locations)>0)


                                            @foreach ($locations as $location)



                                                <li>
                                                    <div class="log-icon">
                                                        <i class="lni lni-flag-alt"></i>
                                                    </div>
                                                    <a href="" class="title">{{$location->title}}</a>
                                                    <span class="time"><a href='{{route('location_dashboard_edit', ['location' => $location->id])}}'>Редактировать </a></span>
                                                    <span class="time"><a href='{{route('location_dashboard_delete', ['location' => $location->id])}}'>Удалить </a></span>


                                                </li>

                                            @endforeach
                                        @endif
                                    </ul>
                                </div>

                                <!-- End Activity Log -->
                            </div>

                        </div>

                    {{ $locations->onEachSide(1)->links() }}

                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
