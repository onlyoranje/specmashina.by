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
                            <h3 class="block-title">Post Ad</h3>
                            <form  action="{{route('addBbToDB')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="inner-block">


                                <!-- Start Post Ad Tab -->
                                <div class="post-ad-tab">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-item-info-tab" data-bs-toggle="tab" data-bs-target="#nav-item-info" type="button" role="tab" aria-controls="nav-item-info" aria-selected="true">
                                                <span class="serial">01</span>
                                                Step
                                                <span class="sub-title">Общая информация</span>
                                            </button>
                                            <button class="nav-link" id="nav-item-details-tab" data-bs-toggle="tab" data-bs-target="#nav-item-details" type="button" role="tab" aria-controls="nav-item-details" aria-selected="false">
                                                <span class="serial">02</span>
                                                Step
                                                <span class="sub-title">Фото и описание</span>
                                            </button>
                                            <button class="nav-link" id="nav-user-info-tab" data-bs-toggle="tab" data-bs-target="#nav-user-info" type="button" role="tab" aria-controls="nav-user-info" aria-selected="false">
                                                <span class="serial">03</span>
                                                Step
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
                                                        <div class="col-md-6 col-12">
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
                                                                        <option selected disabled>- выбрать -</option>

                                                                        @foreach($vendors as $vendor)
                                                                            <option value="{{$vendor->id}}" @if (old('vendor_id')==$vendor->id) selected @endif >{{$vendor->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group">
                                                                <label>Модель</label>
                                                                <input value="{{old('title')}}" name="title" type="text" data-name="title">
                                                            </div>
                                                        </div>


                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Цена</label>
                                                                <input name="price" type="number" value="{{old('price')}}"   id="price" data-name="price" min="1">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                            <label class="form-label">Вид цены</label>

                                                            <div class="selector-head">
                                                                <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                            <select class="user-chosen-select" name="price_type"  required data-name="price_type">
                                                                <option selected disabled>- выбрать -</option>
                                                                @if (count($price_types)>0)
                                                                @foreach($price_types as $price_type)

                                                                    <option value="{{$price_type->id}}" id="pricetype_{{$price_type->id}}" class="input-pricetype" @if (old('price_type')==$price_type->id) selected @endif >{{$price_type->type}}</option>
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
                                                                @if ($parameter->type == 'option')
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
                                                                                    <option value="{{$option}}">{{$option}}</option>
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
                                                                            <input type="checkbox" class="form-check-input width-auto" name="parameter[{{$parameter->id}}]" value="Y">
                                                                            <label class="form-check-label">Да</label>
                                                                        </div>
                                                                        </div>

                                                                    </div>
                                                                @elseif ($parameter->type == 'number')
                                                                    <div class="col-6">
                                                                        <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                            <label class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                            </label>
                                                                            <input type="{{$parameter->type}}" step="0.01" name="parameter[{{$parameter->id}}]" class="form-control" @if ($parameter->max) max="{{$parameter->max}}" @endif @if ($parameter->min)min="{{$parameter->min}}" @endif>
                                                                        </div>
                                                                    </div>
                                                                @elseif ($parameter->type == 'year')
                                                                    <div class="col-6">
                                                                        <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                            <label class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                            </label>
                                                                            <input type="number"  name="parameter[{{$parameter->id}}]" class="form-control" max="{!! date('Y') !!}" @if ($parameter->min)min="{{$parameter->min}}" @endif>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="col-6">
                                                                        <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                            <label class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
                                                                            </label>
                                                                            <input type="{{$parameter->type}}" name="parameter[{{$parameter->id}}]" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif

<div class="col-12">
    <input type="file" name="file">
</div>


                                                        <div class="col-12">
                                                            <div class="form-group mt-30">
                                                                <label>Описание</label>
                                                                <textarea name="description" placeholder="">{{old('description')}}</textarea>
                                                            </div>
                                                        </div>

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
                                                                <input type="text" value="" name="contact[{{$contact_type->id}}]"
                                                                        id="contact_{{$contact_type->id}}"
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


                                                            <div class="col-12">
                                                                <div class="form-group button mb-0">
                                                                    <button type="button" class="btn alt-btn" onclick="selectTab('nav-item-details')">Назад</button>
                                                                    <button type="submit" class="btn ">Добавить</button>
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

            $("input[name*='parameter']").change(function () {
                if (typeof ($(this).attr("min"))!= "undefined")
                {
                    var min = $(this).attr("min");
                    if ($(this).val()<=min) $(this).val(min)
                    console.log(min+' '+$(this).val)
                }

                if (typeof ($(this).attr("max"))!= "undefined")
                {
                    var max = $(this).attr("max");
                    if ($(this).val()>=max) $(this).val(max)
                    console.log(max+' '+$(this).val)
                }
            });
            NewSelect('rubric');

            NewSelect('location');
            //$('.input-images').imageUploader();


        })
    </script>
@endsection

