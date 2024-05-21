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
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">

                    <div class="single-item-grid">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-7 col-12">
                                <div class="image">
                                    <a href="item-details.html"><img src="assets/images/items-tab/item-2.jpg" alt="#"></a>

                                </div>
                            </div>
                            <div class="col-lg-9 col-md-5 col-12">
                                <div class="content">

                                    <h3 class="title">
                                        <a href="item-details.html">Travel Kit</a>
                                    </h3>
                                    <p class="location"><a href="javascript:void(0)"><i class="lni lni-map-marker">
                                            </i>San Francisco</a></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>

    </section>

@endsection
