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

                                @if (count($organization)==1)

                                @else
                                    <a href="{{route('organization_add')}}">Добавить Организацию</a>

                                @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

