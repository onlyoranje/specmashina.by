@php
    $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
    $parent_rubric = $parent_rubrics[0];
    $subparent_rubric = $parent_rubrics[1];
    $images = App\Models\UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();

@endphp
<div class="image">
    @if (count($images)> 0)
        <a href="{{route('bb',['bb'=>$bb->id])}}"><img
                src="{{Storage::url($images[0]->resize(60, 60))}}" alt="{{ $bb->title }}"></a>
    @else
        <a href="{{route('bb',['bb'=>$bb->id])}}"><img
                src="http://placehold.it/60x60&text={{ $bb->id }}" alt="{{ $bb->title }}"></a>
    @endif
</div>
<a href="{{route('bb',['bb'=>$bb->id])}}" class="title">{{$parent_rubric->title}} {{$bb->rubric->title_r}} {{ $bb->vendor->name }} {{ $bb->title }}</a>
@if ($bb->status_bb->active=='Y')
<span class="time">{{$bb->bbstatistic_count}} просмотров</span>
@endif

@if ($bb->status_bb->status=='N')
    <div><a href="{{route('bb_edit',$bb->id)}}" class="btn btn-sm btn-secondary" >Исправить</a></div>
@endif
