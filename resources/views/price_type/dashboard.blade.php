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
                                <div class="activity-log dashboard-block mt-0">
                                    <h3 class="block-title">Виды цен</h3>
                                    <ul>

                                        @if (count($types)>0)


                                    @foreach ($types as $type)
                                                                            <li>
                                            <div class="log-icon">
                                                <i class="lni lni-coin"></i>
                                            </div>
                                            <a href="" class="title">{{$type->type}}</a>
                                            <span class="time"><a href='{{route('price_type_edit' , [$type->id])}}'>Редактировать </a></span>
                                            <span class="time"><a href='{{route('price_type_delete', [$type->id])}}'>Удалить </a></span>


                                        </li>
                                            @endforeach
                                            @endif
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <div class="form-group button mb-0 mt-5">
                                        <a href="{{route('price_type_add')}}" class="btn ">Добавить тип цены</a>
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



   {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">


                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <a href="{{route('price_type_add')}}">Добавить тип цены</a>

                            <br>

                                @if (count($types)>0)
                                <?php

                                    foreach ($types as $type) {

                                        echo $type->type."  <a href='".route('price_type_edit' , [$type->id]) ."'>Редактировать </a> <a href='".route('price_type_delete', [$type->id])."'>Удалить</a><br>";



                                    }


                               ;
                                ?>


                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection

