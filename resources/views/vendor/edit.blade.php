@extends('layouts.dashboard')
@section('title', 'Редактирование производителя')

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

                        <div class="profile-settings-block dashboard-block mt-0">
                            <div class="block-head">
                                <h3 class="block-title">Редактирование производителя</h3>
                                <div class="block-actions">
                                    <a class="btn alt-btn" href="{{route('vendor_dashboard')}}">К списку производителей</a>
                                </div>
                            </div>
                            <div class="inner-block">
                                <form class="default-form-style" action="{{route('editVendorToDB',['vendor'=>$vendor->id])}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Бренд</label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name',$vendor->name)}}">
                                            </div>
                                        </div>
                                        <?php

                                        if ($vendor->logo){
                                            $old_image ='{"name":"'.$vendor->name.'","id":'.$vendor->id.',"file":"'.$vendor->id.'","local":"'.Storage::url($vendor->logo).'","data":{"url":"'.Storage::url($vendor->logo).'","thumbnail":"'.Storage::url($vendor->logo) .'","readerForce":true}}';
                                        }

                                        ?>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group upload-image">
                                                <label>Логотип</label>
                                                <input type="file" name="file" data-fileuploader-limit="1"
                                                       <?php if ($vendor->logo) {?> data-fileuploader-files='[<?= $old_image ?>]'<?php }?>>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group button mb-0 mt-5">
                                                <button type="submit" class="btn">Сохранить</button>
                                                <a href="{{route('vendor_dashboard')}}" class="btn alt-btn">Отмена</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

        $(document).ready(function() {

            $('.input-images').imageUploader();


        })
    </script>
@endsection
