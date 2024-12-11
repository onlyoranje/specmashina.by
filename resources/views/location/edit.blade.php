@extends('layouts.dashboard')

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
                                    <h3 class="block-title">Редактирование  "{{$location->title}}"</h3>
                                    <form class="default-form-style" action="{{route('editLocationToDB',['location'=>$location->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование</label>
                                                        <input type="text" value="{{old('title',$location->title)}}"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование (род.пад.)</label>
                                                        <input type="text" value="{{old('title_r',$location->title_r)}}"  name="title_r"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Сортировка</label>
                                                        <input type="number" value="{{old('sort',$location->sort)}}" name="sort"   required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Родительская категория</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>


                                                        <select name="parent_id" id="select_category" class="user-chosen-select">
                                                            <option value="">Корневая категория</option>
                                                            <?php


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

                                                <script>
                                                    window.addEventListener("load", function() {
                                                            @isset ($location->parent_id)
                                                            $('#select_category option[value={{$location->parent_id}}]').prop('selected', true);
                                                            @endisset

                                                            @foreach ($depth as $ch_cat)
                                                            $('#select_category option[value="{{$ch_cat->id}}"]').attr('disabled', 'disabled');
                                                            @endforeach
                                                        }
                                                    )
                                                </script>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group upload-image">
                                                        <?php

                                                        if ($location->image){
                                                            $old_image ='{"name":"'.$location->name.'","id":'.$location->id.',"file":"'.$location->id.'","local":"'.Storage::url($location->image).'","data":{"url":"'.Storage::url($location->image).'","thumbnail":"'.Storage::url($location->image) .'","readerForce":true}}';
                                                        }

                                                        ?>
                                                        <label for="exampleInputEmail1" class="form-label">Фото</label>
                                                        <input type="file" class="form-control" name="file" data-fileuploader-limit="1"
                                                               <?php if ($location->image) {?> data-fileuploader-files='[<?= $old_image ?>]'<?php }?>>
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


    <section class="add-resume section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="add-resume-inner box">

                        <form class="form-ad" action="{{route('editLocationToDB',['location'=>$location->id])}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" value="{{old('title',$location->title)}}" name="title" class="form-control" placeholder="Name">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-6" id="container">

                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Сортировка</label>
                                        <input type="number" value="{{old('sort',$location->sort)}}" name="sort" class="form-control" placeholder="сортировка">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="selector-head">
                                        <label class="control-label">Родительская категория</label>
                                        <select name="parent_id" id="select_category" class="user-chosen-select">
                                            <option value="">Корневая категория</option>
                                            <?php
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


                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control" name="description" rows="7">{{old('description',$location->description)}}</textarea>
                                </div>

<button type="submit" class="btn" value="сохранить" >сохранить </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

