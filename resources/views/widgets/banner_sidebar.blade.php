<?php
$banner = \App\Models\Banner::all()->random();
//if (!Auth::user()->isAdmin()){
$banner->update(['views'=>($banner->views+1)]);

?>
@if ($banner)
<div class="widget sidebar-as">
    <h5 class="widget-title"><span>Реклама</span></h5>
    <a href="{{route('banner',['banner'=>$banner->id])}}" target="_blank">
        <img src="{{Storage::url($banner->image)}}" alt="{{$banner->title}}">
    </a>
</div>
@endif
