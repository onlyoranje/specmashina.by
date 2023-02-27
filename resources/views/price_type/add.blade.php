@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="add-resume section">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1 col-12">
                                    <div class="add-resume-inner box">

                    <form class="form-ad" action="{{route('addPriceTypeToDB')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label class="control-label">Тип</label>
                                    <input type="text" value="{{old('type')}}" name="type" class="form-control" required>
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
    </div>
    </div>
    </div>
    </div>
    </div>



@endsection

