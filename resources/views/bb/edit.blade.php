@extends('layouts.dashboard')
@section('title', 'Главная')
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
                        <!-- Start Post Ad Block Area -->
                        <div class="dashboard-block mt-0">
                            <h3 class="block-title">Редактирование объявления</h3>
                            <form  action="{{route('bb_update',['bb'=>$bb->id])}}" enctype="multipart/form-data" method="POST" >
                                @csrf
                                @method('PATCH')
                                <div class="inner-block">


                                    <!-- Start Post Ad Tab -->
                                    <div class="post-ad-tab">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-item-info-tab" data-bs-toggle="tab" data-bs-target="#nav-item-info" type="button" role="tab" aria-controls="nav-item-info" aria-selected="true">
                                                    <span class="serial">01</span>
                                                    Шаг
                                                    <span class="sub-title">Общая информация</span>
                                                </button>
                                                <button class="nav-link" id="nav-item-details-tab" data-bs-toggle="tab" data-bs-target="#nav-item-details" type="button" role="tab" aria-controls="nav-item-details" aria-selected="false">
                                                    <span class="serial">02</span>
                                                    Шаг
                                                    <span class="sub-title">Фото и описание</span>
                                                </button>
                                                <button class="nav-link" id="nav-user-info-tab" data-bs-toggle="tab" data-bs-target="#nav-user-info" type="button" role="tab" aria-controls="nav-user-info" aria-selected="false">
                                                    <span class="serial">03</span>
                                                    Шаг
                                                    <span class="sub-title">Контактные данные</span>
                                                </button>
                                            </div>
                                        </nav>

                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade active show" id="nav-item-info" role="tabpanel" aria-labelledby="nav-item-info-tab">
                                                <!-- Start Post Ad Step One Content -->
                                                <div class="step-one-content">
                                                    <div class="default-form-style">
                                                        <div class="row">



                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Раздел</label>
                                                                    @error('rubric_id')
                                                                    <span class="invalid-feedback">
