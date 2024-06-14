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
                                            <h3 class="title">Показано {{$locations->firstItem()}}-{{$locations->lastItem()}} из {{$locations->total()}} городов</h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">

                                    <!-- Pagination -->
                                    <div class="pagination left">
                                        <ul class="pagination-list" >
@foreach($locations_letter as $letter)
                                        <li>
                                            <a href="{{route('locations')}}?letter={{$letter}}">{{$letter}}</a>
                                        </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <!--/ End Pagination -->
                                </div>

                                <div class="col-lg-12 col-md-12 col-12">

                                    @foreach ($locations as $city)

                                        <div class="single-item-grid">
                                            <div class="row align-items-center">


                                                <div class="col-lg-3 col-md-7 col-12">
                                                    <div class="image">
                                                        <a href="{{route('location',$city->id)}}">
                                                            @if ($city->image)
                                                                <img src="{{Storage::url($city->resizeImage($city->image,635,325))}}" alt="{{ $city->title }}">
                                                            @else
                                                                <img src="http://placehold.it/640x480&text={{ $city->title }}" alt="{{ $city->title }}">
                                                            @endif
                                                        </a>

                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-5 col-12">
                                                    <div class="content">

                                                        <h3 class="title title-organization">
                                                            <a href="{{route('location',$city->id)}}">{{ $city->title }}</a>
                                                        </h3>
                                                        <p class="location location-organization"><a href="javascript:void(0)">{{ $city->parent_location()->title }}</a></p>
                                                        <a href="{{route('location',$city->id)}}" class="tag">Объявлений: {{$city->bbs_count}}</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Pagination -->
                                        {{ $locations->onEachSide(1)->appends(request()->input())->links() }}
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
