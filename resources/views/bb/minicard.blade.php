<?php
$parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb_mc->rubric_id)->orderBy('level')->get();
$parent_rubric = $parent_rubrics[0];
?>
<div class="col-12 col-md-4 mt-3">
    <div class="card shadow">@if (count($bb_mc->userfile)> 0)
            <a href="{{route('bb',['bb'=>$bb_mc->id])}}"></a><img
                src="{{Storage::url($bb_mc->userfile[0]->resize(320, 320))}}" alt="{{ $bb_mc->title }}"></a>
        @else
            <a href="{{route('bb',['bb'=>$bb_mc->id])}}"><img
                    src="http://placehold.it/300x300&text={{ $bb_mc->title }}" alt="{{ $bb_mc->title }}"></a>
        @endif
        <div class="card-footer border-top border-gray-300 p-4"><a href="#" class="h5">{{$parent_rubric->title}} {{$bb_mc->rubric->title_r}}
                <br>{{ $bb_mc->vendor->name }} {{ $bb_mc->title }}</a>
            <h3 class="h6 fw-light text-gray mt-2"><span class="fas fa-map-marker me-1"></span>{{$bb->location->title}}, {{$bb->location->parent->title}}</h3>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <span
                    class="h5 mb-0 text-gray">{{$bb->bbprice->price}} <span
                        class="h6 mb-0 text-danger">{{$bb->bbprice->pricetype->type}}</span></span>
                <a class="btn btn-xs btn-tertiary" href="{{route('bb',['bb'=>$bb_mc->id])}}"> Подробно</a></div>
        </div>
    </div>

</div>
