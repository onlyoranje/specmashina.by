@extends('layouts.dashboard')
@section('title',' Удаление города/региона')
@section('main')
    @php
        $title= "Удалить город/регион ".$location->title;
        $id = ['location'=>$location->id];
        $route = 'location_dashboard_destroy';
        $used = App\Models\Bb::Where('location_id',$location->id)->pluck('id')->toArray();
        $errors_form=[];
        if (count($used)>0) $errors_form[] = "Данный регион используется в ".count($used)." объявлениях  ";
    @endphp
    @include('layouts.delete_form')
@endsection


