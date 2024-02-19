@extends('layouts.dashboard')

@section('title', 'Главная')

@section('main')
    @include('dashboard_nav')

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
                        <div class="dashboard-block mt-0">
                            <h3 class="block-title">My Ads</h3>
                            <nav class="list-nav">
                                <ul>
                                    <li class="active"><a href="javascript:void(0)">Все <span>{{count($bbs)}}</span></a></li>
                                    <li><a href="javascript:void(0)">Published <span>88</span></a></li>
                                    <li><a href="javascript:void(0)">Featured <span>12</span></a></li>
                                    <li><a href="javascript:void(0)">Sold <span>02</span></a></li>
                                    <li><a href="javascript:void(0)">Active <span>45</span></a></li>
                                    <li><a href="javascript:void(0)">Expired <span>55</span></a></li>
                                </ul>
                            </nav>

                            <!-- Start Items Area -->
                            <div class="my-items">
                                <!-- Start Item List Title -->
                                <div class="item-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-5 col-12">
                                            <p>Объявление</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Категория</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Статус</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Город</p>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-12 align-right">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End List Title -->
                            @if (count($bbs) > 0)
                                @foreach ($bbs as $bb)

                                    @php
                                        $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
                                        $parent_rubric = $parent_rubrics[0];
                                        $subparent_rubric = $parent_rubrics[1];
                                    @endphp
                                <!-- Start Single List -->
                                <div class="single-item-list">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-5 col-12">
                                            <div class="item-image">
                                                @if (count($bb->userfile)> 0)
                                                    <img   src="{{Storage::url($bb->userfile[0]->resize(100, 100))}}" alt="{{ $bb->title }}" >
                                                @else
                                                    <img   src="http://placehold.it/100x100&text={{ $bb->title }}" alt="{{ $bb->title }}">
                                                @endif
                                                <div class="content">
                                                    <h3 class="title"><a href="javascript:void(0)">{{ $bb->title }}</a></h3>
                                                    <span class="price">{{$bb->bbprice->price}} {{$bb->bbprice->pricetype->type}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>{{$bb->rubric->title}}</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>New</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>{{$bb->location->title}}</p>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-12 align-right">
                                            <ul class="action-btn">
                                                <li><a href="{{route('bb_edit', ['bb'=>$bb->id]) }}"><i class="lni lni-pencil"></i></a></li>
                                                <li><a href="{{route('bb',['bb'=>$bb->id])}}" target="_blank"><i class="lni lni-eye"></i></a></li>
                                                <li><a href="{{route('bb_delete', ['bb'=>$bb->id]) }}"><i class="lni lni-trash"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single List -->
                                @endforeach
                            @endif
                                <!-- Pagination -->
                            {{ $bbs->onEachSide(1)->links() }}
                                <!--/ End Pagination -->
                            </div>
                            <!-- End Items Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
