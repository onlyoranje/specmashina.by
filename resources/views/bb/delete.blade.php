@extends('layouts.dashboard')
@section('title',' Удаление объявления')
@section('main')
    @php
        $title= "Удалить объявление ".$bb->title();
        $id = ['bb'=>$bb->id];
        $route = 'bb_destroy';

        $errors_form=[];

    @endphp
    @include('layouts.delete_form')
@endsection
