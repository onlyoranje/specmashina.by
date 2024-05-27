@php
    if (!isset($col)) $col='col-lg-4 col-12';
@endphp
<div class="{{$col}}">
    <div class="single-item-grid">
        <div class="image">
            @if (count($bb_widget->images())> 0)
                <a href="{{route('bb',['bb'=>$bb_widget])}}"><img
                        src="{{Storage::url($bb_widget->images()[0]->resize(600, 400))}}" alt="{{$bb_widget->title()}}"></a>
            @else
                <a href="{{route('bb',['bb'=>$bb_widget->id])}}"><img
                        src="http://placehold.it/600x400&text={{ $title }}" alt="{{ $bb_widget->title() }}"></a>
            @endif
                @if (isset($bb_widget->status_bb->premium_status_days))
                    <i class=" cross-badge lni lni-bolt"></i>
                    <span class="flat-badge" style="background-color:#{{$bb_widget->status_bb->color_badge}}">{{$bb_widget->status_bb->badge_text}}</span>
                @endif
        </div>
        <div class="content">
            <a href="{{route('rubric',$bb_widget->subparent_rubric()->id)}}" class="tag">{{$bb_widget->parent_rubric()->title}} {{$bb_widget->subparent_rubric()->title_r}}</a>
            <h3 class="title">
                <a href="{{route('bb',['bb'=>$bb_widget->id])}}">{{$bb_widget->title()}} </a>
            </h3>
            <p class="location"><a href="{{route('location',$bb_widget->location->id)}}"><i class="lni lni-map-marker">
                    </i>{{$bb_widget->location->title}}</a></p>
            <ul class="info">
                <li class="price">{{$bb_widget->bbprice->price}} {{$bb_widget->bbprice->pricetype->type}}</li>
                @if (\Maize\Markable\Models\Bookmark::has($bb_widget, Auth::user()))
                <li class="like" data-bb-id="{{$bb_widget->id}}" data-bookmark="true">
                    <a>

                            <i class="fa-solid fa-bookmark"></i>
                    </a>
                </li>
                @else
                    <li class="like" data-bb-id="{{$bb_widget->id}}" data-bookmark="false">
                        <a>
                    <i class="fa-regular fa-bookmark"></i>
                        </a>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</div>
