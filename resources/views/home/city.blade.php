<section class="browse-cities section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Аренда и продажа техники по городам</h2>
                   {{-- <p class="wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>--}}
                </div>
            </div>
        </div>
        <div class="row ">
           @foreach($bbs_city as $key=>$city)

               @php
               if ($key<2)
                   $col='col-lg-6 col-md-6';
                else
                   $col='col-lg-4 col-md-4';

                @endphp
            <div class="{{$col}} col-12">
                <!-- Start Single City -->
                <div class="single-city wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <a href="{{route('location',$city->id)}}" class="info-box">
                        <div class="image">


                            @if ($city->image)
                                <img src="{{Storage::url($city->resizeImage($city->image,636,400))}}" alt="{{ $city->title }}">
                            @else
                                {{--<img src="http://placehold.it/635x325&text={{ $city->title }}" alt="{{ $city->title }}">--}}
                                {!! FakeImage(400,200,8,0,$city->title,'city.jpg') !!}
                            @endif
                        </div>
                        <div class="content">
                            <h4 class="name">
                                {{$city->title}}
                                <span>Объявлений: {{$city->bbs_count}}</span>
                            </h4>
                        </div>
                        <div class="more-btn">
                            <i class="fa-solid fa-city"></i>
                        </div>
                    </a>
                </div>
                <!-- Start Single City -->
            </div>
               @if ($key==4)
                    @break;
                @endif
            @endforeach

        </div>
    </div>
</section>
