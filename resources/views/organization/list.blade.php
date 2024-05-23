@extends('layouts.base')
@section('title', $title)
@section('main')

    <section class="category-page section">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5"><h1>{{$title}}</h1></div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="category-sidebar">
                        @include('widgets.search_mini')
                        @include('widgets.location')
                        @include('widgets.banner')
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="category-grid-list">
                        <div class="row">
                            <div class="col-12">
                                <div class="category-grid-topbar">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <h3 class="title">Показано {{$organizations->firstItem()}}-{{$organizations->lastItem()}} из {{$organizations->total()}} организаций</h3>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-12">

                                @foreach ($organizations as $organization)

                    <div class="single-item-grid">
                        <div class="row align-items-center">


                            <div class="col-lg-3 col-md-7 col-12">
                                <div class="image">
                                    <a href="{{route('organization',$organization->id)}}">
                                        @if($organization->logo)
                                        <img src="{{Storage::url($organization->logo)}}" alt="{{$organization->title}}">
                                        @else
                                            <img src="http://placehold.it/640x480&text={{$organization->title}}" alt="{{$organization->title}}">
                                        @endif
                                    </a>

                                </div>
                            </div>
                            <div class="col-lg-9 col-md-5 col-12">
                                <div class="content">

                                    <h3 class="title title-organization">
                                        <a href="{{route('organization',$organization->id)}}">{{$organization->title}}</a>
                                    </h3>
                                    <p class="location location-organization"><a href="javascript:void(0)"><i class="fa-solid fa-location-dot"></i>{{$organization->location->title}}</a></p>
                                    <a href="{{route('organization',$organization->id)}}" class="tag">Объявлений: {{$organization->count_bbs()}}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                                    @endforeach
                    <div class="row">
                        <div class="col-12">
                            <!-- Pagination -->
                        {{ $organizations->onEachSide(1)->links() }}
                        <!--/ End Pagination -->
                        </div>
                    </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>

    </section>

@endsection
