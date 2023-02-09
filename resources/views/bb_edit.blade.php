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
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Производитель</label>
                            <select class="form-select" name="vendor_id" required>
                                <option   disabled>- выбрать -</option>
                                <?php use App\Models\BbParameters;$vendors = App\Models\Vendor::get();?>
                                @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}" <?php if ($vendor->id==$bb->vendor_id) echo "selected"?>>{{$vendor->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            @error('title')
                            <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                            @enderror


                            @error('rubric_id')
                            <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                            @enderror

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Рубрика</label>
                            <div class="col-lg-12 col-md-6" id="container_rubric_0"></div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Город:</label>
                            <div class="col-lg-12 col-md-6" id="container_location_0"></div>
                            </div>

                            @if (count($parameters)>0)
                                @foreach($parameters as $parameter)
<?
                                    $pv = null;
if (!empty($parameter_value[$parameter->id])) $pv=$parameter_value[$parameter->id];
?>
                                    <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                        <label for="exampleFormControlInput1" class="form-label">{{$parameter->name}}<?php if ($parameter->measure) echo', '.$parameter->measure?>
                                        </label>
                                        <input type="{{$parameter->type}}" class="form-control" id="exampleFormControlInput1" name="parameter[{{$parameter->id}}]" value="{{$pv}}">
                                    </div>
                                    @unset($pv)
                                @endforeach
                            @endif

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

                        $(document).ready(function() {
                            window.json_rubric = @json($rubrics);
                            window.json_location = @json($locations);
                            window.json_parameter_rubric = @json($parameter_rubric);
                            @foreach($all_rubrics as $rubric_)

                            NewSelect('rubric',<?php if (!$rubric_->parent_id) {echo 'null';} else {echo $rubric_->parent_id;}  ?>,{{$rubric_->level}},{{$rubric_->id}},@json($all_rubrics));
                            $('#rubric_level_{{$rubric_->level}} option[value={{$rubric_->id}}]').prop('selected', true);

                            @endforeach

                            @foreach($all_locations as $location_)

                            NewSelect('location',<?php if (!$location_->parent_id) {echo 'null';} else {echo $location_->parent_id;}  ?>,{{$location_->level}},{{$location_->id}},@json($all_rubrics));
                            $('#location_level_{{$location_->level}} option[value={{$location_->id}}]').prop('selected', true);


                            @endforeach
                            $('.input-images').imageUploader();
                            Parameter_Rubric($("select[name='rubric_id']").val())
                        })
                    </script>


            </div>
        </div>
    </div>

@endsection
