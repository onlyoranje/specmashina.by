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

                                    @if (count($rubrics)>0)
                                        <?
                                        $traverse = function ($rubrics, $prefix = '&emsp;') use (&$traverse) {
                                        foreach ($rubrics as $rubric){
                                        ?>
                                    <ul>

                                                <li>
                                                    <div class="log-icon">
                                                        <i class="lni lni-flag-alt"></i>
                                                    </div>
                                                    <a href="" class="title">{!! $prefix !!} {{$rubric->title}} (уровень: {{$rubric->level}})</a>
                                                    <span class="time"><a href='{{route('rubric_dashboard_edit', ['rubric' => $rubric->id])}}'>Редактировать </a></span>
                                                    <span class="time"><a href='{{route('rubric_dashboard_delete', ['rubric' => $rubric->id])}}'>Удалить </a></span>


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
                            <div class="col-12">
                                <div class="form-group button mb-0 mt-5">
                                    <a href="{{route('rubric_dashboard_add')}}" class="btn ">Добавить категорию</a>
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
