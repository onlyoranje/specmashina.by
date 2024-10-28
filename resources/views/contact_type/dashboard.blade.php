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
                                    <h3 class="block-title">Типы контактов</h3>




                                    <ul>
                                        <li>
                                            <div class="form-group button mb-0 mt-0"><a href="{{route('contact_type_add')}}" class="btn ">Добавить тип контакта</a></div>
                                        </li>
                                        @if (count($types)>0)


                                            @foreach ($types as $type)



                                                <li>
                                                    <div class="log-icon">
                                                        <i class="lni lni-flag-alt"></i>
                                                    </div>
                                                    <a href="" class="title">{{$type->name}}</a>
                                                    <span class="time"><a href='{{route('contact_type_edit', ['type' => $type->id])}}'>Редактировать </a></span>
                                                    <span class="time"><a href='{{route('contact_type_delete', ['type' => $type->id])}}'>Удалить </a></span>


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

