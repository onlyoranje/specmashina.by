@extends('layouts.base')
@section('title', $bb->title)
@section('main')
    <div class="container">
        <h1 class="my-3 text-center">Объявления</h1>
        <h2>{{ $bb->title }}</h2>
        <p>Автор: {{  $bb->user->name }}</p>
        <p>{{ $bb->content }}</p>
        <p>{{ $bb->price }} руб.</p>
        <p><a href="/">На перечень объявлений</a></p>
    </div>
@endsection('main')
