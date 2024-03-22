@extends('layouts.base')
@section('title', 'Главная')
@section('main')

    @include('home.hero')
    @include('home.categories')

@endsection('main')
