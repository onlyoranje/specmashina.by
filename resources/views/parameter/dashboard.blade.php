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
                                    <h3 class="block-title">Параметры</h3>




                                    <ul>
                                        <li>
                                            <div class="form-group button mb-0 mt-0"><a href="{{route('parameter_dashboard_add')}}" class="btn ">Добавить параметр</a></div>
                                        </li>
                                        @if (count($parameters)>0)


                                            @foreach ($parameters as $parameter)



                                                <li>
                                                    <div class="log-icon">
                                                        <i class="lni lni-flag-alt"></i>
                                                    </div>
                                                    <a href="" class="title">{{$parameter->name}}</a>
                                                    <span class="time"><a href='{{route('parameter_dashboard_edit', ['parameter' => $parameter->id])}}'>Редактировать </a></span>
                                                    <span class="time"><a href='{{route('parameter_dashboard_delete', ['parameter' => $parameter->id])}}'>Удалить </a></span>


                                                </li>

                                            @endforeach
                                        @endif
                                    </ul>
                            </div>

                            <!-- End Activity Log -->
                        </div>

                    </div>

                    {{ $parameters->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
        </div>
    </section>





@endsection
