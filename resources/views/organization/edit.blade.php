@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <div class="add-resume section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-10 offset-lg-1 col-12">
                                        <div class="add-resume-inner box">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

