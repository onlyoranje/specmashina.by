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

                        <div class="row">
                            <div class="col-12">
                                <!-- Start Activity Log -->
                                <div class="profile-settings-block dashboard-block mt-0">
                                    <h3 class="block-title">Редактирование параметра "{{$parameter->name}}" </h3>
                                    <form class="default-form-style" action="{{route('editParameterToDB',['parameter'=>$parameter->id])}}" method="post">
                                        @csrf
                                        @method('PATCH')

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-3 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование</label>
                                                        <input type="text" value="{{old('name',$parameter->name)}}"  name="name"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12">
                                                    <div class="form-group">
                                                        <label >Мера</label>
                                                        <input type="text" value="{{old('measure',$parameter->measure)}}" name="measure"  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12">
                                                    <div class="form-group">
                                                        <label>Вид данных {{$parameter->type}}</label>
                                                        <select class="form-select" name='type' required>
                                                            <option  disabled>- выбрать -</option>
                                                            @foreach($types as $type)
                                                                <option value="{{$type->type}}" <?php if ($type->type_name==old('type',$parameter->type)) echo 'selected' ?>>{{$type->type_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>





                                                <div class="col-lg-3 col-12">
                                                    <div class="form-group">
                                                        <label>Сортировка</label>
                                                        <input type="number" value="{{old('sort',$parameter->sort)}}" name="sort"   required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-12" id="options" >
                                                    <div class="form-group">
                                                        <label>Опции</label>
                                                        <div id="sortable">
                                                            @php $options = json_decode($parameter->options, true);

                                                            if(!is_array($options)) $options[]='';
                                                            @endphp
                                                            @foreach ($options as $option_value )
                                                            <div class="input-group flex-nowrap mt-1 input-option">
                                                                <span class="input-group-text" id="addon-wrapping">
                                                                 <i class="lni lni-circle-plus"></i></span>
                                                                <input name="options[]" type="text" value="{{$option_value}}">
                                                            </div>
                                                            @endforeach

                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group button mt-1">
                                                                <span type="button" class="reply add-option" >Добавить строку</span>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 limit">
                                                    <div class="form-group">
                                                        <label>Минимальное значение</label>
                                                        <input type="number" value="{{old('min',$parameter->min)}}" name="min">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-12 limit">
                                                    <div class="form-group">
                                                        <label>Максимальное значение</label>
                                                        <input type="number" value="{{old('max',$parameter->max)}}" name="max">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-12">

                                                    {{--  <div class="form-group">
                                                          <label class="control-label">Рубрики</label>--}}

                                                    @if (count($rubrics)>0)
                                                        <?php
                                                        //
                                                        $pr= $parameter->rubrics->pluck('id')->toArray();

                                                        $traverse = function ($rubrics, $prefix = '<ul>',$postfix= '</ul>') use ($pr, &$traverse) {

                                                            if (count($rubrics)>0) echo '<ul>';
                                                            foreach ($rubrics as $rubric) {
                                                                $parent_id=$rubric->parent_id;
                                                                if (!is_numeric($rubric->parent_id)) $parent_id=0;
                                                                echo "<li class=\"form-check\"><input type=\"checkbox\" id=\"checkbox".$rubric->id."\" name=\"rubrics[]\" value=\"".$rubric->id."\" class=\"form-check-input\"";
                                                                if (in_array($rubric->id, $pr )) echo "checked";
                                                                echo "><label class=\"form-check-label\" for=\"checkbox".$rubric->id."\">".$rubric->title."</label>";


                                                                if (count($rubric->children)==0) echo "</li>";
                                                                $traverse($rubric->children);
                                                            }
                                                            if (count($rubrics)>0) echo "</ul>";
                                                        };

                                                        $traverse($rubrics);

                                                        ?>
                                                    @endif



                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn ">Добавить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- End Activity Log -->
                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.addEventListener("load", function(){
            $( "#sortable" ).sortable();
            @if ($parameter->type!=='options') $('#options').hide() @endif
            @if ($parameter->type!=='number') $('.limit').hide() @endif

            $("select[name='type']").change(function () {
                if ($(this).val()==='options')
                {
                    $('#options').show()
                    $('.limit').hide()
                } else if ($(this).val()==='number')
                {
                    $('.limit').show()
                    $('#options').hide()
                } else {
                    $('.limit').hide()
                    $('#options').hide()

                }

            });
            $(".add-option").on( "click",function (){
                $('#sortable').append('<div class="input-group flex-nowrap mt-1 input-option"><span class="input-group-text" id="addon-wrapping"><i class="lni lni-circle-plus"></i></span><input name="options[]" type="text"></div>');
            })
        });
    </script>
@endsection




