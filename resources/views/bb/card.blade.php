<div class="col-12 mb-3">
    <div class="card shadow p-4">
        <div class="row align-items-center">
            <aside class="col-md-3"><a href="#">
                    @if (count($bb->userfile)> 0)
                        <a href="{{route('bb',['bb'=>$bb->id])}}"></a><img
                            src="{{Storage::url($bb->userfile[0]->resize(320, 320))}}" alt="{{ $bb->title }}"></a>
                @else
                    <a href="{{route('bb',['bb'=>$bb->id])}}"><img
                            src="http://placehold.it/300x300&text={{ $bb->title }}" alt="{{ $bb->title }}"></a>
                @endif
            </aside>
            <?php
            $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
            $parent_rubric = $parent_rubrics[0];
            ?>
            <div class="col-md-6">
                <div class="info-main"><a href="{{route('bb',['bb'=>$bb->id])}}"
                                          class="h5 title">{{$parent_rubric->title}} {{$bb->rubric->title_r}}
                        <br>{{ $bb->vendor->name }} {{ $bb->title }}</a>

                    <div class="d-flex my-3">
                         <span class="small text-success ">
                            <span class="fas fa-map-marker me-1"></span>{{$bb->location->title}}, {{$bb->location->parent->title}}
                        </span>
                        {{--<span class="star fas fa-star text-warning me-1 ms-3"></span>

                        <span class="star fas fa-star text-warning me-1"></span>
                        <span class="star fas fa-star text-warning me-1"></span>
                        <span class="star fas fa-star text-warning me-1"></span>
                        <span class="star fas fa-star text-warning"></span>
                        <span class="badge badge-pill badge-gray ms-2">4.7</span>--}}

                    </div>
                    <p title="{{$bb->content}}">{{Illuminate\Support\Str::limit(strip_tags($bb->content),50)}}</p>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="d-flex align-items-center"><span
                        class="h5 mb-0 text-gray  me-2">{{$bb->bbprice->price}} </span><span
                        class="h6 mb-0 text-danger">{{$bb->bbprice->pricetype->type}}</span></div>
                @if ($bb->organization_id)
                    <span class="text-success small"><span class="fas fa-building me-1"></span>{{$bb->user->organization->title}}</span>
                @endif
                <div class="d-grid gap-2 mt-4"><a class="btn btn-tertiary btn-sm"
                                                  href="{{route('bb',['bb'=>$bb->id])}}">Подробно</a><a href="#"
                                                                                                        class="btn btn-tertiary btn-sm"><span
                            class="fa fa-heart me-1"></span>
                        Wishlist</a></div>
            </div>
        </div>
    </div>
</div>
