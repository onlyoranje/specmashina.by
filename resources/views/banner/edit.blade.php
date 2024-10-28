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
                                <div class="profile-settings-block dashboard-block mt-0">
                                    <h3 class="block-title">{{$title}}</h3>
                                    <form class="default-form-style" action="{{route('edit_banner',['banner'=>$banner->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Заголовок</label>
                                                        <input type="text" value="{{old('title',$banner->title)}}"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>URL</label>
                                                        <input type="text" value="{{old('url',$banner->url)}}"  name="url"  required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Максимальное количесвто показов</label>
                                                        <input type="number" value="{{old('maximum_views',$banner->maximum_views)}}"  name="maximum_views">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Начало показов</label>
                                                        <input type="datetime-local" value="{{old('start',$banner->start)}}"  name="start">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Окончание показов</label>
                                                        <input type="datetime-local" value="{{old('end',$banner->end)}}"  name="end">
                                                    </div>
                                                </div>



                                                <div class="col-9">
                                                    <div class="form-group upload-image">
                                                        <label>Фото профиля</label>
                                                        <input name="file1" type="file" placeholder="Upload Image">
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                <div class="col-3">
                                                    <img src="{{Storage::url($banner->image)}}" class="img-fluid" alt="">
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn " id="addpost">Обновить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- End Activity Log -->
                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>
