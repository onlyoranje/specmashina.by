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
                @php
                    $bbc = Bb::select('bbs.*')->
            Join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->

            where('status_bbs.active','Y')->where('bbs.location_id',$location->id)->whereIn('rubric_id',Rubric::descendantsAndSelf($sub_rubric->id)->pluck('id'))->get();
                @endphp
            @if (count($bbc)>0)
                <li>
                    <a href="{{route('location',$location->id)}}?rubric={{$sub_rubric->id}}"> {{$sub_rubric->title}}<span>

                            {{count($bbc)}}
                        </span></a>
                </li>
                @endif
            @endforeach
                @if (!empty($rubric->parent->id) and str_contains(url_parameters($request),'rubric'))

                        <li>
                            <a href="{{route('location',$location->id)}}?rubric={{$rubric->parent->id}}">
                                Вернуться в категорию "{{$rubric->parent->title}}"
                            </a>
                        </li>

                @else
                    @if (str_contains(url_parameters($request),'rubric'))

                            <li>
                                <a href="{{route('location',$location->id)}}">
                                    Показать весь список
                                </a>
                            </li>

                    @endif
                    @endif
        </ul>
    </div>
@else
    <div class="single-widget">



        <ul class="list">




            @if (!empty($rubric->parent->id) and str_contains(url_parameters($request),'rubric'))

                <li>
                    <a href="{{route('location',$location->id)}}?rubric={{$rubric->parent->id}}">
                        Вернуться в категорию "{{$rubric->parent->title}}"
                    </a>
                </li>


            @endif
        </ul>
    </div>

@endif
