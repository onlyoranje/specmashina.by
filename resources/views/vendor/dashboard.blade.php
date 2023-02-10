@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">


                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <a href="{{route('vendor_dashboard_add')}}">Добавить производителя</a>
                            <br>
                                    @if (count($vendors)>0)
                            @foreach($vendors as $vendor)
                                        <a href='{{route('vendor_dashboard_edit' ,  ['vendor'=>$vendor->id])}}'>{{$vendor->name}}</a>
                                        <a href='{{route('vendor_dashboard_edit' ,  ['vendor'=>$vendor->id])}}'>Редактировать </a>
                                        <a href='{{route('vendor_dashboard_delete', ['vendor'=>$vendor->id])}}'>Удалить</a><br>
                            @endforeach


                                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

