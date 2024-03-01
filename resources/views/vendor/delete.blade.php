@extends('layouts.dashboard')
@section('title',' Удаление параметра')
@section('main')

    @php
        $title= "Удалить производителя ".$vendor->name;
        $id = ['vendor'=>$vendor->id];
        $route = 'vendor_dashboard_destroy';
        $used = App\Models\Bb::Where('vendor_id',$vendor->id)->pluck('id')->toArray();
        $errors_form = [];
        if (count($used)>0) $errors_form[] = "Данный производитель используется в ".count($used)." объявлениях  ";
    @endphp
    @include('layouts.delete_form')

@endsection
