@php
    $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb_widget->rubric_id)->orderBy('level')->get();
    $parent_rubric = $parent_rubrics[0];
    $subparent_rubric = $parent_rubrics[1];
    $images = App\Models\UserFile::where('bb_id',$bb_widget->id)->orderBy('sort')->get();
    $title =$parent_rubric->title." ".$bb_widget->rubric->title_r." ".$bb_widget->vendor->name." ".$bb_widget->title;
    if (!isset($col)) $col='col-lg-4 col-12';
@endphp
<div class="{{$col}}">
    <div class="single-item-grid">
        <div class="image">
            @if (count($images)> 0)
                <a href="{{route('bb',['bb'=>$bb_widget])}}"><img
                        src="{{Storage::url($images[0]->resize(600, 400))}}" alt="{{$title}}"></a>
            @else
                <a href="{{route('bb',['bb'=>$bb_widget->id])}}"><img
                        src="http://placehold.it/600x400&text={{ $title }}" alt="{{ $title }}"></a>
            @endif
                @if (isset($bb_widget->status_bb->premium_status_days))
                    <i class=" cross-badge lni lni-bolt"></i>
                    <span class="flat-badge" style="background-color:#{{$bb_widget->status_bb->color_badge}}">{{$bb_widget->status_bb->badge_text}}</span>
                @endif
        </div>
        <div class="content">
            <a href="javascript:void(0)" class="tag">{{$subparent_rubric->title}}</a>
            <h3 class="title">
                <a href="{{route('bb',['bb'=>$bb_widget->id])}}">{{$title}} {{$bb_widget->id}}</a>
            </h3>
            <p class="location"><a href="{{route('location',$bb_widget->location->id)}}"><i class="lni lni-map-marker">
                    </i>{{$bb_widget->location->title}}</a></p>
            <ul class="info">
                <li class="price">{{$bb_widget->bbprice->price}} {{$bb_widget->bbprice->pricetype->type}}</li>
                <li class="like"><a href="javascript:void(0)"><i class="lni lni-heart"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
