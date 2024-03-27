<section class="items-grid section custom-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Актуальные объявления</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="single-head">
            <div class="row">
            @if (count($bbs_actual)>0)
                @foreach ($bbs_actual as $bb)
                    @php
                        $images = App\Models\UserFile::where('bb_id',$bb->id)->orderBy('sort')->get();

                        $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
                        $parent_rubric = $parent_rubrics[0];
                        $subparent_rubric = $parent_rubrics[1];



                    @endphp
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Grid -->
                    <div class="single-grid wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="image">
                            <a href="{{route('bb',['bb'=>$bb->id])}}" class="thumbnail">
                                @if (count($images)> 0)
                                    <img
                                            src="{{Storage::url($images[0]->resize(600, 400))}}" alt="{{ $bb->title }}">
                                @else
                                    <img
                                            src="http://placehold.it/600x400&text={{ $bb->title }}" alt="{{ $bb->title }}">
                                @endif
                            </a>

                            <div class="author">
                                @if ($bb->organization_id)
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="{{Storage::url($bb->user->organization->logo)}}" alt="{{$bb->user->organization->title}}">
                                        <span>{{$bb->user->organization->title}}</span></a>
                                </div>
                                @endif
                                <p class="sale">{{$parent_rubric->title}}</p>
                            </div>

                        </div>
                        <div class="content">
                            <div class="top-content">
                                <a href="{{route('rubric',$bb->rubric->id)}}" class="tag">{{$bb->rubric->title}}</a>
                                <h3 class="title">
                                    <a href="{{route('bb',['bb'=>$bb->id])}}">{{$bb->vendor->name}} {{$bb->title}}</a>
                                </h3>
                                <p class="update-time">Обновлено: {{timesince($bb->updated_at)}}</p>

                                <ul class="info-list">
                                    <li><a href="{{route('location',$bb->location->id)}}"><i class="lni lni-map-marker"></i> {{$bb->location->title}}, {{$bb->location->parent->title}}</a></li>

                                </ul>
                            </div>
                            <div class="bottom-content">
                                <p class="price">Цена: <span>{{$bb->bbprice->price}} {{$bb->bbprice->pricetype->type}}</span></p>
                                <a href="javascript:void(0)" class="like"><i class="lni lni-heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Grid -->
                </div>
                    @endforeach
            @endif
            </div>
        </div>
    </div>
</section>
