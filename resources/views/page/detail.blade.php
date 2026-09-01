@extends('layouts.base')
@section('title', $title)
@section('main')
    <section class="section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-inner">

                        <div class="post-details">
                            <div class="detail-inner">
                                <h1 class="post-title">
                                    <a href="{{route('page',$page->id)}}">{{ $page->title }}</a>
                                </h1>

                            {!! $page->content !!}

                            </div>



                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
