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
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Производитель</label>
                                                    <select class="form-select" name="vendor_id" required>
                                                        <option  selected disabled>- выбрать -</option>
                                                        <?php use App\Models\Location;use App\Models\Rubric;$vendors = App\Models\Vendor::get();?>
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Рубрика</label>
                                                    <div class="col-lg-12 col-md-6" id="container_rubric_0"></div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Город:</label>
                                                    <div class="col-lg-12 col-md-6" id="container_location_0"></div>
                                                </div>
                                                @error('rubric_id')
                                                <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                                                @enderror
                                                @if (count($parameters)>0)
                                                    @foreach($parameters as $parameter)
                                                        @if ($parameter->type == 'year')
                                                            <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                <label for="exampleFormControlInput1" class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                </label>
                                                                <select class="form-select" name="parameter[{{$parameter->id}}]" >
                                                                    <option disabled selected>- выбрать -</option>
                                                                    @for($year=date('Y');$year>=1950;$year--)
                                                                    <option value="{{$year}}">{{$year}}</option>
                                                                    @endfor
                                                                </select>

                                                            </div>
                                                            @else

                                                        <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                            <label for="exampleFormControlInput1" class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                            </label>
                                                            <input type="{{$parameter->type}}" name="parameter[{{$parameter->id}}]" class="form-control">
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                    @endif

                                                    <div class="mb-3 col-6">
                                                        <label class="form-label">Цена</label>
                                                        <input type="number" value="{{old('price')}}" name="price"
                                                               class="form-control" required >
                                                    </div>

                                                <div class="mb-3 col-6">
                                                    <label class="form-label">Цена</label>
                                                    @if (count($price_types)>0)
                                                        @foreach($price_types as $price_type)
                                                    <div class="input-pricetype" id="pricetype_{{$price_type->id}}">
                                                        <input class="form-check-input" type="radio" name="price_type" id="input_pricetype_{{$price_type->id}}" value="{{$price_type->id}}" required  >
                                                        <label class="form-check-label" >
                                                            {{$price_type->type}}
                                                        </label>
                                                    </div>
                                                        @endforeach
                                                    @endif
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
                        <div id="log"></div>
                    </section>
                    Отладка:{{old('rubric_id')}}
                    Отладка:{{old('location_id')}}
                    <script>

                        $(document).ready(function() {
                            window.json_rubric = @json($rubrics);
                            window.json_location = @json($locations);
                            window.json_parameter_rubric = @json($parameter_rubric);
                            window.json_pricetype_rubric = @json($price_type_rubric);
<?php
//рубрики
    if (old('rubric_id')){
    $all_rubrics = Rubric::whereAncestorOrSelf(old('rubric_id'))->orderBy('level')->get();?>
@foreach($all_rubrics as $rubric_)

NewSelect('rubric',<?php if (!$rubric_->parent_id) {echo 'null';} else {echo $rubric_->parent_id;}  ?>,{{$rubric_->level}},{{$rubric_->id}},@json($all_rubrics));
                            $('#rubric_level_{{$rubric_->level}} option[value={{$rubric_->id}}]').prop('selected', true);

                            @endforeach
<?php
        }else {
        ?>
NewSelect('rubric');
<?php
    }

//локации
    if (old('location_id')){
$all_locations = Location::whereAncestorOrSelf(old('location_id'))->orderBy('level')->get();?>
@foreach($all_locations as $location_)

NewSelect('location',<?php if (!$location_->parent_id) {echo 'null';} else {echo $location_->parent_id;}  ?>,{{$location_->level}},{{$location_->id}},@json($all_locations));
                            $('#location_level_{{$location_->level}} option[value={{$location_->id}}]').prop('selected', true);

                            @endforeach
                            <?php
                            }else {
                            ?>
                            NewSelect('location');
                            <?php
                            }

                            ?>


                            $('.input-images').imageUploader();


                        })
                    </script>


                </div>
            </div>
        </div>
    </div>
@endsection

