@extends('layouts.dashboard')
@section('title',' Удаление раздела')

@section('main')
    @php
        $title= "Удалить категорию ".$rubric->title;
        $id = ['rubric'=>$rubric->id];
        $route = 'rubric_dashboard_destroy';
        //
        $children = App\Models\Rubric::descendantsAndSelf($rubric->id)->pluck('id')->toArray();
        $used = App\Models\Bb::WhereIn('rubric_id',$children)->pluck('id')->toArray();

        $errors_form=[];
        if ($rubric->level==0) $errors_form[] = "Нельзя удалять корневую рубрику";
        if (count($used)>0) $errors_form[] = "Данный раздел используется в ".count($used)." объявлениях  ";
    @endphp
    @include('layouts.delete_form')
@endsection
