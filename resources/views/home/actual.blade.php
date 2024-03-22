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
                                <div class="author-image">
                                    <a href="javascript:void(0)"><img src="assets/images/items-grid/author-1.jpg" alt="#">
                                        <span>Smith jeko</span></a>
                                </div>
                                <p class="sale">For Sale</p>
                            </div>
                        </div>
                        <div class="content">
                            <div class="top-content">
                                <a href="javascript:void(0)" class="tag">{{$bb->rubric->title}}</a>
                                <h3 class="title">
                                    <a href="item-details.html">{{$bb->vendor->name}} {{$bb->title}}</a>
                                </h3>
                                <p class="update-time">Last Updated: 1 hours ago</p>
                                <ul class="rating">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><a href="javascript:void(0)">(35)</a></li>
                                </ul>
                                <ul class="info-list">
                                    <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i> New York, US</a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-timer"></i> Feb 18, 2023</a></li>
                                </ul>
                            </div>
                            <div class="bottom-content">
                                <p class="price">Start From: <span>$200.00</span></p>
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
