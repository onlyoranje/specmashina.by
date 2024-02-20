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
                        <!-- Start Profile Settings Area -->
                        <div class="dashboard-block mt-0 profile-settings-block">
                            <h3 class="block-title">Моя организация</h3>
                            <div class="inner-block">
                                @if ($organization)
                                <div class="image">

                                    @if ($organization->logo)
                                        <img class="image-logo" src="{{Storage::url($organization->logo)}}" alt="{{$organization->title}}">
                                    @else
                                        <svg class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <title>Placeholder</title>
                                            <rect width="100%" height="100%" fill="#868e96"></rect>
                                            <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text>
                                        </svg>
                                    @endif

                                </div>
                                    <form class="profile-setting-form" method="post" action="{{route('organization_update',['organization'=>$organization->id])}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Название организации</label>
                                                    <input name="title" type="text" value="{{$organization->title}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>УНП</label>
                                                    <input name="unp" type="text" id="unp"  value="{{$organization->unp}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">

                                                <div class="form-group">
                                                    <label>Город</label>
                                                    <div class="selector-head">

                                                        <div id="container_location_0" class="container_location"></div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Адрес организации</label>
                                                    <textarea name="address" cols="1" >{{$organization->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Телефон</label>
                                                    <input type="text"  id="phone" name="phone"  value="{{$organization->phone}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="email"  name="email"  value="{{$organization->email}}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group upload-image">
                                                    <?php

                                                   /* if ($organization->logo){
                                                      echo  $old_image ='{"name":"'.$organization->name.'","id":'.$organization->id.',"file":"'.$organization->id.'","local":"'.Storage::url($organization->logo).'","data":{"url":"'.Storage::url($organization->logo).'","thumbnail":"'.Storage::url($organization->logo) .'","readerForce":true}}';
                                                    }*/

                                                    ?>
                                                    <label>Лого</label>
                                                    <input type="file"  name="file" data-fileuploader-limit="1">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group button mb-0">
                                                    <button type="submit" class="btn ">Обновить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else

                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group button mb-0">
                                                    <a href="{{route('organization_add')}}" class="btn ">Добавить организацию</a>
                                                </div>
                                            </div>
                                        </div>

                                @endif
                            </div>
                        </div>
                        <!-- End Profile Settings Area -->
                        <!-- Start Password Change Area -->

                        <!-- End Password Change Area -->
                    </div>



                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        window.addEventListener("load", function(){
            $("#phone").mask("+375 (99) 999-99-99")
            $("#unp").mask("999999999")
            window.json_location = @json($locations);
            @foreach($all_locations as $location_)

            NewSelect('location',<?php if (!$location_->parent_id) {echo 'null';} else {echo $location_->parent_id;}  ?>,{{$location_->level}},{{$location_->id}},@json($all_locations));
            $('#location_level_{{$location_->level}} option[value={{$location_->id}}]').prop('selected', true);
console.log({{$location_->id}})

            @endforeach
        });
    </script>

   {{-- <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
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
    </div>--}}











@endsection

