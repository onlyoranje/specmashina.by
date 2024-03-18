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
            <a href="{{route('rubric',$sub_rubric->id)}}"><i class="lni lni-dinner"></i> {{$sub_rubric->title}}<span>{{count(Bb::whereIn('rubric_id',Rubric::descendantsAndSelf($sub_rubric->id)->pluck('id'))->get())}}</span></a>
        </li>
        @endforeach
    </ul>
</div>
@endif