@extends('layouts.dashboard')

@section('title', 'Главная')

@section('main')
@include('dashboard_nav')

<div class="section section-md">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="mb-4">
                    <a href="{{route('addForm')}}"><button class="btn btn-primary" type="button">Добавить</button></a>
                </div>
                @if (count($bbs) > 0)
                <div class="mb-5">
                    <table class="table">

                        <tr>
                            <th>Товар</th>
                            <th>Цена, руб.</th>
                            <th colspan="2">&nbsp;</th>
                        </tr>
                        @foreach ($bbs as $bb)
                        <tr>
                            <th scope="row" id="firstyear" rowspan="2"><a href="{{route('bb', ['bb'=>$bb->id]) }}" target="_blank"> {{ $bb->title }}</a></th>
                            <th scope="row" id="Bolter" headers="firstyear teacher">{{ $bb->price }}</th>
                            <td headers="firstyear Bolter males"><a href="{{route('bb_edit', ['bb'=>$bb->id]) }}">Изменить</a></td>
                            <td headers="firstyear Bolter females"><a href="{{route('bb_delete', ['bb'=>$bb->id]) }}">Удалить</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                    @endif
            </div>
            </div>
            </div>
            </div>


@endsection
