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
                                    <h3 class="block-title">Добавление города</h3>
                                    <form class="default-form-style" action="{{route('addLocationToDB')}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование</label>
                                                        <input type="text" value="{{old('title')}}"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование (род.пад.)</label>
                                                        <input type="text" value="{{old('title_r')}}"  name="title_r"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Сортировка</label>
                                                        <input type="number" value="{{old('sort',500)}}" name="sort"   required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Родительская категория</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>


                                                            <select name="parent_id" id="select_category" class="user-chosen-select">
                                                                <option value="">Корневая категория</option>
                                                                <?
                                                                $traverse = function ($locations, $prefix = '-') use (&$traverse) {
                                                                    foreach ($locations as $locationl) {
                                                                        echo "<option value=".$locationl->id." ";
                                                                        echo ">". PHP_EOL.$prefix.' '.$locationl->title."</option>";

                                                                        $traverse($locationl->children, $prefix.'-');
                                                                    }
                                                                };

                                                                $traverse($locations);
                                                                ?>



                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group upload-image">
                                                        <label>Фото</label>
                                                        <input type="file"  name="file">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn ">Обновить</button>
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
                    <form class="form-ad" action="{{route('addLocationToDB')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" value="{{old('title')}}" name="title" class="form-control" placeholder="Name">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-6" id="container">

                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Сортировка</label>
                                    <input type="number" value="{{old('sort',500)}}" name="sort" class="form-control" placeholder="сортировка">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Родительская категория</label>
                                    <select name="parent_id">
                                        <option value="">Корневая категория</option>
                                        <?php
                                        $traverse = function ($locations, $prefix = '-') use (&$traverse) {
                                            foreach ($locations as $location) {?>
                                                <?php echo '<option value='.$location->id.'>'. PHP_EOL.$prefix.' '.$location->title.'</option>';

                                                $traverse($location->children, $prefix.'-');
                                            }
                                        };

                                        $traverse($locations);
                                        ?>



</select>
                                </div>
                            </div>


                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-6 col-md-5 col-12">
                                    <div class="button">
                                        <button type="submit" class="btn">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

