@extends('layouts.base')
@section('title', 'Главная')
@section('main')
    @if (count($bbs) > 0)
        <table class="table table-striped">
            <tbody>
            @foreach ($bbs as $bb)
                <tr>
                    <td><h3>{{ $bb->title }}</h3></td>
                    <td>{{ $bb->price }}</td>
                    <td>
                        <a href="/{{ $bb->id }}">Подробнее...</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection('main')
