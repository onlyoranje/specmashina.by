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

                            <a href="{{route('location_dashboard_add')}}">Добавить Регион/Город</a>
                            <br>
                                @if (count($locations)>0)
                                <?
                                $traverse = function ($locations, $prefix = '-') use (&$traverse) {
                                    foreach ($locations as $location) {

                                        echo "<a href='".route('location_dashboard_edit' , ['location'=>$location->id]) ."'>".PHP_EOL.$prefix.' '.$location->title."</a>  <a href='".route('location_dashboard_edit' , ['location'=>$location->id]) ."'>Редактировать </a> <a href='".route('location_dashboard_delete', ['location'=>$location->id])."'>Удалить</a><br>";


                                        $traverse($location->children, $prefix.'-');
                                    }
                                };

                                $traverse($locations);
                                ?>


                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

