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

                        <div class="row">
                            <div class="col-12">
                                <!-- Start Activity Log -->
                                <div class="profile-settings-block dashboard-block mt-0">
                                    <h3 class="block-title">Добавление производителя</h3>
                                    <form class="default-form-style" action="{{route('addVendorToDB')}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="inner-block">
                                            <div class="row">

                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label >Бренд</label>
                                                        <input type="text" value="{{old('name')}}" name="name" class="form-control"  required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group upload-image">
                                                        <label>Лого</label>
                                                        <input name="logo_image" type="file" placeholder="Upload Image">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn ">Добавить</button>
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





    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="add-resume section">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1 col-12">
                                    <div class="add-resume-inner box">
                    <form action="{{route('addVendorToDB')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label  class="form-label">Бренд</label>
                        <input type="text" name="name" class="form-control" >
                        <input type="file" name="file" data-fileuploader-limit="1">
                        <div class="col-lg-6 col-md-5 col-12">
                            <div class="button">
                                <button type="submit" class="btn">Save</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    </section>
                    </div>

                    </div>
                    </div>
                    </div>
    <script>

        $(document).ready(function() {

            $('.input-images').imageUploader();


        })
    </script>
@endsection
