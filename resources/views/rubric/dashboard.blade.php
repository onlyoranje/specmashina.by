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
                                    <h3 class="block-title">Категории</h3>


                                    <ul>

                                        @if (count($rubrics)>0)


                                            @foreach ($rubrics as $rubric)



                                                <li>
                                                    <div class="log-icon">
                                                        <i class="lni lni-flag-alt"></i>
                                                    </div>
                                                    <a href="" class="title">{{$rubric->title}}</a>
                                                    <span class="time"><a href='{{route('location_dashboard_edit', ['location' => $rubric->id])}}'>Редактировать </a></span>
                                                    <span class="time"><a href='{{route('location_dashboard_delete', ['location' => $rubric->id])}}'>Удалить </a></span>


                                                </li>

                                            @endforeach
                                        @endif
                                    </ul>
                            </div>
                            <div class="col-12">
                                <div class="form-group button mb-0 mt-5">
                                    <a href="{{route('rubric_dashboard_add')}}" class="btn ">Добавить категорию</a>
                                </div>
                            </div>
                            <!-- End Activity Log -->
                        </div>

                    </div>

                    {{ $rubrics->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
        </div>
    </section>


    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')
                <div class="col-12 col-lg-8">
                    <div class="card p-0 p-md-4 mb-4">
                        <div class="card-header bg-white border-0">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="d-grid"><a href="{{route('rubric_dashboard_add')}}"
                                                   class="btn btn-outline-secondary mb-4 py-3"><span class="me-2"><span
                                            class="fas fa-plus"></span></span>Добавить Категорию</a></div>
                        </div>

                        @if (count($rubrics)>0)
                            <?
                            $traverse = function ($rubrics, $prefix = '-') use (&$traverse) {
                            foreach ($rubrics as $rubric){
                            ?>
                            <ul class="list-group list-group-flush">


                                <li class="list-group-item py-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            {{--<span class="icon icon-md"><span  class="fas fa-sms"></span></span>--}}
                                        </div>
                                        <div class="col ms-n2"><h6 class="text-sm mb-0">{{PHP_EOL.$prefix.' '.$rubric->title}}</h6></div>
                                        {{-- <div class="col d-none d-md-block"><span class="text-muted">Added:</span>
                                             2021-02-12 14:34:12
                                         </div>--}}
                                        <div class="col-auto">
                                            <div class="btn-group">
                                                <button
                                                    class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><span class="icon icon-sm"><span
                                                            class="fas fa-ellipsis-v icon-dark"></span> </span><span
                                                        class="sr-only">Toggle Dropdown</span></button>
                                                <div class="dropdown-menu py-0" style=""><a
                                                        class="dropdown-item rounded-top" href="{{route('rubric_dashboard_edit' , ['rubric'=>$rubric->id])}}"><span
                                                            class="fas fa-edit me-2"></span>Edit post</a>
                                                    <a class="dropdown-item text-danger rounded-bottom" href="{{route('rubric_dashboard_delete', ['rubric'=>$rubric->id])}}"><span
                                                            class="fa fa-trash me-2"
                                                            aria-hidden="true"></span>Disable</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>



                            <?



                                $traverse($rubric->children, $prefix.'-');
                                }
                                };

                                $traverse($rubrics);
                            ?>
                        @endif
                    </div>

                </div>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
