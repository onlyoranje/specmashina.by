@extends('layouts.dashboard')
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
                                    <h3 class="block-title">Добавление новости</h3>
                                    <form class="default-form-style" action="{{route('post_add_db')}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Заголовок</label>
                                                        <input type="text" value="{{old('title')}}"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mt-30">
                                                        <label>Предварительный текст</label>
                                                        <textarea name="preview_text" placeholder="" maxlength="1000">{{old('preview_text')}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mt-30">
                                                        <label>Tекст</label>
                                                        <textarea name="text" placeholder="" id="editor">{{old('text')}}</textarea>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group upload-image">
                                                        <label>Обложка</label>
                                                        <input type="file"  name="file">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn " id="addpost">Добавить</button>
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


