<?php
$banner = \App\Models\Banner::inRandomOrder()->first();;
//if (!Auth::user()->isAdmin()){


?>
@if ($banner)
    @php($banner->update(['views'=>($banner->views+1)]))
<div class="single-widget banner">
    <h3>Реклама</h3>
    <a href="{{route('banner',['banner'=>$banner->id])}}" target="_blank">
        <img src="{{Storage::url($banner->image)}}" alt="{{$banner->title}}">
    </a>
</div>
@endif
<?
//}
?>
