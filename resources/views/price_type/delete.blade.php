@extends('layouts.dashboard')
@section('title',' Удаление города/региона')
@section('main')
    @php
        $title= "Удалить тип цены ".$type->type;
        $id = ['type'=>$type->id];
        $route = 'price_type_destroy';

        $errors_form=[];

    @endphp
    @include('layouts.delete_form')
@endsection
