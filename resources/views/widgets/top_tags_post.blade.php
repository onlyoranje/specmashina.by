<?php

use App\Models\Post;


$tags = Post::where('active','Y')->pluck('tags')->toArray();
$tags = implode(', ',$tags);
$tags = explode(',',$tags);
$tags = array_count_values($tags);
$tags = array_slice($tags, 0, 15);
arsort($tags);

?>
<!-- Start Single Widget -->
<div class="widget popular-tag-widget">
    <h5 class="widget-title"><span>Популярные теги</span></h5>
    <div class="tags">
        @foreach($tags as $tag=>$count)
        <a href="{{route('posts')}}?tag={{$tag}}">{{$tag}}</a>
        @endforeach
    </div>
</div>
<!-- End Single Widget -->
