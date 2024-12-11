@extends('layouts.base')
@section('title', 'Главная')
@section('description', 'Landi.by - Портал объявлений об аренде и продаже
строительной техники и инструмента')
@section('main')

    @include('home.hero')
    @include('home.categories')
    @include('home.actual')
    @include('home.city')
    @include('home.trending')
    @include('home.latest_news')


@endsection('main')
