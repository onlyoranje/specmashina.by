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
                                    <h3 class="block-title">Обновление категории</h3>
                                    <form class="default-form-style" action="{{route('editRubricToDB',['rubric'=>$rubric->id])}}" method="post">
                                        @csrf
                                        @method('PATCH')

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование</label>
                                                        <input type="text" value="{{old('title',$rubric->title)}}"  name="title"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Наименование (род.пад.)</label>
                                                        <input type="text" value="{{old('title_r',$rubric->title_r)}}"  name="title_r"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Сортировка</label>
                                                        <input type="number" value="{{old('sort',$rubric->sort)}}" name="sort"   required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Родительская категория</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>


                                                            <select name="parent_id" id="select_category" class="user-chosen-select">
                                                                <option value="">Корневая категория</option>
                                                                <?
                                                                $traverse = function ($rubrics, $prefix = '-') use (&$traverse) {
                                                                    foreach ($rubrics as $rubric) {
                                                                        echo "<option value=".$rubric->id." ";
                                                                        echo ">". PHP_EOL.$prefix.' '.$rubric->title."</option>";

                                                                        $traverse($rubric->children, $prefix.'-');
                                                                    }
                                                                };

                                                                $traverse($rubrics);
                                                                ?>



                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Иконка</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>


                                                            <select name="icon"  class="user-chosen-select">
                                                                @foreach ($icons as $icon)
                                                                <option value="{{$icon}}">{{$icon}}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div>
                                                        <img class="img-fluid icon" src="{{asset("images/logo/logo.svg")}}" alt="Logo">
                                                    </div>

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
    <script>
        window.addEventListener("load", function() {
            @isset ($rubric->parent_id)
            $('#select_category option[value={{$rubric->parent_id}}]').prop('selected', true);
            @endisset

            @foreach ($depth as $ch_cat)
            $('#select_category option[value="{{$ch_cat->id}}"]').attr('disabled', 'disabled');
            @endforeach

            $( "select[name='icon']" ).on( "change",function () {
                $('.icon').attr('src','/images/'+$("select[name='icon']" ).val())
                console.log($( "select[name='icon']" ).val())
            })

        })
    </script>


@endsection

