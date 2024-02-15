@extends('layouts.dashboard')

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
                                    <h3 class="block-title">Редактирование типа цены "{{$type->type}}"</h3>
                                    <form class="profile-setting-form" action="{{route('editPriceTypetoDB',[$type->id])}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="inner-block">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Наименование</label>
                                                    <input type="text" value="{{old('type',$type->type)}}"  name="type"  required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Сортировка</label>
                                                    <input type="number" value="{{old('sort',$type->sort)}}" name="sort"   required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <ul class="list-group  list-group-flush">

                                                    @if (count($rubrics)>0)
                                                        <?php
                                                        //
                                                        $pr= $type->rubrics->pluck('id')->toArray();

                                                        $traverse = function ($rubrics, $prefix = '<ul>',$postfix= '</ul>') use ($pr, &$traverse) {
                                                            if (count($rubrics)>0) echo '<ul>';
                                                            foreach ($rubrics as $rubric) {
                                                                $parent_id=$rubric->parent_id;
                                                                if (!is_numeric($rubric->parent_id)) $parent_id=0;
                                                                echo "<li  class=\"list-group-item list-group-dashboard\"><input class=\"form-check-input me-1\" type=\"checkbox\" id=\"checkbox".$rubric->id."\" name=\"rubrics[]\" value=\"".$rubric->id."\"";
                                                                if (in_array($rubric->id, $pr)) echo "checked";
                                                                echo ">".$rubric->title;


                                                                if (count($rubric->children)==0) echo "</li>";
                                                                $traverse($rubric->children);
                                                            }
                                                            if (count($rubrics)>0) echo "</ul>";
                                                        };

                                                        $traverse($rubrics);

                                                        ?>
                                                    @endif
                                                </ul>
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
                    <form class="form-ad" action="{{route('editPriceTypetoDB',[$type->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Тип</label>
                                        <input type="text" value="{{old('type',$type->type)}}"  name="type" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Сортировка</label>
                                        <input type="text" value="{{old('sort',$type->sort)}}" name="sort" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <input class="form-check-input" type="checkbox" value="Y" name="has_value" <?php if ($type->has_value == 'Y') echo 'checked'?>>
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Указывать цену
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-5 col-12">
                                    <div class="button">
                                        <button type="submit" class="btn">Save</button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Рубрики</label>


                                        @if (count($rubrics)>0)
                                            <?php
                                            //
                                            $pr= $type->rubrics->pluck('id')->toArray();

                                            $traverse = function ($rubrics, $prefix = '<ul>',$postfix= '</ul>') use ($pr, &$traverse) {
                                                if (count($rubrics)>0) echo '<ul>';
                                                foreach ($rubrics as $rubric) {
                                                    $parent_id=$rubric->parent_id;
                                                    if (!is_numeric($rubric->parent_id)) $parent_id=0;
                                                    echo "<li><input  type=\"checkbox\" id=\"checkbox".$rubric->id."\" name=\"rubrics[]\" value=\"".$rubric->id."\"";
                                                    if (in_array($rubric->id, $pr)) echo "checked";
                                                    echo "><label  for=\"checkbox".$rubric->id."\">".$rubric->title."</label>";


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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>--}}



@endsection


