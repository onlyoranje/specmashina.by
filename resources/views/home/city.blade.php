<section class="browse-cities section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Browse By Cities</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row ">
           @foreach($bbs_city as $key=>$city)

               @php
               if ($key<3)
                   $col='col-lg-4 col-md-4';
                else
                   $col='col-lg-6 col-md-6';

                @endphp
            <div class="{{$col}} col-12">
                <!-- Start Single City -->
                <div class="single-city wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <a href="category.html" class="info-box">
                        <div class="image">


                            @if ($city->image)
                                <img src="{{Storage::url($city->image->resize(635, 325))}}" alt="{{ $city->title }}">
                            @else
                                <img src="http://placehold.it/635x325&text={{ $city->title }}" alt="{{ $city->title }}">
                            @endif
                        </div>
                        <div class="content">
                            <h4 class="name">
                                {{$city->title}}
                                <span>Объявлений: {{$city->bbs_count}}</span>
                            </h4>
                        </div>
                        <div class="more-btn">
                            <i class="lni lni-circle-plus"></i>
                        </div>
                    </a>
                </div>
                <!-- Start Single City -->
            </div>
            @endforeach
           {{-- <div class="col-lg-4 col-md-4 col-12">
                <!-- Start Single City -->
                <div class="single-city wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                    <a href="category.html" class="info-box">
                        <div class="image">
                            <img src="assets/images/cities/img2.jpg" alt="#">
                        </div>
                        <div class="content">
                            <h4 class="name">
                                Philadelphia
                                <span>288 Ads</span>
                            </h4>
                        </div>
                        <div class="more-btn">
                            <i class="lni lni-circle-plus"></i>
                        </div>
                    </a>
                </div>
                <!-- Start Single City -->
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <!-- Start Single City -->
                <div class="single-city wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                    <a href="category.html" class="info-box">
                        <div class="image">
                            <img src="assets/images/cities/img3.jpg" alt="#">
                        </div>
                        <div class="content">
                            <h4 class="name">
                                Los Angeles
                                <span>95 Ads</span>
                            </h4>
                        </div>
                        <div class="more-btn">
                            <i class="lni lni-circle-plus"></i>
                        </div>
                    </a>
                </div>
                <!-- Start Single City -->
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Start Single City -->
                <div class="single-city wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <a href="category.html" class="info-box">
                        <div class="image">
                            <img src="assets/images/cities/img4.jpg" alt="#">
                        </div>
                        <div class="content">
                            <h4 class="name">
                                San Francisco
                                <span>355 Ads</span>
                            </h4>
                        </div>
                        <div class="more-btn">
                            <i class="lni lni-circle-plus"></i>
                        </div>
                    </a>
                </div>
                <!-- Start Single City -->
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <!-- Start Single City -->
                <div class="single-city wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                    <a href="category.html" class="info-box">
                        <div class="image">
                            <img src="assets/images/cities/img5.jpg" alt="#">
                        </div>
                        <div class="content">
                            <h4 class="name">
                                Newe Orleans
                                <span>76 Ads</span>
                            </h4>
                        </div>
                        <div class="more-btn">
                            <i class="lni lni-circle-plus"></i>
                        </div>
                    </a>
                </div>
                <!-- Start Single City -->
            </div>--}}
        </div>
    </div>
</section>
