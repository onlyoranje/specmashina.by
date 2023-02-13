@extends('layouts.base')
@section('title', $bb->title)
@section('main')
    <div class="container">
        <h1 class="my-3 text-center">Объявления</h1>
        <h2>{{ $bb->title }}</h2>
        <h4>{{ $bb->rubric->title }}</h4>
        <h4>{{ $bb->location->title }}</h4>
        <p>Автор: {{  $bb->user->name }}</p>
        <p><?= nl2br($bb->content) ?> </p>
        <p>{{ $bb->price }} руб.</p>

        @foreach($bb->BbParameters as $BbParameter)

        {{$BbParameter->parameters->name}}:{{$BbParameter->value}}
        @endforeach
        @foreach($bb->userfile as $image)
        <img src="{{ Storage::url($image->resize(640, 320)) }}" alt="Иллюстрация">
        @endforeach
        <p><a href="/">На перечень объявлений</a></p>
    </div>
@endsection('main')
