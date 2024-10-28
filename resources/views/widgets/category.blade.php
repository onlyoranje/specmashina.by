<?php
use App\Models\Bb;
use App\Models\Rubric;
$sub_rubrics = Rubric::where('parent_id',$rubric->id)->orderBy('sort')->get();  ?>
@if (count($sub_rubrics)>0)
<div class="single-widget">
    <h3>Подкатегории</h3>
    <ul class="list">


        @foreach($sub_rubrics as $sub_rubric)

        <li>
            <a href="{{route('rubric',$sub_rubric->id)}}{{str_contains(url_parameters($request),'location')?url_parameters($request):''}}">{{--<i class="lni lni-dinner"></i>--}} {{$sub_rubric->title}}<span>
                    {{count(Bb::select('bbs.*')->
        Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->

        where('status_bbs.active','Y')->whereIn('rubric_id',Rubric::descendantsAndSelf($sub_rubric->id)->pluck('id'))->where(function($query)
        {
            global $request;
            if ($request->location) $query->where('location_id', $request->location );

                })->get())}}</span></a>
        </li>
        @endforeach
            @if (!empty($rubric->parent->id))

                <li>
                    @if (str_contains(url_parameters($request),'location'))
                    <a href="{{route('rubric',$rubric->parent->id)}}?location={{$request->location}}">
                        Вернуться в категорию "{{$rubric->parent->title}}"
                    </a>
                    @else
                        <a href="{{route('rubric',$rubric->parent->id)}}">
                            Вернуться в категорию "{{$rubric->parent->title}}"
                        </a>
                    @endif
                </li>


            @endif

    </ul>
</div>
@else

    <div class="single-widget">

        <ul class="list">

            @if (str_contains(url_parameters($request),'location'))
                <a href="{{route('rubric',$rubric->parent->id)}}?location={{$request->location}}">
                    Вернуться в категорию "{{$rubric->parent->title}}"
                </a>
            @else
                <a href="{{route('rubric',$rubric->parent->id)}}">
                    Вернуться в категорию "{{$rubric->parent->title}}"
                </a>
            @endif
        </ul>
    </div>
@endif


