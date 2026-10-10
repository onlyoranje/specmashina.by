@extends('layouts.dashboard')
@section('title','Удаление типа параметра')
@section('main')
    @php
        $title = "Удалить тип параметра ".$type->type_name." (".$type->type.")";
        $id = ['type'=>$type->id];
        $route = 'parameter_type_destroy';
        $errors_form=[];
    @endphp
    @include('layouts.delete_form')
@endsection
