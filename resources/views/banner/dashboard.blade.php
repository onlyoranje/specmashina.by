@extends('layouts.dashboard')
@section('title', $title)

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
                                    <h3 class="block-title">Баннеры</h3>




                                    <ul>
                                        <li>
                                            <div class="form-group button mb-0 mt-0"><a href="{{route('banner_add')}}" class="btn ">Добавить баннер</a></div>
                                        </li>
                                        @if (count($banners)>0)


                                            @foreach ($banners as $banner)



                                                <li>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="log-icon">
                                                                <i class="lni lni-flag-alt"></i>
                                                                <a href="" class="title">{{$banner->title}}</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            Показов: {{$banner->views}}<br>
                                                            Кликов: {{$banner->clicks}}<br>
                                                            @if($banner->views>0)
                                                            CTR: {{round($banner->clicks/$banner->views*100,2)}}%
                                                            @endif
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="time"><a href='{{route('edit_banner', ['banner' => $banner->id])}}'>Редактировать </a></span>
                                                            <span class="time"><a href='{{route('delete_banner', ['banner' => $banner->id])}}'>Удалить </a></span>
                                                        </div>
                                                    </div>






                                                </li>

                                            @endforeach
                                        @endif
                                    </ul>
                            </div>

                            <!-- End Activity Log -->
                        </div>

                    </div>

                    {{ $banners->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
        </div>
    </section>



@endsection