<strong>{{ $message }}</strong>
</span>
                                                                    @enderror
                                                                    <div class="selector-head">

                                                                        <div id="container_rubric_0" class="container_rubric"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Производитель</label>
                                                                    <div class="selector-head">
                                                                        <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                                        @php
                                                                            use App\Models\Location;
                                                                            use App\Models\Rubric;
                                                                            $vendors = App\Models\Vendor::get();
                                                                        @endphp
                                                                        <select class="user-chosen-select" name="vendor_id" data-name="vendor_id" required>
                                                                            <option   disabled>- выбрать -</option>
                                                                            <?php use App\Models\BbParameters;
                                                                            $vendors = App\Models\Vendor::get();?>
                                                                            @foreach($vendors as $vendor)
                                                                                <option value="{{$vendor->id}}" <?php if ($vendor->id==$bb->vendor_id) echo "selected"?>>{{$vendor->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Модель</label>
                                                                    <input value="{{ old('title',$bb->title)}}" name="title" type="text" data-name="title">
                                                                </div>
                                                            </div>


                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label>Цена</label>
                                                                    <input name="price" type="number" value="{{old('price',$bb->bbprice->price)}}"   id="price" data-name="price" min="1">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label class="form-label">Вид цены</label>
                                                                    {{--  @if (count($price_types)>0)
                                                                          @foreach($price_types as $price_type)
                                                                              <div class="input-pricetype" id="pricetype_{{$price_type->id}}">
                                                                                  <input class="form-check-input" type="radio" data-hasvalue="{{$price_type->has_value}}" name="price_type" id="input_pricetype_{{$price_type->id}}" value="{{$price_type->id}}" required data-name="price_type"
                                                                                  @if (count($price_types)==1)
                                                                                  checked
                                                                                  @endif
                                                                                  >
                                                                                  <label class="form-check-label" >
                                                                                      {{$price_type->type}}
                                                                                  </label>
                                                                              </div>
                                                                          @endforeach
                                                                      @endif--}}
                                                                    <div class="selector-head">
                                                                        <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                                        <select class="user-chosen-select" name="price_type"  required data-name="price_type">
                                                                            @if (count($price_types)>0)
                                                                                @foreach($price_types as $price_type)
                                                                                    <option value="{{$price_type->id}}" id="pricetype_{{$price_type->id}}" class="input-pricetype"
                                                                                            @if ($bb->bbprice->price_type_id ==$price_type->id)
                                                                                            selected
                                                                                        @endif

                                                                                    >{{$price_type->type}}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group button mb-0">
                                                                    <button type="button" class="btn " onclick="selectTab('nav-item-details',['rubric','title','vendor_id','price','price_type'])">Далее</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Start Post Ad Step One Content -->
                                            </div>
                                            <div class="tab-pane fade" id="nav-item-details" role="tabpanel" aria-labelledby="nav-item-details-tab">
                                                <!-- Start Post Ad Step Two Content -->
                                                <div class="step-two-content">
                                                    <div class="default-form-style">
                                                        <div class="row">


                                                                @if (count($parameters)>0)
                                                                    @foreach($parameters as $parameter)
                                                                        @if ($parameter->type == 'options')
                                                                            <div class="col-6">
                                                                                <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                                    <label  class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                                    </label>
                                                                                    <select class="form-select" name="parameter[{{$parameter->id}}]" >
                                                                                        <option disabled selected>- выбрать -</option>
                                                                                        @php
                                                                                            $options = json_decode($parameter->options);
                                                                                        @endphp
                                                                                        @foreach($options as $option)
                                                                                            <option value="{{$option}}" {{(isset($parameter_value[$parameter->id]) && $parameter_value[$parameter->id] ==$option)?  'selected' : ''}} >{{$option}}</option>
                                                                                        @endforeach
                                                                                    </select>

                                                                                </div>
                                                                            </div>
                                                                        @elseif ($parameter->type == 'checkbox')
                                                                            <div class="col-6">

                                                                                <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                                    <label  class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                                    </label>
                                                                                    <div class="form-check">
                                                                                        <input type="checkbox" class="form-check-input width-auto" name="parameter[{{$parameter->id}}]" value="Y" {{isset($parameter_value[$parameter->id]) ? 'checked':''}}>
                                                                                        <label class="form-check-label">Да</label>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                    @elseif ($parameter->type == 'number')
                                                                        <div class="col-6">
                                                                            <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                                <label class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                                </label>
                                                                                <input type="{{$parameter->type}}" value="{{isset($parameter_value[$parameter->id]) ? $parameter_value[$parameter->id]:''}}" step="0.01" name="parameter[{{$parameter->id}}]" class="form-control" @if ($parameter->max) max="{{$parameter->max}}" @endif @if ($parameter->min)min="{{$parameter->min}}"@endif>
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($parameter->type == 'year')
                                                                        <div class="col-6">
                                                                            <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                                <label class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                                </label>
                                                                                <input type="number"  name="parameter[{{$parameter->id}}]" class="form-control" max="{!! date('Y') !!}" @if ($parameter->min)min="{{$parameter->min}}" @endif value="{{isset($parameter_value[$parameter->id]) ? $parameter_value[$parameter->id]:''}}">
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                            <div class="col-6">
                                                                                <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                                    <label class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                                    </label>
                                                                                    <input type="{{$parameter->type}}" name="parameter[{{$parameter->id}}]" class="form-control" value="{{isset($parameter_value[$parameter->id]) ? $parameter_value[$parameter->id]:''}}">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            <div class="col-12">
                                                                @php
                                                                $old_image=[];
                                                                @endphp
                                                                @if (count($images)>0)
                                                                @foreach($images as $image)
                                                                    <?php $old_image[]='{"name":"'.$image->original_name.'","id":'.$image->id.',"type":"'.$image->type.'","size":'.$image->size.',"file":"'.$image->id.'","local":"'.Storage::url($image->url).'","data":{"url":"'.Storage::url($image->url).'","thumbnail":"'.Storage::url($image->resize(480,360)) .'","readerForce":true}}'?>
                                                                @endforeach
                                                                @endif

                                                                <input type="file" name="file" data-fileuploader-files='[<?= implode(',',$old_image) ?>]'>
                                                            </div>

                                                            {{--  <div class="col-lg-6 col-12">

                                                                  <div class="upload-input">


                                                                      <label for="upload" class="text-center content">
                                                                          <span class="text">
                                                                              <span class="d-block mb-15">Drop files anywhere
                                                                                  to Upload</span>
                                                                              <span class=" mb-15 plus-icon"><i class="lni lni-plus"></i></span>
                                                                              <span class="main-btn d-block btn-hover">Select
                                                                                  File</span>
                                                                              <span class="d-block">Maximum upload file size
                                                                                  10Mb</span>
                                                                          </span>
                                                                      </label>
                                                                  </div>
                                                              </div>--}}
                                                            {{--<div class="col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label class="video-label">Video Link* <span>Input only
                                                                            YouTube &amp; Vimeo</span></label>
                                                                    <input name="video" type="text" placeholder="Input link">
                                                                    <a href="javascript:void(0)" class="add-video"><i class="lni lni-plus"></i> Add Video</a>
                                                                </div>
                                                            </div>--}}
                                                            <div class="col-12">
                                                                <div class="form-group mt-30">
                                                                    <label>Описание</label>
                                                                    <textarea name="description" placeholder="">{{old('description',$bb->content)}}</textarea>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-lg-6 col-12">
                                                                 <div class="form-group">
                                                                     <label>Type of Ad*</label>
                                                                     <div class="selector-head">
                                                                         <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                                         <select class="user-chosen-select">
                                                                             <option value="none">Select an option</option>
                                                                             <option value="none">Option 1</option>
                                                                             <option value="none">Option 2</option>
                                                                             <option value="none">Option 3</option>
                                                                         </select>
                                                                     </div>
                                                                 </div>
                                                             </div>--}}
                                                            {{--<div class="col-lg-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Item Condition*</label>
                                                                    <div class="selector-head">
                                                                        <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                                        <select class="user-chosen-select">
                                                                            <option value="none">Select an option</option>
                                                                            <option value="none">Used</option>
                                                                            <option value="none">Brand New</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>--}}
                                                            {{--<div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="tag-label">Tags* <span>Comma(,)
                                                                            separated</span></label>
                                                                    <input name="tag" type="text" placeholder="Type Product tag">
                                                                </div>
                                                            </div>--}}
                                                            <div class="col-12">
                                                                <div class="form-group button mb-0">
                                                                    <button type="button" class="btn alt-btn"  onclick="selectTab('nav-item-info')">Назад</button>
                                                                    <button type="button" class="btn "  onclick="selectTab('nav-user-info')">Далее</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Start Post Ad Step Two Content -->
                                            </div>
                                            <div class="tab-pane fade" id="nav-user-info" role="tabpanel" aria-labelledby="nav-user-info-tab">
                                                <!-- Start Post Ad Step Three Content -->
                                                <div class="step-three-content">
                                                    <div class="default-form-style" >
                                                        <div class="row">


                                                            @foreach($contact_types as $contact_type)
                                                                @if ($contact_type->mask)
                                                                    <script>
                                                                        window.addEventListener("load", function(){
                                                                            $("#contact_{{$contact_type->id}}").mask("{{$contact_type->mask}}")
                                                                        });
                                                                    </script>

                                                                @endif
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">{{$contact_type->name}}</label>
                                                                        <input type="text"
                                                                               @if (array_key_exists($contact_type->id,$contacts))
                                                                        value="{{old('contact['.$contact_type->id.']',$contacts[$contact_type->id])}}"
                                                                               @else
                                                                               value=""
                                                                               @endif
                                                                               name="contact[{{$contact_type->id}}]"
                                                                               class="form-control" id="contact_{{$contact_type->id}}"
                                                                               @if ($contact_type->required == 'Y')
                                                                               required
                                                                            @endif
                                                                        >

                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>Город</label>
                                                                    <div class="selector-head">

                                                                        <div id="container_location_0" class="container_location"></div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                         {{--   @if ($bb->user->organization)
                                                            <div class="col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="Y" name="organization" id="flexCheckDefault" @if ($bb->organization_id) checked @endif>
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        Разместить объявление от имени {{$bb->user->organization->title}}
                                                                    </label>
                                                                </div>
                                                                </div>
                                                                @endif--}}
                                                            <div class="col-12">
                                                                <div class="form-group button mb-0">
                                                                    <button type="button" class="btn alt-btn" onclick="selectTab('nav-item-details')">Назад</button>
                                                                    <button type="submit" class="btn ">Обновить</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Start Post Ad Step Three Content -->
                                            </div>
                                        </div>

                                    </div>

                                    <!-- End Post Ad Tab -->
                                </div>
                            </form>
                        </div>
                        <!-- End Post Ad Block Area -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

        window.addEventListener("load", function(){
            window.json_rubric = @json($rubrics);
            window.json_location = @json($locations);
            window.json_parameter_rubric = @json($parameter_rubric);
            window.json_pricetype_rubric = @json($price_type_rubric);
            @foreach($all_rubrics as $rubric_)

            NewSelect('rubric',<?php if (!$rubric_->parent_id) {echo 'null';} else {echo $rubric_->parent_id;}  ?>,{{$rubric_->level}},{{$rubric_->id}},@json($all_rubrics));
            $('#rubric_level_{{$rubric_->level}} option[value={{$rubric_->id}}]').prop('selected', true);

            @endforeach

            @foreach($all_locations as $location_)

            NewSelect('location',<?php if (!$location_->parent_id) {echo 'null';} else {echo $location_->parent_id;}  ?>,{{$location_->level}},{{$location_->id}},@json($all_locations));
            $('#location_level_{{$location_->level}} option[value={{$location_->id}}]').prop('selected', true);


            @endforeach
            $("input[name*='parameter']").change(function () {
                var value_par = parseInt($(this).attr('value'))

                if (typeof ($(this).attr("min"))!= "undefined")
                {
                    var min = $(this).attr("min");
                    if (value_par<=min) $(this).val(min)

                }

                if (typeof ($(this).attr("max"))!= "undefined")
                {
                    var max = $(this).attr("max");
                    if (value_par>max) $(this).val(max)

                }
            });
            /*$('.input-images').imageUploader();*/
            Parameter_Rubric($("select[name='rubric_id']").val())
            PriceType_Rubric($("select[name='rubric_id']").val())
            $("select[name='rubric_id']").attr('data-name', 'rubric')
            /*$("#input_pricetype_{{$bb->bbprice->price_type_id}}").prop('checked', true)
            if ($("#input_pricetype_{{$bb->bbprice->price_type_id}}").data('hasvalue')==='N'){
                $('#price').hide()
            }*/
        })
    </script>





@endsection
