@extends('layouts.dashboard')
@section('title',' Удаление параметра')
@section('main')
    @php
        $title= "Удалить параметр ".$parameter->name;
        $id = ['parameter'=>$parameter->id];
        $route = 'parameter_dashboard_destroy';
        $used = App\Models\BbParameters::Where('parameter_id',$parameter->id)->pluck('bb_id')->toArray();
        $errors_form = [];
        if (count($used)>0) $errors_form[] = "Данный параметр используется в ".count($used)." объявлениях  ";
    @endphp
    @include('layouts.delete_form')
@endsection
