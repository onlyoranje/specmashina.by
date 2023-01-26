@extends('layouts.dashboard')

@section('title', 'Главная')

@section('main')
@include('dashboard_nav')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <p class="text-right"><a href="{{route('addForm')}}">Добавить объявление</a></p>
                @if (count($bbs) > 0)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Цена, руб.</th>
                            <th colspan="2">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bbs as $bb)
                            <tr>
                                <td><h3><a href="{{route('bb', ['bb'=>$bb->id]) }}" target="_blank"> {{ $bb->title }}</a></h3></td>
                                <td>{{ $bb->price }}</td>
                                <td>
                                    <a href="{{route('bb_edit', ['bb'=>$bb->id]) }}">Изменить</a>
                                </td>
                                <td>
                                    <a href="">Удалить</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            </div>
        </div>
    </div>


@endsection
