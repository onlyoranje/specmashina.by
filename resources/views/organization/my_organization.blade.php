@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($organization)
                    <div class="card">


                        <div class="card-body">




                                    <div class="card mb-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                @if ($organization->logo)
                                                <img src="{{Storage::url($organization->logo)}}" class="img-fluid rounded-start" alt="...">
                                                @else
                                                    <svg class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false">
                                                        <title>Placeholder</title>
                                                        <rect width="100%" height="100%" fill="#868e96"></rect>
                                                        <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$organization->title}}</h5>
                                                    <p class="card-text">УНП {{$organization->unp}}</p>
                                                    <p class="card-text">{{$organization->address}}</p>
                                                    @if ($organization->url) <p class="card-text">{{$organization->url}}</p> @endif
                                                    @if ($organization->email) <p class="card-text">{{$organization->email}}</p> @endif
                                                    <a  href={{route('organization_edit')}} class="card-text"><small class="text-muted">редактировать</small></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                        </div>

                    </div>
                    @else
                        <a href="{{route('organization_add')}}">Добавить Организацию</a>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

