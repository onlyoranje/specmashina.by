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


                                    <form class="profile-setting-form" method="post" action="{{route('addOrganizationToDB')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Название организации</label>
                                                    <input name="title" type="text" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>УНП</label>
                                                    <input name="unp" type="text" id="unp">
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
                                                    <textarea name="address" cols="1" ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                <label>Телефон</label>
                                                <input type="text"  id="phone" name="phone">
                                            </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="email"  name="email">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <div class="form-group upload-image">
                                                    <label>Лого</label>
                                                    <input type="file"  name="file">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group button mb-0">
                                                    <button type="submit" class="btn ">Добавить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

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


   {{-- <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')

                <div class="col-12 col-lg-8">
                    <div class="row justify-content-center">


<form class="form-ad" action="{{route('addOrganizationToDB')}}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Название организации</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Адрес организации</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">УНП</label>
                                    <input type="text" id="unp"  class="form-control" name="unp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Сайт</label>
                                    <input type="text" class="form-control" name="site">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Телефон</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Лого</label>
                                    <input type="file" class="form-control" name="file">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
</form>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>--}}
    <script>
        window.addEventListener("load", function(){
            $("#phone").mask("+375 (99) 999-99-99")
            $("#unp").mask("999999999")
            window.json_location = @json($locations);
            NewSelect('location');
        });
    </script>
@endsection

