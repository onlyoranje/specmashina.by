@extends('layouts.layout')
@section('main_section')
    <div class="breadcrumbs overlay">
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
    </div>
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


@foreach ($announcements as $ann)
                            <div class="resume-item">
                                <a href="{{route('announcement_detail', ['ann' => $ann->id])}}">
                                    @foreach ($ann->userfile as $image)

                                        @if ($loop->first)
                                            <img src="{{ Storage::url($image->resize(240, 240)) }}" class="img-fluid rounded-start" alt="">
                                        @endif
                                    @endforeach
                                </a>
                                <div class="right">
                                    <h3>
                                        <a href="{{route('announcement_detail', ['ann' => $ann->id])}}">{{$ann->title}} </a>
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


