@php
$parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
$parent_rubric = $parent_rubrics[0];
$subparent_rubric = $parent_rubrics[1];
$images = App\Models\UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();

@endphp
<div class="col-lg-12 col-md-12 col-12">
    <!-- Start Single Item -->
    <div class="single-item-grid" style="background-color: {{($bb->user->id==Auth::id()) ? '#ffeb3b30':''}}">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-7 col-12">
                <div class="image">


                        @if (count($images)> 0)
                            <a href="{{route('bb',['bb'=>$bb->id])}}"><img
                                    src="{{Storage::url($images[0]->resize(600, 400))}}" alt="{{ $bb->title }}"></a>
                        @else
                            <a href="{{route('bb',['bb'=>$bb->id])}}"><img
                                    src="http://placehold.it/600x400&text={{ $bb->id }}" alt="{{ $bb->title }}"></a>
                        @endif

                    @if (isset($bb->status_bb->premium_status_days))
              {{--      <i class=" cross-badge lni lni-bolt"></i>--}}
                    <span class="flat-badge" style="background-color:#{{$bb->status_bb->color_badge}}">{{$bb->status_bb->badge_text}}</span>
                            @endif
                </div>
            </div>
            <div class="col-lg-7 col-md-5 col-12">
                <div class="content">
                    <a href="javascript:void(0)" class="tag">{{$subparent_rubric->title}}</a>
                    <h3 class="title">
                        <a href="{{route('bb',['bb'=>$bb->id])}}">{{$parent_rubric->title}} {{$bb->rubric->title_r}} {{ $bb->vendor->name }} {{ $bb->title }}</a>
                    </h3>
                    <p class="location">
                        <a href="javascript:void(0)"><i class="lni lni-map-marker"></i>{{$bb->location->title}}, {{$bb->location->parent->title}}</a>
                    </p>
                    <p  class="location"><a><i class="fa-solid fa-calendar-days"></i>{{$bb->time_update()}}</a></p>
                    <ul class="info">
                        <li class="price">{{$bb->bbprice->price}} {{$bb->bbprice->pricetype->type}}</li>
                        {{$bb->like()}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Item -->
</div>


