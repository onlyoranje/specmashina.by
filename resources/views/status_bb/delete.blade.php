@extends('layouts.dashboard')
@section('title', 'Главная')
@section('main')
    @php
        $title= "Удалить статус ".$status->name;
        $id = $status->id;
        $route = 'status_dashboard_destroy';
        $used = App\Models\Bb::Where('status_bb_id',$status->id)->pluck('id')->toArray();
        $errors_form=[];
        if (count($used)>0) $errors_form[] = "Данный статус используется в ".count($used)." объявлениях  ";
    @endphp
    @include('layouts.delete_form')
@endsection
