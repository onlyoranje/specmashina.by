@extends('layouts.dashboard')
@section('title', $title)
@php
    $title= "Удалить статью ".$post->title;
    $id = ['post'=>$post->id];
    $route = 'destroy_post';
    $errors_form=[];
    @endphp
@section('main')
    @include('layouts.delete_form')

@endsection
