@extends('layouts.base')
@section('title', $title)
@section('main')

    <section class="section latest-news-area blog-list">
        <div class="container">
            <div class="row">
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
                                            <img src="http://placehold.it/640x480&text={{ $post->title }}" alt="{{ $post->title }}">

                                        @endif
                                    </a>
                                </div>
                                <div class="content-body">
                                    <h4 class="title"><a href="{{route('post',$post->id)}}">{{$post->title}}</a></h4>
                                    <p>{{$post->preview_text}}</p>
                                    <div class="meta-details">
                                        <ul>
                                            <li><a href="javascript:void(0)">{{date('d.m.Y',strtotime($post->created_at))}}</a></li>
                                            <li><a href="javascript:void(0)">{{$post->category}}</a></li>
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
                        {{ $posts->onEachSide(1)->links() }}
                        <!--/ End Pagination -->
                        </div>
                    @endif
                    <!--/ End Pagination -->
                </div>
                <aside class="col-lg-4 col-md-5 col-12">
                    <div class="sidebar blog-grid-page">
                        <!-- Start Single Widget -->
                        <div class="widget search-widget">
                            <h5 class="widget-title"><span>Search This Site</span></h5>
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="widget popular-feeds">
                            <h5 class="widget-title"><span>Popular Feeds</span></h5>
                            <div class="popular-feed-loop">
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <h6 class="post-title"><a href="javascript:void(0)">Tips to write an impressive resume online for
                                                beginner</a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 05th Nov 2023</span>
                                    </div>
                                </div>
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <h6 class="post-title"><a href="javascript:void(0)">10 most important SEO focus areas for
                                                colleges
                                                and universities</a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 24th March 2023</span>
                                    </div>
                                </div>
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <h6 class="post-title"><a href="javascript:void(0)">7 things you should never say to your boss in
                                                your joblife</a></h6>
                                        <span class="time"><i class="lni lni-calendar"></i> 30th Jan 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                    @include('widgets.top_category_post')
                        <!-- Start Single Widget -->
                        <div class="widget popular-tag-widget">
                            <h5 class="widget-title"><span>Popular Tags</span></h5>
                            <div class="tags">
                                <a href="javascript:void(0)">Jobpress</a>
                                <a href="javascript:void(0)">Design</a>
                                <a href="javascript:void(0)">HR</a>
                                <a href="javascript:void(0)">Recruiter</a>
                                <a href="javascript:void(0)">Interview</a>
                                <a href="javascript:void(0)">Employee</a>
                                <a href="javascript:void(0)">Labor</a>
                                <a href="javascript:void(0)">Salary</a>
                                <a href="javascript:void(0)">Consult</a>
                                <a href="javascript:void(0)">Business</a>
                                <a href="javascript:void(0)">Candidates</a>
                            </div>
                        </div>
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
