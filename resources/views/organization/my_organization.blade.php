@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')

    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')

                <div class="col-12 col-lg-8">
                    <div class="row justify-content-center">
                        @if ($organization)
                            <div class="col-12 col-md-6 col-lg-12">
                                <div class="card border-gray-300 mb-4">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-12 col-lg-6 col-xl-4">
                                            @if ($organization->logo)
                                            <a href="#"><img
                                                    src="{{Storage::url($organization->logo)}}" alt="{{$organization->title}}"
                                                    class="card-img p-2 rounded-xl"></a>
                                                @else
                                                <svg class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false">
                                                    <title>Placeholder</title>
                                                    <rect width="100%" height="100%" fill="#868e96"></rect>
                                                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="col-12 col-lg-6 col-xl-8">
                                            <div class="card-body py-lg-0">
                                                <div class="d-flex g-0 align-items-center mb-2">
                                                    <div class="col text-left">
                                                        <ul class="list-group mb-0">
                                                            <li class="list-group-item border-0 small p-0"><span
                                                                    class="fas fa-medal text-tertiary me-2"></span>Изменено: {{$organization->created_at->format('d F, Y год. Время: H:i')}}
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
                                                                    href="{{route('organization_edit')}}"><span
                                                                        class="fas fa-edit me-2"></span>Edit Item</a> <a
                                                                    class="dropdown-item"><span
                                                                        class="fas fa-chart-line me-2"></span>Statistics</a>
                                                                <a class="dropdown-item text-danger rounded-bottom"
                                                                   href="{{route('organization_delete')}}"><span class="fa fa-trash me-2"
                                                                                                                         aria-hidden="true"></span>Disable</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h2 class="h5">{{$organization->title}}</h2>
                                                <div class="col d-flex ps-0">
                                                    <div class="card-body">

                                                        <p class="card-text">УНП {{$organization->unp}}</p>
                                                        <p class="card-text">{{$organization->address}}</p>
                                                        @if ($organization->url) <p class="card-text">{{$organization->url}}</p> @endif
                                                        @if ($organization->email) <p class="card-text">{{$organization->email}}</p> @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="col-12">
                                <div class="d-grid"><a href="{{route('organization_add')}}"
                                                       class="btn btn-outline-secondary mb-4 py-3"><span class="me-2"><span
                                                class="fas fa-plus"></span></span>Добавить организацию</a></div>
                            </div>
                        @endif



                    </div>

                </div>
            </div>
        </div>
    </div>











@endsection

