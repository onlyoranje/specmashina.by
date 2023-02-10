@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
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
    </div>



@endsection

