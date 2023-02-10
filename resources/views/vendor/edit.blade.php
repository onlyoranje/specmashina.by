@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="add-resume section">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1 col-12">
                                    <div class="add-resume-inner box">
                                        <form action="{{route('editVendorToDB',['vendor'=>$vendor->id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <label  class="form-label">Бренд</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name',$vendor->name)}}">

                                            <?php

                                            if ($vendor->logo){
                                                $old_image ='{"name":"'.$vendor->name.'","id":'.$vendor->id.',"file":"'.$vendor->id.'","local":"'.Storage::url($vendor->logo).'","data":{"url":"'.Storage::url($vendor->logo).'","thumbnail":"'.Storage::url($vendor->logo) .'","readerForce":true}}';
                                            }

                                            ?>
                                            <input type="file" name="file" data-fileuploader-limit="1"
                                                   <?php if ($vendor->logo) {?> data-fileuploader-files='[<?= $old_image ?>]'<?php }?>>
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
