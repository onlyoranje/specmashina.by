@extends('layouts.dashboard')
@section('title','Удаление типа контакта')
@section('main')
    @php
        $title = "Удалить тип контакта ".$type->name;
        $id = ['type'=>$type->id];
        $route = 'contact_type_destroy';
        $errors_form=[];
    @endphp
    @include('layouts.delete_form')
@endsection
