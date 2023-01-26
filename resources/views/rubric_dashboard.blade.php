@extends('layouts.layout')

@section('dashboard')
    <section class="all-categories section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        @include('dashboard_nav')

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
    </section>
@endsection
