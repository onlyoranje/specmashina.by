@extends('layouts.base')
@section('title', 'Главная')
@section('main')

    <?
    use App\Models\Bb;

    $orders = Bb::search('etqw')->get();?>
    <pre><?print_r($orders)?></pre>



@endsection



