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
                                                <div class="col-lg-12 col-md-6" id="container_rubric"></div>
                                                <div class="col-lg-12 col-md-6" id="container_location"></div>
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
                        function newSelect(model, pid = null, level = 0) {
                            var json;
                            var cc = 0;
                            var max_level = 0;
                            //model = $.trim(model)
                            if (pid) {
                                pids = parseInt(pid.value)

                                pid = pids
                                var pidp = pids
                                var qwe = 1;
                            } else {
                                pids = ''
                            }
                            if (model === 'rubric')  json =  @json($rubrics);
                            if (model === 'location')  json =  @json($locations);


                            $(json).each(function () {
                                if (pid == this.id) {
                                    level = this.level
                                    console.log(this.title + " id:" + this.id + " level:" + level)
                                    var new_level = level + 1;
                                }
                                if (this.level > max_level) max_level = this.level;
                            });
                            new_level = level + 1;
                            for (var i = new_level; i <= max_level; i++) {
                                $(".cl_" + model + "_" + i).remove();
                            }
                            //alert(level)

                            var sel = $('<select class="form-select" required="required" name="' + model + '_id" onchange="newSelect(\'' + model + '\',this,' + level + ')">');
                            $("#container_" + model).append($(sel))
                            sel.append($("<option disabled selected>- выбрать -</option>"))
                            $(json).each(function () {
                                if (this.parent_id == pid) {
                                    sel.append($("<option>").attr('value', this.id).text(this.title));
                                    cc++;
                                    level = this.level
                                }

                            });

                            if (!pid) {
                                for (var i = level; i <= max_level; i++) {
                                    $(".cl_" + model + "_" + i).remove();

                                }

                                $(".cl_" + model + "_0").html(sel)
                            }

                            for (var i = new_level; i < max_level; i++) {

                            }
                            if (cc > 0) {


                                $("#container_" + model).append('<div id="" class="col cl_' + model + '_' + (level) + '></div>');
                                $(".cl_" + model + "_" + (level)).find(".form-select").attr('name', model + '_id')
                                $(".cl_" + model + "_" + (level)).html(sel)
                                var level_rr = level - 1;
                                $(".cl_" + model + "_" + level_rr).find(".form-select").removeAttr("required");
                                $(".cl_" + model + "_" + level_rr).find(".form-select").removeAttr('name');
                            } else {
                                for (var i = 0; i < level; i++) {
                                    $(".cl_" + model + "_" + i).find(".form-select").removeAttr('name');
                                    $(".cl_" + model + "_" + i).find(".form-select").removeAttr('required');
                                }
                                $(".cl_" + model + "_" + (level)).find(".form-select").attr('name', model + '_id')
                                /*alert(level) */
                            }
                        }

                        newSelect('rubric');
                        newSelect('location');
                        $(document).ready(function () {

                            $('.input-images').imageUploader();

                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
