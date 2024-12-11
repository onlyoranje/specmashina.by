@extends('layouts.base')
@section('title', $organization->title)
@section('main')
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-2 col-md-2 col-12">
                    <div class="content-left wow fadeInLeft" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                        @if($organization->logo)
                            <img src="{{Storage::url($organization->logo)}}" alt="{{$organization->title}}">
                        @else
                            <img src="http://placehold.it/640x480&text={{$organization->title}}" alt="{{$organization->title}}">
                        @endif
                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-12">
                    <!-- content-1 start -->
                    <div class="content-right wow fadeInRight" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;">
                        <!-- Heading -->
                        <span class="sub-heading">УНП {{$organization->unp}}</span>
                        <h1>
                            {{$organization->title}}</h1>
                        <div class="organization-info">
                        <ul>
                            <li><span>Город:</span> {{$organization->location->title}}</li>
                            <li><span>Адрес:</span> {{$organization->address}}</li>
                            @if ($organization->phone)
                            <li><span>Телефон:</span> {{$organization->phone}}</li>
                            @endif
                            @if ($organization->email)
                                <li><span>e-mail:</span> <a href="mailto:{{$organization->email}}">{{$organization->email}}</a> </li>
                            @endif
                            @if ($organization->site)
                                <li><span>Сайт:</span> <a href="{{route('organization_site_redirect',$organization->id)}}">{{$organization->site}}</a> </li>
                            @endif
                        </ul>
                        </div>
                        @if ($organization->content)
                        <h3>Об организации</h3>
                        <p>{!!  nl2br(e($organization->content)) !!}</p>
                        @endif
                        <!-- End Heading -->
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="single-block ">
                        {{-- <h3>Location</h3>--}}
                        <div class="mapouter">
                            <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q={{$organization->address}},%20{{$organization->location->title}}&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><br>
                                <style>
                                    .mapouter {
                                        position: relative;
                                        text-align: right;
                                        height: 300px;
                                        width: 100%;
                                    }
                                </style><a href="https://www.embedgooglemap.net">google map code for website</a>
                                <style>
                                    .gmap_canvas {
                                        overflow: hidden;
                                        background: none !important;
                                        height: 300px;
                                        width: 100%;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        <div class="row mt-5">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Объявления организации</h2>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane active fade show" id="nav-latest" role="tabpanel" aria-labelledby="nav-latest-tab">
                        <div class="row">
                            @foreach ($bbs as $bb_widget)
                                @include('bb.minicard')
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
