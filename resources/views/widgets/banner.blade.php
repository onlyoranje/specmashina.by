<?php
$banner = \App\Models\Banner::all()->random();

?>
<div class="single-widget banner">
    <h3>Реклама</h3>
    <a href="javascript:void(0)">
        <img src="{{Storage::url($banner->image)}}" alt="#">
    </a>
</div>
