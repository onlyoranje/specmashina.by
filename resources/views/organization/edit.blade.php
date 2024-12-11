@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')


    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')

                <div class="col-12 col-lg-8">
                    <div class="row justify-content-center">


                        <form class="form-ad" action="{{route('organization_update',['organization'=>$organization->id])}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Название организации</label>
                                    <input type="text" class="form-control" name="title" value="{{old('title',$organization->title)}}" >
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Адрес организации</label>
                                    <input type="text" class="form-control" name="address"  value="{{old('title',$organization->address)}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">email</label>
                                    <input type="email" class="form-control" name="email"  value="{{old('title',$organization->email)}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">УНП</label>
                                    <input type="number" min="100000000" max="799999999"  class="form-control" name="unp"  value="{{old('title',$organization->unp)}}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Сайт</label>
                                    <input type="text" class="form-control" name="site" value="{{old('title',$organization->site)}}">
                                </div>
                                    <div class="col-12">
                                        <div class="form-group mt-30">
                                            <label>Описание (не более 1000 символов)</label>
                                            <textarea name="description" placeholder="" maxlength="1000">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                <div class="mb-3">
                                    <?php

                                    if ($organization->logo){
                                        $old_image ='{"name":"'.$organization->name.'","id":'.$organization->id.',"file":"'.$organization->id.'","local":"'.Storage::url($organization->logo).'","data":{"url":"'.Storage::url($organization->logo).'","thumbnail":"'.Storage::url($organization->logo) .'","readerForce":true}}';
                                    }


                                    ?>
                                    <label for="exampleInputEmail1" class="form-label">Лого</label>
                                    <input type="file" class="form-control" name="file" data-fileuploader-limit="1"
                                           <?php if ($organization->logo) {?> data-fileuploader-files='[<?= $old_image ?>]'<?php }?>>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener("load", function(){
            $("#phone").mask("+375 99 999-99-99")
            $("#unp").mask("999999999")
        });
    </script>
@endsection
