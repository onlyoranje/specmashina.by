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
                                                <form class="default-form-style" method="post" action="#">
                                                    <div class="row">



                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Раздел</label>
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
                                                                    <select class="user-chosen-select" name="vendor_id" required>
                                                                        <option  selected disabled>- выбрать -</option>

                                                                        @foreach($vendors as $vendor)
                                                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Модель</label>
                                                                <input value="{{old('title')}}" name="title" type="text">
                                                            </div>
                                                        </div>


                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Цена</label>
                                                                <input name="price" type="number" value="{{old('price')}}"   id="price">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label">Цена</label>
                                                            @if (count($price_types)>0)
                                                                @foreach($price_types as $price_type)
                                                                    <div class="input-pricetype" id="pricetype_{{$price_type->id}}">
                                                                        <input class="form-check-input" type="radio" data-hasvalue="{{$price_type->has_value}}" name="price_type" id="input_pricetype_{{$price_type->id}}" value="{{$price_type->id}}" required
                                                                        @if (count($price_types)==1)
                                                                        checked
                                                                        @endif
                                                                        >
                                                                        <label class="form-check-label" >
                                                                            {{$price_type->type}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group button mb-0">
                                                                <button type="button" class="btn " onclick="selectTab('nav-item-details')">Next Step</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Start Post Ad Step One Content -->
                                        </div>
                                        <div class="tab-pane fade" id="nav-item-details" role="tabpanel" aria-labelledby="nav-item-details-tab">
                                            <!-- Start Post Ad Step Two Content -->
                                            <div class="step-two-content">
                                                <form class="default-form-style" method="post" action="#">
                                                    <div class="row">
                                                        @if (count($parameters)>0)
                                                            @foreach($parameters as $parameter)
                                                                @if ($parameter->type == 'year')
                                                                    <div class="col-6">
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
                                                                    </div>
                                                                @else
                                                                    <div class="col-6">
                                                                        <div class="mb-3 input-parameter" id="parameter_{{$parameter->id}}">
                                                                            <label for="exampleFormControlInput1" class="form-label">{{$parameter->name}}<? if ($parameter->measure) echo', '.$parameter->measure?>
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

                                                        <div class="col-lg-6 col-12">
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
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label class="video-label">Video Link* <span>Input only
                                                                        YouTube &amp; Vimeo</span></label>
                                                                <input name="video" type="text" placeholder="Input link">
                                                                <a href="javascript:void(0)" class="add-video"><i class="lni lni-plus"></i> Add Video</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group mt-30">
                                                                <label>Ad Description*</label>
                                                                <textarea name="message" placeholder="Input ad description"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
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
                                                        </div>
                                                        <div class="col-lg-6 col-12">
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
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="tag-label">Tags* <span>Comma(,)
                                                                        separated</span></label>
                                                                <input name="tag" type="text" placeholder="Type Product tag">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group button mb-0">
                                                                <button type="button" class="btn alt-btn"  onclick="selectTab('nav-item-info')">Previous</button>
                                                                <button type="button" class="btn "  onclick="selectTab('nav-user-info')">Next Step</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Start Post Ad Step Two Content -->
                                        </div>
                                        <div class="tab-pane fade" id="nav-user-info" role="tabpanel" aria-labelledby="nav-user-info-tab">
                                            <!-- Start Post Ad Step Three Content -->
                                            <div class="step-three-content">
                                                <form class="default-form-style" method="post" action="#">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Name*</label>
                                                                <input name="name" type="text" placeholder="Enter your name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Mobile Numbe*</label>
                                                                <input name="number" type="text" placeholder="Enter mobile number">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Country*</label>
                                                                <div class="selector-head">
                                                                    <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                                    <select class="user-chosen-select">
                                                                        <option value="none">Select a Country</option>
                                                                        <option value="none">Afghanistan</option>
                                                                        <option value="none">America</option>
                                                                        <option value="none">Albania</option>
                                                                        <option value="none">Bangladesh</option>
                                                                        <option value="none">Brazil</option>
                                                                        <option value="none">India</option>
                                                                        <option value="none">South Africa</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Select City*</label>
                                                                <div class="selector-head">
                                                                    <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                                    <select class="user-chosen-select">
                                                                        <option value="none">Select City</option>
                                                                        <option value="none">New York</option>
                                                                        <option value="none">Los Angeles</option>
                                                                        <option value="none">Chicago</option>
                                                                        <option value="none">San Diego</option>
                                                                        <option value="none">San Jose</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Select State*</label>
                                                                <div class="selector-head">
                                                                    <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                                    <select class="user-chosen-select">
                                                                        <option value="none">Select State</option>
                                                                        <option value="none">New York</option>
                                                                        <option value="none">Texas</option>
                                                                        <option value="none">Arizona</option>
                                                                        <option value="none">Florida</option>
                                                                        <option value="none">Washington</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Address*</label>
                                                                <input name="address" type="text" placeholder="Enter a location">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="google-map">
                                                                <div class="mapouter">
                                                                    <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br>
                                                                        <style>
                                                                            .mapouter {
                                                                                position: relative;
                                                                                text-align: right;
                                                                                height: 300px;
                                                                                width: 100%;
                                                                            }
                                                                        </style><a href="https://www.embedgooglemap.net">embed
                                                                            google maps wordpress</a>
                                                                        <style>
                                                                            .gmap_canvas {
                                                                                overflow: hidden;
                                                                                background: none !important;
                                                                                height: 300px;
                                                                                width: 100%;
                                                                            }
                                                                        </style>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    I agree to all Terms of Use &amp; Posting Rules
                                                                </label>
                                                            </div>
                                                            <div class="form-group button mb-0">
                                                                <button type="button" class="btn alt-btn" onclick="selectTab('nav-item-details')">Previous</button>
                                                                <button type="submit" class="btn ">Submit Ad</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Start Post Ad Step Three Content -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Post Ad Tab -->
                            </div>
                        </div>
                        <!-- End Post Ad Block Area -->
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section section-md pb-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">

                    <form class="form-ad" action="{{route('addBbToDB')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="my-1 me-2" for="inlineFormCustomSelectPref">Рубрика</label>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Производитель</label>

                        </div>
                        <div class="form-group">
                            <label class="control-label">Модель</label>
                            <input type="text" value="{{old('title')}}" name="title"
                                   required class="form-control" placeholder="Name">
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


                        <div class="mb-3 col-6">
                            <label class="form-label">Цена</label>
                            <input type="number" value="{{old('price')}}" name="price"
                                   class="form-control" id="price">
                        </div>

                        <div class="mb-3 col-6">
                            <label class="form-label">Цена</label>
                            @if (count($price_types)>0)
                                @foreach($price_types as $price_type)
                                    <div class="input-pricetype" id="pricetype_{{$price_type->id}}">
                                        <input class="form-check-input" type="radio" data-hasvalue="{{$price_type->has_value}}" name="price_type" id="input_pricetype_{{$price_type->id}}" value="{{$price_type->id}}" required  >
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

                        @foreach($contact_types as $contact_type)
                            @if ($contact_type->mask)
                                <script>
                                   window.addEventListener("load", function(){
                                        $("#contact_{{$contact_type->id}}").mask("{{$contact_type->mask}}")
                                    });
                                </script>

                            @endif
                            <div class="mb-3 col-6">
                                <label class="form-label">{{$contact_type->name}}</label>
                                <input type="text" value="{{old('contact',$contact_type[$contact_type->id])}}" name="contact[{{$contact_type->id}}]"
                                       class="form-control" id="contact_{{$contact_type->id}}"
                                       @if ($contact_type->required == 'Y')
                                       required
                                    @endif
>

                            </div>
                        @endforeach


                        @if ($user->organization)
                            <div class="mb-3 col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Y" name="organization" id="flexCheckChecked" checked>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Подать объявление от {{$user->organization->title}}
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="button">
                            <button type="submit" class="btn">Save</button>
                        </div>
                    </form>

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
            NewSelect('rubric');
            NewSelect('location');
            $('.input-images').imageUploader();


        })
    </script>
@endsection

