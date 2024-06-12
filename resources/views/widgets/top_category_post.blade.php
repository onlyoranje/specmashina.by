<?php

use App\Models\Post;
use Illuminate\Support\Facades\DB;

$categories = Post::select('category', DB::raw('count(*) as total'))
    ->groupBy('category')
    ->get();

?>
<!-- Start Single Widget -->
<div class="widget categories-widget">
    <h5 class="widget-title"><span>Категории</span></h5>
    <ul class="custom">
        @foreach($categories as $category)
        <li>
            <a href="{{route('posts')}}">{{$category->category}}<span>{{$category->total}}</span></a>
        </li>
        @endforeach
    </ul>
</div>
<!-- End Single Widget -->
