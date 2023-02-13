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

                            <a href="{{route('parameter_dashboard_add')}}">Добавить Параметр</a>
                            <a href="{{route('parameter_type_add')}}">Добавить Тип Параметра</a>
                            <br>
                                @if (count($parameters)>0)
                                <?php

                                    foreach ($parameters as $parameter) {

                                        echo $parameter->name."  <a href='".route('parameter_dashboard_edit' , ['parameter'=>$parameter->id]) ."'>Редактировать </a> <a href='".route('parameter_dashboard_delete', ['parameter'=>$parameter->id])."'>Удалить</a><br>";



                                    }


                               ;
                                ?>


                                @endif
                        </div>
                        <hr>
                        <h3> Типы параметров</h3>
                        @if (count($types)>0)
                            <?php

                            foreach ($types as $type) {

                                echo $type->type_name."  <a href='".route('parameter_type_edit' , ['type'=>$type->id]) ."'>Редактировать </a> <a href='".route('parameter_type_delete', ['type'=>$type->id])."'>Удалить</a><br>";



                            }


                            ;
                            ?>


                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

