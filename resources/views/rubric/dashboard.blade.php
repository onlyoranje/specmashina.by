@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">


                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <a href="{{route('rubric_dashboard_add')}}">Добавить Категорию</a>
                            <br>
                                @if (count($rubrics)>0)
                                <?
                                $traverse = function ($rubrics, $prefix = '-') use (&$traverse) {
                                    foreach ($rubrics as $rubric) {

                                        echo "<a href='".route('rubric_dashboard_edit' , ['rubric'=>$rubric->id]) ."'>".PHP_EOL.$prefix.' '.$rubric->title."</a>  <a href='".route('rubric_dashboard_edit' , ['rubric'=>$rubric->id]) ."'>Редактировать </a> <a href='".route('rubric_dashboard_delete', ['rubric'=>$rubric->id])."'>Удалить</a><br>";


                                        $traverse($rubric->children, $prefix.'-');
                                    }
                                };

                                $traverse($rubrics);
                                ?>


                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

