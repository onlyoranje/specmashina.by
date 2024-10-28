<?php

use App\Models\Post;

$posts = Post::where('active','Y')->addSelect(['poststatistic_count' => \App\Models\PostStatistic::selectRaw('sum(views) as total')
    ->whereColumn('post_id', 'posts.id')
    ->groupBy('post_id')
])->orderBy('poststatistic_count','desc')->limit(5)->get()
?>
<div class="widget popular-feeds">
    <h5 class="widget-title"><span>Популярное</span></h5>
    <div class="popular-feed-loop">
        @foreach ($posts as $post)
        <div class="single-popular-feed">
            <div class="feed-desc">
                <h6 class="post-title"><a href="{{route('post',$post->id)}}">{{$post->title}}</a></h6>
                <span class="time"><i class="lni lni-calendar"></i> {{date('d.m.Y',strtotime($post->created_at))}}</span>
            </div>
        </div>
        @endforeach

    </div>
</div>
