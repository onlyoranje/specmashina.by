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
                                    <h3 class="block-title">Добавление категории</h3>
                                    <form class="default-form-style" action="{{route('addRubricToDB')}}" method="post">
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
                                                                $traverse = function ($rubrics, $prefix = '-') use (&$traverse) {
                                                                    foreach ($rubrics as $rubric) {
                                                                        echo "<option value=".$rubric->id." ";
                                                                        echo ">". PHP_EOL.$prefix.' '.$rubric->title."</option>";

                                                                        $traverse($rubric->children, $prefix.'-');
                                                                    }
                                                                };

                                                                $traverse($rubrics);
                                                                ?>



                                                            </select>
                                                        </div>
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
                    <form class="form-ad" action="{{route('addRubricToDB')}}" method="post">
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
                                        $traverse = function ($rubrics, $prefix = '-') use (&$traverse) {
                                            foreach ($rubrics as $rubric) {
                                                echo "<option value=".$rubric->id.">". PHP_EOL.$prefix.' '.$rubric->title."</option>";

                                                $traverse($rubric->children, $prefix.'-');
                                            }
                                        };

                                        $traverse($rubrics);
                                        ?>



</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" name="description" rows="7">{{old('description')}}</textarea>
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

