@extends('layouts.base')
@section('title', $title)
@section('main')
    <section class="section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="single-inner">
                        <div class="post-thumbnils">
                            @if (isset($post->image))
                                <img class="thumb" src="{{Storage::url($post->resizeImage($post->image,640,480))}}" alt="{{ $post->title }}">
                            @else
                                <img src="http://placehold.it/640x480&text={{ $post->title }}" alt="{{ $post->title }}">

                            @endif
                        </div>
                        <div class="post-details">
                            <div class="detail-inner">
                                <h1 class="post-title">
                                    <a href="{{route('post',$post->id)}}">{{ $post->title }}</a>
                                </h1>
                                <!-- post meta -->
                                <ul class="custom-flex post-meta">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fa-regular fa-calendar"></i>
                                            {{date('d.m.Y',strtotime($post->created_at))}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('posts')}}?category={{$post->category}}">
                                            <i class="fa-regular fa-folder"></i>
                                            {{$post->category}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fa-regular fa-eye"></i>
                                            Просмотров: {{$post->count_views()}}
                                        </a>
                                    </li>
                                </ul>
                            {!! $post->content !!}
                                <!-- Post Social Share -->
                                {{--<div class="post-social-media">
                                    <h5 class="share-title">Social Share</h5>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="lni lni-facebook-filled"></i>
                                                <span>facebook</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="lni lni-twitter-original"></i>
                                                <span>twitter</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="lni lni-google"></i>
                                                <span>google+</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="lni lni-linkedin-original"></i>
                                                <span>linkedin</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <i class="lni lni-pinterest"></i>
                                                <span>pinterest</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>--}}
                                <!-- Post Social Share -->
                            </div>

                            <div class="single-block tags">
                                <h3>Теги</h3>
                                <ul>
                                    @foreach(explode(',',$post->tags) as $tag)
                                    <li><a href="{{route('posts')}}?tag={{$tag}}">{{$tag}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Comments -->
                          {{--  <div class="post-comments">
                                <h3 class="comment-title"><span>3 comments on this post</span></h3>
                                <ul class="comments-list">
                                    <li>
                                        <div class="comment-img">
                                            <img src="assets/images/blog/comment1.jpg" class="rounded-circle" alt="img">
                                        </div>
                                        <div class="comment-desc">
                                            <div class="desc-top">
                                                <h6>Arista Williamson</h6>
                                                <span class="date">19th May 2023</span>
                                                <a href="javascript:void(0)" class="reply-link"><i class="lni lni-reply"></i>Reply</a>
                                            </div>
                                            <p>
                                                Donec aliquam ex ut odio dictum, ut consequat leo interdum. Aenean nunc
                                                ipsum, blandit eu enim sed, facilisis convallis orci. Etiam commodo
                                                lectus
                                                quis vulputate tincidunt. Mauris tristique velit eu magna maximus
                                                condimentum.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="children">
                                        <div class="comment-img">
                                            <img src="assets/images/blog/comment2.jpg" class="rounded-circle" alt="img">
                                        </div>
                                        <div class="comment-desc">
                                            <div class="desc-top">
                                                <h6>Rosalina Kelian <span class="saved"><i class="lni lni-bookmark"></i></span></h6>
                                                <span class="date">15th May 2023</span>
                                                <a href="javascript:void(0)" class="reply-link"><i class="lni lni-reply"></i>Reply</a>
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim.
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment-img">
                                            <img src="assets/images/blog/comment3.jpg" class="rounded-circle" alt="img">
                                        </div>
                                        <div class="comment-desc">
                                            <div class="desc-top">
                                                <h6>Alex Jemmi</h6>
                                                <span class="date">12th May 2023</span>
                                                <a href="javascript:void(0)" class="reply-link"><i class="lni lni-reply"></i>Reply</a>
                                            </div>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                veniam.
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="comment-form">
                                <h3 class="comment-reply-title"><span>Leave a comment</span></h3>
                                <form action="#" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-box form-group">
                                                <input type="text" name="name" class="form-control form-control-custom" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-box form-group">
                                                <input type="email" name="email" class="form-control form-control-custom" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <textarea name="#" class="form-control form-control-custom" placeholder="Your Comments"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="button">
                                                <button type="submit" class="btn">Post Comment</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>--}}
                        </div>
                    </div>
                </div>
                <aside class="col-lg-4 col-md-12 col-12">
                    <div class="sidebar blog-grid-page">
                        <!-- Start Single Widget -->
                      {{--  <div class="widget search-widget">
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
