@extends('layouts.dashboard')
@section('title', 'Главная')
@section('main')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <ul>
                        <li><a href="{{route('mybb')}}"> Мои объявления</a></li>

                    </ul>
                </div>
                <div class="p-6 text-gray-900">

                    <section class="add-resume section">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1 col-12">
                                    <div class="add-resume-inner box">

                                        <form class="form-ad" action="{{route('addBbToDB')}}" method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Name</label>
                                                        <input type="text" value="{{old('title')}}" name="title"
                                                               required class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                @error('title')
                                                <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                                                @enderror

                                                Рубрика:
                                                <div class="col-lg-12 col-md-6" id="container_rubric_0"></div>
                                                Город:
                                                <div class="col-lg-12 col-md-6" id="container_location_0"></div>
                                                @error('rubric_id')
                                                <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                                                @enderror
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label class="control-label">price</label>
                                                        <input type="number" value="{{old('price')}}" name="price"
                                                               class="form-control" required placeholder="Name">
                                                    </div>
                                                </div>
                                                @error('price')
                                                <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                                                @enderror
                                                <input type="file" name="file">


                                                <div class="form-group">
                                                    <label class="control-label">Description</label>
                                                    <textarea class="form-control" name="description"
                                                              rows="7">{{old('description')}}</textarea>
                                                </div>
                                                @error('description')
                                                <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                                                @enderror
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
                    </section>
                    <script>

                        $(document).ready(function() {
                            window.json_rubric = @json($rubrics);
                            window.json_location = @json($locations);
                            NewSelect('rubric');
                            NewSelect('location');
                            $('.input-images').imageUploader();
                        })
                    </script>


                </div>
            </div>
        </div>
    </div>
@endsection
