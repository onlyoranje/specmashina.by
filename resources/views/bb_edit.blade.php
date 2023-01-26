@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                <div class="mt-5 md:col-span-2 md:mt-0">

                    <form class="form-ad" action="{{route('bb_update',['bb'=>$bb->id])}}" enctype="multipart/form-data" method="POST"  has-files class="dropzone">
                        @csrf
                        @method('PATCH')



                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="title" value="{{ old('title',$bb->title)}}" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            @error('title')
                            <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                            @enderror
                            <input type="hidden" name="rubric_id" id="old_rubric_id" value="{{$bb->rubric_id}}">
                            <div class="col-lg-12 col-md-6" id="container"></div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">price</label>
                                    <input type="number" value="{{old('price',$bb->price)}}" name="price" class="form-control"  required placeholder="Name">
                                </div>
                            </div>
                            @error('price')
                            <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                            @enderror


<?php $old_image = ''?>
                            @foreach($images as $image)
                                <?php $old_image .='{"name":"'.$image->original_name.'","id":'.$image->id.',"type":"'.$image->type.'","size":'.$image->size.',"file":"'.$image->id.'","local":"'.Storage::url($image->url).'","data":{"url":"'.Storage::url($image->url).'","thumbnail":"'.Storage::url($image->resize(480,360)) .'","readerForce":true}},'?>
                            @endforeach
<?php $old_image = substr($old_image,0,-1);?>

                            <input type="file" name="file" data-fileuploader-files='[<?= $old_image ?>]'>




                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" name="description" rows="7">{{old('description',$bb->content)}}</textarea>
                            </div>

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
                        function newSelect(pid = null,level=0,selected= null) {
                            var cc = 0;
                            var max_level = 0;
                            if (pid) {
                                if (!isFinite(pid))
                                {
                                    pid = parseInt(pid.value)
                                }


                            }
                            if (pid<0) pid='';

                            var json =  @json($all_rubrics);

                            $(json).each(function() {
                                if (pid == this.id) {
                                    level = this.level
                                    console.log(this.title + " id:" + this.id + " level:" + level)
                                    var new_level = level + 1;
                                }
                                if (this.level > max_level) max_level = this.level;
                            });
                            new_level = level+1;
                            for (var i = new_level; i <= max_level; i++) {
                                $('.cl' + i).remove();
                            }
                            /* alert(level)*/
                            var sel = $('<select class="form-select"   required="required"  onchange="newSelect(this,'+level+')">');
                            sel.append($("<option disabled selected>- выбрать -</option>"))
                            $(json).each(function() {

                                if (this.parent_id == pid) {

                                    if (selected==this.id){

                                        sel.append($("<option>").attr({'value':this.id, 'selected':'selected'}).text(this.title)) ;

                                    } else {

                                        sel.append($("<option>").attr('value',this.id).text(this.title)) ;

                                    }

                                    cc++;
                                    level = this.level
                                }

                            });
                            if (!pid) {
                                for (var i = level; i <= max_level; i++) {
                                    $('.cl' + i).remove();

                                }

                                $(".cl0").html(sel)
                            }

                            for (var i = new_level; i < max_level; i++) {

                            }
                            if (cc > 0) {


                                $("#container").append('<div id="" class="col cl' + (level) + '"></div>');
                                $(".cl" + (level)).html(sel)

                            }
                            else
                            {
                                for (var i = 0; i < level; i++) {
                                    $('.cl' + i).find(".form-select").removeAttr('name');
                                }
                                $(".cl" + (level)).find(".form-select").attr('name','rubric_id')

                            }
                        }
                        @foreach($rubrics as $rubric)
                        @if ($rubric->parent_id)
                        newSelect({{$rubric->parent_id}},{{$rubric->level}},{{$rubric->id}});
                        @else
                        newSelect(null,0,{{$rubric->id}});
                        @endif
                        @endforeach
                    </script>

            </div>
        </div>
    </div>

@endsection
