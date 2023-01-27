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
                        function NewSelect(model, parent_id = null, level = 0, id = null) {
                            var json;
                            var child_cat = 0;
                            if (model === 'rubric')  json =  @json($rubrics);
                            if (model === 'location')  json =  @json($locations);
                            $.each(json, function(key, data)
                                {
                                    if (parent_id==data['parent_id']) {
                                        child_cat++
                                    }

                                }
                            )
                            $('#log').text("child_cat:"+child_cat+" parent_id:"+parent_id+" level:"+level)
                            if(level>0 && child_cat===0) {$("#"+model+"_level_"+level).remove()}
                            if (child_cat>0){
                                var sel = $("#container_"+model+"_"+(level)).html("<select class=\"form-select\" name='"+model+"_id' id='"+model+"_level_"+level+"' onchange=\"NewSelect('"+model+"', this.value,"+(level+1)+","+parent_id+")\"></select>");
                                $("#"+model+"_level_"+level).append(new Option("- выбрать -"));
                                $("#"+model+"_level_"+(level-1)).removeAttr('name')
                                $.each(json, function(key, data)
                                    {
                                        if (parent_id==data['parent_id']) {
                                            $("#"+model+"_level_"+level).append(new Option(data['title'], data['id']));
                                        }    }
                                );
                                $("#container_"+model+"_"+(level)).append($("<div id='container_"+model+"_"+(level+1)+"'></div>"))

                            }


                        }
                        $(document).ready(function() {
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
