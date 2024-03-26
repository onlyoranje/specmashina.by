@extends('layouts.base')
@section('title', 'Главная')
@section('main')

    @include('home.hero')
    @include('home.categories')
    @include('home.actual')
    @include('home.city')
    @include('home.trending')
<script type="javascript">



</script>
@endsection('main')
