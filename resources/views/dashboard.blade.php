@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>{{ __("You're logged in!") }}</p>

                    <ul>
                        <li><a href="{{route('mybb')}}"> Мои объявления</a></li>
                        <li>Моя организация</li>
                        <li><a href="{{route('location_dashboard')}}">Регионы/Города</a></li>
                        <li><a href="{{route('rubric_dashboard')}}"> Категории</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection
