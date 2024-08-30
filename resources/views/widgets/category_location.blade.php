<?php
use App\Models\Bb;
use App\Models\Rubric;
if (str_contains(url_parameters($request),'rubric') ) {

    $sub_rubrics = Rubric::where('parent_id',$request->rubric)->orderBy('sort')->get();
} else {
$sub_rubrics = Rubric::whereNull('parent_id')->orderBy('sort')->get();
}

  ?>

@if (count($sub_rubrics)>0)
    <div class="single-widget">
        <h3>Подкатегории</h3>
        <ul class="list">


            @foreach($sub_rubrics as $sub_rubric)

                <li>
                    <a href="{{route('location',$location->id)}}?rubric={{$sub_rubric->id}}"> {{$sub_rubric->title}}<span>
                @php
                $bbc = Bb::select('bbs.*')->
        Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->

        where('status_bbs.active','Y')->where('bbs.location_id',$location->id)->whereIn('rubric_id',Rubric::descendantsAndSelf($sub_rubric->id)->pluck('id'))->get();
                @endphp
                            {{count($bbc)}}
                        </span></a>
                </li>
            @endforeach
        </ul>
    </div>
    {{--
    @else
    @php($sub_rubrics = Rubric::where('parent_id',$rubric->parent_id)->orderBy('sort')->get())
        <div class="single-widget">
            <h3>Подкатегории</h3>
            <ul class="list">


                @foreach($sub_rubrics as $sub_rubric)

                    <li>
                        <a href="{{route('rubric',$sub_rubric->id)}}{{str_contains(url_parameters($request),'location')?url_parameters($request):''}}"
                           class="{{$sub_rubric->id==$rubric->id? 'active':'' }}" >--}}{{--<i class="lni lni-dinner"></i>--}}{{-- 6{{$sub_rubric->title}}<span>
                        {{count(Bb::select('bbs.*')->
            Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->

            where('status_bbs.active','Y')->whereIn('rubric_id',Rubric::descendantsAndSelf($sub_rubric->id)->pluck('id'))->where('bbs.location_id',$location->id)->get())}}</span></a>
                    </li>
                @endforeach
            </ul>
        </div>--}}
@endif
