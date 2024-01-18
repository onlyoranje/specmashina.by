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
                                        <div class="col-lg-5 col-md-5 col-12">
                                            <p>Объявление</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Категория</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Статус</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-12 align-right">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End List Title -->
                            @if (count($bbs) > 0)
                                @foreach ($bbs as $bb)
                                <!-- Start Single List -->
                                <div class="single-item-list">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5 col-md-5 col-12">
                                            <div class="item-image">
                                                @if (count($bb->userfile)> 0)
                                                    <img   src="{{Storage::url($bb->userfile[0]->resize(100, 100))}}" alt="{{ $bb->title }}" >
                                                @else
                                                    <img   src="http://placehold.it/100x100&text={{ $bb->title }}" alt="{{ $bb->title }}">
                                                @endif
                                                <div class="content">
                                                    <h3 class="title"><a href="javascript:void(0)">{{ $bb->title }}</a></h3>
                                                    <span class="price">$800</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Electronic</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>New</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-12 align-right">
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
                            <!-- End Items Area -->
                        </div>
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
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="d-grid"><a href="{{route('addForm')}}"
                                                   class="btn btn-outline-secondary mb-4 py-3"><span class="me-2"><span
                                            class="fas fa-plus"></span></span>Добавить объявление</a></div>
                        </div>
                        @if (count($bbs) > 0)
                            @foreach ($bbs as $bb)
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="card border-gray-300 mb-4">
                                <div class="row g-0 align-items-center">
                                    <div class="col-12 col-lg-6 col-xl-4"><a href="#">
                                            @if (count($bb->userfile)> 0)
                                            <img   src="{{Storage::url($bb->userfile[0]->resize(600, 400))}}" alt="{{ $bb->title }}" class="card-img p-2 rounded-xl">
                                            @else
                                                <img   src="http://placehold.it/600x400&text={{ $bb->title }}" alt="{{ $bb->title }}" class="card-img p-2 rounded-xl">
                                            @endif
                                        </a></div>
                                    <div class="col-12 col-lg-6 col-xl-8">
                                        <div class="card-body py-lg-0">
                                            <div class="d-flex g-0 align-items-center mb-2">
                                                <div class="col text-left">
                                                    <ul class="list-group mb-0">
                                                        <li class="list-group-item border-0 small p-0"><span
                                                                class="fas fa-medal text-tertiary me-2"></span>Изменено: {{$bb->created_at->format('d F, Y год. Время: H:i')}}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col text-right">
                                                    <div class="btn-group">
                                                        <button
                                                            class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><span class="icon icon-sm"><span
                                                                    class="fas fa-ellipsis-h icon-secondary"></span> </span><span
                                                                class="sr-only">Toggle Dropdown</span></button>
                                                        <div class="dropdown-menu py-0"><a
                                                                class="dropdown-item rounded-top"
                                                                href="{{route('bb_edit', ['bb'=>$bb->id]) }}"><span
                                                                    class="fas fa-edit me-2"></span>Edit Item</a> <a
                                                                class="dropdown-item"><span
                                                                    class="fas fa-chart-line me-2"></span>Statistics</a>
                                                            <a class="dropdown-item text-danger rounded-bottom"
                                                               href="{{route('bb_delete', ['bb'=>$bb->id]) }}"><span class="fa fa-trash me-2"
                                                                              aria-hidden="true"></span>Disable</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{route('bb', ['bb'=>$bb->id]) }}"><h2 class="h5">{{ $bb->title }}</h2></a>
                                            <div class="col d-flex ps-0"><span
                                                    class="text-success font-small me-3"><span
                                                        class="fas fa-check-circle me-2"></span>Active</span> <span
                                                    class="text-muted font-small me-3"><span
                                                        class="fas fa-eye me-2"></span>680</span> <span
                                                    class="text-muted font-small me-3"><span
                                                        class="far fa-heart me-2"></span>10</span> <a
                                                    class="font-small text-dark" href="./messages.html"><span
                                                        class="fas fa-envelope me-2"></span>8</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-4 mt-lg-5">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>













@endsection
