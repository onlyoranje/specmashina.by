@extends('layouts.base')
@section('title', 'Главная')
@section('main')


    <section class="category-page section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="category-sidebar">
                        <!-- Start Single Widget -->
                        @include('widgets.search_mini')
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                    @include('widgets.category')
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                    @include('widgets.range')
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                    @include('widgets.options')
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                    @include('widgets.banner')
                        <!-- End Single Widget -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="category-grid-list">
                        <div class="row">
                            <div class="col-12">
                                <div class="category-grid-topbar">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <h3 class="title">Showing 1-12 of 21 ads found</h3>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="nav-link" id="nav-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-grid" type="button" role="tab" aria-controls="nav-grid" aria-selected="false"><i class="lni lni-grid-alt"></i></button>
                                                    <button class="nav-link active" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="true"><i class="lni lni-list"></i></button>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
                                        <div class="row">

                                            @foreach ($bbs as $bb_widget)
                                                @include('bb.minicard')
                                            @endforeach

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Pagination -->
                                                <div class="pagination left">
                                                    <ul class="pagination-list">
                                                        <li><a href="javascript:void(0)">1</a></li>
                                                        <li class="active"><a href="javascript:void(0)">2</a></li>
                                                        <li><a href="javascript:void(0)">3</a></li>
                                                        <li><a href="javascript:void(0)">4</a></li>
                                                        <li><a href="javascript:void(0)"><i class="lni lni-chevron-right"></i></a></li>
                                                    </ul>
                                                </div>
                                                <!--/ End Pagination -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active show" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                                        <div class="row">
                                            @foreach ($bbs as $bb)
                                                @include('bb.card')
                                            @endforeach

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Pagination -->
                                                <div class="pagination left">
                                                    <ul class="pagination-list">
                                                        <li><a href="javascript:void(0)">1</a></li>
                                                        <li class="active"><a href="javascript:void(0)">2</a></li>
                                                        <li><a href="javascript:void(0)">3</a></li>
                                                        <li><a href="javascript:void(0)">4</a></li>
                                                        <li><a href="javascript:void(0)"><i class="lni lni-chevron-right"></i></a></li>
                                                    </ul>
                                                </div>
                                                <!--/ End Pagination -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



  {{--  <div class="breadcrumbs overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">
                            {{$rubric->title}}                                                     </h1>
                    </div>
                    <ul class="breadcrumb-nav">
                        <li><a href="/">Главная</a></li>
                        @foreach($breadcrumbs as $breadcrumb)
                            <li>
                                @if(!$loop->last)

                                    <a href="{{ route('rubric', ['rubric' => $breadcrumb->id]) }}">{{$breadcrumb->title}}</a>

                                @else

                                    {{$breadcrumb->title}}

                                    @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>--}}
    <div class="manage-resumes section">
        <div class="container">
            <div class="resume-inner">
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="dashbord-sidebar">
                            <!--<ul>
<li class="heading">Manage Account</li>
<li><a href="resume.html"><i class="lni lni-clipboard"></i> My Resume</a></li>
<li><a href="bookmarked.html"><i class="lni lni-bookmark"></i> Bookmarked Jobs</a></li>
<li><a href="notifications.html"><i class="lni lni-alarm"></i> Notifications <span class="notifi">5</span></a></li>
<li><a href="manage-applications.html"><i class="lni lni-envelope"></i> Manage Applications</a></li>
<li><a class="active" href="manage-resumes.html"><i class="lni lni-files"></i> Manage Resumes</a></li>
<li><a href="job-alerts.html"><i class="lni lni-briefcase"></i> Job Alerts</a></li>
<li><a href="change-password.html"><i class="lni lni-lock"></i> Change Password</a></li>
<li><a href="index.html"><i class="lni lni-upload"></i> Sign Out</a></li>
</ul>-->
                            <form method="GET" enctype="multipart/form-data">
                                <!-- цена -->
                                <!--<div class="form-check">
                                    <label class="form-check-label">
                                      <input class="form-check-input" name='ENABLE_WITHOUTPRICE'  value='Y' type="checkbox">
                                      <span class="form-check-sign"></span>
                                      Скрыть без цены
                                    </label>
                                  </div>-->
                                <!-- цена -->
                                <button class="btn btn-primary btn-round" type="submit">Поиск</button>
                            </form>                        </div>
                    </div>
                    <div class="col-lg-8 col-12">

                        <div class="inner-content">


@foreach ($bbs as $bb)
                            <div class="resume-item">
                                <a href="{{route('bb', ['bb' => $bb->id])}}">
                                    @foreach ($bb->userfile as $image)

                                        @if ($loop->first)
                                            <img src="{{ Storage::url($image->resize(240, 240)) }}" class="img-fluid rounded-start" alt="">
                                        @endif
                                    @endforeach
                                </a>
                                <div class="right">
                                    <h3>
                                        <a href="{{route('bb', ['bb' => $bb->id])}}">{{$bb->title}} </a>
                                    </h3>
                                    <span class="deg">Аренда  автогудронатора</span>
                                    <ul class="experience">
                                        <li>Стоимость: <span>0.10 BYN руб/час</span></li>
                                        <!--<li>Hour Rate: <span>$30</span></li>  -->
                                        <li>
                                            <i class="lni lni-map-marker"></i>
                                            Вилейка, Минская область</li>
                                    </ul>

                                    <div class="update-date">
                                        <p class="status">
                                            <strong>Обновлено:</strong> Обновлено 313 дней назад</p>
                                        <!--<div class="action-btn">
                                        <a href="#">Hide</a>
                                        <a href="#">Edit</a>
                                        <a href="#">Delete</a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>

@endforeach
                        </div>
                        <div class="pagination left pagination-md-center">
                            <ul class="pagination-list">

                                <li><a href="#"><i class="lni lni-arrow-left"></i></a></li>
                                <li class="active"><a href="?PAGE=1">1</a></li>



                                <li><a href="#"><i class="lni lni-arrow-right"></i></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


