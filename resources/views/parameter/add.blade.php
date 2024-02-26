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
                                    <h3 class="block-title">Добавление параметра</h3>
                                    <form class="default-form-style" action="{{route('addParameterToDB')}}" method="post">
                                        @csrf

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование</label>
                                                        <input type="text" value="{{old('title')}}"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label >Мера</label>
                                                        <input type="text" value="{{old('measure')}}" name="measure"  >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Вид данных</label>
                                                        <select class="form-select" name='type' required>
                                                            <option selected disabled>- выбрать -</option>
                                                            @foreach($types as $type)
                                                                <option value="{{$type->type}}">{{$type->type_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>





                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Сортировка</label>
                                                        <input type="number" value="{{old('sort',500)}}" name="sort"   required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-12">

                                                  {{--  <div class="form-group">
                                                        <label class="control-label">Рубрики</label>--}}


                                                        @if (count($rubrics)>0)
                                                            <?php

                                                            $traverse = function ($rubrics, $prefix = '<ul>',$postfix= '</ul>') use (&$traverse) {
                                                               if (count($rubrics)>0) echo '<ul>';
                                                                foreach ($rubrics as $rubric) {
                                                                    $parent_id=$rubric->parent_id;
                                                                    if (!is_numeric($rubric->parent_id)) $parent_id=0;
                                                                    echo "<li class=\"form-check\"><input type=\"checkbox\" id=\"checkbox".$rubric->id."\" name=\"rubrics[]\" value=\"".$rubric->id."\" class=\"form-check-input\"><label class=\"form-check-label\" for=\"checkbox".$rubric->id."\">".$rubric->title."</label>";

                                                                    if (count($rubric->children)==0) echo "</li>";
                                                                    $traverse($rubric->children);
                                                                }
                                                               if (count($rubrics)>0) echo "</ul>";
                                                            };

                                                            $traverse($rubrics);

                                                            ?>
                                                        @endif

                                                {{--    </div>--}}

                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn ">Обновить</button>
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


  {{--  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="form-ad" action="{{route('addParameterToDB')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="Name" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Мера</label>
                                    <input type="text" value="{{old('measure')}}" name="measure" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Вид данных</label>
                                    <select class="form-select" name='type' aria-label="Default select example"required>
                                        <option selected disabled>- выбрать -</option>
                                        @foreach($types as $type)
                                        <option value="{{$type->type}}">{{$type->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Сортировка</label>
                                    <input type="number" value="{{old('sort',500)}}" name="sort" class="form-control" placeholder="сортировка">
                                </div>
                            </div>

<div class="col-lg-6 col-12">
    <div class="form-group">
        <label class="control-label">Рубрики</label>


                @if (count($rubrics)>0)
                    <?php

                    $traverse = function ($rubrics, $prefix = '<ul>',$postfix= '</ul>') use (&$traverse) {
                        if (count($rubrics)>0) echo '<ul>';
                        foreach ($rubrics as $rubric) {
                            $parent_id=$rubric->parent_id;
                                if (!is_numeric($rubric->parent_id)) $parent_id=0;
                            echo "<li>

<input  type=\"checkbox\" id=\"checkbox".$rubric->id."\" name=\"rubrics[]\" value=\"".$rubric->id."\" >
<label  for=\"checkbox".$rubric->id."\">".$rubric->title.'</label>
';

if (count($rubric->children)==0) echo "</li>";
                            $traverse($rubric->children);
                        }
                        if (count($rubrics)>0) echo "</ul>";
                    };

                    $traverse($rubrics);

                    ?>
@endif

    </div>
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
    </div>--}}



@endsection

