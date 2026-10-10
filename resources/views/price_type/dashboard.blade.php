@extends('layouts.dashboard')
@section('title', 'Виды цен')

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

                        <!-- Start Activity Log -->
                        <div class="dashboard-block mt-0">
                            <div class="block-head">
                                <h3 class="block-title">Виды цен</h3>
                                <div class="block-actions">
                                    <a href="{{route('price_type_add')}}" class="btn">+ Добавить тип цены</a>
                                </div>
                            </div>
                            <ul class="adm-list">
                                @forelse ($types as $type)
                                    <li>
                                        <div class="log-icon">
                                            <i class="lni lni-coin"></i>
                                        </div>
                                        <a href="{{route('price_type_edit', [$type->id])}}" class="title">{{$type->type}}</a>
                                        <span class="time"><a href="{{route('price_type_edit', [$type->id])}}">Редактировать</a></span>
                                        <span class="time"><a href="{{route('price_type_delete', [$type->id])}}" class="text-danger">Удалить</a></span>
                                    </li>
                                @empty
                                    <li class="adm-empty">Пока нет ни одного вида цен</li>
                                @endforelse
                            </ul>
                        </div>
                        <!-- End Activity Log -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
