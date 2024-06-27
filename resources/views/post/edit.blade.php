@extends('layouts.base')
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
                                    <form class="default-form-style" action="{{route('edit_post',['post'=>$post->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-12 col-12">
                                                    <div class="form-group">
                                                        <label>Заголовок</label>
                                                        <input type="text" value="{{old('title',$post->title)}}"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">

                                                    <div class="form-group">
                                                        <label>Категория</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                            <select class="user-chosen-select" name="category">
                                                                <option value="none">Select a Category</option>
                                                                @if (isset($categories))
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{$category}}" {{($post->category==$category) ? "selected" : ""}}>{{$category}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Новая категория</label>
                                                        <input type="text" value="{{old('new_category')}}"  name="new_category">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mt-30">
                                                        <label>Предварительный текст</label>
                                                        <textarea name="preview_text" placeholder="" maxlength="1000">{{old('preview_text',$post->preview_text)}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mt-30">
                                                        <label>Tекст</label>
                                                        <textarea name="text" placeholder="" id="editor">{{old('text',$post->content)}}</textarea>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6 col-12">
                                                    <?php

                                                    if ($post->image){
                                                        $old_image = Array(
                                                            'name'=>$post->title,
                                                            'id'=>$post->id,
                                                            'file'=>$post->id,
                                                            'local'=>Storage::url($post->image),
                                                            'data'=>Array(
                                                                'url'=>Storage::url($post->image),
                                                        'thumbnail'=>Storage::url($post->image),
                                                                'readerForce'=>true
                                                            ));

                                                    }


                                                    ?>
                                                    <label for="exampleInputEmail1" class="form-label">Лого</label>
                                                    <input type="file" class="form-control" name="file" data-fileuploader-limit="1"
                                                 <?php if ($post->image) {?> data-fileuploader-files='[{{json_encode($old_image)}} ]'<?php }?>>
                                                </div>
                                                <div class="col-lg-12 col-12">
                                                    <div class="form-group">
                                                        <label>Теги</label>
                                                        <input type="text" value="{{old('tags', $post->tags)}}"  name="tags">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn " >Сохранить</button>
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
    <script>
        window.addEventListener("load", function(){

            ClassicEditor
                .create( document.querySelector( '#editor' ), {

                    ckfinder: {
                        uploadUrl: '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                    },
                    mediaEmbed: {
                        previewsInData: true
                    }

                } )
                .catch( error => {
                    console.error( error );
                } );
            ClassicEditor.replace( 'Resolution', {
                height: 400
            } );

        } );
    </script>

@endsection
