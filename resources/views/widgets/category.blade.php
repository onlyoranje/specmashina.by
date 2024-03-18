<div class="single-widget">
    <h3>All Categories</h3>
    <ul class="list">
       @php
       $sub_rubrics = App\Models\Rubric::where('parent_id',$rubric->id)->orderBy('sort')->get();
       @endphp

        @foreach($sub_rubrics as $sub_rubric)
            {{--@dd($sub_rubric->bbs())--}}
        <li>
            <a href="javascript:void(0)"><i class="lni lni-dinner"></i> {{$sub_rubric->title}}<span>{{count($sub_rubric->bbs()->get())}}</span></a>
        </li>
        @endforeach
    </ul>
</div>
