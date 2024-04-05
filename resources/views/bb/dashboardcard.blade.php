@php
    $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
    $parent_rubric = $parent_rubrics[0];
    $subparent_rubric = $parent_rubrics[1];
    $images = App\Models\UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();

@endphp
<div class="image">
    @if (count($images)> 0)
        <a href="{{route('bb',['bb'=>$bb->id])}}"><img
                src="{{Storage::url($images[0]->resize(600, 400))}}" alt="{{ $bb->title }}"></a>
    @else
        <a href="{{route('bb',['bb'=>$bb->id])}}"><img
                src="http://placehold.it/600x400&text={{ $bb->id }}" alt="{{ $bb->title }}"></a>
    @endif
</div>
<a href="{{route('bb',['bb'=>$bb->id])}}" class="title">{{$parent_rubric->title}} {{$bb->rubric->title_r}} {{ $bb->vendor->name }} {{ $bb->title }}</a>
<span class="time">{{$bb->bbstatistic_count}} просмотров</span>
<span >стасту</span>
