@extends('layouts.dashboard')
@section('title', 'Главная')
@section('main')







    <section class="section section-md pb-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">

                    <form class="form-ad" action="{{route('addBbToDB')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="my-1 me-2" for="inlineFormCustomSelectPref">Рубрика</label>
                            <div id="container_rubric_0"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Производитель</label>
                            <select class="form-select" name="vendor_id" required>
                                <option  selected disabled>- выбрать -</option>
                                <?php
                                use App\Models\Location;
                                use App\Models\Rubric;
                                $vendors = App\Models\Vendor::get();?>
                                @foreach($vendors as $vendor)
                                    <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                @endforeach
                            </select>
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
                                    $(function() {
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

        $(document).ready(function() {
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

