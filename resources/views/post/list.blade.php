@extends('layouts.base')
@section('title', $title)
@section('main')

    <section class="section latest-news-area blog-list">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5"><h1>{{$title}}</h1></div>
                <div class="col-lg-8 col-md-7 col-12">
                    @if (count($posts)>0)

                    <div class="row">
@foreach($posts as $post)
                        <div class="col-lg-6 col-12">
                            <!-- Single News -->
                            <div class="single-news wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="image">
                                    <a href="{{route('post',$post->id)}}">
                                        @if (isset($post->image))
                                            <img class="thumb" src="{{Storage::url($post->resizeImage($post->image,640,480))}}" alt="{{ $post->title }}">
                                        @else
                                            <img src="/storage/test/image.jpg" alt="{{ $post->title }}">

                                        @endif
                                    </a>
                                </div>
                                <div class="content-body">
                                    <h4 class="title"><a href="{{route('post',$post->id)}}">{{$post->title}}</a></h4>
                                    <p>{{$post->preview_text}}</p>
                                    <div class="meta-details">
                                        <ul>
                                            <li><a href="javascript:void(0)">{{date('d.m.Y',strtotime($post->created_at))}}</a></li>
                                            <li><a href="{{route('posts')}}?category={{$post->category}}">{{$post->category}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single News -->
                        </div>
@endforeach
                    </div>
                    <!-- Pagination -->
                        <div class="col-12">
                            <!-- Pagination -->
                        {{ $posts->onEachSide(1)->appends(request()->input())->links() }}
                        <!--/ End Pagination -->
                        </div>
                    @endif
                    <!--/ End Pagination -->
                </div>
                <aside class="col-lg-4 col-md-5 col-12">
                    <div class="sidebar blog-grid-page">
                        <!-- Start Single Widget -->
                        {{--<div class="widget search-widget">
                            <h5 class="widget-title"><span>Search This Site</span></h5>
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>--}}
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                    @include('widgets.top_posts')
                        <!-- End Single Widget -->
                    @include('widgets.top_category_post')
                        <!-- Start Single Widget -->
                    @include('widgets.top_tags_post')
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        @include('widgets.banner_sidebar')
                        <!-- End Single Widget -->
                    </div>
                </aside>

            </div>
        </div>
    </section>
@endsection
